@extends('layouts.default')

@section('title','Membro Info')

@section('content')

<div class="container mt-5">
    <div class="text-center">
        <img src="{{ asset('storage/'.$user->dado->foto) }}" alt="Foto do Membro" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
        <h3 class="mt-3">{{ $user->apelido }}</h3>
    </div>

    <div class="accordion accordion-flush">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Dados Pessoais
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse mt-3 p-3" data-bs-parent="#accordionFlushExample">
                <div class="row mb-3">
                    <div class="col-sm">
                        <label for="Email" class="form-label">Email address</label>
                        <input type="email" value="{{ $user->email }}" class="form-control border-primary" disabled>
                    </div>

                    <div class="col-sm">
                        <label for="apelido" class="form-label">Apelido</label>
                        <input type="text" value="{{ $user->apelido }}" class="form-control border-primary" id="apelido" name="apelido" maxlength="15" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm">
                        <label for="name" class="form-label">Nome Completo</label>
                        <input type="text" value="{{ $user->dado->nome }}" class="form-control border-primary" id="nome" name="nome" disabled>
                    </div>

                    <div class="col-sm">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" value="{{ $user->dado->cpf }}" class="form-control border-primary" id="cpf" name="cpf" maxlength="14" disabled>
                    </div>

                    <div class="col-sm">
                        <label for="cpf" class="form-label">RG</label>
                        <input type="text" value="{{ $user->dado->rg }}" class="form-control border-primary" id="rg" name="rg" disabled>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            const cpf = document.getElementById('cpf');
                            const rg = document.getElementById('rg');

                            if (cpf && cpf.value) {
                                let value = cpf.value.replace(/\D/g, '');
                                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                                value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                                cpf.value = value;
                            }

                            if (rg && rg.value) {
                                let value = rg.value.replace(/\D/g, '');
                                value = value.replace(/(\d{2})(\d)/, '$1.$2');
                                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                                value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                                rg.value = value;
                            }
                        });
                    </script>
                </div>

                <div class="row mb-3">
                    <div class="col-sm">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" value="{{ $user->dado->telefone }}" class="form-control border-primary" id="telefone" name="telefone" disabled>
                    </div>

                    <div class="col-sm">
                        <label class="form-label" for="sexo">Sexo</label>
                        <select class="form-select border-primary" id="sexo" name="sexo" disabled>
                            <option value="">Escolha...</option>
                            <option value="M" @if (isset($user->dado->sexo)) @selected($user->dado->sexo == 'M') @endif>Masculino</option>
                            <option value="F" @if (isset($user->dado->sexo)) @selected($user->dado->sexo == 'F') @endif>Femino</option>
                        </select>
                    </div>

                    <script>
                        const telefone = document.getElementById('telefone');

                        telefone.addEventListener('input', () => {
                            let value = telefone.value.replace(/\D/g, '');
                            value = value.replace(/(\d{2})(\d)/, '($1) $2');
                            value = value.replace(/(\d{5})(\d)/, '$1-$2');

                            telefone.value = value;
                        });

                    </script>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    Naturalidade
                </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="container row p-3">
                    <div class="col-sm p-3">
                        <div class="mb-3">
                            <label for="naturalidade" class="form-label">Naturalidade</label>
                            <input type="text" @if($user->dado->naturalidade == null) value="Ainda não preenchido" @else value="{{ $user->dado->naturalidade }}" @endif class="form-control border-primary" name="naturalidade" disabled>
                        </div>

                        <div>
                            <label for="uf_naturalidade" class="form-label">UF de Naturalidade</label>
                            <input type="text" @if($user->dado->uf_naturalidade == null) value="Ainda não preenchido" @else value="{{ $user->dado->uf_naturalidade }}" @endif class="form-control border-primary" name="uf_naturalidade" disabled>
                        </div>
                    </div>

                    <div class="col-sm p-3">
                        <div class="mb-3">
                            <label for="data_nasci" class="form-label">Data de Nascimento</label>
                            <input type="text" @if($user->dado->data_nasci == null) value="Ainda não preenchido" @else value="{{ $user->dado->data_nasci }}" @endif class="form-control border-primary" name="data_nasci" disabled>
                        </div>

                        <div class="">
                            <label class="form-label" for="estado civil">Estado Civil</label>
                            <input type="text" @if($user->dado->estado_civil == null) value="Ainda não preenchido" @else value="{{ $user->dado->estado_civil }}" @endif class="form-control border-primary" name="estado_civil" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTree" aria-expanded="false" aria-controls="flush-collapseTwo">
                    Endereço
                </button>
            </h2>
            <div id="flush-collapseTree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="container p-3">
                    <div class="container row mb-3">
                        <div class="col-sm">
                            <label for="cidade" class="form-label">Cidade</label>
                            <input type="text" @if (isset($user->endereco->cidade))
                            value="{{ $user->endereco->cidade }}"
                            @else
                            value="Não preenchido"
                            @endif class="form-control border-primary" name="cidade" disabled>
                        </div>

                        <div class="col-sm">
                            <label for="endereco" class="form-label">Endereço</label>
                            <input type="text" @if (isset($user->endereco->endereco))
                            value="{{ $user->endereco->endereco }}"
                            @else
                            value="Não preenchido"
                            @endif class="form-control border-primary" name="endereco" disabled>
                        </div>
                    </div>

                    <div class="container row">
                        <div class="col-sm">
                            <label for="uf" class="form-label">UF - Estado</label>
                            <input type="text" @if (isset($user->endereco->uf))
                            value="{{ $user->endereco->uf }}"
                            @else
                            value="Não preenchido"
                            @endif class="form-control border-primary" name="uf" disabled>
                        </div>

                        <div class="col-sm">
                            <label for="bairro" class="form-label">Bairro</label>
                            <input type="text" @if (isset($user->endereco->bairro))
                            value="{{ $user->endereco->bairro }}"
                            @else
                            value="Não preenchido"
                            @endif class="form-control border-primary" name="bairro" disabled>
                        </div>

                        <div class="col-sm">
                            <label for="complemento" class="form-label">Complemento</label>
                            <input type="text" @if (isset($user->endereco->complemento))
                            value="{{ $user->endereco->complemento }}"
                            @else
                            value="Não preenchido"
                            @endif class="form-control border-primary" name="complemento" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseTwo">
                    Devoção
                </button>
            </h2>
            <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="container p-3">
                    <div class="container row mb-3">
                        <div class="col-sm">
                            <label for="data_novo_nasci" class="form-label">Data de novo Nascimento</label>
                            <input type="text" @if (isset($user->devocao->data_novo_nasci))
                            value="{{ $user->devocao->data_novo_nasci }}"
                            @else
                            value="Não preenchido"
                            @endif class="form-control border-primary" name="data_novo_nasci" disabled>
                        </div>

                        <div class="col-sm">
                            <label class="form-label" for="rhema">Estado Rhema</label>
                            <input type="text" @if (isset($user->devocao->rhema))
                            value="{{ $user->devocao->rhema }}"
                            @else
                            value="Não preenchido"
                            @endif class="form-control border-primary" name="estado_rhema" disabled>
                        </div>
                    </div>

                    <div class="container row">
                        <div class="col-sm">
                            <label class="form-label" for="batismo_aguas">Batismo nas aguas</label>
                            <input type="text" @if (isset($user->devocao->batismo_aguas))
                            value="{{ $user->devocao->batismo_aguas }}"
                            @else
                            value="Não preenchido"
                            @endif class="form-control border-primary" name="batismo_aguas" disabled>
                        </div>

                        <div class="col-sm">
                            <label class="form-label" for="tipo_batismo_aguas">Tipo de batismo nas aguas</label>
                            <input type="text" @if (isset($user->devocao->tipo_batismo_aguas))
                            value="{{ $user->devocao->tipo_batismo_aguas }}"
                            @else
                            value="Não preenchido"
                            @endif class="form-control border-primary" name="tipo_batismo_aguas" disabled>
                        </div>

                        <div class="col-sm">
                            <label class="form-label" for="batismo_espirito">Batismo no Espirito Santo</label>
                            <input type="text" @if (isset($user->devocao->batismo_espirito))
                            value="{{ $user->devocao->batismo_espirito }}"
                            @else
                            value="Não preenchido"
                            @endif class="form-control border-primary" name="batismo_espirito" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseTwo">
                    Escolaridade
                </button>
            </h2>
            <div id="flush-collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="container p-3">
                    <div class="container row">
                        <div class="col-sm">
                            <label for="grau_instrucao" class="form-label">Grau de Instrução</label>
                            <input type="text" @if (isset($user->devocao->grau_instrucao))
                            value="{{ $user->devocao->grau_instrucao }}"
                            @else
                            value="Não preenchido"
                            @endif class="form-control border-primary" name="grau_instrucao" disabled>
                        </div>

                        <div class="col-sm">
                            <label for="formacao" class="form-label">Formação</label>
                            <input type="text" @if(isset($user->escolaridade->formacao))
                            value="{{ $user->escolaridade->formacao }}"
                            @else
                            value="Não preenchido"
                            @endif name="formacao" class="form-control border-primary" maxlength="50" disabled>
                        </div>

                        <div class="col-sm">
                            <label for="proficao" class="form-control">Profição</label>
                            <input type="text" @if(isset($user->escolaridade->proficao))
                            value="{{ $user->escolaridade->proficao }}"
                            @else
                            value="Não preenchido"
                            @endif name="proficao" class="form-control border-primary" maxlength="50" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection
