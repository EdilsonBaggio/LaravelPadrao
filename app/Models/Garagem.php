<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garagem extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'qtd_vagas',
        'usuario_id',
        'deleted_at'
    ];
}
