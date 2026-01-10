<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    protected $fillable = [
        'transaction_id',
        'item_id',
        'unit_price',
        'quantity',
        'delivered_data',
    ];

    protected $casts = [
        'delivered_data' => 'array',
    ];

    /* =====================
     | RELATION
     ===================== */

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function buktiLogins()
    {
        return $this->hasMany(BuktiLogin::class);
    }

    /* =====================
     | HELPER / SCOPE
     ===================== */

    // 🔥 item hanya tampil max 24 jam untuk bukti login
    public function scopeValidForBuktiLogin($query)
    {
        return $query->where('created_at', '>=', now()->subHours(24));
    }

    public function isStillValid24Hours(): bool
    {
        return $this->created_at
            && $this->created_at->greaterThanOrEqualTo(now()->subHours(24));
    }

    public function belongsToUser(int $userId): bool
    {
        return $this->transaction
            && $this->transaction->user_id === $userId;
    }
}
