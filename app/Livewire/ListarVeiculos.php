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
        $veiculos = Veiculos::where('placa', 'like', '%' . $this->searchTerm . '%')->paginate(10);
        // Renderizar a view com os resultados da busca
        return view('livewire.listar-veiculos', compact('veiculos'));
    }

    public function deleteVeiculo($id)
    {
        $veiculo = Veiculos::find($id); // Localiza o veículo com o ID fornecido

        if ($veiculo) {
            $veiculo->deleted_at = now(); // Define delete_at como a data e hora atual
            $veiculo->save(); // Salva as alterações no banco de dados

            session()->flash('message', 'Veículo marcado como excluído com sucesso.');
        } else {
            session()->flash('message', 'Veículo não encontrado.');
        }
    }

    public function render()
    {
        $veiculos = Veiculos::leftJoin('pessoas', 'pessoas.id', '=', 'veiculos.usuario_id')
            ->select('veiculos.*', 'pessoas.email as email_usuario', 'pessoas.name as usuario')
            ->whereNull('veiculos.deleted_at') // Condição para garantir que apenas os veículos não excluídos sejam mostrados
            ->paginate(10);

        return view('livewire.listar-veiculos', compact('veiculos'));
    }


}
