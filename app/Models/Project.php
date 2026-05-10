<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'user_id',
        'template_id',
        'name',
        'logo',
        'editor_data',
        'status',
    ];

    public function template()
    {
        return $this->belongsTo(Template::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
