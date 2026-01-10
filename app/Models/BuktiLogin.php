<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuktiLogin extends Model
{
    protected $fillable = [
        'user_id',
        'transaction_item_id',
        'item_id',
        'image_path',
        'email_akun',
        'nama_buyer',
        'tipe_akun',
        'durasi',
        'device',
        'lokasi',
        'penggunaan',
    ];

    /* ================= RELATION ================= */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactionItem()
    {
        return $this->belongsTo(TransactionItem::class);
    }

    public function claimGaransi()
    {
        return $this->hasOne(ClaimGaransi::class);
    }

    /* ================= SCOPE / HELPER ================= */

    // 🔥 bukti login hanya bisa diklaim max 30 hari
    public function scopeValidForGaransi($query)
    {
        return $query->where('created_at', '>=', now()->subDays(30));
    }

    public function isStillValid30Days(): bool
    {
        return $this->created_at
            && $this->created_at->greaterThanOrEqualTo(now()->subDays(30));
    }
}
