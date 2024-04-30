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

        return view('cadastro-veiculo', compact('registros'));
    }

    public function atualizar(Request $request, $id){
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'placa' => 'required|string|max:255',
            'usuario' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'cor' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
        ]);
    
        try {
            // Encontrar o usuário pelo ID
            $veiculo = Veiculos::findOrFail($id);
        
            // Atualizar os dados do usuário
            $veiculo = new Veiculos();
            $veiculo->usuario = $validatedData['usuario'];
            $veiculo->placa = $validatedData['placa'];
            $veiculo->modelo = $validatedData['modelo'];
            $veiculo->cor = $validatedData['cor'];
            $veiculo->marca = $validatedData['marca'];
            $veiculo->save();

            // Redirecionar após salvar
            return redirect()->route('listar')->with('success', 'Usuário atualizado com sucesso!');
        } catch (\Exception $e) {
            // Se ocorrer algum erro, redirecione de volta com uma mensagem de erro
            return redirect()->back()->with('error', 'Ocorreu um erro ao atualizar o usuário.');
        }
    }

    public function veiculo($id){
        // Encontrar o usuário pelo ID
        $veiculo = Veiculos::findOrFail($id);
        
        // Aqui você pode retornar a visualização de edição com os dados do usuário
        return view('editar-veiculos', compact('veiculo'));
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
