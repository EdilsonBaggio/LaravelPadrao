@extends('layout.master') 
@section('content')
<div class="container">
    <h2 class="titulo">Tabela de Cadastros:</h2>      
    <table id="tabela-pessoas" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>CPF</th>
                <th>Telefone</th>
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
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('script')
@endsection
