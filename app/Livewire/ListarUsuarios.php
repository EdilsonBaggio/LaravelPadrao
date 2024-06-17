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

    public function deleteUsuario($id)//Cria uma função para deletar o usuario
    {
        // Encontrar o usuário pelo ID
        $usuario = Pessoas::find($id);

        if ($usuario) {//Se o usuário for encomtrado pelo id então:
            $usuario->deleted_at = now(); //Ele deleta o usuário na tabela do banco de dados na coluna que se chama deleted_at e o now serve para mostar no banco a data e hora que o usuario foi deletado
            $usuario->save();// Salva as alterações no banco de dados

            // Atualizar os veículos associados ao usuário
            Veiculos::where('usuario_id', $id)//Está consultando a tabela veiculos no banco de dados onde o usuario_id é igual ao id e seleciona todos os veiculos associados a esse usuario
                    ->update(['deleted_at' => now()]);//Atualiza os registros selecionados e define na coluna deleted_at no banco a data e hora queo veiculo foi excluido

            session()->flash('message', 'Usuário marcado como excluído com sucesso.');//após o usuario ser excluido com sucesso retorna essa mensagem ao usuario
        } else {//Se o usuario não for encontrado ou caso ele foi excluido:
            session()->flash('message', 'Usuário não encontrado.');//Retorna uma mensagem de erro que não foi encontrado
        }
    }

    public function render()
    {
        return view('livewire.listar-usuarios', [//Retorna a view listar-usuarios que serve para mostar os usuarios cadastrados na tela 
            'pessoas' => Pessoas::whereNull('deleted_at')->paginate(10),//Acessa a tabela pessoas no banco de dados e busca todas as pessoas onde o valor da coluna deleted_at é nulo 
        ]);
    } 
}
