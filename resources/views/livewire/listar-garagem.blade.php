<div>
    <div class="container">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        
        <div class="card">
            <div class="card-header titulo">
                <h2>Tabela de Garagem:</h2>
            </div>                
            <div class="card-body">
                <table id="tabela-pessoas" class="display table" style="width:100%">
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
                            <tr>
                                <td>{{ $garagem->id }}</td>
                                <td>{{ $garagem->nome }}</td>
                                <td>{{ $garagem->qtd_vagas}}</td>
                                <td>
                                
                                <td>
                                <a class="btn btn-primary" href="{{ route('garagem.editar', $garagem->id) }}">
                                        Editar 
                                    </a>
                                </td>
                                <td>
                                    <button wire:click="deleteGaragem({{ $garagem->id }})" class="btn btn-warning">
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
