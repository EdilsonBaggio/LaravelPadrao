@extends('layout.master')
@section('content')
<div class="row gx-0 mt-5 justify-content-center">
    <div class="col-2">
        <a class="p-4 border bg-light" href="{{ route('listar') }}">Meus dados</a>
    </div>
    <div class="col-2">
        <a class="p-4 border bg-light" href="{{route('cadastro-garagem')}}">Cadastrar Garagem</a>
    </div>
    <div class="col-2">
        <a class="p-4 border bg-light" href="{{route('listar-garagem')}}">Listar Garagens</a>
    </div>
    <div class="col-2">
        <a class="p-4 border bg-light" href="{{route('cadastro-veiculo')}}">Cadastrar Veiculos</a>
    </div>
</div>
@endsection
@section('script')
@endsection