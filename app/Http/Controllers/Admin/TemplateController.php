<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = Template::with('category')->latest()->paginate(10);
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
            'photos'      => 'required|array|min:3|max:5',
            'photos.*'    => 'image|mimes:jpg,jpeg,png,webp|max:2048', 
            'zip_file'    => 'required|file|mimes:zip|max:51200', 
            'is_active'   => 'nullable|boolean',
        ]);

        $templateSlug = Str::slug($request->name);

        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $photo) {
                $extension = $photo->getClientOriginalExtension();
                $fileName = $templateSlug . '-' . ($index + 1) . '.' . $extension;
                $photoPaths[] = $photo->storeAs('thumbnails', $fileName, 'public');
            }
        }

        $zipExtension = $request->file('zip_file')->getClientOriginalExtension();
        $zipName = $templateSlug . '.' . $zipExtension;
        $zipPath = $request->file('zip_file')->storeAs('templates', $zipName, 'private');

        Template::create([
            'name'        => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'photos'      => $photoPaths, 
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
            'photos'      => 'nullable|array|max:5', 
            'photos.*'    => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'zip_file'    => 'nullable|file|mimes:zip|max:51200',
            'is_active'   => 'nullable|boolean',
        ]);

        $templateSlug = Str::slug($request->name);

        $data = [
            'name'        => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'is_active'   => $request->has('is_active'), 
        ];

        if ($request->hasFile('photos')) {
            $existingPhotos = is_array($template->photos) ? $template->photos : [];
            foreach ($request->file('photos') as $index => $photo) {
                if (isset($existingPhotos[$index]) && Storage::disk('public')->exists($existingPhotos[$index])) {
                    Storage::disk('public')->delete($existingPhotos[$index]);
                }
                $extension = $photo->getClientOriginalExtension();
                $fileName = $templateSlug . '-' . ($index + 1) . '-' . time() . '.' . $extension;
                $existingPhotos[$index] = $photo->storeAs('thumbnails', $fileName, 'public');
            }
            ksort($existingPhotos);
            $data['photos'] = array_values($existingPhotos);
        }

        if ($request->hasFile('zip_file')) {
            Storage::disk('private')->delete($template->zip_path);
            
            $zipExtension = $request->file('zip_file')->getClientOriginalExtension();
            $zipName = $templateSlug . '.' . $zipExtension;
            $data['zip_path'] = $request->file('zip_file')->storeAs('templates', $zipName, 'private');
        }

        $template->update($data);

        return redirect()->route('admin.templates.index')
            ->with('success', 'Template berhasil diperbarui!');
    }

    public function destroy(Template $template)
    {
        if (is_array($template->photos)) {
            foreach ($template->photos as $photo) {
                Storage::disk('public')->delete($photo);
            }
        }
        Storage::disk('private')->delete($template->zip_path);
        
        $template->delete();

        return redirect()->route('admin.templates.index')
            ->with('success', 'Template berhasil dihapus!');
    }

    public function toggle(Template $template)
    {
        $template->update(['is_active' => !$template->is_active]);
        return back()->with('success', 'Status template diperbarui!');
    }
}