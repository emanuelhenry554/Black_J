<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'categorie_id',
        'nom',
        'slug',
        'prix',
        'matiere',
        'description',
        'description_courte',
        'image',
        'edition_limitee',
        'nouveau',
        'stock',
        'dimensions',
        'caracteristiques',
        'is_featured',
        'is_new',
    ];

    protected $casts = [
        'edition_limitee' => 'boolean',
        'nouveau' => 'boolean',
        'is_featured' => 'boolean',
        'is_new' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'categorie_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function colors(): HasMany
    {
        return $this->hasMany(ProductColor::class);
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
