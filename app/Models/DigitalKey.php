<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DigitalKey extends Model
{
    protected $fillable = ['product_id', 'order_item_id', 'key_value', 'status', 'used_at'];

    protected $casts = [
        'used_at' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }
}