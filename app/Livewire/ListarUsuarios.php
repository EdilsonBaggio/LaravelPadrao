<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pessoas;
use App\Models\Veiculos;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ListarUsuarios extends Component
{   
    public $usuarios;

    public function mount()
    {

        $userId = Auth::user()->id;
        $this->usuarios = Pessoas::where('id', $userId)->whereNull('deleted_at')->get();
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
        $userId = Auth::user()->id;
        return view('livewire.listar-usuarios', [
            'pessoas' => Pessoas::where('id', $userId)->whereNull('deleted_at')->paginate(10),
        ]);
    } 
}
