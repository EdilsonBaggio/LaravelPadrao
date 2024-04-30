<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pessoas;
use Livewire\WithPagination;

class ListarUsuarios extends Component
{   
    public $usuarios;

    public function mount()
    {
        $this->usuarios = Pessoas::all();
    }

    use WithPagination;

    public function render()
    {
        return view('livewire.listar-usuarios', [
            'pessoas' => Pessoas::paginate(5),
        ]);
    }
    
}
