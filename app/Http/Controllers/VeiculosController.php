<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculos;

class VeiculosController extends Controller
{
    public function veiculos(Request $request)
    {
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'placa' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'cor' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
        ]);
 
        // Criar um novo veiculo com os dados validados
        $user = new veiculos();
        $user->placa = $validatedData['placa'];
        $user->modelo = $validatedData['modelo'];
        $user->cor = $validatedData['cor'];
        $user->marca = $validatedData['marca'];
        $user->save();
 
        // Redirecionar após salvar
        return redirect()->back()->with('success', 'Veiculo cadastrado com sucesso!');
    }
}
