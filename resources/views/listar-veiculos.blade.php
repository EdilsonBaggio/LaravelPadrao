@extends('layout.master') 

@section('content')
<br></br>
<div class="container">
    <h2 class="titulo">Tabela de Veiculos:</h2>      
    <table id="tabela-pessoas" class="display table" style="width:100%">
        <thead>
            <tr>
                <th>ID:</th>
                <th>Usuário:</th>
                <th>Placa:</th>
                <th>Modelo:</th>
                <th>Cor:</th>
                <th>Marca:</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($veiculos as $veiculo)
                <tr>
                    <td>{{ $veiculo->id }}</td>
                    <td>{{ $veiculo->usuario }}</td>
                    <td>{{ $veiculo->placa }}</td>
                    <td>{{ $veiculo->modelo }}</td>
                    <td>{{ $veiculo->cor }}</td>
                    <td>{{ $veiculo->marca }}</td>
                    <td>
                        <a class="btn btn-warning" href="{{ route('excluir', $veiculo->id) }}">
                            Excluir
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('script')
@endsection
