<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Modelo responsável por representar os pedidos realizados pelos usuários na aplicação. Ele define os atributos que podem ser preenchidos em massa e estabelece as relações com o usuário que fez o pedido e os itens do pedido. Esse modelo é essencial para gerenciar o histórico de compras dos usuários, processar pagamentos e fornecer informações detalhadas sobre cada pedido, como status, método de pagamento e endereço de entrega.
class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total',
        'status',
        'payment_method',
        'address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}