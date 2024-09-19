@extends('layout.master') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header titulo">Cadastro Garagem:</div>

                <div class="card-body cadastro">
                    <form id="formCadastro">
                        @csrf

                        <div class="form-group"> 
                            <label for="nome">Nome da Garagem:</label>
                            <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ old('nome') }}" required autofocus>

                            @error('nome')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="usuario">Usuário:</label>
                            <select class="form-control mt-2" name="usuario_id" id="usuario">
                                <option value="">Selecione</option>
                                @foreach($registros as $registro)
                                    <option value="{{ $registro->id }}">{{ $registro->name }}</option>
                                @endforeach
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
                            <button type="submit" class="btn btn-primary">
                                Registrar Garagem
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
                    console.error(error);
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

        $('#usuario').change(function() {
            var selectedName = $(this).children("option:selected").text(); 
            $('#nome_usuario').val(selectedName);
        });
    });
</script>
@endsection 