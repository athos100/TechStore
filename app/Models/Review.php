<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// Modelo responsável por representar as avaliações dos usuários para os produtos na aplicação. Ele define os atributos que podem ser preenchidos em massa, como o ID do usuário, o ID do produto, a classificação (rating) e o comentário, além de estabelecer as relações com o usuário que fez a avaliação e o produto avaliado. Esse modelo é essencial para permitir que os usuários compartilhem suas opiniões sobre os produtos, ajudando outros clientes a tomar decisões de compra informadas e fornecendo feedback valioso para os administradores da loja.

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
