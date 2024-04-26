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
        'verificacao_email',
        'telefone',
        'data_nascimento',
        'cpf',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
