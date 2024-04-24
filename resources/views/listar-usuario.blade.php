@extends('layout.master') 

@section('content')
<br></br>
<div class="container">
    <h2 class="titulo">Tabela de Cadastros:</h2>      
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
                    <td>{{ \Carbon\Carbon::parse($pessoa->data_nascimento)->format('d/m/Y') }}</td> <!-- Aqui ele esta pedindo para o campo de data de nascimento formatar na ordem: dia, mes e ano-->
                    <td>
                        <a class=botao-editar href="{{ route('usuario', $pessoa->id) }}">
                            Editar
                        </a>
                    </td>
                    <td>
                        <a class=botao-excluir href="{{ route('excluir', $pessoa->id) }}">
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
