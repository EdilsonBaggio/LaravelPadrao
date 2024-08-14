<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pessoas extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'telefone',
        'data_nascimento',
        'cpf',
        'password',
        'deleted_at'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];
}
