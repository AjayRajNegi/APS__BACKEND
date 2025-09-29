<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;
        protected $fillable = [
        'name',
        'code',
        'country',
        'city',
        'location',
        'short_description',
        'description',
        'image_path',
        'published_at', 
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}
