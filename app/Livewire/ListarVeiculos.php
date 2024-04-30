<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Veiculos;
use Livewire\WithPagination;

class ListarVeiculos extends Component
{
    use WithPagination;

    public function render()
    {
        // Paginate the query instead of using all()
        $veiculos = Veiculos::paginate(5);

        return view('livewire.listar-veiculos', [
            'veiculos' => $veiculos,
        ]);
    }
}

