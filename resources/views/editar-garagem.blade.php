@extends('layout.master') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header titulo">Editar Garagem:</div>

                <div class="card-body cadastro">
                    <form id="formEditar" method="POST" action="{{ route('atualizar_garagem', $garagem->id) }}"> <!-- Alteração no action para a rota de edição -->

                        @csrf

                        <div class="form-group"> <!--  Este é um grupo de formulário bootstrap. -->
                            <label for="nome">Nome da Garagem:</label> <!-- Este é um rótulo de campo de formulário para o campo "placa". -->
                            <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ $garagem->nome }}" required autofocus> <!--  Este é o campo de entrada para o nome do usuário. Ele é do tipo "texto", tem uma classe "form-control" do bootstrap e é obrigatório (devido ao atributo required). O valor do campo é preenchido com o valor antigo (se houver), para que os dados não sejam perdidos em caso de erro de validação. Se houver um erro de validação para este campo, a classe "is-invalid" será adicionada para estilização.-->

                            @error('nome') <!--  Esta é uma diretiva do Blade que verifica se houve um erro de validação para o campo "placa". Se houver um erro, ele exibe uma mensagem de erro.-->
                                <span class="invalid-feedback" role="alert"> <!-- Esta é uma tag <span> que será usada para exibir a mensagem de erro. A classe "invalid-feedback" geralmente é estilizada para fornecer um feedback visual quando há um erro de validação no formulário.  -->
                                    <strong>{{ $message }}</strong> <!--  {{ $message }} é uma variável que contém a mensagem de erro específica para o campo "fone". O $message é uma variável pré-definida pelo Laravel que contém a mensagem de erro associada ao campo de formulário atualmente sendo validado. -->
                                </span>
                            @enderror <!-- Usada para validação dos dados e exibi uma mensagem de erro associado a um campo espefifico, nesse caso no (placa) -->
                        </div>

                        <input type="hidden" name="usuario_id" value="{{ $garagem->usuario_id }}"> <!--Atráves do input hidden ele passa os dados do usuario_id, ou seja, quando o formulário for enviado o usuario_id será incluido na requisição, então atráves do id do usuario ele ira pegar os dados da garagem e atualizar.-->


                        <div class="form-group"> 
                            <label for="qtd_vagas">Quantidade de Vagas:</label> 
                            <input id="qtd_vagas" type="number" class="form-control @error('qtd_vagas') is-invalid @enderror" name="qtd_vagas" value="{{ $garagem->qtd_vagas}}"  required autofocus> 

                            @error('qtd_vagas') 
                                    <strong>{{ $message }}</strong> 
                                </span>
                            @enderror 
                        </div>

                        
                        <!-- Restante dos campos do formulário com os valores preenchidos -->

                        <div class="form-group mb-0 botoes-cadastro"> <!-- Adicionando uma classe para os botões -->
                            <button type="submit" class="btn btn-primary"> <!-- Alterado para refletir a ação de edição -->
                                Atualizar Garagem
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

            $.ajax({
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
    });
</script>
@endsection
