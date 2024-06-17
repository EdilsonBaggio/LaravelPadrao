@extends('layout.master') 
@section('content')
<div class="container"> <!-- conteiner bootstrap onde contém todo o conteúdo da página -->
    <div class="row justify-content-center"> <!-- Comando bootstrap que centraliza o conteúdo  -->
        <div class="col-md-8"> <!-- Esta é uma coluna bootstrap que ocupa 8 das 12 colunas disponíveis na grade, centralizando assim o formulário na página.  -->
            <div class="card"> <!-- Este é um cartão bootstrap que contém o formulário de cadastro.  -->
                <div class="card-header titulo">Cadastro Garagem:</div> <!-- Seção de cabeçalho do cartão, que contém o título "Cadastro:". -->

                <div class="card-body cadastro"> <!--  É a seção do corpo do cartão, que contém o formulário de cadastro. -->
                    <form id="formCadastro"> <!-- Este é o formulário HTML que enviará os dados para o servidor. O atributo method="POST" especifica que os dados serão enviados por meio de uma solicitação POST. O atributo action="" especifica o URL para o qual os dados serão enviados. -->
                        @csrf <!--  Este é um token de segurança CSRF,gerado automaticamente pelo Laravel para proteger contra ataques  -->

                        <div class="form-group"> <!--  Este é um grupo de formulário bootstrap. -->
                            <label for="nome">Nome da Garagem:</label> <!-- Este é um rótulo de campo de formulário para o campo "placa". -->
                            <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ old('nome') }}" required autofocus> <!--  Este é o campo de entrada para o nome do usuário. Ele é do tipo "texto", tem uma classe "form-control" do bootstrap e é obrigatório (devido ao atributo required). O valor do campo é preenchido com o valor antigo (se houver), para que os dados não sejam perdidos em caso de erro de validação. Se houver um erro de validação para este campo, a classe "is-invalid" será adicionada para estilização.-->

                            @error('nome') <!--  Esta é uma diretiva do Blade que verifica se houve um erro de validação para o campo "placa". Se houver um erro, ele exibe uma mensagem de erro.-->
                                <span class="invalid-feedback" role="alert"> <!-- Esta é uma tag <span> que será usada para exibir a mensagem de erro. A classe "invalid-feedback" geralmente é estilizada para fornecer um feedback visual quando há um erro de validação no formulário.  -->
                                    <strong>{{ $message }}</strong> <!--  {{ $message }} é uma variável que contém a mensagem de erro específica para o campo "fone". O $message é uma variável pré-definida pelo Laravel que contém a mensagem de erro associada ao campo de formulário atualmente sendo validado. -->
                                </span>
                            @enderror <!-- Usada para validação dos dados e exibi uma mensagem de erro associado a um campo espefifico, nesse caso no (placa) -->
                        </div>

                        <div class="form-group mb-3">
                            <label for="usuario">Usuário:</label><!--Cria o nome usuario para o campo select -->
                            <select class="form-control mt-2" name="usuario_id" id="usuario"> <!--Alterado de 'usuario' para 'usuario_id' -->
                                <option value="">Selecione</option><!--Cria uma opção que permite o usuario selecionar o nome que deseja,o value(valor) está vazio pois será preenchido com o nome que o usuário irá selecionar-->
                                @foreach($registros as $registro) <!--Inicia um loop foreach itera sobre uma coleção de registros chamada $registros,cada registro representa um usuário-->
                                    <option value="{{ $registro->id }}">{{ $registro->name }}</option> <!--A partir do registro pelo id do banco de dados ele vai pegar o nome das pessoas que estão cadastradas e puxar o nome, aparecendo assim os nomes e o usuariopodendo escolher a opção que deseja-->
                                @endforeach<!--Finaliza o loop foreach.-->
                            </select>
                        </div>

                        <input type="hidden" name="usuario" id="nome_usuario" value="">

                        <div class="form-group"> 
                            <label for="qtd_vagas">Quantidade de Vagas:</label> 
                            <input id="qtd_vagas" type="number" class="form-control @error('qtd_vagas') is-invalid @enderror" name="qtd_vagas" value="{{ old('qtd_vagas') }}" required autofocus> 

                            @error('qtd_vagas') 
                                    <strong>{{ $message }}</strong> 
                                </span>
                            @enderror 
                        </div>

                        <div class="form-group mb-0 botoes-cadastro">
                            <button type="submit" class="btn btn-primary"> <!--  Este é o botão de envio do formulário. Quando clicado, enviará os dados do formulário para o servidor.-->
                                Registrar Garagem
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script><!-- Importando da biblioteca o link do ajax.-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script> <!-- Importando da biblioteca o link do ajax jQuery Mask (mascara).-->
<script>
    $(document).ready(function() {
        $('#formCadastro').submit(function(e){
            e.preventDefault(); // Evita o comportamento padrão de envio do formulário

            // Serialize o formulário para enviar os dados
            var formData = $(this).serialize();

            $.ajax({
                url: '{{ route("garagem") }}',
                type: 'POST',
                data: formData,
                success: function(response){
                    console.log('Sucesso');
                    Swal.fire({
                    title: "Sucesso!!!",
                    text: "Garagem cadastrada com sucesso.",
                    icon: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ok",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("#nome").val("");
                            $("#usuario").val("Selecione").change();
                            $("#qtd_vagas").val("");
                            window.location.href = "";
                        }
                    });
                },
                error: function(xhr, status, error){
                    console.error('Erro');
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "A Garagem não foi cadastrado.",
                        showCancelButton: false,
                        cancelButtonColor: "#d33",
                    });
                }
            });
        });

        $('#usuario').change(function() {//Pegando os Usuarios cadastrados no banco de dados e listando os nomes 
            var selectedName = $(this).children("option:selected").text(); // Obtém o texto da opção selecionada
            $('#nome_usuario').val(selectedName); // Atualiza o valor do campo oculto com o nome do usuário selecionado
        });
    });
</script>
@endsection 