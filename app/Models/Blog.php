<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'excerpt',
        'content',
        'published_at', 
    ];

    protected $casts = [
        'content' => 'array',
        'published_at' => 'datetime',
    ];
}
