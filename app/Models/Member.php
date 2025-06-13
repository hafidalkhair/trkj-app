<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'nim',
        'position',
        'profile_image',
        'study_program',
        'hobbies',
        'status',
        'social_media_links',
        'favorite_quote',
        'display_order',
    ];

    protected $casts = [
        'social_media_links' => 'array',
    ];
}
