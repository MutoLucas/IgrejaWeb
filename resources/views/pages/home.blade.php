@extends('layouts.default')

@section('title', 'home - IgrejaWeb')

@section('content')

<div class="container-fluid shadow-lg p-3">

    <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary" style="background-image: url('{{ asset('imagens/home.jpeg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="col-lg-6 px-0">
          <h1 class="display-4 fst-italic text-light">Bem-vindo(a) a Verbo Jatobá</h1>
          <p class="lead my-3 text-light">Frase sobre a igreja ou alguma frase de boas vindas.</p>
        </div>
    </div>


  <div class="row mb-2">
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary-emphasis">Pastor</strong>
          <h3 class="mb-0">Fulano da Silva</h3>
          <div class="mb-1 text-body-secondary">Pastor Verbo da Vida Jatobá</div>
          <p class="card-text mb-auto">Aquele que guia, acolhe e inspira, sendo um farol de fé e amor para sua comunidade</p>
          <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
            Link para conversar via Whatsapp
            <svg class="bi"><use xlink:href="#chevron-right"></use></svg>
          </a>
        </div>
        <div class="col-auto d-none d-lg-block">
            <img src="{{ asset('imagens/demonstrativa_pastor.webp') }}" alt="Thumbnail" width="200" height="250" />
        </div>

      </div>
    </div>

    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-success-emphasis">Pastora</strong>
          <h3 class="mb-0">Fulana da Silva</h3>
          <div class="mb-1 text-body-secondary">Pastora Verbo da vida Jatobá</div>
          <p class="mb-auto">Aquela que acolhe e guia, oferecendo sabedoria e amor à sua comunidade com compaixão e fé</p>
          <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
            Link para conversar via Whatsapp
            <svg class="bi"><use xlink:href="#chevron-right"></use></svg>
          </a>
        </div>
        <div class="col-auto d-none d-lg-block">
            <img src="{{ asset('imagens/demonstrativa_pastora.webp') }}" alt="Thumbnail" width="200" height="250" />
        </div>
      </div>
    </div>
  </div>

  <div class="row g-5">
    <div class="col-md-8">
      <h3 class="pb-4 mb-4 fst-italic border-bottom">
        Nossa congregação
      </h3>

      <article class="blog-post">
        <h2 class="display-5 link-body-emphasis mb-1">Nossa História</h2>
        <p class="blog-post-meta">Fundada em 1995 por <a href="#">Fulano da Silva</a></p>

        <p>a Igreja nasceu do sonho de um pequeno grupo de moradores locais em criar um espaço onde a comunidade pudesse encontrar conforto, fé e um sentido de pertencimento. Com poucas cadeiras e um altar simples feito de madeira local, as primeiras reuniões eram realizadas na garagem do pastor Fulano, que sentia um forte chamado para ministrar e apoiar as pessoas em tempos de alegria e adversidade.</p>

        <hr>

        <p>No início, a igreja enfrentou desafios. O grupo era pequeno, e muitos vizinhos viam com ceticismo a ideia de uma nova congregação em uma cidade já repleta de igrejas tradicionais. Mas a mensagem de inclusão e amor ao próximo de Fulano começou a atrair pessoas de todos os cantos, desde jovens à procura de orientação até famílias em busca de uma comunidade acolhedora.

            Com o passar dos anos, a Igreja cresceu e ganhou espaço em um terreno próximo, onde foi erguido um prédio simples, mas acolhedor. A igreja se tornou conhecida por seus programas comunitários, como uma cozinha solidária para alimentar famílias carentes, um centro de apoio psicológico gratuito, e eventos culturais abertos ao público.</p>

        <h2>Objetivos da Igreja</h2>

        <p>A Igreja busca ser uma fonte de transformação positiva na cidade, promovendo valores de amor, inclusão e serviço comunitário. Seus principais objetivos são acolher pessoas de todas as origens, oferecer suporte espiritual e emocional, e incentivar a unidade entre os moradores. A igreja trabalha para fortalecer laços na comunidade através de ações como assistência a famílias em situação de vulnerabilidade, programas educacionais para jovens e iniciativas de saúde mental.</p>

      </article>

      <article class="blog-post">
        <h2 class="display-5 link-body-emphasis mb-1">Venha cultuar conosco</h2>
        <p class="blog-post-meta">Rua das Oliveiras, 250 - Bairro Nova Esperança, Vale do Sol, SP, CEP 12345-678</p>

        <h3>Dias de cultos</h3>
        <p>Cultos Semanáis</p>
        <table class="table">
          <thead>
            <tr>
              <th>Dia</th>
              <th>Inicio</th>
              <th>Termino</th>
              <th>Tipo</th>
            </tr>
          </thead>
          <tbody>
            <tr>
                <td>Terças-Feiras</td>
                <td>19h:30min</td>
                <td>21h:30min</td>
                <td>Oração e Intercessão</td>
            </tr>

            <tr>
                <td>Quintas-Feiras</td>
                <td>19h:30min</td>
                <td>21h:30min</td>
                <td>Celebração</td>
            </tr>

            <tr>
                <td>Domingos</td>
                <td>10h</td>
                <td>12h</td>
                <td>EBD</td>
            </tr>

            <tr>
              <td>Domingos</td>
              <td>18h:30min</td>
              <td>20h</td>
              <td>Celebração</td>
            </tr>

          </tbody>
        </table>
      </article>
    </div>

    <div class="col-md-4">
      <div class="position-sticky" style="top: 2rem;">
        <div class="p-4 mb-3 bg-body-tertiary rounded">
          <h4 class="fst-italic">Departamentos</h4>
          <p class="mb-0">Contamos com diversos departamentos, onde você poderá servir com amor e carinho à casa de Deus.</p>
        </div>

        <div>
          <h4 class="fst-italic">Departamentos</h4>
          <ul class="list-unstyled">

            @foreach ($dpts as $key)
            <li>
                <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top" href="#">
                <img src="{{ asset('imagens/logo_verbo.png') }}" alt="placeholder image">
                <div class="col-lg-8">
                <h6 class="mb-0">{{ $key->nome }}</h6>
                <small class="text-body-secondary">Venha servir com amor no(a) {{ $key->nome }} da Verbo da Vida Jatobá</small>
                </div>
                </a>
              </li>
            @endforeach

          </ul>
        </div>
      </div>
    </div>
  </div>


</div>

@endsection
