<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Project;

class SubdomainHandler
{
    protected $reservedSubdomains = [
        'www', 'admin', 'api', 'mail', 'ftp', 'cpanel', 'webmail',
        'smtp', 'pop', 'imap', 'ns1', 'ns2', 'dns', 'cdn',
        'static', 'assets', 'img', 'media', 'download', 'app',
    ];

    public function handle(Request $request, Closure $next)
    {
        $host = $request->getHost();
        $mainDomain = config('app.main_domain', 'bisite.web.id');

        // If it's the main domain or www, continue normally
        if ($host === $mainDomain || $host === 'www.' . $mainDomain || !str_ends_with($host, '.' . $mainDomain)) {
            return $next($request);
        }

        // Extract subdomain
        $subdomain = str_replace('.' . $mainDomain, '', $host);

        // Block reserved subdomains
        if (in_array($subdomain, $this->reservedSubdomains)) {
            return $next($request);
        }

        // Find project by subdomain
        $project = Project::where('subdomain', $subdomain)
                          ->where('is_published', true)
                          ->first();

        if (!$project) {
            abort(404, 'Website tidak ditemukan.');
        }

        // Determine the requested file path
        $requestPath = $request->path();
        if ($requestPath === '/' || $requestPath === '') {
            $requestPath = 'index.html';
        }

        // Security: prevent path traversal
        $requestPath = str_replace(['..', "\0"], '', $requestPath);

        $basePath = storage_path("app/public/users/{$project->user_id}/projects/{$project->id}");
        $filePath = realpath($basePath . '/' . $requestPath);

        // Ensure the resolved path is within the project directory
        if (!$filePath || !str_starts_with($filePath, realpath($basePath))) {
            abort(404);
        }

        if (!file_exists($filePath) || is_dir($filePath)) {
            abort(404);
        }

        // Determine MIME type
        $mimeTypes = [
            'html' => 'text/html',
            'htm'  => 'text/html',
            'css'  => 'text/css',
            'js'   => 'application/javascript',
            'json' => 'application/json',
            'png'  => 'image/png',
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif'  => 'image/gif',
            'svg'  => 'image/svg+xml',
            'webp' => 'image/webp',
            'ico'  => 'image/x-icon',
            'woff' => 'font/woff',
            'woff2'=> 'font/woff2',
            'ttf'  => 'font/ttf',
            'eot'  => 'application/vnd.ms-fontobject',
            'otf'  => 'font/otf',
            'mp4'  => 'video/mp4',
            'webm' => 'video/webm',
            'xml'  => 'application/xml',
            'txt'  => 'text/plain',
            'pdf'  => 'application/pdf',
        ];

        $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        $mime = $mimeTypes[$ext] ?? 'application/octet-stream';

        return response()->file($filePath, [
            'Content-Type' => $mime,
            'Cache-Control' => 'public, max-age=3600',
            'X-Powered-By' => 'BikinWebsite',
        ]);
    }
}
