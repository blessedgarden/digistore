<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = [
        'code', 'description', 'discount_amount', 'discount_percent',
        'max_uses', 'current_uses', 'expires_at', 'active'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];
}