<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = [
        'category_id', 'name', 'photos', 'zip_path', 'description', 'is_active'
    ];

    protected $casts = [
        // 'photos' is now a string
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Helper: URL thumbnail
    public function getThumbnailUrlAttribute()
    {
        return asset('storage/' . $this->thumbnail);
    }
}