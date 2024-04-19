<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoas extends Model
{
    use HasFactory;

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
    ];
}
