<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image; 

class TemplateController extends Controller
{
    public function index(Request $request)
    {
        $query = Template::with('category');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $templates = $query->latest()->paginate(5)->withQueryString();
        
        return view('admin.templates.index', compact('templates'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.templates.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'photos'      => 'required|image|mimes:jpg,jpeg,png,webp',
            'zip_file'    => 'required|file|mimes:zip|max:51200', 
            'is_active'   => 'nullable|boolean',
        ]);

        $templateSlug = Str::slug($request->name);

        $photoPath = null;
        if ($request->hasFile('photos')) {
            $photo = $request->file('photos');
            $fileName = $templateSlug . '.webp'; 
            
            $destinationPath = storage_path('app/public/thumbnails');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            Image::make($photo->getRealPath())
                ->encode('webp', 80)
                ->save($destinationPath . '/' . $fileName);

            $photoPath = 'thumbnails/' . $fileName;
        }

        $zipPath = $this->processZipFile($request->file('zip_file'), $templateSlug);

        Template::create([
            'name'        => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'photos'      => $photoPath, 
            'zip_path'    => $zipPath,
            'is_active'   => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.templates.index')
            ->with('success', 'Template berhasil ditambahkan!');
    }

    public function edit(Template $template)
    {
        $categories = Category::all();
        return view('admin.templates.edit', compact('template', 'categories'));
    }

    public function update(Request $request, Template $template)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'photos'      => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'zip_file'    => 'nullable|file|mimes:zip|max:51200',
            'is_active'   => 'nullable|boolean',
        ]);

        $newSlug = Str::slug($request->name);
        $oldSlug = Str::slug($template->name);

        $data = [
            'name'        => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'is_active'   => $request->has('is_active'), 
        ];

        if ($request->hasFile('photos')) {
            if ($template->photos && Storage::disk('public')->exists($template->photos)) {
                Storage::disk('public')->delete($template->photos);
            }
            $photo = $request->file('photos');
            $fileName = $newSlug . '.webp';
            
            $destinationPath = storage_path('app/public/thumbnails');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            Image::make($photo->getRealPath())
                ->encode('webp', 80)
                ->save($destinationPath . '/' . $fileName);

            $data['photos'] = 'thumbnails/' . $fileName;
        }

        if ($request->hasFile('zip_file')) {
            if ($template->zip_path && Storage::disk('private')->exists($template->zip_path)) {
                Storage::disk('private')->delete($template->zip_path);
            }
            $data['zip_path'] = $this->processZipFile($request->file('zip_file'), $newSlug);
            if ($newSlug !== $oldSlug) {
                $oldPreviewPath = storage_path('app/public/previews/' . $oldSlug);
                if (File::exists($oldPreviewPath)) {
                    File::deleteDirectory($oldPreviewPath);
                }
            }
        } else {
            if ($newSlug !== $oldSlug) {
                $oldPreviewPath = storage_path('app/public/previews/' . $oldSlug);
                $newPreviewPath = storage_path('app/public/previews/' . $newSlug);
                
                if (File::exists($oldPreviewPath)) {
                    File::moveDirectory($oldPreviewPath, $newPreviewPath);
                }
            }
        }

        $template->update($data);

        return redirect()->route('admin.templates.index')
            ->with('success', 'Template berhasil diperbarui!');
    }

    public function destroy(Template $template)
    {
        $templateSlug = Str::slug($template->name);
        if ($template->photos && Storage::disk('public')->exists($template->photos)) {
            Storage::disk('public')->delete($template->photos);
        }
        if ($template->zip_path && Storage::disk('private')->exists($template->zip_path)) {
            Storage::disk('private')->delete($template->zip_path);
        }
        $previewPath = storage_path('app/public/previews/' . $templateSlug);
        if (File::exists($previewPath)) {
            File::deleteDirectory($previewPath);
        }
        $template->delete();
        return redirect()->route('admin.templates.index')
            ->with('success', 'Template berhasil dihapus!');
    }

    public function toggle(Template $template)
    {
        $template->update(['is_active' => !$template->is_active]);
        return back()->with('success', 'Status template diperbarui!');
    }

    private function processZipFile($uploadedFile, $templateSlug)
    {
        $zip = new \ZipArchive();
        if ($zip->open($uploadedFile->path()) === TRUE) {
            $tempExtractPath = storage_path('app/temp_extract_' . uniqid());
            $zip->extractTo($tempExtractPath);
            $zip->close();

            $extractedItems = File::directories($tempExtractPath);
            $extractedFiles = File::files($tempExtractPath);

            $sourcePath = $tempExtractPath;
            if (count($extractedItems) === 1 && count($extractedFiles) === 0) {
                $sourcePath = $extractedItems[0];
            }

            $previewPath = storage_path('app/public/previews/' . $templateSlug);
            
            if (File::exists($previewPath)) {
                File::deleteDirectory($previewPath);
            }
            File::makeDirectory($previewPath, 0755, true);
            
            File::copyDirectory($sourcePath, $previewPath);

            $newZipRelativePath = 'templates/' . $templateSlug . '.zip';
            $newZipAbsolutePath = Storage::disk('private')->path($newZipRelativePath);
            
            File::ensureDirectoryExists(dirname($newZipAbsolutePath));
            
            $newZip = new \ZipArchive();
            if ($newZip->open($newZipAbsolutePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === TRUE) {
                $files = new \RecursiveIteratorIterator(
                    new \RecursiveDirectoryIterator($sourcePath),
                    \RecursiveIteratorIterator::LEAVES_ONLY
                );

                foreach ($files as $name => $file) {
                    if (!$file->isDir()) {
                        $filePath = $file->getRealPath();
                        $relativePath = substr($filePath, strlen($sourcePath) + 1);
                        $relativePath = str_replace('\\', '/', $relativePath);
                        
                        $newZip->addFile($filePath, $templateSlug . '/' . $relativePath);
                    }
                }
                $newZip->close();
            }
            
            if (File::exists($tempExtractPath)) {
                File::deleteDirectory($tempExtractPath);
            }

            return $newZipRelativePath;
        }

        return $uploadedFile->storeAs('templates', $templateSlug . '.' . $uploadedFile->getClientOriginalExtension(), 'private');
    }
}