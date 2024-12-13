@extends('layout.master')
@section('content')
<div class="row gx-0 mt-5 justify-content-center content-home">
    <div class="col-sm-2 text-center">
        <a href="{{ route('listar') }}">
            <div class="botoes-home p-4 border bg-light">Meus dados</div>
        </a>
    </div>
    <div class="col-2 text-center">
        <a href="{{route('cadastro-garagem')}}">
            <div class="botoes-home p-4 border bg-light">Cadastrar Garagem</div>
        </a>
    </div>
    <div class="col-2 text-center">
        <a href="{{route('listar-garagem')}}">
            <div class="botoes-home p-4 border bg-light">Listar Garagens</div>
        </a>
    </div>
    <div class="col-2 text-center">
        <a href="{{route('cadastro-veiculo')}}">
            <div class="botoes-home p-4 border bg-light">Cadastrar Veiculos</div>
        </a>
    </div>
    <div class="col-2 text-center">
        <a style="cursor: pointer"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <div class="botoes-home p-4 border bg-light">Sair</div>
        </a>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> 
            @csrf
        </form> 
    </div>
</div>
@endsection
@section('script')
@endsection