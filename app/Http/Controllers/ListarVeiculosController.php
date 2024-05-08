<?php

namespace App\Http\Controllers;//Controller de ListarVeiculos

use Illuminate\Support\Facades\Schema;//Importa a classe Schema do laravel, que fornece métodos para interagir com o esquema do banco de dados 
use App\Models\ListarVeiculos;//Importa a classe ListarVeiculos

class ListarVeiculosController extends Controller//A classe ListarVeiculosController herda os metodos da classe controller
{
    public function lista()//Defini o método lista
    {
        $columns = Schema::getColumnListing('veiculos');//Pega o nome das colunas no banco de dados por meio do nome do banco (veiculos)

        $veiculos = ListarVeiculos::all();//Obtém todos os registros que tem no banco de dados que será exibido na página ListarVeiculos

        return view('listar-veiculos', compact('columns', 'veiculos'));//Retorna uma view chamada listar-veiculos passando as variáveis columns e veiculos com o metodo compact 
    }


}
