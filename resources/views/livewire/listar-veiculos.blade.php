<div>
    <div class="container">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        
        <div class="card">
            <div class="card-header titulo">
                <h2>Tabela de Veiculos:</h2>
            </div>
            <form wire:submit.prevent="submitForm">
                <div class="form-group d-flex m-4">
                    <input type="text" class="form-control me-3" style="width: 300px" wire:model="searchTerm" placeholder="Buscar veículos...">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>                 
            <div class="card-body">
                <table id="tabela-pessoas" class="display table" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID:</th>
                            <th>Placa:</th>
                            <th>Modelo:</th>
                            <th>Cor:</th>
                            <th>Marca:</th>
                            <th>Nome do usuário:</th>
                            <th>E-mail:</th>
                            <th>Garagem:<th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($veiculos as $veiculo)
                            <tr> 
                                <td>{{ $veiculo->id }}</td>
                                <td>{{ $veiculo->placa }}</td>
                                <td>{{ $veiculo->modelo }}</td>
                                <td>{{ $veiculo->cor }}</td>
                                <td>{{ $veiculo->marca }}</td>
                                <td>{{ $veiculo->usuario }}</td>
                                <td>{{ $veiculo->email_usuario }}</td>
                                <td>{{ $veiculo->nome}}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('veiculo.editar', $veiculo->id) }}">
                                        Editar 
                                    </a>
                                </td>
                                <td>
                                    <button wire:click="deleteVeiculo({{ $veiculo->id }})" class="btn btn-warning">
                                        Excluir
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-links">
                    {{ $veiculos->links() }}
                </div>
            </div>
        </div> 
    </div>
</div>
