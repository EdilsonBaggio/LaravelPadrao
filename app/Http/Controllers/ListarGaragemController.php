<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use App\Models\ListarGaragem;
use Illuminate\Support\Facades\Auth;

class ListarGaragemController extends Controller
{
    public function lista()
    {
        $columns = Schema::getColumnListing('garagens');
        $userId = Auth::user()->id;
        $garagens = ListarGaragem::where('usuario_id', $userId)->whereNull('deleted_at')->get();
        return view('listar-garagem', compact('columns', 'garagens'));
    }
}
