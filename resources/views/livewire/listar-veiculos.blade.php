<div>
    <div class="container">
        <div class="card">
            <div class="card-header titulo">
                <h2>Tabela de Veiculos:</h2>
            </div>     
            <div class="card-body">
                <table id="tabela-beiculos" class="display table responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID:</th>
                            <th>Placa:</th>
                            <th>Modelo:</th>
                            <th>Cor:</th>
                            <th>Marca:</th>
                            <th>Motorista:</th>
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

    @push('script')
    <script>
        document.addEventListener('livewire:init', () => {
            let table = $('#tabela-beiculos').DataTable( {
                responsive: true
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
        });

    </script>
    @endpush
</div>
