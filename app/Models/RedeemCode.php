<?php
// app/Models/RedeemCode.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RedeemCode extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'code',
        'type',
        'distribution_type',
        'item_id',
        'total_saldo',
        'max_users',
        'per_user_saldo',
        'total_stock',
    ];

    protected $casts = [
        'per_user_saldo' => 'array',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function claims()
    {
        return $this->hasMany(RedeemClaim::class);
    }
    
    public function getStatusAttribute()
    {
        $claimed = $this->claims()->count();
        
        if ($this->type === 'saldo') {
            return $claimed >= $this->max_users ? 'Habis' : 'Tersedia';
        } else {
            return $claimed >= $this->total_stock ? 'Habis' : 'Tersedia';
        }
    }
    
    public function getRemainingQuotaAttribute()
    {
        $claimed = $this->claims()->count();
        
        if ($this->type === 'saldo') {
            return $this->max_users - $claimed;
        } else {
            return $this->total_stock - $claimed;
        }
    }
    
    // Accessor untuk nominal per user (rata)
    public function getNominalPerUserAttribute()
    {
        if ($this->distribution_type === 'rata' && !empty($this->per_user_saldo)) {
            return $this->per_user_saldo[0] ?? 0;
        }
        return 0;
    }
    
    // Accessor untuk total saldo yang sudah dibagikan
    public function getTotalDistributedAttribute()
    {
        if ($this->type === 'saldo' && !empty($this->per_user_saldo)) {
            return array_sum($this->per_user_saldo);
        }
        return 0;
    }
    
    // Accessor untuk mendapatkan sisa saldo yang tidak terbagi (hanya untuk acak)
    public function getRemainingSaldoAttribute()
    {
        if ($this->type === 'saldo' && $this->distribution_type === 'acak') {
            return $this->total_saldo - $this->total_distributed;
        }
        return 0;
    }
    
    // Accessor untuk total saldo yang seharusnya keluar
    public function getExpectedTotalAttribute()
    {
        if ($this->type === 'saldo') {
            if ($this->distribution_type === 'rata') {
                // RATA: nominal per user × max_users
                return $this->nominal_per_user * $this->max_users;
            } else {
                // ACAK: total_saldo
                return $this->total_saldo;
            }
        }
        return 0;
    }
}