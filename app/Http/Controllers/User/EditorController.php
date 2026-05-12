<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EditorController extends Controller
{
    public function createProject(\App\Models\Template $template)
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $userId = $user->id;
        
        $existingProject = \App\Models\Project::where('user_id', $userId)
                                              ->where('template_id', $template->id)
                                              ->first();
                                              
        if (!$existingProject) {
            $projectCount = \App\Models\Project::where('user_id', $userId)->count();
            $tier = $user->tier ?? 'lite';
            $limit = $tier == 'lite' ? 1 : ($tier == 'pro' ? 3 : PHP_INT_MAX);
            
            if ($projectCount >= $limit) {
                $abandonedProject = \App\Models\Project::where('user_id', $userId)
                                      ->whereColumn('updated_at', 'created_at')
                                      ->first();
                                      
                if ($abandonedProject) {
                    $abandonedPath = storage_path("app/public/users/{$userId}/projects/{$abandonedProject->id}");
                    if (\Illuminate\Support\Facades\File::exists($abandonedPath)) {
                        \Illuminate\Support\Facades\File::deleteDirectory($abandonedPath);
                    }
                    $abandonedProject->delete();
                } else {
                    $limitMsg = $tier == 'lite' ? '1 website' : '3 website';
                    $upgradeMsg = $tier == 'lite' ? 'Pro atau Elite' : 'Elite';
                    return redirect()->back()->with('error', "Batas maksimal ($limitMsg) telah tercapai untuk tier " . ucfirst($tier) . ". Upgrade ke $upgradeMsg untuk membuat lebih banyak website.");
                }
            }
        }

        $project = \App\Models\Project::firstOrCreate(
            [
                'user_id' => $userId,
                'template_id' => $template->id,
            ],
            [
                'name' => 'Project - ' . $template->name,
                'status' => 'draft',
            ]
        );

        $templateSlug = \Illuminate\Support\Str::slug($template->name);
        $sourcePath = storage_path('app/public/previews/' . $templateSlug);
        $destPath = storage_path("app/public/users/{$userId}/projects/{$project->id}");

        if (!\Illuminate\Support\Facades\File::exists($destPath)) {
            \Illuminate\Support\Facades\File::makeDirectory($destPath, 0755, true, true);
            \Illuminate\Support\Facades\File::copyDirectory($sourcePath, $destPath);
        }

        return redirect()->route('user.editor', $project->id);
    }

    public function destroyProject(\App\Models\Project $project)
    {
        $userId = \Illuminate\Support\Facades\Auth::id();

        if ($project->user_id !== $userId) {
            abort(403, 'Unauthorized action.');
        }

        if ($project->is_published) {
            return redirect()->back()->with('error', 'Project yang sudah di-deploy tidak bisa dihapus. Silakan unpublish terlebih dahulu.');
        }

        $projectPath = storage_path("app/public/users/{$userId}/projects/{$project->id}");
        if (\Illuminate\Support\Facades\File::exists($projectPath)) {
            \Illuminate\Support\Facades\File::deleteDirectory($projectPath);
        }

        $project->delete();

        return redirect()->route('user.dashboard')->with('success', 'Project berhasil dihapus.');
    }

    public function resetProject(\App\Models\Project $project)
    {
        $userId = \Illuminate\Support\Facades\Auth::id();

        if ($project->user_id !== $userId) {
            abort(403, 'Unauthorized action.');
        }

        $template = $project->template;
        if (!$template) {
            return back()->with('error', 'Template asal tidak ditemukan.');
        }

        $templateSlug = \Illuminate\Support\Str::slug($template->name);
        $sourcePath = storage_path('app/public/previews/' . $templateSlug);
        $destPath = storage_path("app/public/users/{$userId}/projects/{$project->id}");

        if (!\Illuminate\Support\Facades\File::exists($sourcePath)) {
            return back()->with('error', 'Folder template sumber tidak ditemukan.');
        }

        \Illuminate\Support\Facades\File::deleteDirectory($destPath);
        \Illuminate\Support\Facades\File::makeDirectory($destPath, 0755, true, true);
        \Illuminate\Support\Facades\File::copyDirectory($sourcePath, $destPath);

        return redirect()->route('user.editor', $project->id)->with('success', 'Project berhasil direset ke template asal.');
    }

    public function show(\App\Models\Project $project)
    {
        if ($project->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $userId = $project->user_id;
        $destPath = storage_path("app/public/users/{$userId}/projects/{$project->id}");
        $indexPath = $destPath . '/index.html';

        if (!file_exists($indexPath)) {
            abort(404, 'Project index.html not found.');
        }

        $iframeUrl = asset("storage/users/{$userId}/projects/{$project->id}/index.html");

        return view('user.editor.index', compact('project', 'iframeUrl'));
    }

    public function load(\App\Models\Project $project)
    {
        if ($project->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $userId = $project->user_id;
        $destPath = storage_path("app/public/users/{$userId}/projects/{$project->id}");
        $indexPath = $destPath . '/index.html';

        if (!file_exists($indexPath)) {
            return response()->json([]);
        }

        $htmlContent = file_get_contents($indexPath);
        
        $bodyContent = '';
        if (preg_match('/<body[^>]*>(.*?)<\/body>/is', $htmlContent, $matches)) {
            $bodyContent = $matches[1];
        } else {
            $bodyContent = $htmlContent;
        }

        $gjsCss = '';
        if (preg_match('/<style id="gjs-custom-styles">(.*?)<\/style>/is', $htmlContent, $matches)) {
            $gjsCss = $matches[1];
        }

        return response()->json([
            'gjs-html' => trim($bodyContent),
            'gjs-css' => trim($gjsCss),
        ]);
    }

    public function save(Request $request, \App\Models\Project $project)
    {
        if ($project->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $data = json_decode($request->getContent(), true);
        $html = $data['html'] ?? '';

        if (empty($html)) {
            return response()->json(['error' => 'No HTML content provided'], 400);
        }

        $userId = $project->user_id;
        $indexPath = storage_path("app/public/users/{$userId}/projects/{$project->id}/index.html");

        if (!file_exists($indexPath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        file_put_contents($indexPath, $html);
        $project->touch();

        return response()->json(['message' => 'Project saved successfully']);
    }

    public function uploadImage(Request $request, \App\Models\Project $project)
    {
        if ($project->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'image' => 'required|image|max:5120',
        ]);

        $userId = $project->user_id;
        $destDir = "users/{$userId}/projects/{$project->id}/uploads";
        $path = $request->file('image')->store($destDir, 'public');
        $url = asset('storage/' . $path);

        return response()->json(['url' => $url]);
    }

    public function preview(\App\Models\Project $project)
    {
        // Implement later if needed
    }

    public function download(\App\Models\Project $project)
    {
        // Implement later if needed
    }

    public function publishProject(Request $request, \App\Models\Project $project)
    {
        $userId = \Illuminate\Support\Facades\Auth::id();

        if ($project->user_id !== $userId) {
            abort(403, 'Unauthorized action.');
        }

        // Merge JSON body if sent via fetch
        if ($request->isJson()) {
            $request->merge(json_decode($request->getContent(), true) ?? []);
        }

        $reservedNames = [
            'www', 'admin', 'api', 'mail', 'ftp', 'cpanel', 'webmail',
            'smtp', 'pop', 'imap', 'ns1', 'ns2', 'dns', 'cdn',
            'static', 'assets', 'img', 'media', 'download', 'app',
        ];

        $request->validate([
            'subdomain' => [
                'required',
                'string',
                'min:3',
                'max:30',
                'regex:/^[a-z0-9]([a-z0-9\-]*[a-z0-9])?$/',
                'not_in:' . implode(',', $reservedNames),
                Rule::unique('projects', 'subdomain')->ignore($project->id),
            ],
        ], [
            'subdomain.required' => 'Nama subdomain wajib diisi.',
            'subdomain.min' => 'Subdomain minimal 3 karakter.',
            'subdomain.max' => 'Subdomain maksimal 30 karakter.',
            'subdomain.regex' => 'Subdomain hanya boleh berisi huruf kecil, angka, dan tanda hubung (-).',
            'subdomain.not_in' => 'Nama subdomain ini tidak diperbolehkan.',
            'subdomain.unique' => 'Subdomain ini sudah digunakan oleh website lain.',
        ]);

        $project->update([
            'subdomain' => strtolower($request->subdomain),
            'is_published' => true,
            'status' => 'published',
        ]);

        $domain = config('app.main_domain', 'bisite.web.id');
        $url = "https://{$request->subdomain}.{$domain}";

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Published', 'url' => $url]);
        }

        return redirect()->back()->with('success', "Website berhasil dipublish di {$url}");
    }

    public function unpublishProject(\App\Models\Project $project)
    {
        $userId = \Illuminate\Support\Facades\Auth::id();

        if ($project->user_id !== $userId) {
            abort(403, 'Unauthorized action.');
        }

        $project->update([
            'is_published' => false,
            'status' => 'draft',
        ]);

        return redirect()->back()->with('success', 'Website berhasil di-unpublish.');
    }
}
