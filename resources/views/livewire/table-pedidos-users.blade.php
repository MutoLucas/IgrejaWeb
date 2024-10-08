<div class="col-sm text-center">
    <h1>Pedidos De Usuários</h1>
    <div class="container">
        <div class="row">
            <div class="col-md input-group">
                <input type="text" wire:model="buscaNome" class="form-control border-primary" placeholder="Departamento">
                <input type="text" wire:model="buscaStatus" class="form-control border-primary" placeholder="Status">
                <input type="date" wire:model="buscaData" class="form-control border-primary" placeholder="Data">
            </div>

            <div class="col-md">
                <button type="button" class="btn btn-outline-primary" wire:click="resetBusca" style="width: 100px">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#userSolicitar" style="width: 100px">
                    <i class="bi bi-plus-lg"></i>
                </button>
                <button type="button" class="btn btn-outline-primary" wire:click='buscaPedido' style="width: 100px">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
    </div>

    <table class="table table-bordered shadow mt-2">
        <thead class="table-dark">
            <tr>
                <th scope="col">Departamento</th>
                <th scope="col">Estatos</th>
                <th scope="col">Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $pedido)
            <tr>
                <td><i class="bi bi-building"></i> {{ $pedido->nome }}</td>
                @if($pedido->status == 'pendente')
                <td class="text-warning fw-bold">{{ $pedido->status }} <i class="bi bi-bookmark-dash text-black"></i></td>
                @elseif($pedido->status == 'aceito')
                <td class="text-success fw-bold">{{ $pedido->status }} <i class="bi bi-bookmark-check text-black"></i></td>
                @elseif($pedido->status == 'recusada')
                <td class="text-danger fw-bold">{{ $pedido->status }} <i class="bi bi-bookmark-x text-black"></i></td>
                @endif

                <td><i class="bi bi-calendar-event"></i> {{ $pedido->data }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

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
