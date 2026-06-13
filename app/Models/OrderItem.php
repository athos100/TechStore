<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Modelo responsável por representar os itens de um pedido na aplicação. Ele define os atributos que podem ser preenchidos em massa e estabelece as relações com o pedido ao qual pertence e o produto associado. Esse modelo é crucial para detalhar cada item incluído em um pedido, permitindo calcular o subtotal de cada item com base na quantidade e no preço, além de fornecer informações essenciais para o processamento do pedido e a geração de relatórios de vendas se aplcabeis.
class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'subtotal'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}