<?php

namespace App\Livewire;//Define o namespace do componente Livewire

use Livewire\Component;// Importa a classe Component do Livewire para que este componente possa estender essa classe.
use App\Models\Pessoas;//Importa o modelo pessoas do namespace app\models
use App\Models\Veiculos;
use Livewire\WithPagination;//Importa o WithPagination do Livewire para habilitar a paginação no componente 

class ListarUsuarios extends Component//Define a classe listarUsuario como um  componente Livewire 
{   
    public $usuarios;//Declara uma propriedade pública chamada $usuarios, que será usada para armazenar todos os usuários.

    public function mount()//: Define o método mount, que é executado automaticamente quando o componente é inicializado.
    {
        $this->usuarios = Pessoas::all();//Pega todos os dados do banco de dados do nome pessoas e armazena na propriedade usuarios
    }

    use WithPagination;//usado para adicionar funcionalidade de paginação ao componente.

    public function deleteUsuario($id)
    {
        // Encontrar o usuário pelo ID
        $usuario = Pessoas::find($id);

        if ($usuario) {
            // Marcar o usuário como excluído
            $usuario->deleted_at = now(); 
            $usuario->save();

            // Atualizar os veículos associados ao usuário
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
            'pessoas' => Pessoas::whereNull('deleted_at')->paginate(5),
        ]);
    } 
}
