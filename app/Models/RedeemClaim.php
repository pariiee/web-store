<?php
// app/Models/RedeemClaim.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RedeemClaim extends Model
{
    protected $fillable = [
        'redeem_code_id',
        'user_id',
        'reward_type',
        'saldo_awarded',
        'stock_awarded',
        'data_stock',
    ];

    protected $casts = [
        'data_stock' => 'array',
    ];

    public function code()
    {
        return $this->belongsTo(RedeemCode::class, 'redeem_code_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}