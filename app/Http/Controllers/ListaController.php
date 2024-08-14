<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\Lista;

class ListaController extends Controller
{
    public function lista()
    {
        $columns = Schema::getColumnListing('pessoas');
        $pessoas = Lista::all(); 
        return view('listar-usuario', compact('columns', 'pessoas'));
    }
}
