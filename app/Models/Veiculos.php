<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculos extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'placa',
        'modelo',
        'cor',
        'marca',
        'email',
        'garagem_id',
        'deleted_at',
    ];

}
