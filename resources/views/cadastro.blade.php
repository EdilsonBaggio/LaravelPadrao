@extends('layout.master') 
@section('content')
<div class="container"> <!-- conteiner bootstrap onde contém todo o conteúdo da página -->
    <div class="row justify-content-center"> <!-- Comando bootstrap que centraliza o conteúdo  -->
        <div class="col-md-8"> <!-- Esta é uma coluna bootstrap que ocupa 8 das 12 colunas disponíveis na grade, centralizando assim o formulário na página.  -->
            <div class="card"> <!-- Este é um cartão bootstrap que contém o formulário de cadastro.  -->
                <div class="card-header titulo">Cadastro:</div> <!-- Seção de cabeçalho do cartão, que contém o título "Cadastro:". -->

                <div class="card-body cadastro"> <!--  É a seção do corpo do cartão, que contém o formulário de cadastro. -->
                    <form id="formCadastro"> <!-- Este é o formulário HTML que enviará os dados para o servidor. O atributo method="POST" especifica que os dados serão enviados por meio de uma solicitação POST. O atributo action="" especifica o URL para o qual os dados serão enviados. -->
                        @csrf <!--  Este é um token de segurança CSRF,gerado automaticamente pelo Laravel para proteger contra ataques  -->

                        <div class="form-group"> <!--  Este é um grupo de formulário bootstrap. -->
                            <label for="name">Nome:</label> <!-- Este é um rótulo de campo de formulário para o campo "Nome". -->
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus> <!--  Este é o campo de entrada para o nome do usuário. Ele é do tipo "texto", tem uma classe "form-control" do bootstrap e é obrigatório (devido ao atributo required). O valor do campo é preenchido com o valor antigo (se houver), para que os dados não sejam perdidos em caso de erro de validação. Se houver um erro de validação para este campo, a classe "is-invalid" será adicionada para estilização.-->

                            @error('name') <!--  Esta é uma diretiva do Blade que verifica se houve um erro de validação para o campo "name". Se houver um erro, ele exibe uma mensagem de erro.-->
                                <span class="invalid-feedback" role="alert"> <!-- Esta é uma tag <span> que será usada para exibir a mensagem de erro. A classe "invalid-feedback" geralmente é estilizada para fornecer um feedback visual quando há um erro de validação no formulário.  -->
                                    <strong>{{ $message }}</strong> <!--  {{ $message }} é uma variável que contém a mensagem de erro específica para o campo "fone". O $message é uma variável pré-definida pelo Laravel que contém a mensagem de erro associada ao campo de formulário atualmente sendo validado. -->
                                </span>
                            @enderror <!-- Usada para validação dos dados e exibi uma mensagem de erro associado a um campo espefifico, nesse caso no (nome) -->
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                        </div>

                        <div class="form-group">
                            <label for="email_verified_at">Confirme e-mail:</label>
                            <input id="email_verified_at" type="email" class="form-control @error('email_verified_at') is-invalid @enderror" name="email_verified_at" value="{{ old('email_verified_at') }}" required>

                            @error('email_verified_at')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                        </div>


                        <div class="form-group">
                            <label for="telefone">Telefone:</label>
                            <input id="telefone" type="number" class="form-control @error('telefone') is-invalid @enderror" name="telefone" value="{{ old('telefone') }}" required autofocus>

                            @error('telefone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="data_nascimento">Data de Nascimento:</label>
                            <input id="data_nascimento" type="date" class="form-control @error('data_nascimento') is-invalid @enderror" name="date" value="{{ old('data_nascimento') }}" required autofocus>

                            @error('data_nascimento')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="cpf">CPF:</label>
                            <input id="cpf" type="number" class="form-control @error('cpf') is-invalid @enderror" name="cpf" min="0" max="99999999999" value="{{ old('cpf') }}" required autofocus>

                            @error('int')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Senha:</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-0 botoes-cadastro">
                            <button type="submit" class="btn btn-primary"> <!--  Este é o botão de envio do formulário. Quando clicado, enviará os dados do formulário para o servidor.-->
                                Criar Cadastro
                            </button>
                           
                            <a href="" class="btn btn-secondary" > <!--  Este é um link que permite cancelar a operação de cadastro e retornar à página anterior. No entanto, neste momento, o atributo href está vazio, então não levará a lugar nenhum. Geralmente, você colocaria o URL da página anterior aqui. -->
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#formCadastro').submit(function(e){
            e.preventDefault(); // Evita o comportamento padrão de envio do formulário

            // Serialize o formulário para enviar os dados
            var formData = $(this).serialize();

            console.log(formData);

            $.ajax({
                url: '{{ route("passoas") }}',
                type: 'POST',
                data: formData,
                success: function(response){
                    // Lidar com a resposta bem-sucedida aqui
                    console.log('Resposta do servidor:', response);
                },
                error: function(xhr, status, error){
                    // Lidar com erros aqui
                    console.error('Erro na chamada AJAX:', error);
                }
            });
        });
    });
</script>
@endsection