<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\Models\Veiculos;
use App\Models\Lista;
use App\Models\ListarGaragem;

class VeiculosController extends Controller
{

    public function veiculos(Request $request)
    {
        $validatedData = $request->validate([
            'placa' => 'required|string|max:255',
            'usuario_id' => 'required|exists:pessoas,id',
            'modelo' => 'required|string|max:255',
            'cor' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'garagem_id' => 'required|exists:garagens,id',
        ]);

        $garagem = ListarGaragem::find($validatedData['garagem_id']);
        $capacidadeMaxima = $garagem->qtd_vagas;

        $quantidadeVeiculos = Veiculos::where('garagem_id', $validatedData['garagem_id'])->whereNull('deleted_at')
                                    ->count();
                                    
        if ($quantidadeVeiculos >= $capacidadeMaxima) {
            return response()->json([
                'error' => 'Garagem já está cheia!'
            ], 422);
        }

        // Salva o novo veículo
        $veiculo = new Veiculos();
        $veiculo->usuario_id = $validatedData['usuario_id'];
        $veiculo->placa = $validatedData['placa'];
        $veiculo->modelo = $validatedData['modelo'];
        $veiculo->cor = $validatedData['cor'];
        $veiculo->marca = $validatedData['marca'];
        $veiculo->garagem_id = $validatedData['garagem_id'];
        $veiculo->save();

        return response()->json([
            'success' => 'Veículo cadastrado com sucesso!'
        ]);

    }

    public function lista()
    {
        $userId = Auth::user()->id;
        $registros = Lista::where('id', $userId)->whereNull('deleted_at')->get();
        $garagens = ListarGaragem::where('usuario_id', $userId)->whereNull('deleted_at')->get();
        return view('cadastro-veiculo', compact('registros','garagens'));
    }

    public function atualizar(Request $request, $id){
        $validatedData = $request->validate([
            'placa' => 'required|string|max:255',
            'usuario_id' => 'required|exists:pessoas,id',
            'modelo' => 'required|string|max:255',
            'cor' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'garagem_id' => 'required|exists:garagens,id',
        ]);
    
        try {
            $veiculo = Veiculos::findOrFail($id);
        
            $veiculo->usuario_id = $validatedData['usuario_id'];
            $veiculo->placa = $validatedData['placa'];
            $veiculo->modelo = $validatedData['modelo'];
            $veiculo->cor = $validatedData['cor'];
            $veiculo->marca = $validatedData['marca'];
            $veiculo->garagem_id = $validatedData['garagem_id'];
            $veiculo->save();

            return redirect()->route('listar')->with('success', 'Veículo atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao atualizar o Veículo.');
        }
    }

    public function veiculo($id)
    {
        $veiculo = Veiculos::findOrFail($id);
        return view('editar-veiculos', compact('veiculo'));
    }
}
