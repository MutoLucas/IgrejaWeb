<div class="container p-3">
    <h1 class="text-center">Caléndario de Lidereança</h1>
    <div class="row">
        <div class="col-sm input-group my-1">
            @if(auth()->user()->tipo == "pastor" || auth()->user()->tipo == "lider")
            <input type="text" class="form-control border-secondary" wire:model="buscaApelido" placeholder="Membro">
            <input type="text" class="form-control border-secondary" wire:model="buscaDpt" placeholder="Departamento">
            <input type="date" class="form-control border-secondary" wire:model="buscaData">
            @else
            <input type="text" class="form-control border-secondary" wire:model="buscaDpt" placeholder="Departamento">
            <input type="date" class="form-control border-secondary" wire:model="buscaData">
            @endif

        </div>

        <div class="col-sm-2 btn-group my-1">
            @if(auth()->user()->tipo == "pastor" || auth()->user()->tipo == "lider")
            <button class="btn btn-outline-primary" type="button" wire:click="resetBusca">
                <i class="bi bi-arrow-clockwise"></i>
            </button>
            <button class="btn btn-outline-primary" type="button" wire:click="busca">
                <i class="bi bi-search"></i>
            </button>
            <button class="btn btn-outline-primary" data-bs-target="#criarEvento" data-bs-toggle="modal" type="button">
                <i class="bi bi-plus-lg"></i>
            </button>
            @else
            <button class="btn btn-outline-primary" type="button" wire:click="resetBusca">
                <i class="bi bi-arrow-clockwise"></i>
            </button>
            <button class="btn btn-outline-primary" type="button" wire:click="busca">
                <i class="bi bi-search"></i>
            </button>
            @endif
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-evenly">
            @foreach($eventos as $evento)
                @if(auth()->user()->tipo == 'pastor' || auth()->user()->tipo == "lider")
                <div class="my-2 card border-dark shadow" style="max-width: 300px">
                    <button class="position-absolute top-0 end-0 mt-2 me-2 btn btn-sm btn-danger" wire:click="excluirEvento({{ $evento->id }})"><i class="bi bi-dash-circle"></i></button>
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-building-fill"></i>{{ $evento->nome }}</h5>
                        <h6 class="card-title"><i class="bi bi-person-fill"></i>{{ $evento->apelido }}</h6>
                        <h7 class="card-subtitle mb-2 text-success"><i class="bi bi-calendar-check"></i> {{ $evento->data }}</h7>
                        @if($evento->descricao == null)
                        <p class="card-text text-center">Sem observações</p>
                        @else
                        <p class="card-text text-center">{{ $evento->descricao }}</p>
                        @endif
                    </div>
                </div>
                @else
                <div class="my-2 card border-dark shadow" style="max-width: 300px">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-building-fill"></i>{{ $evento->nome }}</h5>
                        <h7 class="card-subtitle mb-2 text-success"><i class="bi bi-calendar-check"></i> {{ $evento->data }}</h7>
                        @if($evento->descricao == null)
                        <p class="card-text text-center">Sem observações</p>
                        @else
                        <p class="card-text text-center">{{ $evento->descricao }}</p>
                        @endif
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>

    @if(auth()->user()->tipo == 'pastor' || auth()->user()->tipo == "lider")
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
                            <input wire:model="dataEvento" id="data" type="date" class="form-control border-primary">
                        </div>

                        <div class="col-sm">
                            <label for="">Membro</label>
                            <select wire:model="idPessoa" id="membro" class="form-select border-primary">
                                <option value="">Select</option>
                                @foreach ($allUser as $user)
                                <option value="{{ $user->id }}">{{ $user->dado->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm">
                            <label for="">Departamento</label>
                            <select wire:model="idDpt" id="dpt" class="form-select border-primary">
                                <option value="">Select</option>
                                @foreach ($allDpt as $dpt)
                                <option value="{{ $dpt->id }}">{{ $dpt->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <textarea wire:model="desc" class="form-control border-primary mt-2 mx-auto" cols="30" rows="3" maxlength="50" placeholder="Descrição do Evento"></textarea>
                    </div>

                    <div class="modal-footer">
                        <div class="d-flex justify-content-end g-2">
                            <button type="button" class="btn btn-outline-danger me-1" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" wire:click="storeEvento" id="btnEvento" disabled aria-label="criar">Criar Evento</button>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const dataEvento = document.getElementById('data');
                            const membro = document.getElementById('membro');
                            const dpt = document.getElementById('dpt');
                            const criarEventoBtn = document.getElementById('btnEvento');

                            function verificarCampos() {
                                if (dataEvento.value && membro.value && dpt.value) {
                                    criarEventoBtn.disabled = false;
                                } else {
                                    criarEventoBtn.disabled = true;
                                }
                            }

                            dataEvento.addEventListener('input', verificarCampos);
                            membro.addEventListener('change', verificarCampos);
                            dpt.addEventListener('change', verificarCampos);
                        });

                    </script>

                </div>
            </div>
        </div>
    </div>
    @endif

    @if(auth()->user()->tipo == "lider")
    <div class="container p-3 mt-5">
        <h1 class="text-center">Caléndario</h1>

        <div class="row">
            <div class="col-sm input-group my-1">
                <input type="text" class="form-control border-secondary" wire:model="buscaDptServi" placeholder="Departamento">
                <input type="date" class="form-control border-secondary" wire:model="buscaDataServi">
            </div>

            <div class="col-sm-2 btn-group my-1">
                <button class="btn btn-outline-primary" type="button" wire:click="resetBuscaServi">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
                <button class="btn btn-outline-primary" type="button" wire:click="buscaServi">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-evenly">
                @foreach($queryServi as $evento)
                    <div class="my-2 card border-dark shadow" style="max-width: 300px">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-building-fill"></i>{{ $evento->nome }}</h5>
                            <h7 class="card-subtitle mb-2 text-success"><i class="bi bi-calendar-check"></i> {{ $evento->data }}</h7>
                            @if($evento->descricao == null)
                            <p class="card-text text-center">Sem observações</p>
                            @else
                            <p class="card-text text-center">{{ $evento->descricao }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif




</div>
