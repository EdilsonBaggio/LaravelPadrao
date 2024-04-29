<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pessoas;

class ListarUsuarios extends Component
{   
    public $usuarios;

    public function mount(){
        $this->usuarios = Pessoas::all();
    }

    public function render()
    {
        return view('livewire.listar-usuarios', [
            'pessoas' => $this->usuarios,
        ]);
    }
    
}
