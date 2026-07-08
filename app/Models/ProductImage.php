<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'path', 'is_primary'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getImageUrlAttribute()
    {
        if (!$this->path) {
            return asset('img/sacs-blac-joyaux.jpg');
        }

        if (str_contains($this->path, '/')) {
            return asset('storage/' . $this->path);
        }

        return asset('img/' . $this->path);
    }
}
