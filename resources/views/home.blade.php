@extends('layout.master')
@section('content')
<div class="container-fluid content-top">
    <div class="row">
        <div class="col-md-12 content-banner">
            <div>
                <div id="video-container" class="video-container" class="video">
                    <video id="video" width="100%" height="100%" autoplay loop muted>
                        <source src="{{ Vite::asset('resources/images/padrao.mp4') }}" type="video/mp4">
                        Seu navegador não suporta o elemento de vídeo.
                    </video>
                </div>
            </div>
        </div>
        <div class="col-md-6 content-sobre" id="quem">
            <p data-aos="fade-down">
                A Catuaí é uma produtora boutique, especializada em construir conteúdos personalizados que atendem às necessidades de cada cliente.
            </p>
            <p data-aos="fade-down">
                Com visão artística e conhecimento técnico, impulsiona
                negócios por meio de produções audiovisuais, como lives,
                materiais institucionais, vídeos comerciais, webinares e
                conteúdo para eventos, e tudo o mais que sua imaginação
                mandar. 
            </p>
            <h1 data-aos="fade-down">
                Não importa a
                dimensão, seu projeto
                é sempre especial.
            </h1>
        </div>
        <div class="col-md-6">
            <div class="imagem-xicaras">
                <img  class="img-fluid animate__animated" src="{{ Vite::asset('resources/images/canecas-1.png') }}" alt="">
            </div>
        </div>
    </div>
</div>
<div class="container-fluid content-padrao">
    <div class="row">
        <div class="col-md-6 fundo-xicaras"></div>
        <div class="col-md-6 texto-guarani">
            <p data-aos="fade-down">
                Catuaí é uma variedade de grão de café especial,
                um produto 100% brasileiro responsável por
                grande parte da construção da riqueza do país e
                uma das iguarias mais exportadas na história do
                Brasil. 
            </p>
            <span data-aos="fade-down">Catuaí," em guarani, significa</span>
            <h2 data-aos="fade-down">"o melhor que há".</h2>
        </div>
    </div>
</div>
<div class="container-fluid content-listas">
    <div class="row">
        <div class="col-md-6">
            <ul data-aos="flip-up">
                <li>Transmissões ao Vivo de Eventos Corporativos</li>
                <li>Vídeos institucionais</li>
                <li>Gravações e Lives em Estúdio</li>
                <li>Cobertura de feiras e eventos</li>
            </ul>
        </div>
        <div class="col-md-6">
            <ul data-aos="flip-up">
                <li>Transmissões ao Vivo In Company</li>
                <li>Vídeo</li>
                <li>Treinamentos</li>
                <li>Produção de Fotos</li>
                <li>Podcasts</li>
            </ul>
        </div>
    </div>
</div>
<div class="col-md-12 content-video">
    <div>
        <div style="position: relative; width: 100%; height: 0; padding-bottom: 56.25%;">
            <iframe src="https://player.vimeo.com/video/901308126?h=0fe2e6777d&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" style="position: absolute; width: 100%; height: 100%; top: 0; left: 0;" title="padrao Institucional (horizontal)" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        </div> 
        <script src="https://player.vimeo.com/api/player.js"></script>
    </div>
</div>
<div class="col-md-12 content-clientes">
    <img class="img-fluid serv-desktop" src="{{ Vite::asset('resources/images/servicos.png') }}" alt="">
    <img class="img-fluid serv-mobile" src="{{ Vite::asset('resources/images/servicos-m.png') }}" alt="">
