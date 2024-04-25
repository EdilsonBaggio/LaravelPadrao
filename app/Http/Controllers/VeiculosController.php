<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\Models\Veiculos;
use App\Models\Lista;

class VeiculosController extends Controller
{
    public function veiculos(Request $request)
    {
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'placa' => 'required|string|max:255',
            'usuario' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'cor' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
        ]);
 
        // Criar um novo veiculo com os dados validados
        $user = new Veiculos();
        $user->usuario = $validatedData['usuario'];
        $user->placa = $validatedData['placa'];
        $user->modelo = $validatedData['modelo'];
        $user->cor = $validatedData['cor'];
        $user->marca = $validatedData['marca'];
        $user->save();
 
        // Redirecionar após salvar
        return redirect()->back()->with('success', 'Veiculo cadastrado com sucesso!');
    }

    public function lista()
    {
        $registros = Lista::all(); // Recuperar todos os registros da tabela "Lista"

        return view('cadastro_veiculo', compact('registros'));
    }

    public function excluir($id){
        // Verifica se o veiculo existe
        $user = Veiculos::find($id);
        
        if($user){
            // Se o veiculo existe, exclui
            $user->delete();
            return redirect()->route('listar-veiculos');
        } else {
            // Se o veiculo não existe, retorna uma mensagem de erro
            return "veiculo não encontrado.";
        }
    }
}
