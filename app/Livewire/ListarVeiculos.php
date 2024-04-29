<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Veiculos; // Assuming Veiculo is your model

class ListarVeiculos extends Component
{
    public $veiculos;

    public function mount()
    {
        // Retrieve veiculos from your database or any other data source
        $this->veiculos = Veiculos::all();
    }

    public function render()
    {
        // Pass the $veiculos variable to the view
        return view('livewire.listar-veiculos', [
            'veiculos' => $this->veiculos,
        ]);
    }
}
