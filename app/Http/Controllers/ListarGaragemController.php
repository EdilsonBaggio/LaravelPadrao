<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\ListarGaragem;

class ListarGaragemController extends Controller
{
    public function lista()
    {
        $columns = Schema::getColumnListing('garagens');
        $garagens = ListarGaragem::all();
        return view('listar-garagem', compact('columns', 'garagens'));
    }
}
