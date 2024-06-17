<?php

namespace App\Livewire; //define o namespace do componente Livewire

use Livewire\Component;
use App\Models\Garagem;
use App\Models\Veiculos;
use Livewire\WithPagination;


class ListarGaragem extends Component//define a classe ListarVeiculos que estende a classe component do Livewire
{
    public $garagens;//Declara uma propriedade pública chamada $usuarios, que será usada para armazenar todos os usuários.

    public function mount()//: Define o método mount, que é executado automaticamente quando o componente é inicializado.
    {
        $this->garagens = Garagem::whereNull('deleted_at')->get();//Pega todos os dados do banco de dados do nome pessoas e armazena na propriedade usuarios
    }

    use WithPagination;//usado para adicionar funcionalidade de paginação ao componente.

    public function deleteGaragem($id)//Cria uma função para deletar o usuario
    {
        // Encontrar o usuário pelo ID
        $garagem = Garagem::find($id);

        if ($garagem) {//Se o usuário for encomtrado pelo id então:
            $garagem->deleted_at = now(); //Ele deleta o usuário na tabela do banco de dados na coluna que se chama deleted_at e o now serve para mostar no banco a data e hora que o usuario foi deletado
            $garagem->save();// Salva as alterações no banco de dados

            // Atualizar os veículos associados ao usuário
            Garagem::where('id', $id)//Está consultando a tabela veiculos no banco de dados onde o usuario_id é igual ao id e seleciona todos os veiculos associados a esse usuario
                    ->update(['deleted_at' => now()]);//Atualiza os registros selecionados e define na coluna deleted_at no banco a data e hora queo veiculo foi excluido


            session()->flash('message', 'Garagem marcado como excluído com sucesso.');//após o usuario ser excluido com sucesso retorna essa mensagem ao usuario
        } else {//Se o usuario não for encontrado ou caso ele foi excluido:
            session()->flash('message', 'Garagem não encontrado.');//Retorna uma mensagem de erro que não foi encontrado
        }
    }

    public function render()
    {
        $garagens = Garagem::whereNull('deleted_at')->paginate(5);
    
        // Adicionar o count dos registros de garagem à coluna qtd_vagas
        foreach ($garagens as $garagem) {
            $garagem->qtd_vagas = Veiculos::where('garagem_id', $garagem->id)->count();//relação entre as tabelas Garagem e Veiculo, onde Veiculo possui uma coluna garagem_id que referencia a id da Garagem. Assim, o count de veículos associados a cada garagem é calculado e atribuído à coluna qtd_vagas de cada registro de garagem. 
        }
    
        return view('livewire.listar-garagem', ['garagens' => $garagens]);
    }
    
}
 
