<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            @if(Auth::check())
              <li class="nav-item">
                <a href="{{route('home')}}" class="nav-link active">
                  ( Olá! {{ Auth::user()->name }} ) 
                </a>
              </li>
              @if(!Route::is('home'))
                <li class="nav-item">
                  <a class="nav-link @if(Route::is('listar')) active @endif" href="{{route('listar')}}">Meus dados</a> 
                </li>
                <li class="nav-item">
                  <a class="nav-link @if(Route::is('cadastro-garagem')) active @endif" href="{{route('cadastro-garagem')}}">Cadastrar Garagem</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link @if(Route::is('listar-garagem')) active @endif" href="{{route('listar-garagem')}}">Lista de Garagem</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link @if(Route::is('cadastro-veiculo')) active @endif" href="{{route('cadastro-veiculo')}}">Cadastrar Veiculos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link @if(Route::is('listar-veiculos')) active @endif" href="{{route('listar-veiculos')}}">Lista de Veiculos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link @if(Route::is('garagens')) active @endif" href="{{route('garagens')}}">Minhas Garagens</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" style="cursor: pointer"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                      Logout
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> 
                      @csrf
                  </form> 
                </li>
              @endif
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