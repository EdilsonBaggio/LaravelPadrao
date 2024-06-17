<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent"><!--Está criando um navbar (barra de navegação) responsiva -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0"><!--Usando a Classe navbar-->
            <li class="nav-item"> <!--É definido como um item da lista (li), com a classe do CSS nav-item -->
              <a class="nav-link @if(Route::is('cadastro')) active @endif" href="{{route('cadastro')}}">Cadastro de Usuários</a><!--Ao clicar na barra com o nome de cadsatro de usuários será redirecionada para a página por meio da rota cadastro-->
            </li>
            <li class="nav-item"><!--É definido como um item da lista (li), com a classe do CSS nav-item -->
              <a class="nav-link @if(Route::is('listar')) active @endif" href="{{route('listar')}}">Lista usuários</a> <!--O link(a) tem a calsse do CSS nav-link,que ao clicar na barra de listar usuários será redirecionada para a página por meio da rota listar-->
            </li> 
            <li class="nav-item">
              <a class="nav-link @if(Route::is('cadastro-veiculo')) active @endif" href="{{route('cadastro-veiculo')}}">Cadastro de Veiculos</a><!--Ao clicar na barra com o nome de cadsatro de veiculos será redirecionada para a página por meio da rota cadastro-veiculo -->
            </li>
            <li class="nav-item">
              <a class="nav-link @if(Route::is('listar-veiculos')) active @endif" href="{{route('listar-veiculos')}}">Lista de Veiculos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @if(Route::is('cadastro-garagem')) active @endif" href="{{route('cadastro-garagem')}}">Cadastro de Garagem</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @if(Route::is('listar-garagem')) active @endif" href="{{route('listar-garagem')}}">Lista de Garagem</a>
            </li>
        </ul>
        <ul class="navbar-nav mb-2 mb-lg-0 float-end"><!--Usando a classe navbar para aplicar estilos especifcicos do bootstrap,a classe float-end alinha a lista à direita da barra de navegação.-->
          @if(Auth::check()) <!--Verifica se o usuário está autenticado-->
            <li class="nav-item"><!--Definido um novo item da lista (li).-->
                  <a 
                    onclick="event.preventDefault(); //Está definindo um link(a), que quando clicar para fazer o envio das informações do login ele enviará o formulário e aparecerá o logout
                    document.getElementById('logout-form').submit();"> 
                    Logout
                  </a>
    
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> <!--Define um formulário de logout. Este formulário é oculto com style="display: none;", mas é submetido quando o link "Logout" é clicado.-->
                      @csrf
                  </form> 
              </li>
          @else <!--É executado se o usuário não estiver autenticado-->
              <li class="nav-item"><!--Definido um novo item da lista (li).-->
                  <a class="nav-link @if(Route::is('login')) active @endif" aria-current="page" href="{{route('login')}}">Login</a> <!--Define um link "Login" que será exibido na barra de navegação, usando a rota login.-->
              </li>
          @endif
      </ul>
    </div>
  </div>
</nav>