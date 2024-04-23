@extends('layout.master') 
@section('content')
<br>
</br>
<div class="container">
    <h2 class="titulo">Tabela de Cadastros:</h2>      
    <table id="tabela-pessoas" class="display table" style="width:100%">
        <thead>
            <tr>
                <th>ID:</th> <!-- Cria nome das tabelas em html  -->
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
                    <td>{{ $pessoa->id }}</td> <!-- Pega os dados do banco de dados de acordo com cada id e mostra na tela nesse caso o (id) -->
                    <td>{{ $pessoa->name }}</td> <!-- Pega os dados do banco de dados de acordo com cada id e mostra na tela nesse caso o (nome) -->
                    <td>{{ $pessoa->email }}</td>  <!-- Pega os dados do banco de dados de acordo com cada id e mostra na tela nesse caso o (email) -->
                    <td>{{ $pessoa->cpf }}</td>  <!-- Pega os dados do banco de dados de acordo com cada id e mostra na tela nesse caso o (cpf) -->
                    <td>{{ $pessoa->telefone }}</td> <!-- Pega os dados do banco de dados de acordo com cada id e mostra na tela nesse caso o (telefone) -->
                    <td>{{ $pessoa->data_nascimento }}</td> <!-- Pega os dados do banco de dados de acordo com cada id e mostra na tela nesse caso o (data_nascimento) -->
                    <td>
                      <button class="botao-editar">Editar</button>
                    </td>
                    <td>
                      <button class="botao-excluir">Excluir</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('script')
@endsection
