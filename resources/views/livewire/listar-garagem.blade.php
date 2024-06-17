<div>
    <div class="container">
        @if (session()->has('message')) <!-- verifica se há uma mensagem na sessão -->
            <div class="alert alert-success"><!-- tem uma classe do CSS que definem um alerta de sucesso.  -->
                {{ session('message') }}<!-- acessa o valor associado à chave 'message' na sessão e o exibe dentro da <div> como texto.  -->
            </div>
        @endif
        
        <div class="card">
            <div class="card-header titulo">
                <h2>Tabela de Garagem:</h2> <!-- Titulo do nome da tabela -->     
            </div>
            <form wire:submit.prevent="submitForm">
                <div class="form-group d-flex m-4">
                    <input type="text" class="form-control me-3" style="width: 300px" wire:model="searchTerm" placeholder="Buscar Garagem...">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>                 
            <div class="card-body">
                <table id="tabela-pessoas" class="display table" style="width:100%"><!--Criando uma tabela com id tabela-pessoas, chamando uma classe no css. -->     
                    <thead>
                        <tr>    
                            <th>ID:</th>   
                            <th>Nome da Garagem:</th> 
                            <th>Quantidade de Carros:</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($garagens as $garagem) 
                            <tr><!--linha dentro da tabela --> 
                                <td>{{ $garagem->id }}</td> <!--Pega o atributo de veiculo, dados que estão no banco de dados e exibe em cada coluna da tabela, nesse caso o ID -->
                                <td>{{ $garagem->nome }}</td><!--Pega o nome da placa que está no banco de dados e mostra na página HTML-->
                                <td>{{ $garagem->qtd_vagas}}</td><!--Pega o nome usuario que está no banco de dados e mostra na página HTML-->
                                <td>
                                
                                <td>
                                <a class="btn btn-primary" href="{{ route('garagem.editar', $garagem->id) }}"> <!--Ao clicar no botão editar ele aponta para a rota veiculo passando o id como parametro, levando-o para a página de editar veiculo-->
                                        Editar 
                                    </a>
                                </td>
                                <td>
                                    <button wire:click="deleteGaragem({{ $garagem->id }})" class="btn btn-warning"><!--Este atributo wire:click indica que este botão está usando o Livewire,quando ele é clicado dipara um metodo deleteveiculo e passa o id como parametro-->
                                        Excluir
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div> 
    </div>
</div>
