<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'user_id',
        'template_id',
        'name',
        'subdomain',
        'editor_data',
        'status',
        'is_published',
    ];

    public function template()
    {
        return $this->belongsTo(Template::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getSubdomainSuggestionAttribute()
    {
        if ($this->subdomain) return $this->subdomain;

        $indexPath = storage_path("app/public/users/{$this->user_id}/projects/{$this->id}/index.html");

        if (!file_exists($indexPath)) return '';

        $html = file_get_contents($indexPath, false, null, 0, 2048);

        if (preg_match('/<title[^>]*>(.*?)<\/title>/is', $html, $matches)) {
            $title = trim($matches[1]);
            $slug = strtolower($title);
            $slug = preg_replace('/[^a-z0-9\s\-]/', '', $slug);
            $slug = preg_replace('/\s+/', '-', $slug);
            $slug = preg_replace('/-+/', '-', $slug);
            $slug = trim($slug, '-');
            $slug = substr($slug, 0, 30);

            return strlen($slug) >= 3 ? $slug : '';
        }

        return '';
    }
}
