<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// Modelo responsável por representar os usuários da aplicação, ele define os atributos que podem ser preenchidos em massa, os atributos que devem ser ocultados na serialização e os tipos de dados que devem ser convertidos. Além disso, estabelece as relações com os pedidos e avaliações feitas pelos usuários. Esse modelo é fundamental para gerenciar a autenticação, autorização e o perfil dos usuários, permitindo que eles façam compras, deixem avaliações e acessem suas informações pessoais de forma segura.
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Atributos que podem ser atribuidos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * Atributos que devem ficar ocultos na serializacao.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Atributos que devem ser convertidos (cast).
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
