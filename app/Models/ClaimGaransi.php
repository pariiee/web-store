<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClaimGaransi extends Model
{
    protected $fillable = [
        'user_id',
        'bukti_login_id',
        'transaction_item_id',
        'image_path',
        'tanggal_order',
        'tanggal_bermasalah',
        'sisa_durasi',
        'email_akun',
        'password_akun',
        'device',
        'lokasi',
        'penggunaan',
        'permasalahan',
        'note',
    ];

    protected $casts = [
        'tanggal_order' => 'date',
        'tanggal_bermasalah' => 'date',
    ];

    /* ================= RELATION ================= */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buktiLogin()
    {
        return $this->belongsTo(BuktiLogin::class);
    }

    public function transactionItem()
    {
        return $this->belongsTo(TransactionItem::class);
    }
}
