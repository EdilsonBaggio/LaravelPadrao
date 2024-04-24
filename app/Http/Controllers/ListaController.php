<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\Lista; // Certifique-se de importar o modelo Pessoa

class ListaController extends Controller
{
    public function lista()
    {
        $columns = Schema::getColumnListing('pessoas');

        $pessoas = Lista::all(); // Supondo que você tenha um modelo Pessoa

        return view('listar-usuario', compact('columns', 'pessoas'));
    }
}
