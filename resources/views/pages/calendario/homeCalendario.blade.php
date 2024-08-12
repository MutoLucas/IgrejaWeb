@extends('layouts.default')

@section('title', 'VerboWeb - Calendario')

@section('content')

@if(Session::get('error'))
<div id="menssage" class="alert alert-danger p-3 text-center">
    {{ Session::get('error') }}
</div>
<script>
    setTimeout(function() {
        var menssage = document.getElementById('menssage');
        if (menssage) {
            menssage.style.display = 'none';
        }
    }, 4000);

</script>
@endif

@if(Session::Get('success'))
<div id="menssage" class="alert alert-success p-3 text-center">
    {{ Session::get('success') }}
</div>
<script>
    setTimeout(function() {
        var menssage = document.getElementById('menssage');
        if (menssage) {
            menssage.style.display = 'none';
        }
    }, 4000);

</script>
@endif

<div class="container">
    @if(auth()->user()->tipo === 'admin' || auth()->user()->tipo === 'pastor' || auth()->user()->tipo === 'lider')
    <div class="container">
        <form action="">
            <div class="input-group my-3">
                <input type="date" class="form-control border-primary" id="data" name="data">
                <input type="text" class="form-control border-primary" id="pessoa" name="pessoa" placeholder="Membro">
                <input type="text" class="form-control border-primary" id="dpt" name="dpt" placeholder="Departamento">
                <button type="submite" class="btn btn-outline-primary">
                    <i class="bi bi-search"></i>
                </button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#criarEvento" class="btn btn-outline-primary">
                    <i class="bi bi-plus-lg"></i>
                </button>
            </div>
        </form>
    </div>
    @else
    <div class="container" style="max-width: 500px">
        <form action="">
            <div class="input-group my-3">
                <input type="date" class="form-control border-primary" id="data" name="data">
                <input type="text" class="form-control border-primary" id="dpt" name="dpt" placeholder="Departamento">
                <button type="submite" class="btn btn-outline-primary">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    </div>
    @endif

    <div class="border rounded rounded-3 shadow container">
        <div class="row p-3">

            @foreach ($eventos as $evento)
            <div class="card col-sm-3 shadow m-3">
                <div class="card-body">
                    <h5 class="card-title">({{ $evento->data }}) - {{ $evento->nome }} - {{ $evento->departamento }}</h5>
                    <p class="card-text">{{ $evento->descricao }}</p>
                    @if(auth()->user()->tipo === 'admin' || auth()->user()->tipo === 'pastor' || auth()->user()->tipo === 'lider')
                    <a href="" class="btn btn-danger">Excluir</a>
                    @endif
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>

<div class="modal fade" id="criarEvento" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-3">Criar Evento</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('calendario.criar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <div class="row">

                            <div class="col-sm">
                                <label for="user" class="form-label">Membro</label>
                                <select name="user" id="user" class="form-select border-primary">
                                    <option value="" selected>Selecione</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->dado->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm">
                                <label for="departamento" class="form-label">Departamento</label>
                                <select name="departamento" id="departamento" class="form-select border-primary">
                                    <option value="" selected>Selecione</option>
                                    @foreach ($dpts as $dpt)
                                        <option value="{{ $dpt->id }}">{{ $dpt->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm">
                                <label for="data" class="form-label">Data</label>
                                <input type="date" class="form-control border-primary" name="data" id="data">
                            </div>
                        </div>

                        <div class="container mt-3">
                            <div class="form-floating">
                                <textarea class="form-control border-primary" name="descricao" id="descricao" cols="30" rows="10"></textarea>
                                <label for="descricao">Descrição</label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <button class="btn btn-primary">
                                Criar Evento
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
