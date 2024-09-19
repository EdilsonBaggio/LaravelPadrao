<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use App\Models\ListarVeiculos;
use Illuminate\Support\Facades\Auth;

class ListarVeiculosController extends Controller
{
    public function lista()
    {
        $userId = Auth::user()->id;
        $columns = Schema::getColumnListing('veiculos');
        $veiculos = ListarVeiculos::where('usuario_id', $userId)->whereNull('deleted_at')->get();
        return view('listar-veiculos', compact('columns', 'veiculos'));
    }
}
