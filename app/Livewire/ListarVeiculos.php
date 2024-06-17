<?php

namespace App\Livewire; //define o namespace do componente Livewire

use Livewire\Component;
use App\Models\Veiculos;
use Livewire\WithPagination;

class ListarVeiculos extends Component//define a classe ListarVeiculos que estende a classe component do Livewire
{
    use WithPagination;

    public $searchTerm;

    public function submitForm()
    {
        $veiculos = Veiculos::where('placa', 'like', '%' . $this->searchTerm . '%')->paginate(10);//Faz uma consulta no banco de dados na tabela veiculos e solicita uma paginação de 10 por pág
       
        return view('livewire.listar-veiculos', compact('veiculos')); // Renderizar a view com os resultados da busca
    }

    public function deleteVeiculo($id)//Criando uma função para o deletar veiculo
    {
        $veiculo = Veiculos::find($id); // Localiza o veículo na tabela veiculos do banco de dados pelo seu ID 

        if ($veiculo) {//Se o veiculo for identificado entaão:
            $veiculo->deleted_at = now(); //Ele deleta o veiculo na tabela do banco de dados na coluna que se chama deleted_at e o now serve para mostar no banco a data e hora que o usuario foi deletado
            $veiculo->save(); // Salva as alterações no banco de dados

            session()->flash('message', 'Veículo marcado como excluído com sucesso.');//após o veiculo ser excluido com sucesso retorna essa mensagem ao usuario
        } else {//Se o veiculo não for encontrado ou caso ele foi excluido:
            session()->flash('message', 'Veículo não encontrado.');//Retorna uma mensagem de erro que não foi encontrado
        }
    }

    public function render()//Criando uma função render do laravel
    {
        $veiculos = Veiculos::leftJoin('pessoas', 'pessoas.id', '=', 'veiculos.usuario_id') //Pega do banco de dados a tabela veiculos e faz um leftJoin(junção), na tabela pessoas do banco pega o campo usuario_id e fala que é igual ao usuario_id da tabela de veiculos 
                     ->leftJoin('garagems', 'garagems.id', '=', 'veiculos.garagem_id')// Alterado para 'usuario_id'
                     ->select('veiculos.*', 'pessoas.email as email_usuario', 'pessoas.name as usuario','garagems.nome as nome')//Seleciona na tabela de veiculos do banco todos os campos e na de pessoas pega o email e renomeia como email_usuario e pega o nome do usuario e renomeia como usuario, tudo isso para mostrar na pág listar veiculos esses dados que estarão cadastrados no banco.
                     ->whereNull('veiculos.deleted_at') // Condição para garantir que apenas os veículos não excluídos sejam mostrados
                     ->paginate(10);//Mostra 10 veiculos por paginação

        return view('livewire.listar-veiculos', compact('veiculos'));//Retorna a view listar-veiculos que serve para mostar os usuarios cadastrados na tela, e o compact() ignifica que os resultados da consulta serão disponibilizados na visualização para que possam ser exibidos na tela.
    }


}
