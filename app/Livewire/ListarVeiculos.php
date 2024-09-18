<?php

namespace App\Livewire; //define o namespace do componente Livewire

use Livewire\Component;
use App\Models\ListarVeiculos as Veiculos;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ListarVeiculos extends Component
{
    use WithPagination;

    public function deleteVeiculo($id)
    {
        $veiculo = Veiculos::find($id);

        if ($veiculo) {
            $veiculo->deleted_at = now();
            $veiculo->save();

            session()->flash('message', 'Veículo marcado como excluído com sucesso.');
        } else {
            session()->flash('message', 'Veículo não encontrado.');
        }
    }

    public function render()
    {
        $userId = Auth::user()->id;
        $veiculos = Veiculos::leftJoin('pessoas', 'pessoas.id', '=', 'veiculos.usuario_id') 
            ->leftJoin('garagens', 'garagens.id', '=', 'veiculos.usuario_id')
            ->select('veiculos.*', 'pessoas.email as email_usuario', 'pessoas.name as usuario', 'garagens.nome as nome')
            ->where('veiculos.usuario_id', $userId)
            ->whereNull('veiculos.deleted_at')
            ->paginate(10);
            
        return view('livewire.listar-veiculos', compact('veiculos'));
    }

}
