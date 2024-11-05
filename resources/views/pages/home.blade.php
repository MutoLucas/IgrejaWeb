@extends('layouts.default')

@section('title', 'home - VerboWeb')

@section('page_title', 'Home VerboWeb')

@section('content')

<div class="container shadow-lg p-3">

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
          <h3 class="mb-0">jackson Barbosa</h3>
          <div class="mb-1 text-body-secondary">Pastor Verbo da Vida Jatobá</div>
          <p class="card-text mb-auto">Alguma frase sobre o pastor ou um pequeno trechinho da historia</p>
          <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
            Link para conversar via Whatsapp???
            <svg class="bi"><use xlink:href="#chevron-right"></use></svg>
          </a>
        </div>
        <div class="col-auto d-none d-lg-block">
            <img src="{{ asset('imagens/jackson.png') }}" alt="Thumbnail" width="200" height="250" />
        </div>

      </div>
    </div>

    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-success-emphasis">Pastora</strong>
          <h3 class="mb-0">Andreia</h3>
          <div class="mb-1 text-body-secondary">Pastora Verbo da vida Jatobá</div>
          <p class="mb-auto">Alguma frase sobre o pastor ou um pequeno trechinho da historia</p>
          <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
            Link para conversar via Whatsapp???
            <svg class="bi"><use xlink:href="#chevron-right"></use></svg>
          </a>
        </div>
        <div class="col-auto d-none d-lg-block">
            <img src="{{ asset('imagens/andrea.png') }}" alt="Thumbnail" width="200" height="250" />
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
        <p class="blog-post-meta">Fundada em xx/xx/xxxx por <a href="#">nome</a></p>

        <p>Paragrafo sobre  história</p>

        <hr>

        <p>Paragrafo maior sobre a historia.</p>

        <h2>Objetivo em Jatobá</h2>

        <p>Paragrafo sobre o objetivo</p>

        <blockquote class="blockquote">
          <p>Por que jatobá</p>
        </blockquote>

        <p>Paragrafo sobre o que queremos fazer em jatobá</p>

      </article>

      <article class="blog-post">
        <h2 class="display-5 link-body-emphasis mb-1">Venha cultuar conosco</h2>
        <p class="blog-post-meta">Endereço</p>

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
                <td>Domingo</td>
                <td>10h</td>
                <td>12h</td>
                <td>EBD</td>
            </tr>

            <tr>
              <td>Domingo</td>
              <td>18h:30min</td>
              <td>20h</td>
              <td>Celebração</td>
            </tr>

            <tr>
                <td>Quinta-Feira</td>
                <td>19h:45min</td>
                <td>21h:30min</td>
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
