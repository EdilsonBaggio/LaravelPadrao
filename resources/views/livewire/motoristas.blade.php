<div>
    <div class="container">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        
        <div class="card">
            <div class="card-header titulo">
                <h2>Garagens:</h2> 
            </div>             
            <div class="card-body">
                <table id="tabela-pessoas" class="display table" style="width:100%">   
                    <thead>
                        <th>Motorista:</th>
                        <th>CNH:</th>
                        <th>Modelo:</th>
                        <th>Placa:</th>
                        <th>Garagem:</th>
                        <th>Vagas:</th>
                    </thead>
                    <tbody>
                        @foreach($motoristas as $motorista) 
                            <tr>
                                <td>{{ $motorista->motorista_nome }}</td> 
                                <td>{{ $motorista->cnh_motorista }}</td>
                                <td>{{ $motorista->veiculo_modelo }}</td>
                                <td>{{ $motorista->placa_carro }}</td>
                                <td>{{ $motorista->garagem_nome }}</td>
                                <td>{{ $motorista->vaga_carro }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-links">
                    {{ $motoristas->links() }}
                </div>
            </div>
        </div> 
    </div>
</div>
