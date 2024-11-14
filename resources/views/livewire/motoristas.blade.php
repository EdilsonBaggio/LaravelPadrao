<div>
    <div class="container">
        <div class="card">
            <div class="card-header titulo d-flex justify-content-between">
                <h2>Garagens:</h2> 
                <div class="total-vagas">
                    Vagas ocupadas: {{ $vagas }}
                </div>
            </div>             
            <div class="card-body">
                <table id="tabela-garagens" class="display table responsive" style="width:100%">
                    <thead>
                        <th>Placa:</th>
                        <th>Motorista:</th>
                        <th>CNH:</th>
                        <th>Modelo:</th>
                        <th>Marca:</th>
                        <th>Cor:</th>
                        <th>Garagem:</th>
                    </thead>
                    <tbody>
                        @foreach($motoristas as $motorista) 
                            <tr>
                                <td>{{ $motorista->placa_carro }}</td>
                                <td>{{ $motorista->motorista_nome }}</td> 
                                <td>{{ $motorista->cnh_motorista }}</td>
                                <td>{{ $motorista->veiculo_modelo }}</td>
                                <td>{{ $motorista->veiculo_marca }}</td>
                                <td>{{ $motorista->veiculo_cor }}</td>
                                <td>{{ $motorista->garagem_nome }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> 
    </div>
    @push('script')
    <script>
        document.addEventListener('livewire:init', () => {
            let table = $('#tabela-garagens').DataTable( {
                responsive: true
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
        });

    </script>
    @endpush
</div>
