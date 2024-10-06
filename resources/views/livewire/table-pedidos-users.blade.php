<div class="col-sm text-center">
    <h1>Pedidos De Usuários</h1>
    <div class="container">
        <button type="button" class="btn btn-outline-primary" wire:click="" style="width: 100px">
            <i class="bi bi-arrow-clockwise"></i>
        </button>
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#userSolicitar" style="width: 100px">
            <i class="bi bi-plus-lg"></i>
        </button>
    </div>

    <div class="modal fade" id="userSolicitar" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">Solicitar Liderança</h1>
                </div>

                <div class="modal-body">
                    <div class="container">
                        <label for="">Departamento</label>
                        <select wire:model="dptSolicitacao" class="form-select border-primary">
                            <option value="">Select...</option>
                            @foreach ($allDpts as $dpt)
                            <option value="{{ $dpt->id }}">{{ $dpt->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" wire:click="enviarSolicitacao" data-bs-dismiss="modal">Enviar Solicitação</button>
                </div>
            </div>
        </div>
    </div>

</div>
