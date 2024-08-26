<?php

namespace App\Livewire; //define o namespace do componente Livewire

use Livewire\Component;
use App\Models\Veiculos;
use Livewire\WithPagination;

class ListarVeiculos extends Component
{
    use WithPagination;

    public $searchTerm;
    public function submitForm()
    {
        $veiculos = Veiculos::where('placa', 'like', '%' . $this->searchTerm . '%')->paginate(10);
        return view('livewire.listar-veiculos', compact('veiculos'));
    }

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
        $veiculos = Veiculos::leftJoin('pessoas', 'pessoas.id', '=', 'veiculos.usuario_id') 
                     ->leftJoin('garagens', 'garagens.id', '=', 'veiculos.garagem_id')
                     ->select('veiculos.*', 'pessoas.email as email_usuario', 'pessoas.name as usuario','garagens.nome as nome')
                     ->whereNull('veiculos.deleted_at')
                     ->paginate(10);
        return view('livewire.listar-veiculos', compact('veiculos'));
    }


}
