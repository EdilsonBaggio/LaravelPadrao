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
                            <input id="telefone" type="number" class="form-control @error('telefone') is-invalid @enderror" name="telefone" value="{{ $user->telefone }}" required autofocus>

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

                        <div class="form-group mb-0 botoes-cadastro">
                            <button type="submit" class="btn btn-primary"> <!-- Alterado para refletir a ação de edição -->
                                Editar Usuário
                            </button>
                           
                            <a href="{{ url()->previous() }}" class="btn btn-secondary" > <!-- Retorna à página anterior -->
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
        $('#formEditar').submit(function(e){
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                success: function(response){
                    console.log('Sucesso');
                },
                error: function(xhr, status, error){
                    console.error('Erro');
                }
            });
        });
    });
</script>
@endsection
