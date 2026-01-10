<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemStock extends Model
{
    protected $fillable = [
        'item_id',
        'data',
    ];

    protected $casts = [
        'data' => 'array'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
