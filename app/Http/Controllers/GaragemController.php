<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lista;
use App\Models\Garagem;
use Illuminate\Support\Facades\Auth;

class GaragemController extends Controller
{
    public function lista()
    {
        $userId = Auth::user()->id;
        $registros = Lista::where('id', $userId)->whereNull('deleted_at')->get();
        return view('cadastro-garagem', compact('registros'));
    }

    public function garagem(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'qtd_vagas' => 'required|string|max:255',
            'usuario_id' => 'required|string|max:255',
        ]);

        $garagem = new Garagem();
        $garagem->nome = $validatedData['nome'];
        $garagem->qtd_vagas = $validatedData['qtd_vagas'];
        $garagem->usuario_id = $validatedData['usuario_id'];
        $garagem->save();
        return redirect()->route('listar-garagem')->with('success', 'Garagem cadastrada com sucesso!');
    }

    public function atualizar(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'qtd_vagas' => 'required|string|max:255',
            'usuario_id' => 'required|string|max:255',
        ]);

        try {
            $garagem = Garagem::findOrFail($id);
        
            $garagem->nome = $validatedData['nome'];
            $garagem->qtd_vagas = $validatedData['qtd_vagas'];
            $garagem->usuario_id = $validatedData['usuario_id'];
            $garagem->save();

            return redirect()->route('listar')->with('success', 'Garagem atualizada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao atualizar a garagem.');
        }
    }

    public function editar($id)
    {
        $garagem = Garagem::findOrFail($id);
        return view('editar-garagem', compact('garagem'));
    }

}