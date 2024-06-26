<div>
    <div class="container">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header titulo">
                <h2>Tabela de Cadastros:</h2>      
            </div>
            <div class="card-body">
                <table id="tabela-pessoas" class="display table" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID:</th>
                            <th>Nome:</th>
                            <th>E-mail:</th>
                            <th>CPF:</th>
                            <th>Telefone:</th>
                            <th>Data de Nascimento:</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pessoas as $pessoa)
                            <tr>
                                <td>{{ $pessoa->id }}</td>
                                <td>{{ $pessoa->name }}</td>
                                <td>{{ $pessoa->email }}</td>
                                <td>{{ $pessoa->cpf }}</td>
                                <td>{{ $pessoa->telefone }}</td>
                                <td>{{ \Carbon\Carbon::parse($pessoa->data_nascimento)->format('d/m/Y') }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('usuario', $pessoa->id) }}">
                                        Editar
                                    </a>
                                </td>
                                <td>
                                    <button wire:click="deleteUsuario({{ $pessoa->id }})" class="btn btn-warning">
                                        Excluir
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-links">
                    {{ $pessoas->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
