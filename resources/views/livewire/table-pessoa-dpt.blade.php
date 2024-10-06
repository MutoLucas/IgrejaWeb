<div class="col-sm text-center">
    <div class="container">
        <h1>Membro por Departamento</h1>
        <div class="row">
            <div class="col-md input-group">
                <input type="text" wire:model="buscaPessoa" class="form-control border-primary" placeholder="Nome">
                <input type="text" wire:model="buscaDpt" class="form-control border-primary" placeholder="Departamento">
            </div>

            <div class="col-md btn-group">
                <button type="button" class="btn btn-outline-primary" wire:click="resetBusca"><i class="bi bi-arrow-clockwise"></i></button>
                <button type="button" class="btn btn-sm btn-outline-primary" wire:click="buscar"><i class="bi bi-search"></i></button>
                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-target="#criarRelacao" data-bs-toggle="modal"><i class="bi bi-plus-lg"></i></button>
            </div>
        </div>

        <div class="container p-3 mt-2 shadow">
            <table class="table table-bordered shadow">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Departamento</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pessoaDpt as $key)
                    <tr>
                        <td>{{ $key->nome }}</td>
                        <td>{{ $key->departamento }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger" wire:click="deleteRelacionamento({{ $key->user_id }}, {{ $key->departamento_id }})"><i class="bi bi-building-dash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $pessoaDpt->links() }}
        </div>
    </div>

    <div class="modal fade" id="criarRelacao" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Criar Relacionamento Membro/Departamento</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm">
                            <label for="">Membro</label>
                            <select wire:model="idPessoa" class="form-select border-primary">
                                <option value="">Select</option>
                                @foreach ($allUser as $user)
                                <option value="{{ $user->id }}">{{ $user->dado->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm">
                            <label class="form-label" for="">Departamento</label>
                            <select wire:model="idDpt" class="form-select border-primary">
                                <option value="">Select...</option>
                                @foreach ($allDpt as $dpt)
                                <option value="{{ $dpt->id }}">{{ $dpt->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="d-flex justify-content-end g-2">
                            <button type="button" class="btn btn-outline-danger me-1" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" wire:click="storeRelacionamento" aria-label="criar">Criar Relação</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
