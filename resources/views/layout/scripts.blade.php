<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>

<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
    integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/0.9.0/jquery.mask.min.js"
    integrity="sha512-oJCa6FS2+zO3EitUSj+xeiEN9UTr+AjqlBZO58OPadb2RfqwxHpjTU8ckIC8F4nKvom7iru2s8Jwdo+Z8zm0Vg=="
    crossorigin="anonymous"></script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    AOS.init();
    $(document).ready(function(){
        $('#formContato').submit(function(e){
        e.preventDefault(); // Evita o comportamento padrão de envio do formulário
 
        // Serialize o formulário para enviar os dados
        var formData = $(this).serialize();

        console.log(formData);
 
        $.ajax({
            url: '{{ route("contato.send") }}', // Substitua isso pelo caminho correto do endpoint
            type: 'POST',
            data: formData,
            success: function(response){
                // Lidar com a resposta bem-sucedida aqui
                console.log('Resposta do servidor:', response);
                $('#name').val("");
                $('#email').val("");
                $('#fone').val("");
                $('#date').val("");
                $('#cpf').val("");
                $('#password').val("");
                $('#password_confirmation').val("");
            },
            error: function(xhr, status, error){
                // Lidar com erros aqui
                console.error('Erro na chamada AJAX:', error);
                $('#erro').css({'display': 'flex'});
            }
        });
    });
    });
</script>
@yield('script')
@stack('script')
