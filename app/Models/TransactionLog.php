<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionLog extends Model
{
    protected $fillable = [
        'user_id',
        'transaction_id',
        'transfer_id',
        'description',
        'amount',
        'type',
        'metadata' // hanya ini yang ada
    ];

    protected $casts = [
        'amount' => 'integer',
        'metadata' => 'array'
    ];

    // Type constants - TAMBAHKAN TYPE_ADJUSTMENT
    const TYPE_PURCHASE = 'purchase';
    const TYPE_TOPUP = 'topup';
    const TYPE_REDEEM = 'redeem';
    const TYPE_TRANSFER_OUT = 'transfer_out';
    const TYPE_TRANSFER_IN = 'transfer_in';
    const TYPE_ADJUSTMENT = 'adjustment';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transfer()
    {
        return $this->belongsTo(TransferTransaction::class, 'transfer_id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}