<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Veiculos;

class ListarVeiculos extends Component
{
    public $veiculos;

    public function mount()
    {
        $this->veiculos = Veiculos::all();
    }

    public function render()
    {
        return view('livewire.listar-veiculos', [
            'veiculos' => $this->veiculos,
        ]);
    }
}
