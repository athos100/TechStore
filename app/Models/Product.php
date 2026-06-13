<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Modelo responsável por representar os produtos disponíveis para venda na aplicação, ele define os atributos que podem ser preenchidos em massa, como nome, descrição, preço, estoque e imagens, além de estabelecer as relações com a categoria a que pertence, os itens de pedido associados e as avaliações dos usuários. Esse modelo é fundamental para gerenciar o catálogo de produtos, permitindo que os administradores adicionem, editem ou removam produtos, e que os usuários visualizem detalhes e façam compras.
class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'is_active',
        'image',
        'image_2',
        'image_3',
        'brand',
        'manual_pdf',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

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
