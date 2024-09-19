<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\Lista;
use Illuminate\Support\Facades\Auth;

class ListaController extends Controller
{
    public function lista()
    {
        $columns = Schema::getColumnListing('pessoas');
        $userId = Auth::user()->id;
        $pessoas = Lista::where('id', $userId)->whereNull('deleted_at')->get();
        return view('listar-usuario', compact('columns', 'pessoas'));
    }
}
