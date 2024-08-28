@extends('layout.master') 

@section('content')
<div class="container"> 
   <div class="row justify-content-center"> 
      <div class="col-md-8"> 
         <div class="card"> 
            <div class="card-header titulo">Esqueci a senha:</div> 

            <div class="card-body Login">
                <form method="POST" action="{{ route('redefinir') }}">
                  @csrf 

                  <div class="form-group"> 
                     <label class="mb-2" for="usuario">Email</label> 
                     <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="" required autofocus> 
                     @error('email') 
                        <span class="invalid-feedback" role="alert"> 
                            <strong>{{ $message }}</strong> 
                        </span>
                    @enderror 
                  </div>
                  <br>
                  <div class="form-group mb-0 botoes-cadastro">
                     <button type="submit" class="btn btn-primary"> 
                        Enviar senha
                     </button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
