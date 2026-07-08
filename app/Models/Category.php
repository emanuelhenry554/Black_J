<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'slug',
        'image',
        'description',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'categorie_id');
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset('img/sacs-blac-joyaux.jpg');
        }

        if (str_contains($this->image, '/')) {
            return asset('storage/' . $this->image);
        }

        return asset('img/' . $this->image);
    }
}
