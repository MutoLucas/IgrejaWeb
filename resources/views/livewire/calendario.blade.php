<div class="container p-3">
    <div class="container row">
        <div class="col-sm input-group mb-1">
            <input type="text" class="form-control border-secondary" wire:model="buscaApelido" placeholder="Membro">
            <input type="text" class="form-control border-secondary" wire:model="buscaDpt" placeholder="Departamento">
            <input type="date" class="form-control border-secondary" wire:model="buscaData">
        </div>

        <div class="col-sm-2 btn-group mb-1">
            <button class="btn btn-outline-primary" type="button" wire:click="resetBusca">
                <i class="bi bi-arrow-clockwise"></i>
            </button>
            <button class="btn btn-outline-primary" type="button" wire:click="busca">
                <i class="bi bi-search"></i>
            </button>
            <button class="btn btn-outline-primary" data-bs-target="#criarEvento" data-bs-toggle="modal" type="button">
                <i class="bi bi-plus-lg"></i>
            </button>
        </div>
    </div>

    <div class="container">
        <div class="row p-2">
            @foreach($eventos as $evento)
            <div class="mx-auto my-2 card border-dark shadow" style="max-width: 200px">
                <div class="card-body">
                    <h5 class="card-title">{{ $evento->apelido }} - {{ $evento->nome }}</h5>
                    <h6 class="card-subtitle mb-2 text-success">{{ $evento->data }}</h6>
                    <p class="card-text">{{ $evento->descricao }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="modal fade" id="criarEvento" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Criar Evento</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm">
                            <label for="">Data Evento</label>
                            <input wire:model="dataEvento" type="date" class="form-control border-primary">
                        </div>

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
                            <label for="">Departamento</label>
                            <select wire:model="idDpt" class="form-select border-primary">
                                <option value="">Select</option>
                                @foreach ($allDpt as $dpt)
                                <option value="{{ $dpt->id }}">{{ $dpt->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <textarea wire:model="desc" class="form-control border-primary mt-2 mx-auto" cols="30" rows="3" placeholder="Descrição do Evento"></textarea>
                    </div>

                    <div class="modal-footer">
                        <div class="d-flex justify-content-end g-2">
                            <button type="button" class="btn btn-outline-danger me-1" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" wire:click="storeEvento" aria-label="criar">Criar Evento</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
