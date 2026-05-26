<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'image',
        'image_2',
        'image_3',
        'brand',
        'manual_pdf',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getMainImageAttribute(): ?string
    {
        return $this->image ?: ($this->image_2 ?: $this->image_3);
    }

    public function getGalleryImagesAttribute(): array
    {
        return array_values(array_filter([
            $this->image,
            $this->image_2,
            $this->image_3,
        ]));
    }
}
