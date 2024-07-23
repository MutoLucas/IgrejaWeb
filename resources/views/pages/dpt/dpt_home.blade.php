@extends('layouts.default')

@section('title', 'VerboWeb - Departamentos')

@section('content')

@if(Session::get('error'))
<div class="alert alert-danger p-3 text-center">
    {{ Session::get('error') }}
</div>
@endif

@if(Session::Get('success'))
<div class="alert alert-success p-3 text-center">
    {{ Session::get('success') }}
</div>
@endif

<div class="container p-3 border border-danger">
    <div class="row">
        <div class="col-sm">

        </div>

        <div class="col-sm">
            <form action="{{ route('dpt.index') }}" method="get" class="row">
                <div class="col-sm-7">
                    <input type="text" name="busca" class="form-control border-primary mb-2" placeholder="Pesquisa de Departamento">
                </div>
                <div class="col-sm">
                    <button type="submit" class="btn btn btn-outline-primary">Buscar</button>
                </div>
                <div class="col-sm">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalDpt">
                        <i class="bi bi-plus"></i>
                    </button>

                </div>
            </form>
            <table class="table mt-2">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th scope="col">Departamento</th>
                        <th scope="col">Gtd.Pessoas</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dpts as $dpt)
                    <tr class="text-center table-primary">
                        <td>{{ $dpt->nome }}</td>
                        <td></td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('dpt.excluir', $dpt->id)}}" class="btn btn-sm btn-danger">
                                    Excluir
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-sm">
            <form action="" method="get" class="row">
                <div class="col-sm-7">
                    <input type="text" name="buscaPessoa" class="form-control border-primary mb-2" placeholder="Pesquisa de Pessoa">
                </div>
                <div class="col-sm">
                    <button type="submit" class="btn btn btn-outline-primary">Buscar</button>
                </div>
                <div class="col-sm">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalPessoa">
                        <i class="bi bi-plus"></i>
                    </button>
                </div>
            </form>
            <table class="table mt-2">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th scope="col">Nome</th>
                        <th scope="col">Gtd.Pessoas</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dpts as $dpt)
                    <tr class="text-center table-primary">
                        <td>{{ $dpt->nome }}</td>
                        <td></td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('dpt.excluir', $dpt->id)}}" class="btn btn-sm btn-danger">
                                    Excluir
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalDpt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Criar Departamento</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dpt.criar') }}" method="POST" id="formDpt">
                    @csrf
                    <div>
                        <label for="nome" class="form-label">Nome do Departamento</label>
                        <input type="text" name="nome" class="form-control border-primary" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary" onclick="document.getElementById('formDpt').submit();">Criar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalPessoa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Pessoa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="formDpt">
                    @csrf

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary" onclick="document.getElementById('formDpt').submit();">Adicionar</button>
            </div>
        </div>
    </div>
</div>


@endsection
