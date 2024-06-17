<?php

namespace App\Models;//Model de Pessoas

use Illuminate\Foundation\Auth\User as Authenticatable;//Importa a clase user(a classe user é uma base fornecida pelo laravel para autenticação de usuários,obtendo funcionalidades como: login,logout) do laravel e a renomeia como Authenticatable
use Illuminate\Notifications\Notifiable;//Importa o trait notifiable do laravel(reutilizaçãode código no PHP)

class Pessoas extends Authenticatable//Classe pessoas herda todos metodos e propriedades de user
{
    use Notifiable;

    protected $fillable = [//Cria nome das colunas no banco de dados
        'name',//atribuiu o nome da coluna no banco de dados como name
        'email',//atribuiu o nome da coluna no banco de dados como email
        'telefone',
        'data_nascimento',
        'cpf',
        'password',
        'deleted_at'
    ];

    protected $hidden = [//hidden especifica que os atributos a seguir devem ser ocultados 
        'password',//A senha será ocultado
        'remember_token'//Oculta o remember_token e esse token é usado para lembrar o usuário e evitar a necessidade de fazer login repetidamente
    ];
}
