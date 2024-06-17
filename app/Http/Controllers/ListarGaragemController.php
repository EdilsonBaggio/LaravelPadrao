<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\ListarGaragem;

class ListarGaragemController extends Controller
{
    public function lista()//Defini o método lista
    {
        $columns = Schema::getColumnListing('garagems');//Pega o nome das colunas no banco de dados por meio do nome do banco (veiculos)

        $garagems = ListarGaragem::all();//Obtém todos os registros que tem no banco de dados que será exibido na página ListarVeiculos

        return view('listar-garagem', compact('columns', 'garagems'));//Retorna uma view chamada listar-veiculos passando as variáveis columns e veiculos com o metodo compact 
    }
}
