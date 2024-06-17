@extends('layout.master') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header titulo">Editar Veículo:</div>

                <div class="card-body cadastro">
                    <form id="formEditar" method="POST" action="{{ route('atualizar_veiculos', $veiculo->id) }}"> <!-- Alteração no action para a rota de edição -->

                        @csrf
                        <input type="hidden" name="usuario_id" value="{{ $veiculo->usuario_id }}"> <!-- Está criando um campo de entrada oculto em um formulário HTML, cujo valor será o ID do usuário associado a um determinado veículo.-->

                        <div class="form-group">
                            <label for="placa">Placa:</label>
                            <input id="placa" type="text" class="form-control @error('placa') is-invalid @enderror" name="placa" value="{{ $veiculo->placa }}" required>

                            @error('placa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                        </div>

                        <div class="form-group">
                            <label for="modelo">Modelo:</label>
                            <input id="modelo" type="text" class="form-control @error('modelo') is-invalid @enderror" name="modelo" value="{{ $veiculo->modelo }}" required>

                            @error('modelo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                        </div>

                        <div class="form-group">
                            <label for="cor">Cor:</label>
                            <input id="cor" type="text" class="form-control @error('cor') is-invalid @enderror" name="cor" value="{{ $veiculo->cor }}" required>

                            @error('cor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                        </div>

                        <div class="form-group">
                            <label for="marca">Marca:</label>
                            <input id="marca" type="text" class="form-control @error('marca') is-invalid @enderror" name="marca" value="{{ $veiculo->marca }}" required>

                            @error('marca')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                        </div> 
                        
                        <!-- Restante dos campos do formulário com os valores preenchidos -->

                        <div class="form-group mb-0 botoes-cadastro">
                            <button type="submit" class="btn btn-primary"> <!-- Alterado para refletir a ação de edição -->
                                Atualizar
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script> <!-- Importando da biblioteca o link do ajax jQuery Mask (mascara).-->
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
                    Swal.fire({
                    title: "Sucesso!!!",
                    text: "Os dados do usuário foram atualizados",
                    icon: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ok"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ url()->previous() }}";
                        }
                    });
                },
                error: function(xhr, status, error){
                    console.error('Erro');
                    Swal.fire({
                        icon: "error",
                        title: "ERRO...",
                        text: "Os dados não foram atualizados.",
                        showCancelButton: false,
                        cancelButtonColor: "#d33",
                    });
                }
            });
        });
        $('#placa').mask('AAA-0000');//Colocando um mask(mascara)para o campo placa
    });
</script>
@endsection