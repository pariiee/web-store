<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\TransactionItem;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'thumbnail',
        'required_fields',
        'is_active',
    ];

    protected $casts = [
        'required_fields' => 'array',
        'is_active'       => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });

        static::updating(function ($product) {
            if ($product->isDirty('name')) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /* =====================
     | RELATION
     ===================== */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    /**
     * 🔥 SEMUA ITEM TERJUAL UNTUK PRODUCT
     * products → items → transaction_items
     */
    public function transactionItems()
    {
        return $this->hasManyThrough(
            TransactionItem::class,
            Item::class,
            'product_id', // FK di items
            'item_id',    // FK di transaction_items
            'id',         // PK products
            'id'          // PK items
        );
    }
}
