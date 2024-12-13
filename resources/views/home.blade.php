@extends('layout.master')
@section('content')
<div class="row gx-0 mt-5 justify-content-center">
    <div class="col-2">
        <a class="p-4 border bg-light" href="{{ route('listar') }}" target="_blank">Meus dados</a>
    </div>
    <div class="col-2">
        <a class="p-4 border bg-light" href="{{route('cadastro-garagem')}}" target="_blank">Cadastrar Garagem</a>
    </div>
    <div class="col-2">
        <a class="p-4 border bg-light" href="{{route('listar-garagem')}}" target="_blank">Listar Garagens</a>
    </div>
    <div class="col-2">
        <a class="p-4 border bg-light" href="{{route('cadastro-veiculo')}}" target="_blank">Cadastrar Veiculos</a>
    </div>
</div>
@endsection
@section('script')
@endsection