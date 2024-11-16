<div class="col-sm text-center">
    <div class="container">
        <h1 class="mt-3">
            <i class="bi bi-people text-primary"></i> Membros por Departamento
        </h1>

        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" wire:model="buscaPessoa" class="form-control border-primary" placeholder="Nome do membro">
                    <input type="text" wire:model="buscaDpt" class="form-control border-primary" placeholder="Nome do departamento">
                    <button class="btn btn-outline-primary" wire:click="resetBusca">
                        <i class="bi bi-arrow-clockwise"></i>
                    </button>
                    <button class="btn btn-primary" wire:click="buscar">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>

            <div class="col-auto">
                <button class="btn btn-success" data-bs-target="#criarRelacao" data-bs-toggle="modal">
                    <i class="bi bi-plus-lg"></i> Novo Relacionamento
                </button>
            </div>
        </div>

        <div class="row mt-3">
            @foreach ($pessoaDpt as $key)
            <div class="col-md-4 mb-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">{{ $key->nome }}</h5>
                        <p class="card-text"><strong>Departamento:</strong> {{ $key->departamento }}</p>
                        <button class="btn btn-danger btn-sm" wire:click="deleteRelacionamento({{ $key->user_id }}, {{ $key->departamento_id }})">
                            <i class="bi bi-building-dash"></i> Excluir
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $pessoaDpt->links() }}
        </div>
    </div>

    <div class="modal fade" id="criarRelacao" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>
                        <i class="bi bi-link-45deg"></i> Criar Relacionamento
                    </h3>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Campo Membro -->
                        <div class="col-md-6">
                            <label for="idPessoa" class="form-label">Membro</label>
                            <select wire:model="idPessoa" class="form-select border-primary">
                                <option value="">Selecione um membro</option>
                                @foreach ($allUser as $user)
                                <option value="{{ $user->id }}">{{ $user->dado->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Campo Departamento -->
                        <div class="col-md-6">
                            <label for="idDpt" class="form-label">Departamento</label>
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
