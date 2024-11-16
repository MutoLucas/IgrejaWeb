<div class="col-sm text-center">
    <div class="container mt-4">
        <h1 class="mb-4">
            <i class="bi bi-people-fill text-primary"></i> Membro por Departamento
        </h1>

        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <div class="input-group">
                    <input type="text" wire:model="buscaPessoa" class="form-control border-primary" placeholder="Nome do membro">
                    <input type="text" wire:model="buscaDpt" class="form-control border-primary" placeholder="Nome do departamento">
                    <button class="btn btn-outline-primary" wire:click="resetBusca">
                        <i class="bi bi-arrow-clockwise"></i>
                    </button>
                    <button class="btn btn-primary" wire:click="buscar">
                        <i class="bi bi-search"></i>
                    </button>
                    <button class="btn btn-success" data-bs-target="#criarRelacao" data-bs-toggle="modal">
                        <i class="bi bi-plus-lg"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="container p-3 mt-2 shadow">
            <table class="table table-hover table-bordered shadow-sm">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Departamento</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pessoaDpt as $key)
                    <tr>
                        <td>{{ $key->nome }}</td>
                        <td>{{ $key->departamento }}</td>
                        <td>
                            <button class="btn btn-sm btn-danger" wire:click="deleteRelacionamento({{ $key->user_id }}, {{ $key->departamento_id }})">
                                <i class="bi bi-trash"></i> Excluir
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">Nenhum registro encontrado</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-3">
                {{ $pessoaDpt->links() }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="criarRelacao" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>
                        <i class="bi bi-link-45deg"></i> Criar Relacionamento
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Membro</label>
                            <select wire:model="idPessoa" class="form-select border-primary">
                                <option value="">Selecione um membro</option>
                                @foreach ($allUser as $user)
                                <option value="{{ $user->id }}">{{ $user->dado->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Departamento</label>
                            <select wire:model="idDpt" class="form-select border-primary">
                                <option value="">Selecione um departamento</option>
                                @foreach ($allDpt as $dpt)
                                <option value="{{ $dpt->id }}">{{ $dpt->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" wire:click="storeRelacionamento" data-bs-dismiss="modal">Criar Relação</button>
                </div>
            </div>
        </div>
    </div>
</div>
