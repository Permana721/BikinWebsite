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
        $baseUrl = url("storage/users/{$userId}/projects/{$project->id}/");

        $styles = [];
        $scripts = [];
        $htmlContent = '';
        $bodyContent = '';
        $gjsCss = '';

        if (file_exists($indexPath)) {
            $htmlContent = file_get_contents($indexPath);
            
            // Extract external CSS stylesheets - more robust regex
            preg_match_all('/<link[^>]+rel=["\']stylesheet["\'][^>]*href=["\']([^"\']+)["\'][^>]*>/i', $htmlContent, $matches);
            // Also try the other way around: href then rel
            preg_match_all('/<link[^>]+href=["\']([^"\']+)["\'][^>]*rel=["\']stylesheet["\']/i', $htmlContent, $matches2);
            
            $allCssMatches = array_unique(array_merge($matches[1] ?? [], $matches2[1] ?? []));

            if (!empty($allCssMatches)) {
                foreach ($allCssMatches as $cssPath) {
                    if (!preg_match('~^(?:f|ht)tps?://|^//~i', $cssPath)) {
                        $styles[] = rtrim($baseUrl, '/') . '/' . ltrim($cssPath, '/');
                    } else {
                        $styles[] = $cssPath;
                    }
                }
            }

            // Extract ALL external JS scripts (src attribute) in document order.
            // Protocol-relative URLs (//cdn.example.com/...) are prefixed with https:.
            // Duplicates are removed while preserving order (jQuery must come before plugins).
            preg_match_all('/<script[^>]+src=["\']([^"\']+)["\'][^>]*>/i', $htmlContent, $jsMatches);
            $seenScripts = [];
            if (!empty($jsMatches[1])) {
                foreach ($jsMatches[1] as $jsPath) {
                    if (preg_match('~^(?:f|ht)tps?://~i', $jsPath)) {
                        $absUrl = $jsPath;
                    } elseif (preg_match('~^//~', $jsPath)) {
                        $absUrl = 'https:' . $jsPath;
                    } else {
                        $absUrl = rtrim($baseUrl, '/') . '/' . ltrim($jsPath, '/');
                    }
                    if (!in_array($absUrl, $seenScripts)) {
                        $seenScripts[] = $absUrl;
                        $scripts[] = $absUrl;
                    }
                }
            }

            // Extract <body> attributes and content
            $bodyAttributes = '';
            if (preg_match('/<body([^>]*)>(.*?)<\/body>/is', $htmlContent, $matches)) {
                $bodyAttributes = trim($matches[1]);
                $bodyContent = trim($matches[2]);
            } else {
                $bodyContent = trim($htmlContent);
            }

            // Parse body attributes into an associative array for GrapesJS
            $bodyAttrsArray = [];
            if ($bodyAttributes) {
                preg_match_all('/([a-z0-9\-]+)=(["\'])(.*?)\2/i', $bodyAttributes, $attrMatches);
                foreach ($attrMatches[1] as $i => $attrName) {
                    $bodyAttrsArray[$attrName] = $attrMatches[3][$i];
                }
            }

            // ---------------------------------------------------------------
            // NOTE: We do NOT move head inline <style> blocks into gjsCss.
            // They remain in <head> and are rendered by the canvas correctly.
            // Moving them would cause duplication on every save cycle.
            // ---------------------------------------------------------------

            // Extract custom GrapesJS CSS if previously saved
            if (preg_match('/<style id="gjs-custom-styles">(.*?)<\/style>/is', $htmlContent, $matches)) {
                $gjsCss .= "\n" . trim($matches[1]);
                $bodyContent = preg_replace('/<style id="gjs-custom-styles">.*?<\/style>/is', '', $bodyContent);
            }

            // Also extract inline <style> blocks from BODY content and move to gjsCss
            if (preg_match_all('/<style[^>]*>(.*?)<\/style>/is', $bodyContent, $bodyStyleMatches)) {
                foreach ($bodyStyleMatches[1] as $inlineStyle) {
                    $gjsCss .= "\n" . trim($inlineStyle);
                }
                // Remove <style> tags from body so GrapesJS doesn't get confused
                $bodyContent = preg_replace('/<style[^>]*>.*?<\/style>/is', '', $bodyContent);
            }

            // ---------------------------------------------------------------
            // Extract inline <script> blocks from BODY (no src attribute).
            // These contain things like Google Maps init, text rotator config, etc.
            // We pass them to the view as $inlineBodyScripts so the editor can
            // inject them as Blob URL scripts into the canvas after jQuery loads.
            // ---------------------------------------------------------------
            $inlineBodyScripts = [];
            if (preg_match_all('/<script(?![^>]*\bsrc\b)[^>]*>([\s\S]*?)<\/script>/is', $bodyContent, $inlineMatches)) {
                foreach ($inlineMatches[1] as $inlineCode) {
                    $trimmed = trim($inlineCode);
                    if (!empty($trimmed)) {
                        $inlineBodyScripts[] = $trimmed;
                    }
                }
            }

            // Strip ALL <script> tags from body — GrapesJS cannot render them as components.
            // (Inline scripts are preserved in $inlineBodyScripts; external scripts
            //  are loaded via canvas.scripts. Both are re-injected by the editor view.)
            $bodyContent = preg_replace('/<script\b[^>]*>[\s\S]*?<\/script>/is', '', $bodyContent);

            // Strip preloader divs — also hidden via protectedCss, but removing from
            // body keeps the GrapesJS component tree clean.
            $bodyContent = preg_replace('/<div[^>]+id=["\']fh5co-loader["\'][^>]*>[\s\S]*?<\/div>/is', '', $bodyContent);
            $bodyContent = preg_replace('/<div[^>]+id=["\']loader["\'][^>]*>[\s\S]*?<\/div>/is', '', $bodyContent);
            $bodyContent = preg_replace('/<div[^>]+class=["\'][^"\']*preloader[^"\']*["\'][^>]*>[\s\S]*?<\/div>/is', '', $bodyContent);
            $bodyContent = preg_replace('/<div[^>]+class=["\'][^"\']*loader-wrap[^"\']*["\'][^>]*>[\s\S]*?<\/div>/is', '', $bodyContent);


            // ---------------------------------------------------------------
            // Convert ALL relative asset paths to absolute URLs
            // ---------------------------------------------------------------
            $absBase = rtrim($baseUrl, '/') . '/';

            // Function to make a path absolute
            $makeAbsolute = function ($path) use ($absBase) {
                if (empty($path) || preg_match('~^(?:f|ht)tps?://|^//|^data:|^#|^mailto:|^tel:~i', $path)) {
                    return $path;
                }
                return $absBase . ltrim($path, '/');
            };

            // Handle src attributes in any tag
            $bodyContent = preg_replace_callback(
                '/\b(src|href|data-src|data-bg|poster)=["\']([^"\'#][^"\']*?)["\']/i',
                function ($m) use ($makeAbsolute) {
                    return $m[1] . '="' . $makeAbsolute($m[2]) . '"';
                },
                $bodyContent
            );

            // Handle srcset attributes
            $bodyContent = preg_replace_callback(
                '/\bsrcset=["\']([^"\']+)["\']/i',
                function ($m) use ($absBase) {
                    $parts = explode(',', $m[1]);
                    $newParts = array_map(function ($part) use ($absBase) {
                        $trimmed = trim($part);
                        if (empty($trimmed)) return $trimmed;
                        $subParts = preg_split('/\s+/', $trimmed, 2);
                        $url = $subParts[0];
                        if (!preg_match('~^(?:f|ht)tps?://|^//|^data:~i', $url)) {
                            $url = $absBase . ltrim($url, '/');
                        }
                        return $url . (isset($subParts[1]) ? ' ' . $subParts[1] : '');
                    }, $parts);
                    return 'srcset="' . implode(', ', $newParts) . '"';
                },
                $bodyContent
            );

            // CSS background-image in inline styles
            $bodyContent = preg_replace_callback(
                '/(\bbackground(?:-image)?\s*:\s*url\(["\']?)([^"\')\s]+?)(["\']?\))/i',
                function ($m) use ($makeAbsolute) {
                    return $m[1] . $makeAbsolute($m[2]) . $m[3];
                },
                $bodyContent
            );

            // Convert relative url() paths inside gjsCss as well
            $gjsCss = preg_replace_callback(
                '/(url\(["\']?)([^"\')\s]+?)(["\']?\))/i',
                function ($m) use ($makeAbsolute) {
                    return $m[1] . $makeAbsolute($m[2]) . $m[3];
                },
                $gjsCss
            );

        } else {
            abort(404, 'Project index.html not found.');
        }

        return view('user.editor.index', compact(
            'project', 'styles', 'scripts', 'inlineBodyScripts',
            'baseUrl', 'bodyContent', 'gjsCss', 'bodyAttrsArray'
        ));
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

    public function save(Request $request, \App\Models\Project $project)
    {
        if ($project->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $data = json_decode($request->getContent(), true);
        $gjsHtml = $data['gjs-html'] ?? '';
        $gjsCss = $data['gjs-css'] ?? '';

        $userId = $project->user_id;
        $destPath = storage_path("app/public/users/{$userId}/projects/{$project->id}");
        $indexPath = $destPath . '/index.html';

        if (!file_exists($indexPath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        $htmlContent = file_get_contents($indexPath);

        // ---------------------------------------------------------------
        // CRITICAL: Preserve all <script> tags from the original body.
        // GrapesJS strips scripts from the HTML it manages, so we must
        // extract them from the CURRENT file and re-inject after saving,
        // otherwise every save permanently deletes all JavaScript.
        // ---------------------------------------------------------------
        $preservedScripts = '';
        $currentBodyContent = '';
        if (preg_match('/<body[^>]*>(.*?)<\/body>/is', $htmlContent, $bodyMatch)) {
            $currentBodyContent = $bodyMatch[1];
        }
        // Extract all <script> blocks (both inline and external src) from the current body
        if (preg_match_all('/<script\b[^>]*>.*?<\/script>/is', $currentBodyContent, $scriptMatches)) {
            // Filter out the gjs-custom-styles marker script if any
            $preservedScripts = implode("\n", $scriptMatches[0]);
        }

        // Replace everything inside <body> with GrapesJS output + original scripts
        $newBody = "\n" . trim($gjsHtml) . (empty($preservedScripts) ? '' : "\n\n" . $preservedScripts) . "\n";
        $htmlContent = preg_replace(
            '/(<body[^>]*>)(.*?)(<\/body>)/is',
            '${1}' . $newBody . '${3}',
            $htmlContent
        );

        // Inject custom CSS into <head> (remove old one first to avoid duplication)
        $htmlContent = preg_replace('/<style id="gjs-custom-styles">.*?<\/style>/is', '', $htmlContent);
        if (!empty($gjsCss)) {
            $styleBlock = "<style id=\"gjs-custom-styles\">\n" . trim($gjsCss) . "\n</style>\n";
            $htmlContent = preg_replace('/<\/head>/i', $styleBlock . '</head>', $htmlContent);
        }

        file_put_contents($indexPath, $htmlContent);

        $project->touch();

        return response()->json(['message' => 'Project saved successfully']);
    }

    public function preview(\App\Models\Project $project)
    {
        // Implement later if needed
    }

    public function download(\App\Models\Project $project)
    {
        // Implement later if needed
    }
}
