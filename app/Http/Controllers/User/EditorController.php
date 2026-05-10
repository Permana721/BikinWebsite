<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditorController extends Controller
{
    public function createProject(\App\Models\Template $template)
    {
        $userId = \Illuminate\Support\Facades\Auth::id();
        
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

        // Copy template folder to user's project folder if it doesn't exist
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

        // Delete the project's files from storage
        $projectPath = storage_path("app/public/users/{$userId}/projects/{$project->id}");
        if (\Illuminate\Support\Facades\File::exists($projectPath)) {
            \Illuminate\Support\Facades\File::deleteDirectory($projectPath);
        }

        // Delete the database record
        $project->delete();

        return redirect()->route('user.dashboard')->with('success', 'Project berhasil dihapus.');
    }

    /**
     * Reset project files back to the original template (useful if the project HTML was corrupted).
     */
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

        // Delete current project folder and re-copy from template
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
        
        // Extract <body> content
        $bodyContent = '';
        if (preg_match('/<body[^>]*>(.*?)<\/body>/is', $htmlContent, $matches)) {
            $bodyContent = $matches[1];
        } else {
            $bodyContent = $htmlContent;
        }

        // Extract custom GrapesJS CSS if previously saved
        $gjsCss = '';
        if (preg_match('/<style id="gjs-custom-styles">(.*?)<\/style>/is', $htmlContent, $matches)) {
            $gjsCss = $matches[1];
        }

        return response()->json([
            'gjs-html' => trim($bodyContent),
            'gjs-css' => trim($gjsCss),
        ]);
    }

    /**
     * Save the full HTML content from the inline editor.
     * Since we load the template as-is in an iframe, the HTML comes back
     * complete — no need for complex parsing or script preservation.
     */
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

    /**
     * Upload an image for the inline editor (image replacement feature).
     */
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

    /**
     * Update the project name (title).
     */
    public function updateName(Request $request, \App\Models\Project $project)
    {
        if ($project->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $project->update(['name' => $request->name]);

        return response()->json(['message' => 'Nama project berhasil diperbarui', 'name' => $project->name]);
    }

    /**
     * Upload or replace the project logo.
     */
    public function uploadLogo(Request $request, \App\Models\Project $project)
    {
        if ($project->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'logo' => 'required|image|max:2048',
        ]);

        $userId = $project->user_id;

        // Delete old logo if exists
        if ($project->logo && \Illuminate\Support\Facades\Storage::disk('public')->exists($project->logo)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($project->logo);
        }

        $destDir = "users/{$userId}/projects/{$project->id}";
        $path = $request->file('logo')->store($destDir, 'public');
        $project->update(['logo' => $path]);

        return response()->json([
            'message' => 'Logo berhasil diupload',
            'url' => asset('storage/' . $path),
        ]);
    }

    /**
     * Remove the project logo.
     */
    public function removeLogo(\App\Models\Project $project)
    {
        if ($project->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($project->logo && \Illuminate\Support\Facades\Storage::disk('public')->exists($project->logo)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($project->logo);
        }

        $project->update(['logo' => null]);

        return response()->json(['message' => 'Logo berhasil dihapus']);
    }
}
