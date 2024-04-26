@extends('layout.master')
@section('content')
<div class="container-fluid content-formulario" id="contato">
    <div class="row">
        <div class="col-md-6">
            <div class="content-msg" data-aos="flip-up">
                <h3>Deixe seu projeto em boas mãos!</h3>
                <p>Preencha corretamente as
                    informações do formulário para
                    que um de nossos especialistas
                    entre em contato.
                </p>
            </div>
        </div>
        <div class="col-md-6">
            <h4>Fale conosco</h4>
            <form id="formContato">
                @csrf
                <div class="form-group">
                    <label for="nome">Nome*</label>
                    <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome completo" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail*</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Seu e-mail" required>
                </div>
                <div class="form-group">
                    <label for="assunto">Assunto*</label>
                    <input type="text" class="form-control" name="assunto" id="assunto" placeholder="Seu assunto" required>
                </div>
                <div class="form-group">
                    <label for="mensagem">Mensagem:*</label>
                    <textarea class="form-control" id="mensagem" name="mensagem" rows="3" placeholder="Insira aqui sua mensagem" required></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="voltar animate__animated animate__bounce">
    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="14" viewBox="0 0 23 14" fill="none">
        <path d="M9.949 0.662951L0.648816 10.1657C0.443228 10.3741 0.280048 10.622 0.16869 10.8951C0.057332 11.1682 -1.10977e-07 11.4611 -9.80446e-08 11.757C-8.51118e-08 12.0529 0.0573321 12.3458 0.16869 12.6189C0.280048 12.892 0.443228 13.1399 0.648816 13.3483C1.05978 13.7657 1.61571 14 2.19519 14C2.77467 14 3.3306 13.7657 3.74156 13.3483L11.5063 5.41434L19.2711 13.3483C19.6821 13.7657 20.238 14 20.8175 14C21.397 14 21.9529 13.7657 22.3639 13.3483C22.5672 13.1388 22.728 12.8905 22.8371 12.6174C22.9463 12.3444 23.0016 12.052 23 11.757C23.0016 11.462 22.9463 11.1696 22.8371 10.8966C22.728 10.6235 22.5672 10.3752 22.3639 10.1657L13.0637 0.662951C12.8598 0.452884 12.6172 0.286151 12.3499 0.172367C12.0826 0.0585829 11.7959 7.90932e-07 11.5063 8.03589e-07C11.2168 8.16246e-07 10.9301 0.058583 10.6628 0.172367C10.3955 0.286151 10.1529 0.452884 9.949 0.662951Z" fill="#FFC615"/>
    </svg>
</div>
<div class="modal" id="sucesso" data-bs-toggle="modal">
    <div class="modal-dialog">
      <div class="modal-content content-msg">
        <div class="modal-body">
            <img  class="img-fluid" src="{{ Vite::asset('resources/images/icones/sucesso.png') }}" alt="">
            <h1>Enviado com sucesso!</h1>
            <p>Seu contato foi enviado com sucesso!</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-fechar" data-bs-dismiss="modal">Ok</button>
        </div>
      </div>
    </div>
</div>
<div class="modal" id="erro" data-bs-toggle="modal">
    <div class="modal-dialog">
      <div class="modal-content content-msg">
        <div class="modal-body">
            <img  class="img-fluid" src="{{ Vite::asset('resources/images/icones/erro.png') }}" alt="">
            <h1>Erro ao enviar!</h1>
            <p>Não foi possível enviar o seu contato.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-fechar" data-bs-dismiss="modal">Ok</button>
        </div>
      </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(window).scroll(function() {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > 200) {
                $('.voltar').css({"display":"flex"});
                $('.imagem-xicaras img').addClass('animate__headShake');
            } else {
                $('.voltar').css({"display":"none"});
                $('.imagem-xicaras img').removeClass('animate__headShake');
            }
        });

        $('.voltar').click(function() {
            $('html, body').scrollTop(0);
        });

        $('#formContato').submit(function(e){
            e.preventDefault(); // Evita o comportamento padrão de envio do formulário

            // Serialize o formulário para enviar os dados
            var formData = $(this).serialize();

            $.ajax({
                url: '{{ route("contato.send") }}',
                type: 'POST',
                data: formData,
                success: function(response){
                    // Lidar com a resposta bem-sucedida aqui
                    console.log('Resposta do servidor:', response);
                    $('#nome').val("");
                    $('#email').val("");
                    $('#assunto').val("");
                    $('#mensagem').val("");
                    $('#sucesso').css({'display': 'flex'});
                },
                error: function(xhr, status, error){
                    // Lidar com erros aqui
                    console.error('Erro na chamada AJAX:', error);
                    $('#erro').css({'display': 'flex'});
                }
            });
        });

        $('.btn-fechar').click(function(){
            $('#sucesso').css({'display': 'none'});
            $('#erro').css({'display': 'none'});
        });
    });

</script>
@endsection