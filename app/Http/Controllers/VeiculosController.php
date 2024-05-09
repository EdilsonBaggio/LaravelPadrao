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
            'usuario_id' => 'required|exists:pessoas,id',
            'modelo' => 'required|string|max:255',
            'cor' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
        ]);

        // Criar um novo veiculo com os dados validados
        $veiculo = new Veiculos();
        $veiculo->usuario_id = $validatedData['usuario_id']; 
        $veiculo->placa = $validatedData['placa'];
        $veiculo->modelo = $validatedData['modelo'];
        $veiculo->cor = $validatedData['cor'];
        $veiculo->marca = $validatedData['marca'];
        $veiculo->save();

        // Redirecionar após salvar
        return redirect()->back()->with('success', 'Veiculo cadastrado com sucesso!');
    }

    public function lista()
    {
        // Recuperar todos os registros da tabela "Lista" onde o campo "deleted_at" é nulo
        $registros = Lista::whereNull('deleted_at')->get(); 

        return view('cadastro-veiculo', compact('registros'));
    }

    public function atualizar(Request $request, $id){
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'placa' => 'required|string|max:255',
            'usuario_id' => 'required|exists:pessoas,id',
            'modelo' => 'required|string|max:255',
            'cor' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
        ]);
    
        try {
            // Encontrar o usuário pelo ID
            $veiculo = Veiculos::findOrFail($id);
        
            // Atualizar os dados do usuário
            $veiculo->usuario_id = $validatedData['usuario_id'];
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

    public function veiculo($id)
    {
        // Encontrar o veículo pelo ID com informações adicionais do usuário
        $veiculo = Veiculos::leftJoin('pessoas', 'pessoas.id', '=', 'veiculos.usuario_id')
                            ->select('veiculos.*', 'pessoas.name as usuario')
                            ->findOrFail($id);
        
        // Aqui você pode retornar a visualização de edição com os dados do veículo e do usuário
        return view('editar-veiculos', compact('veiculo'));
    }
}
