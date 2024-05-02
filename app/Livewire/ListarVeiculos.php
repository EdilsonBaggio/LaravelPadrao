<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Veiculos;

class ListarVeiculos extends Component
{
    public function deleteVeiculo($id)
    {
        Veiculos::find($id)->delete();
        session()->flash('message', 'Veículo excluído com sucesso.');
    }

    public function render()
    {
        $veiculos = Veiculos::paginate(10);

        return view('livewire.listar-veiculos', compact('veiculos'));
    }
}

