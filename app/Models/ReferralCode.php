<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount_amount',
        'is_active',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime', // ✅ Tempat yang benar untuk casting
    ];
}
