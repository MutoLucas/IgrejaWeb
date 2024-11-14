<div class="container p-3">
    <div class="text-center mb-4 p-3 bg-light rounded shadow-sm">
        <h1>
            @if(auth()->user()->tipo == 'pastor')
            Calendário de Liderança Pastoral
            @elseif(auth()->user()->tipo == 'lider')
            Calendário de Liderança
            @else
            Calendário
            @endif
        </h1>
    </div>

    <div class="row mb-3">
        <div class="col-sm input-group">
            @if(auth()->user()->tipo == "pastor" || auth()->user()->tipo == "lider")
            <input type="text" class="form-control border-secondary rounded-start" wire:model="buscaApelido" placeholder="Membro">
            <input type="text" class="form-control border-secondary" wire:model="buscaDpt" placeholder="Departamento">
            <input type="date" class="form-control border-secondary rounded-end" wire:model="buscaData">
            @else
            <input type="text" class="form-control border-secondary rounded-start" wire:model="buscaDpt" placeholder="Departamento">
            <input type="date" class="form-control border-secondary rounded-end" wire:model="buscaData">
            @endif
        </div>

        <div class="col-sm-2 d-flex justify-content-end mt-2 mt-sm-0">
            @if(auth()->user()->tipo == "pastor" || auth()->user()->tipo == "lider")
            <button class="btn btn-outline-primary me-1" type="button" wire:click="resetBusca">
                <i class="bi bi-arrow-clockwise"></i>
            </button>
            <button class="btn btn-primary me-1" type="button" wire:click="busca">
                <i class="bi bi-search"></i>
            </button>
            <button class="btn btn-success" data-bs-target="#criarEvento" data-bs-toggle="modal" type="button">
                <i class="bi bi-plus-lg"></i>
            </button>
            @else
            <button class="btn btn-outline-primary me-1" type="button" wire:click="resetBusca">
                <i class="bi bi-arrow-clockwise"></i>
            </button>
            <button class="btn btn-primary" type="button" wire:click="busca">
                <i class="bi bi-search"></i>
            </button>
            @endif
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-evenly">
            @foreach($eventos as $evento)
            <div class="my-2 card border-0 shadow-sm rounded" style="max-width: 300px;">
                @if(auth()->user()->tipo == 'pastor' || auth()->user()->tipo == "lider")
                <button class="position-absolute top-0 end-0 mt-2 me-2 btn btn-sm btn-danger" wire:click="excluirEvento({{ $evento->id }})">
                    <i class="bi bi-dash-circle"></i>
                </button>
                @endif
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-building-fill me-1"></i>{{ $evento->nome }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted"><i class="bi bi-person-fill me-1"></i>{{ $evento->apelido ?? 'Sem membro' }}</h6>
                    <h6 class="card-subtitle mb-2 text-success"><i class="bi bi-calendar-check me-1"></i>{{ $evento->data }}</h6>
                    <p class="card-text text-center">{{ $evento->descricao ?? 'Sem observações' }}</p>
                </div>
            </div>
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
    <div class="container p-4 mt-5 bg-light rounded shadow-lg">
        <h1 class="text-center text-primary mb-4">Calendário</h1>

        <div class="row g-3 align-items-center">
            <div class="col-lg-8">
                <div class="input-group">
                    <input type="text" class="form-control border-primary" wire:model="buscaDptServi" placeholder="Buscar por Departamento">
                    <input type="date" class="form-control border-primary" wire:model="buscaDataServi">
                </div>
            </div>
            <div class="col-lg-4 d-flex justify-content-end">
                <button class="btn btn-outline-primary me-2" type="button" wire:click="resetBuscaServi">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
                <button class="btn btn-primary" type="button" wire:click="buscaServi">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>

        <div class="container mt-4">
            <div class="row justify-content-center">
                @foreach($queryServi as $evento)
                <div class="col-md-4 mb-4">
                    <div class="card border-primary shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-primary"><i class="bi bi-building-fill me-2"></i>{{ $evento->nome }}</h5>
                            <h6 class="card-subtitle text-muted mb-2"><i class="bi bi-calendar-check me-2"></i>{{ $evento->data }}</h6>
                            <p class="card-text text-center">
                                {{ $evento->descricao ? $evento->descricao : 'Sem observações' }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

</div>
