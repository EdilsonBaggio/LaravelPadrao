<div>
    <div class="container">
        <div class="card">
            <div class="card-body text-center">
                @foreach($pessoas as $pessoa)
                    <div class="p-3"><i class="bi bi-person"></i> {{ $pessoa->name }}</div>
                    <div class="p-3"><i class="bi bi-envelope-at"></i> {{ $pessoa->email }}</div>
                    <div class="p-3"><i class="bi bi-person-vcard-fill"></i> {{ $pessoa->cpf }}</div>
                    <div class="p-3"><i class="bi bi-postcard-fill"></i> {{ $pessoa->cnh }}</div>
                    <div class="p-3"><i class="bi bi-phone"></i> {{ $pessoa->telefone }}</div>
                    <div class="p-3"><i class="bi bi-calendar2-week"></i> {{ \Carbon\Carbon::parse($pessoa->data_nascimento)->format('d/m/Y') }}</div>
                    <div class="p-3">
                        <a class="btn btn-primary" href="{{ route('usuario', $pessoa->id) }}">
                            <i class="bi bi-pencil-square"></i> Atualizar os dados
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
