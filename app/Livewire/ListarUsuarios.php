<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pessoas;
use App\Models\Veiculos;
use Livewire\WithPagination;

class ListarUsuarios extends Component
{   
    public $usuarios;

    public function mount()
    {
        $this->usuarios = Pessoas::all();
    }

    use WithPagination;

    public function deleteUsuario($id)
    {
        $usuario = Pessoas::find($id);

        if ($usuario) {
            $usuario->deleted_at = now(); 
            $usuario->save();
            
            Veiculos::where('usuario_id', $id)
                    ->update(['deleted_at' => now()]);

            session()->flash('message', 'Usuário marcado como excluído com sucesso.');
        } else {
            session()->flash('message', 'Usuário não encontrado.');
        }
    }

    public function render()
    {
        return view('livewire.listar-usuarios', [
            'pessoas' => Pessoas::whereNull('deleted_at')->paginate(10),
        ]);
    } 
}
