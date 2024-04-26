<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use App\Models\ListarVeiculos;

class ListarVeiculosController extends Controller
{
    public function lista()
    {
        $columns = Schema::getColumnListing('veiculos');

        $veiculos = ListarVeiculos::all();

        return view('listar-veiculos', compact('columns', 'veiculos'));
    }
}
