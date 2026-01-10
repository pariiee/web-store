<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TopupTransaction extends Model
{
    protected $fillable = [
        'user_id',
        'transaction_id',
        'amount',
        'unique_code',
        'total_amount',
        'qr_string',
        'qr_url',
        'status',
        'expired_at',
        'paid_at',
    ];

    protected $casts = [
        'expired_at' => 'datetime',
        'paid_at'    => 'datetime',
    ];

    protected $attributes = [
        'status' => 'pending',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
