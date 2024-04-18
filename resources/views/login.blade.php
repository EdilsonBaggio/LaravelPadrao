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
                     <label class="mb-2" for="usuario">usuario</label> 
                     <input id="usuario" type="text" class="form-control @error('usuario') is-invalid @enderror" name="usuario" value="{{ old('usuario') }}" required autofocus> 
                  </div>
                  @error('Usuário:') 
                  <span class="invalid-feedback" role="alert"> 
                     <strong>{{ $message }}</strong> 
                  </span>
                  @enderror 
                  <br>
                  <div class="form-group">
                     <label class="mb-2" for="password">Senha:</label>
                     <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                  </div>
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                  <br>
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