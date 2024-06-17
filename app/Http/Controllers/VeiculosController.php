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
            'garagem_id' => 'required|exists:garagems,id',
        ]);
 
        $veiculo = new Veiculos();
        $veiculo->usuario_id = $validatedData['usuario_id']; 
        $veiculo->placa = $validatedData['placa'];
        $veiculo->modelo = $validatedData['modelo'];
        $veiculo->cor = $validatedData['cor'];
        $veiculo->marca = $validatedData['marca'];
        $veiculo->garagem_id = $validatedData['garagem_id'];
        $veiculo->save();

        return redirect()->back()->with('success', 'Veiculo cadastrado com sucesso!');
    }



    public function lista()
    {
        $veiculos = Veiculos::all();
        $registros = Lista::whereNull('deleted_at')->get(); 
        $id_usuario_logado = Auth::guard('pessoas')->user()->id;
        $garagens = ListarGaragem::where('usuario_id', $id_usuario_logado)->whereNull('deleted_at')->get();
        return view('cadastro-veiculo', compact('registros','garagens'));
    }

    public function atualizar(Request $request, $id){
        $validatedData = $request->validate([
            'placa' => 'required|string|max:255',
            'usuario_id' => 'required|exists:pessoas,id',
            'modelo' => 'required|string|max:255',
            'cor' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'garagem_id' => 'required|exists:garagems,id',
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
        $veiculo = Veiculos::leftJoin('pessoas', 'pessoas.id', '=', 'veiculos.usuario_id')
        ->leftJoin('garagems', 'garagems.id', '=', )
        ->select('veiculos.*', 'pessoas.name as usuario') 
        ->findOrFail($id);
                                        
        return view('editar-veiculos', compact('veiculo'));
    }  
}
