<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandSetting extends Model
{
    protected $fillable = [
        'nom',
        'email',
        'telephone',
        'adresse',
        'logo_path',
        'banniere_path',
        'mission',
        'vision',
        'facebook',
        'instagram',
        'tiktok',
        'youtube',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];
}
