<?php

namespace App\Livewire;//Define o namespace do componente Livewire

use Livewire\Component;// Importa a classe Component do Livewire para que este componente possa estender essa classe.
use App\Models\Pessoas;//Importa o modelo pessoas do namespace app\models
use Livewire\WithPagination;//Importa o WithPagination do Livewire para habilitar a paginação no componente 

class ListarUsuarios extends Component//Define a classe listarUsuario como um  componente Livewire 
{   
    public $usuarios;//Declara uma propriedade pública chamada $usuarios, que será usada para armazenar todos os usuários.

    public function mount()//: Define o método mount, que é executado automaticamente quando o componente é inicializado.
    {
        $this->usuarios = Pessoas::all();//Pega todos os dados do banco de dados do nome pessoas e armazena na propriedade usuarios
    }

    use WithPagination;//usado para adicionar funcionalidade de paginação ao componente.

    public function deleteUsuario($id) //Defini uma função deleteusuario a partir dp id
    {
        Pessoas::find($id)->delete();//Exclui o usuário com o ID fornecido.
        session()->flash('message', 'Usuário excluído com sucesso.');//Se o usuátio for excluido ele exibira uma mensagem de sucesso
    }

    public function render()//Metodo é chamado para renderizaro componente
    {
        return view('livewire.listar-usuarios', [ //retorna a pagina listar-usuarios 
            'pessoas' => Pessoas::paginate(5),//Pega o nome das pessoas que está no banco de dados e lista na pagina, e só aparecerá 5 pessoas por página, se passar disso os outros usuarios serão redirecionados para outra pagina.
        ]);
    }
    
}
