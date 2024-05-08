@extends('layout.master') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header titulo">Editar Usuário:</div>

                <div class="card-body cadastro">
                    <form id="formEditar" method="POST" action="{{ route('atualizar', $user->id) }}"> <!-- Alteração no action para a rota de edição -->

                        @csrf

                        <div class="form-group">
                            <label for="name">Nome:</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                        </div>

                        <div class="form-group">
                            <label for="verificacao_email">Confirmar e-mail:</label>
                            <input id="verificacao_email" type="email" class="form-control @error('verificacao_email') is-invalid @enderror" name="verificacao_email" value="{{ $user->verificacao_email }}" required>

                            @error('verificacao_email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                        </div>

                        <div class="form-group">
                            <label for="telefone">Telefone:</label>
                            <input id="telefone" type="text" class="form-control @error('telefone') is-invalid @enderror" name="telefone" value="{{ $user->telefone }}" required autofocus>

                            @error('telefone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="data_nascimento">Data de Nascimento:</label>
                            <input id="data_nascimento" type="date" class="form-control @error('data_nascimento') is-invalid @enderror" name="data_nascimento" value="{{ $user->data_nascimento }}" required autofocus>

                            @error('data_nascimento')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="cpf">CPF:</label>
                            <input id="cpf" type="text" class="form-control @error('cpf') is-invalid @enderror" name="cpf"  value="{{ $user->cpf }}" required autofocus>

                            @error('int')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Senha:</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ $user->password }}" required>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Restante dos campos do formulário com os valores preenchidos -->

                        <div class="form-group mb-0 botoes-cadastro"> <!-- Adicionando uma classe para os botões -->
                            <button type="submit" class="btn btn-primary"> <!-- Alterado para refletir a ação de edição -->
                                Editar Usuário
                            </button>
                           
                            <a href="{{ url()->previous() }}" class="btn btn-secondary" > <!-- Ao apertar no botão cancelar ele retorna à página anterior -->
                                Cancelar
                            </a>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script><!-- Importando da biblioteca o link do ajax.-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script> <!-- Importando da biblioteca o link do ajax jQuery Mask (mascara).-->
<script>
    $(document).ready(function() { //Aguarda até que todo o HTML do documento tenha sido completamente carregado antes de executar o código dentro dela.
        $('#formEditar').submit(function(e){//Quando apertar no botao editar o formulário será enviado
            e.preventDefault();//impede o envio padrão do formulário, que normalmente faria com que a página recarregasse

            var formData = $(this).serialize();//serializa os dados do formulário(converte de ajax para string para facilitar a consulta)

            var email = $("#email").val();//Definindo uma variavel email e pegando os valores que foram preenchidos no formulário
            var confemail = $("#verificacao_email").val();//Definindo uma variavel confemail e pegando os valores que foram preenchidos no formulário
 
            if(email != confemail){//Se email e confemail forem diferentes 
                Swal.fire({
                            icon: "error",
                            title: "ERRO...",
                            text: 'Os e-mails não correspondem.',
                            showCancelButton: false,
                            cancelButtonColor: "#d33",
                        });
                return false; // se o retorno for falso ele para de executar o código 
            }

            $.ajax({//Se os e-mails corresponderem, ele faz uma soliciação ajax que mostrara uma mensagem 
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                success: function(response){//Se a resposta for bem sucedida mostrara o icone de sucesso e o texto
                    console.log('Sucesso');
                    Swal.fire({
                    title: "Sucesso!!!",
                    text: "Os dados do usuário foram atualizados.",
                    icon: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ok"
                    }).then((result) => { // Isso indica que uma ação será realizada depois que a solicitação AJAX for concluída com sucesso. 
                        if (result.isConfirmed) {//Verifica se a solicitação AJAX foi confirmada com sucesso.
                            window.location.href = "{{ url()->previous() }}";//Após a verificação ele manda automaticamente para a página anterior.
                        }
                    });
                },
                error: function(xhr, status, error){//Se a solicitação der erro então retornará mensagem de erro 
                    console.error('Erro');
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Os dados não foram atualizados!",//mensagem de erro
                        showCancelButton: false,
                        cancelButtonColor: "#d33",
                    });
                }
            });
        });
        $('#telefone').mask('(00) 00000-0000');//Colocando uma mascara para telefone
        $('#cpf').mask('000.000.000-00', {reverse: true});//Colocando um mask(mascara)para o campo cpf.Reverse:true: indica que a mascara será aplicada da direita para a esquerda 
    });
</script>
@endsection
