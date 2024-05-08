<div>
    <div class="container">
        @if (session()->has('message')) <!-- verifica se há uma mensagem na sessão -->
            <div class="alert alert-success"><!-- tem uma classe do CSS que definem um alerta de sucesso.  -->
                {{ session('message') }}<!-- acessa o valor associado à chave 'message' na sessão e o exibe dentro da <div> como texto.  -->
            </div>
        @endif
        
        <div class="card">
            <div class="card-header titulo">
                <h2>Tabela de Veiculos:</h2> <!-- Titulo do nome da tabela -->     
            </div>
            <div class="card-body">
                <table id="tabela-pessoas" class="display table" style="width:100%"><!--Criando uma tabela com id tabela-pessoas, chamando uma classe no css. -->     
                    <thead>
                        <tr><!--linha dentro da tabela -->    
                            <th>ID:</th><!--Coluna chamada ID na página HTML-->       
                            <th>Placa:</th><!--Coluna chamada Placa na página HTML-->    
                            <th>Modelo:</th>
                            <th>Cor:</th>
                            <th>Marca:</th>
                            <th>Nome do usuário:</th><!--Coluna chamada Usuário na página HTML--> 
                            <th>E-mail:</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($veiculos as $veiculo) <!--Inicia um loop que atribui veiculo a uma variavel veiculo -->
                            <tr><!--linha dentro da tabela --> 
                                <td>{{ $veiculo->id }}</td> <!--Pega o atributo de veiculo, dados que estão no banco de dados e exibe em cada coluna da tabela, nesse caso o ID -->
                                <td>{{ $veiculo->placa }}</td><!--Pega o nome da placa que está no banco de dados e mostra na página HTML-->
                                <td>{{ $veiculo->modelo }}</td>
                                <td>{{ $veiculo->cor }}</td>
                                <td>{{ $veiculo->marca }}</td>
                                <td>{{ $veiculo->usuario }}</td><!--Pega o nome usuario que está no banco de dados e mostra na página HTML-->
                                <td>{{ $veiculo->email_usuario }}</td><!--Acessando campo email da tabela pessoas do banco de dados e exibindo em veiculo-->
                                <td>
                                    <a class="btn btn-primary" href="{{ route('veiculo', $veiculo->id) }}"> <!--Ao clicar no botão editar ele aponta para a rota veiculo passando o id como parametro, levando-o para a página de editar veiculo-->
                                        Editar 
                                    </a>
                                </td>
                                <td>
                                    <button wire:click="deleteVeiculo({{ $veiculo->id }})" class="btn btn-warning"><!--Este atributo wire:click indica que este botão está usando o Livewire,quando ele é clicado dipara um metodo deleteveiculo e passa o id como parametro-->
                                        Excluir
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-links"> <!-- uma div que está puxando uma classe no CSS que chama "pagination-links "-->
                    {{ $veiculos->links() }} <!--Substitui os links de paginação html -->
                </div>
            </div>
        </div> 
    </div>
</div>