</div>
<div class="container-fluid content-posts" id="cases">
    <div class="row">
        <div class="col-md-12">
            <div class="row content-item">
                <div class="col-md-7">
                    <div class="content-imagem-post">
                        <img class="img-fluid" src="{{ Vite::asset('resources/images/posts/cloud.png') }}" alt="">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="content-texto-post">
                        <div class="dados">
                            <p><strong>Job:</strong> Oracle Worlds 2023</p>
                            <p><strong>Agência:</strong> DM9</p>
                            <p><strong>Local:</strong> Thomio Othake</p>
                        </div>
                        <div class="texto">
                            <p>
                                O que rolou: Transmissão ao vivo para o evento
                                Global da Oracle, realizado em São Paulo. Um dia
                                inteiro dedicada à tecnologia e parceiros da Oracle,
                                transmitido ao vivo para uma audiência em mais de
                                70 países, com interação em tempo real para
                                plataforma dedicada da empresa.
                            </p>
                            <p>
                                O grande desafio foi a exigência que um evento
                                deste porte necessita, com um fluxo de trabalho
                                100% em 4k, da captação à transmissão. Realizamos
                                também uma gravação em qualidade proxy para
                                edição e divulgação de cada uma das palestras em
                                tempo real.
                            </p>
                        </div>
                        <p class="p-conteudo-especial" data-aos="flip-up">
                            <img  class="img-fluid" src="{{ Vite::asset('resources/images/icones/padrao-post-logo.png') }}" alt="">
                            <span>CONTEÚDOS ESPECIAIS</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row content-item">
                <div class="col-md-7">
                    <div class="content-imagem-post">
                        <img  class="img-fluid" src="{{ Vite::asset('resources/images/posts/show.png') }}" alt="">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="content-texto-post">
                        <div class="dados">
                            <p><strong>Job:</strong> Exagerados - Tributo à Cazuza</p>
                            <p><strong>Agência:</strong> Universal Music</p>
                            <p><strong>Local:</strong> Manduri.Art</p>
                        </div>
                        <div class="texto">
                            <p>
                                O que rolou: A Universal Music promoveu o
                                casamento de seus novos artistas com a obra
                                atemporal de Cazuza. Uma série de releituras com
                                arranjos reimaginados para reviver todo o talento do
                                poeta.
                            </p>
                            <p>
                                O projeto contou com captação multi-câmera ao
                                vivo em estilo Live-Session. Para isso, realizamos a
                                elaboração do projeto audiovisual, direção de
                                fotografia, gravação, edição e finalização. Os
                                conteúdos contam com mais de meio milhão de
                                visualizações nas redes do Cazuza.
                            </p>
                        </div>
                        <p class="p-conteudo-especial" data-aos="flip-up">
                            <img  class="img-fluid" src="{{ Vite::asset('resources/images/icones/padrao-post-logo.png') }}" alt="">
                            <span>CONTEÚDOS ESPECIAIS</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row content-item">
                <div class="col-md-7">
                    <div class="content-imagem-post">
                        <img  class="img-fluid" src="{{ Vite::asset('resources/images/posts/unimed-click.png') }}" alt="">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="content-texto-post">
                        <div class="dados">
                            <p><strong>Job:</strong> Unimed Click</p>
                            <p><strong>Agência:</strong> Unimed Brasil</p>
                            <p><strong>Local:</strong> Sede da Unimed Av. Paulista</p>
                        </div>
                        <div class="texto">
                            <p>
                                O que rolou: No auge da pandemia, a Unimed realizou
                                um evento para conectar todas as suas unidades a
                                nível nacional. Devido às restrições da época, a
                                empresa escolheu por transformar seu escritório no
                                palco deste evento, que recebe dezenas de
                                palestrantes, presenciais e remotos, debates e clientes
                                para dois dias de eventos. 
                            </p>
                            <p>
                                Levamos toda a infraestrutura audiovisual para realizar
                                a transmissão diretamente na sede da Unimed, com
                                direito à palco móvel em 360, entradas de
                                participantes remotos ao vivo, sonorização para outras
                                partes do escritório para funcionários presenciais e
                                toda a coordenação técnica deste verdadeiro desafio
                                tecnológico.
                            </p>
                        </div>
                        <p class="p-conteudo-especial" data-aos="flip-up">
                            <img  class="img-fluid" src="{{ Vite::asset('resources/images/icones/padrao-post-logo.png') }}" alt="">
                            <span>CONTEÚDOS ESPECIAIS</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
<div class="whatsapp animate__animated animate__bounce">
    <a href="https://api.whatsapp.com/send?phone=5511933226464" target="_blank" rel="noopener noreferrer">
        <img  class="img-fluid" src="{{ Vite::asset('resources/images/whatsapp.png') }}" alt="">
    </a>
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