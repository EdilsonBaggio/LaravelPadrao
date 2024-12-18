@extends('layout.master') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header titulo">Editar Garagem:</div>

                <div class="card-body cadastro">
                    <form id="formEditar" method="POST" action="{{ route('atualizar_garagem', $garagem->id) }}">

                        @csrf

                        <div class="form-group">
                            <label for="nome">Nome da Garagem:</label>
                            <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ $garagem->nome }}" required autofocus>

                            @error('nome')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong> 
                            @enderror
                        </div>

                        <input type="hidden" name="usuario_id" value="{{ $garagem->usuario_id }}">

                        <div class="form-group"> 
                            <label for="qtd_vagas">Quantidade de Vagas:</label> 
                            <input id="qtd_vagas" type="number" class="form-control @error('qtd_vagas') is-invalid @enderror" name="qtd_vagas" value="{{ $garagem->qtd_vagas}}"  required autofocus> 
                            @error('qtd_vagas') 
                                    <strong>{{ $message }}</strong> 
                                </span>
                            @enderror 
                        </div>

                        <div class="form-group mb-0 botoes-cadastro">
                            <button type="submit" class="btn btn-primary">
                                Atualizar Garagem
                            </button>
                           
                            <a href="{{ url()->previous() }}" class="btn btn-secondary" >
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
        $('#formEditar').submit(function(e){
            e.preventDefault();

            var formData = $(this).serialize()

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                success: function(response){
                    console.log('Sucesso');
                    Swal.fire({
                    title: "Sucesso!!!",
                    text: "Os dados do usuário foram atualizados.",
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
                        title: "Oops...",
                        text: "Os dados não foram atualizados!",
                        showCancelButton: false,
                        cancelButtonColor: "#d33",
                    });
                }
            });
        });
    });
</script>
@endsection
