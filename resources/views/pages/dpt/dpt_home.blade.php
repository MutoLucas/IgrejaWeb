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

<div class="container p-3">
    <div class="row">

        <div class="col-sm">
            <form action="{{ route('dpt.index') }}" method="get" class="row">
                <div class="input-group">
                    <input type="text" name="buscaDpt" class="form-control border-primary" placeholder="Pesquisa de Departamento">
                    <button type="submit" class="btn btn btn-outline-primary">Buscar</button>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#ModalDpt">
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
                        <td>{{ $dpt->qtdPessoa }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#ModalPessoaAdd-{{ $dpt->id }}">
                                    <i class="bi bi-person-plus"></i>
                                </button>
                                <div class="modal fade" id="ModalPessoaAdd-{{ $dpt->id }}" tabindex="-1" aria-labelledby="ModalLabel-{{ $dpt->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel-{{ $dpt->id }}">Adicionar Pessoa</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('dpt.adicionar', $dpt->id) }}" method="POST" id="formAdd-{{ $dpt->id }}">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <label for="departamento">Departamento</label>
                                                            <input type="text" class="form-control border-primary" value="{{ $dpt->nome }}" disabled>
                                                        </div>
                                                        <div class="col-sm">
                                                            <label for="pessoa">Pessoa</label>
                                                            <select class="form-select" name="pessoa" id="pessoa">
                                                                <option value="">...</option>
                                                                @foreach ($allUser as $user)
                                                                <option value="{{ $user->id }}">{{ $user->apelido }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary" onclick="document.getElementById('formAdd-{{ $dpt->id }}').submit();">Adicionar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-sm btn-danger ms-2" data-bs-toggle="modal" data-bs-target="#ModalExcluirDpt-{{ $dpt->id }}">
                                    <i class="bi bi-building-dash"></i>
                                </button>
                                <div class="modal fade" id="ModalExcluirDpt-{{ $dpt->id }}" tabindex="-1" aria-labelledby="ModalLabel-{{ $dpt->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                Deseja realmente excluir o departamento {{ $dpt->nome }}?
                                            </div>

                                            <div class="modal-body">
                                                <p>Ao excluir este departamento, irá excluir todas as relações de mambros da igreja que estão vinculados a este departamento </p>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">fechar</button>
                                                <a href="{{ route('dpt.excluir', $dpt->id) }}" class="btn btn-danger">Excluir</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $dpts->links() }}
        </div>

        <div class="col-sm">
            <form action="{{ route('dpt.index') }}" method="get" class="row">
                <div class="input-group">
                    <input type="text" name="buscaApelido" class="form-control border-primary" placeholder="Apelido">
                    <input type="text" name="buscaDpt2" class="form-control border-primary" placeholder="Departamento">
                    <button type="submit" class="btn btn btn-outline-primary">Buscar</button>
                </div>
            </form>
            <table class="table mt-2">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th scope="col">Apelido</th>
                        <th scope="col">Departamento</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pessoaDpt as $pessoa)
                    <tr class="text-center table-primary">
                        <td>{{ $pessoa->nome }}</td>
                        <td>{{ $pessoa->departamento }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#ExcluirPessoa-{{ $pessoa->id }}">
                                    <i class="bi bi-person-dash"></i>
                                </button>
                                <div class="modal fade" id="ExcluirPessoa-{{ $pessoa->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                Deseja realmente desvincular {{ $pessoa->nome }} do departamento {{ $pessoa->departamento }}?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">fechar</button>
                                                <a href="{{ route('dpt.desvincular', ['nome_pessoa' => $pessoa->nome, 'nome_dpt' => $pessoa->departamento]) }}" class="btn btn-danger">Desvincular</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $pessoaDpt->links() }}
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




@endsection
