<?php

namespace App\Livewire; //define o namespace do componente Livewire

use Livewire\Component;//importa a classe component do Livewire
use App\Models\Veiculos;// importa o modelo Veiculos do namespace App\Models

class ListarVeiculos extends Component//define a classe ListarVeiculos que estende a classe component do Livewire
{
    public function deleteVeiculo($id)//criando uma função para deletar veiculo a partir do ID
    {
        Veiculos::find($id)->delete();//localiza e exclui o veículo com o ID fornecido.
        session()->flash('message', 'Veículo excluído com sucesso.');//Ao excluir o veiculo, envia a mensagem sucesso
    }

    public function render()//Renderiza o componente
    {
        // Fazendo um left join com a tabela 'pessoas' usando o método leftJoin()
        $veiculos = Veiculos::leftJoin('pessoas', 'pessoas.id', '=', 'veiculos.usuario_id')//Pegando o id  da tabela pessoas no banco de dados e comparando(dizendo que é igual a usuario_id que está na tabela veiculos no banco de dados)
        ->select('veiculos.*', 'pessoas.email as email_usuario', 'pessoas.name as usuario')//Selecionando todas as colunas da tabela de veiculos e pegando da tabela pessoas somente o email e o nome do usuario.Pega da tabela pessoas o email e renomeia como email_usuarios para não dar conflito, a mesma coisa com pessoas.name, aqui ele esta pegando da tabela pessoas o nome e renomeando como usuario,para não dar conflito.
        ->paginate(10);//Colocando paginação para aparecer 10 veiculos em cada pag.
 
        return view('livewire.listar-veiculos', compact('veiculos'));
    }
}

