<?php

namespace App\Services;

use App\Models\DigitalKey;
use Illuminate\Support\Str;

class KeyService
{
    public function generateKey($productId, $count = 1)
    {
        for ($i = 0; $i < $count; $i++) {
            $keyValue = strtoupper(Str::random(4) . '-' . Str::random(4) . '-' . Str::random(4));
            
            DigitalKey::create([
                'product_id' => $productId,
                'key_value' => $keyValue,
                'status' => 'available',
            ]);
        }
    }

    public function getAvailableKeysCount($productId)
    {
        return DigitalKey::where('product_id', $productId)
            ->where('status', 'available')
            ->count();
    }

    public function getSoldKeysCount($productId)
    {
        return DigitalKey::where('product_id', $productId)
            ->where('status', 'sold')
            ->count();
    }
}