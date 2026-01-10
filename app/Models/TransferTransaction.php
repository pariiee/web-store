<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransferTransaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'amount',
        'status',
        'note',
        'admin_fee',
        'total_deducted',
        'transfer_date'
    ];

    protected $casts = [
        'amount' => 'integer',
        'admin_fee' => 'integer',
        'total_deducted' => 'integer',
        'transfer_date' => 'datetime'
    ];

    // Relationships
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    // Status constants
    const STATUS_SUCCESS = 'success';
    const STATUS_PENDING = 'pending';
    const STATUS_FAILED = 'failed';

    // Admin fee percentage (0.5%)
    const ADMIN_FEE_PERCENTAGE = 0.5;

    // Calculate admin fee
    public static function calculateAdminFee($amount)
    {
        return ceil($amount * (self::ADMIN_FEE_PERCENTAGE / 100));
    }

    // Calculate total deducted
    public static function calculateTotalDeducted($amount)
    {
        $adminFee = self::calculateAdminFee($amount);
        return $amount + $adminFee;
    }
}