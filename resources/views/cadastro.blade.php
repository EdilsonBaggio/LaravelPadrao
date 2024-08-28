@extends('layout.master') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header titulo">Cadastro:</div>

                <div class="card-body cadastro">
                    <form id="formCadastro">
                        @csrf 

                        <div class="form-group"> 
                            <label for="name">Nome:</label> 
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>

                            @error('name') 
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
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
                            <label for="telefone">Telefone:</label>
                            <input id="telefone" type="text" class="form-control @error('telefone') is-invalid @enderror" name="telefone" value="{{ old('telefone') }}" required autofocus>

                            @error('telefone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="data_nascimento">Data de Nascimento:</label>
                            <input id="data_nascimento" type="date" class="form-control @error('data_nascimento') is-invalid @enderror" name="data_nascimento" value="{{ old('data_nascimento') }}" required autofocus>

                            @error('data_nascimento')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="cpf">CPF:</label>
                            <input id="cpf" type="text" class="form-control @error('cpf') is-invalid @enderror" name="cpf"  value="{{ old('cpf') }}" required autofocus>

                            @error('int')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="cnh">CNH:</label>
                            <input id="cnh" type="text" class="form-control @error('cnh') is-invalid @enderror" name="cnh"  value="{{ old('cnh') }}" required autofocus>

                            @error('int')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Senha:</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="verificacao_password">Confirme a Senha:</label>
                            <input id="verificacao_password" type="password" class="form-control" name="verificacao_password" required>
                        </div>

                        <div class="form-group mb-0 botoes-cadastro">
                            <button type="submit" class="btn btn-primary"> 
                                Criar Cadastro
                            </button>
                           
                            <a href="" class="btn btn-secondary" >
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
    $(document).ready(function() {
        $('#formCadastro').submit(function(e){
            e.preventDefault();

            var formData = $(this).serialize();
            var password = $("#password").val();
            var verificacao_password = $("#verificacao_password").val();
 
            if(password != verificacao_password){
                Swal.fire({
                            icon: "error",
                            title: "ERRO...",
                            text: 'As senhas não correspondem.',
                            showCancelButton: false,
                            cancelButtonColor: "#d33",
                        });
                return false; 
            }

            $.ajax({
                url: '{{ route("pessoas") }}',
                type: 'POST',
                data: formData,
                success: function(response){
                    Swal.fire({
                    title: "Sucesso!!!",
                    text: "Usuário cadastrado com sucesso.",
                    icon: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ok"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("#name").val("");
                            $("#email").val("");
                            $("#verificacao_email").val("");
                            $("#telefone").val("");
                            $("#data_nascimento").val("");
                            $("#cpf").val("");
                            $("#cnh").val("");
                            $("#password").val("");
                            $("#verificacao_password").val("");
                            window.location.href = "{{ url()->previous() }}";
                        }
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: 'Não foi possivel efetuar o cadastro.',
                        showCancelButton: false,
                        cancelButtonColor: "#d33",
                    });
                }
            });
        });
        $('#telefone').mask('(00) 00000-0000')
        $('#cpf').mask('000.000.000-00', {reverse: true});
    });
</script>
@endsection

