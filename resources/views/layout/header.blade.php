<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          @if(Auth::check())
            <li class="nav-item text-center">
              <a href="{{route('listar')}}" class="nav-link active">
                ( Olá! {{ Auth::user()->name }} ) 
              </a>
            </li>
            <li class="nav-item mobile">
              <a class="nav-link @if(Route::is('listar')) active @endif" href="{{route('listar')}}">Meus dados</a> 
            </li>
            <li class="nav-item mobile">
              <a class="nav-link @if(Route::is('cadastro-garagem')) active @endif" href="{{route('cadastro-garagem')}}">Cadastrar Garagem</a>
            </li>
            <li class="nav-item mobile">
              <a class="nav-link @if(Route::is('listar-garagem')) active @endif" href="{{route('listar-garagem')}}">Lista de Garagem</a>
            </li>
            <li class="nav-item mobile">
              <a class="nav-link @if(Route::is('cadastro-veiculo')) active @endif" href="{{route('cadastro-veiculo')}}">Cadastrar Veiculos</a>
            </li>
            <li class="nav-item mobile">
              <a class="nav-link @if(Route::is('listar-veiculos')) active @endif" href="{{route('listar-veiculos')}}">Lista de Veiculos</a>
            </li>
            <li class="nav-item mobile">
              <a class="nav-link @if(Route::is('garagens')) active @endif" href="{{route('garagens')}}">Minhas Garagens</a>
            </li>
            <li class="nav-item mobile">
              <a class="nav-link" style="cursor: pointer"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  Sair
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> 
                  @csrf
              </form> 
            </li>
          @else
              <li class="nav-item"> 
                <a class="nav-link @if(Route::is('cadastro')) active @endif" href="{{route('cadastro')}}">Cadastro</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link @if(Route::is('login')) active @endif" aria-current="page" href="{{route('login')}}">Login</a>
              </li>
          @endif
        </ul>
    </div>
  </div>
</nav>
@if(Auth::check())
<div class="container">
  <div class="row gx-0 mt-5 content-home">
    <div class="col-sm-2 text-center">
        <a href="{{ route('listar') }}">
            <div class="botoes-home p-4 border" @if(Route::is('listar')) style="background: #574b4b; color: #fff;" @endif>Meus dados</div>
        </a>
    </div>
    <div class="col-sm-2 text-center">
        <a href="{{route('cadastro-garagem')}}">
            <div class="botoes-home p-4 border" @if(Route::is('cadastro-garagem')) style="background: #574b4b; color: #fff;" @endif>Cadastrar Garagem</div>
        </a>
    </div>
    <div class="col-sm-2 text-center">
        <a href="{{route('listar-garagem')}}">
            <div class="botoes-home p-4 border" @if(Route::is('listar-garagem')) style="background: #574b4b; color: #fff;" @endif>Listar Garagens</div>
        </a>
    </div>
    <div class="col-sm-2 text-center">
        <a href="{{route('cadastro-veiculo')}}">
            <div class="botoes-home p-4 border" @if(Route::is('cadastro-veiculo')) style="background: #574b4b; color: #fff;" @endif>Cadastrar Veiculos</div>
        </a>
    </div>
    <div class="col-sm-2 text-center">
      <a href="{{route('listar-veiculos')}}">
          <div class="botoes-home p-4 border" @if(Route::is('listar-veiculos')) style="background: #574b4b; color: #fff;" @endif>Veiculos</div>
      </a>
  </div>
    <div class="col-sm-2 text-center">
        <a style="cursor: pointer"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <div class="botoes-home p-4 border">Sair</div>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> 
            @csrf
        </form> 
    </div>
  </div>
</div>
@endif