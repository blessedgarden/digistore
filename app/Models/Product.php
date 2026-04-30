<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 'long_description',
        'price', 'subscription_period', 'stock', 'image', 'rating', 'reviews_count', 'featured'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function digitalKeys()
    {
        return $this->hasMany(DigitalKey::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function approvedReviews()
    {
        return $this->hasMany(Review::class)->where('status', Review::STATUS_APPROVED);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function recalculateRatingStats(): void
    {
        $approved = $this->approvedReviews();
        $count = (clone $approved->getQuery())->count();
        $avg = $count > 0 ? (float) (clone $approved->getQuery())->avg('rating') : 0;

        $this->forceFill([
            'reviews_count' => $count,
            'rating' => round($avg, 2),
        ])->save();
    }

    public function wasPurchasedBy(?User $user): bool
    {
        if (!$user) {
            return false;
        }

        return OrderItem::where('product_id', $this->id)
            ->whereHas('order', function ($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->whereIn('status', ['paid', 'completed']);
            })
            ->exists();
    }
}
