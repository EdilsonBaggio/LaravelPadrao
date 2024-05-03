<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Veiculos;
use Livewire\WithPagination;

class ListarVeiculos extends Component
{
    use WithPagination;

    public $searchTerm = '';

    // Método para renderizar a view com os veículos
    public function render()
    {
        // Utiliza o método where para filtrar os veículos com base no termo de pesquisa
        $veiculos = Veiculos::where('usuario', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('placa', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('modelo', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('cor', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('marca', 'like', '%' . $this->searchTerm . '%')
            ->paginate(5);

        // Retorna a view 'livewire.listar-veiculos' com os veículos paginados
        return view('livewire.listar-veiculos', compact('veiculos'));
    }

    // Método para excluir um veículo
    public function deleteVeiculo($id)
    {
        // Encontra o veículo pelo ID e o exclui
        Veiculos::find($id)->delete();
        // Define uma mensagem de sucesso na sessão
        session()->flash('message', 'Veículo excluído com sucesso.');
    }

    // Método para submeter o formulário de pesquisa
    public function submitForm()
    {
        // Redireciona para a página 1 após a pesquisa
        $this->resetPage();
    }
}
