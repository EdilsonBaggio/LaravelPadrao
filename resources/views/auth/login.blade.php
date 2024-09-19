@extends('layout.master') 

@section('content')
<div class="container"> 
   <div class="row justify-content-center"> 
      <div class="col-md-8"> 
         <div class="card"> 
            <div class="card-header titulo">Login:</div> 

            <div class="card-body Login">
               <form method="POST" action="{{ route('login') }}">
                  @csrf 

                  <div class="form-group"> 
                     <label class="mb-2" for="usuario">Usuário</label> 
                     <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus> 
                     @error('email') 
                        <span class="invalid-feedback" role="alert"> 
                           <strong>{{ $message }}</strong> 
                        </span>
                     @enderror 
                  </div>
                  <br>
                  <div class="form-group">
                     <label class="mb-2" for="password">Senha:</label>
                     <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required>
                     @error('password')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
                  <br>
                  <div class="form-group mb-0 botoes-cadastro">
                     <button type="submit" class="btn btn-primary"> 
                     Entrar
                     </button>
                  </div>
               </form>
               <br>
               <a href="{{ route('esqueci') }}" rel="noopener noreferrer">
                  Esqueci a senha!
               </a>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
