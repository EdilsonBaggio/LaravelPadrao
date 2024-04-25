<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link @if(Route::is('cadastro')) active @endif" href="{{route('cadastro')}}">Cadastro de Usuários</a>
          </li>
          @if(Auth::check())
            <li class="nav-item">
              <a class="nav-link @if(Route::is('listar')) active @endif" href="{{route('listar')}}">Listar usuários</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link @if(Route::is('cadastro-veiculo')) active @endif" href="{{route('cadastro-veiculo')}}">Cadastro de Veiculos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @if(Route::is('cadastro-veiculo')) active @endif" href="{{route('listar-veiculos')}}">Lista de Veiculos</a>
            </li>
          @endif
        </ul>
        <ul class="navbar-nav mb-2 mb-lg-0 float-end">
          @if(Auth::check())
            <li class="nav-item">
                  <a
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    Logout
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </li>
          @else
              <li class="nav-item">
                  <a class="nav-link @if(Route::is('login')) active @endif" aria-current="page" href="{{route('login')}}">Login</a>
              </li>
          @endif
      </ul>
    </div>
  </div>
</nav>