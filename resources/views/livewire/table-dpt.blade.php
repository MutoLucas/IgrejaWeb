<div class="col-sm text-center">
    <div class="container">
        <h1 class="mt-3">
            <i class="bi bi-folder2-open text-primary"></i> Departamentos
        </h1>
        <div class="row justify-content-center mb-4">
            <div class="col-md-6 mt-1">
                <div class="input-group">
                    <input type="text" wire:model="busca" class="form-control border-primary" placeholder="Digite o nome do departamento...">
                    <button class="btn btn-outline-primary" wire:click="resetBusca">
                        <i class="bi bi-arrow-clockwise"></i>
                    </button>
                    <button class="btn btn-primary" wire:click="buscarDpt">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>

            @if(auth()->user()->tipo == 'pastor')
            <div class="col-auto mt-1">
                <button class="btn btn-success" data-bs-target="#criarDpt" data-bs-toggle="modal">
                    <i class="bi bi-plus-lg"></i> Novo
                </button>
            </div>
            @endif
        </div>

        <div class="row mt-3">
            @foreach ($allDpts as $dpt)
            <div class="col-md-4 mb-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">{{ $dpt->nome }}</h5>
                        <p class="card-text">Pessoas: {{ $dpt->qtdPessoa }}</p>
                        @if(auth()->user()->tipo != 'lider')
                        <button class="btn btn-danger btn-sm" wire:click="deleteDpt({{ $dpt->id }})">
                            <i class="bi bi-building-dash"></i> Excluir
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $allDpts->links() }}
        </div>
    </div>

    <div class="modal fade" id="criarDpt" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3><i class="bi bi-plus-circle"></i> Criar Departamento</h3>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control border-primary" wire:model="nomeDpt" placeholder="Nome do Departamento">
                        <label for="">Nome do Departamento</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" wire:click="storeDpt" data-bs-dismiss="modal">Cadastrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
