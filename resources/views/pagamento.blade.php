@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pagamento</h1>
    <p>Desbloqueie a criação de novas garagens realizando o pagamento.</p>
    <form action="{{ route('stripe.processar') }}" method="POST">
        @csrf
        <input type="hidden" name="usuario_id" value="{{ $usuarioId }}">
        <button type="submit" class="btn btn-primary">Pagar R$50,00</button>
    </form>
</div>
@endsection
