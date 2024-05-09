<?php

namespace App\Models; // criando o model, nome das colunas no banco de dados(model de Veiculos) 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculos extends Model// chamando a classe veiculo que esta dentro da model 
{
    use HasFactory;//O modelo veiculos está usando o HasFactory que pode ser utilizado para criar instancias 

    protected $fillable = [
        'usuario_id',//atribuiu o nome da coluna no banco de dados como usuario_id
        'placa',//atribuiu o nome da coluna no banco de dados como placa
        'modelo',
        'cor',
        'marca',
        'email',
        'deleted_at'
    ];

}
