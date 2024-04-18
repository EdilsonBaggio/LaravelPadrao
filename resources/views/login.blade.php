@extends('layout.master') 
@section('content')
<div class="container"> 
   <div class="row justify-content-center"> 
      <div class="col-md-8"> 
         <div class="card"> 
            <div class="card-header titulo">Login:</div> 

            <div class="card-body Login">
               <form method="POST" action=""> 
                  @csrf 

                  <div class="form-group"> 
                     <label for="Usuário:">Usuário:</label> 
                     <input id="Usuário:" type="text" class="form-control @error('Usuário:') is-invalid @enderror" name="Usuário:" value="{{ old('Usuário:') }}" required autofocus> 
                  </div>
                  @error('Usuário:') 
                  <span class="invalid-feedback" role="alert"> 
                     <strong>{{ $message }}</strong> 
                  </span>
                  @enderror 


                  <div class="form-group">
                     <label for="password">Senha:</label>
                     <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                  </div>
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                  <br>
                  </br>
                  <div class="form-group mb-0 botoes-cadastro">
                     <button type="submit" class="btn btn-primary"> 
                     Entrar
                     </button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection