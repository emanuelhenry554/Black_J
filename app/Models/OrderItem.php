<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_color',
        'quantity',
        'price_at_purchase',
        'taille',
    ];

    public function getQuantiteAttribute(): int
    {
        return $this->attributes['quantite'] ?? $this->attributes['quantity'] ?? 0;
    }

    public function getPrixUnitaireAttribute(): int
    {
        return $this->attributes['prix_unitaire'] ?? $this->attributes['price_at_purchase'] ?? 0;
    }

    public function getCouleurAttribute(): ?string
    {
        return $this->attributes['couleur'] ?? $this->attributes['product_color'] ?? null;
    }

    public function getTotalAttribute(): int
    {
        if (isset($this->attributes['total'])) {
            return $this->attributes['total'];
        }

        return ($this->attributes['quantity'] ?? 0) * ($this->attributes['price_at_purchase'] ?? 0);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
