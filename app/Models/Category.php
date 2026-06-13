<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Modelo responsável por representar as categorias de produtos na aplicação. Ele define os atributos que podem ser preenchidos em massa e estabelece a relação com os produtos, permitindo que cada categoria tenha vários produtos associados. Esse modelo é fundamental para organizar o catálogo de produtos e facilitar a navegação dos usuários pelas diferentes categorias disponíveis na loja.
class Category extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}