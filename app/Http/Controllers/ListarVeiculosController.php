<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use App\Models\ListarVeiculos; // Certifique-se de importar o modelo Pessoa

class ListarVeiculosController extends Controller
{
    public function lista()
    {
        $columns = Schema::getColumnListing('veiculos');

        $veiculos = ListarVeiculos::all();

        return view('listar-veiculos', compact('columns', 'veiculos'));
    }
}
