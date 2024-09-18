<?php

namespace App\Livewire; //define o namespace do componente Livewire

use Livewire\Component;
use App\Models\Garagem;
use App\Models\Veiculos;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;


class ListarGaragem extends Component
{
    public $garagens;

    public function mount()
    {
        $userId = Auth::user()->id;
        $this->garagens = Garagem::where('usuario_id', $userId)->whereNull('deleted_at')->get();
    }

    use WithPagination;

    public function deleteGaragem($id)
    {
        $garagem = Garagem::find($id);

        if ($garagem) {
            $garagem->deleted_at = now(); 
            $garagem->save();

            Garagem::where('id', $id)
                    ->update(['deleted_at' => now()]);


            session()->flash('message', 'Garagem marcado como excluído com sucesso.');
        } else {
            session()->flash('message', 'Garagem não encontrado.');
        }
    }

    public function render()
    {
        $garagens = Garagem::whereNull('deleted_at')->paginate(5);

        foreach ($garagens as $garagem) {
            $garagem->qtd_vagas = Veiculos::where('garagem_id', $garagem->id)->count();
        }
    
        return view('livewire.listar-garagem', ['garagens' => $garagens]);
    }
    
}
 
