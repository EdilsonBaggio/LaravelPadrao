<div>
    <div class="container">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                @foreach($pessoas as $pessoa)
                    <div class="mb-2">Nome: {{ $pessoa->name }}</div>
                    <div class="mb-2">E-mail: {{ $pessoa->email }}</div>
                    <div class="mb-2">CPF: {{ $pessoa->cpf }}</div>
                    <div class="mb-2">CNH: {{ $pessoa->cnh }}</div>
                    <div class="mb-2">Telefone: {{ $pessoa->telefone }}</div>
                    <div class="mb-2">Data de nascimento: {{ \Carbon\Carbon::parse($pessoa->data_nascimento)->format('d/m/Y') }}</div>
                    <div class="mb-2">
                        <a class="btn btn-primary" href="{{ route('usuario', $pessoa->id) }}">
                            Atualizar os dados
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @push('script')
    <script>
        document.addEventListener('livewire:init', () => {
        });

        document.addEventListener('DOMContentLoaded', function() {
        });
    </script>
    @endpush
</div>
