@extends('layout.master') 
@section('content')
<div class="container"> 
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header titulo">Cadastro Veículo:</div> 

                <div class="card-body cadastro">
                    <form id="formCadastro"> 
                        @csrf

                        <div class="form-group"> 
                            <label for="marca">Marca:</label> 
                            <input id="marca" type="text" class="form-control @error('marca') is-invalid @enderror" name="marca" value="{{ old('marca') }}" required autofocus> 
                        </div>

                        <div class="form-group"> 
                            <label for="modelo">Modelo:</label> 
                            <input id="modelo" type="text" class="form-control @error('modelo') is-invalid @enderror" name="modelo" value="{{ old('modelo') }}" required autofocus> 
                        </div>

                        <div class="form-group"> 
                            <label for="placa">Placa:</label>
                            <input id="placa" type="text" class="form-control @error('placa') is-invalid @enderror" name="placa" value="{{ old('placa') }}" required autofocus> 
                        </div>

                        <div class="form-group"> 
                            <label for="cor">Cor:</label> 
                            <input id="cor" type="text" class="form-control @error('cor') is-invalid @enderror" name="cor" value="{{ old('cor') }}" required autofocus> 
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

                        <div class="form-group mb-3">
                            <label for="garagem">Garagem:</label>
                            <select class="form-control mt-2" name="garagem_id" id="garagem">
                                <option value="">Selecione</option>
                                @foreach($garagens as $garagem)
                                    <option value="{{ $garagem->id }}">{{ $garagem->nome }} - vagas: {{ $garagem->qtd_vagas}}</option>>
                                @endforeach
                            </select>
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

            $.ajax({
                url: '{{ route("veiculos") }}',
                type: 'POST',
                data: formData,
                success: function(response){
                    Swal.fire({
                        title: "Sucesso!!!",
                        text: response.success,
                        icon: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ok",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("#placa").val("");
                            $("#usuario").val("Selecione").change();
                            $("#modelo").val("");
                            $("#cor").val("");
                            $("#marca").val("");
                            window.location.href = "{{ route('listar-veiculos') }}";
                        }
                    });
                },
                error: function(xhr, status, error){
                    var errorMessage = xhr.responseJSON?.error || "O veículo não foi cadastrado.";
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: errorMessage,
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

        $('#placa').mask('AAA-0000');
    });

</script>
@endsection 