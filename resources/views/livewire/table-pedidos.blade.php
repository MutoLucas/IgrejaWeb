<div class="col-sm text-center">
    <h1>Pedidos De Usuários</h1>
    <div class="row">
        <div class="col-md input-group">
            <input type="text" wire:model="buscaNome" class="form-control border-primary" placeholder="Nome">
            <input type="text" wire:model="buscaDpt" class="form-control border-primary" placeholder="Departamento">
            <input type="text" wire:model="buscaStatus" class="form-control border-primary" placeholder="Status">
            <input type="date" wire:model="buscaData" class="form-control border-primary" placeholder="Data">
        </div>

        <div class="col-md-3 btn-group">
            <button type="button" class="btn btn-outline-primary" wire:click="resetBusca"><i class="bi bi-arrow-clockwise"></i></button>
            <button type="button" class="btn btn-outline-primary" data-bs-target="#criarLider" data-bs-toggle="modal">
                <i class="bi bi-plus-lg"></i>
            </button>
            <button type="button" class="btn btn-outline-primary" wire:click="buscarPedido"><i class="bi bi-search"></i></button>
        </div>
    </div>

    <table class="table table-bordered shadow mt-2">
        <thead class="table-dark">
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Departamento</th>
                <th scope="col">Estatos</th>
                <th scope="col">Data</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $pedido)
            <tr>
                <td><i class="bi bi-person"></i> {{ $pedido->apelido }}</td>
                <td><i class="bi bi-building"></i> {{ $pedido->nome }}</td>

                @if($pedido->status == 'pendente')
                <td class="text-warning fw-bold">{{ $pedido->status }} <i class="bi bi-bookmark-dash text-black"></i></td>
                @elseif($pedido->status == 'aceito')
                <td class="text-success fw-bold">{{ $pedido->status }} <i class="bi bi-bookmark-check text-black"></i></td>
                @elseif($pedido->status == 'recusada')
                <td class="text-danger fw-bold">{{ $pedido->status }} <i class="bi bi-bookmark-x text-black"></i></td>
                @endif
                <td><i class="bi bi-calendar-event"></i> {{ $pedido->data }}</td>

                @if($pedido->status == 'pendente')
                <td>
                    <button class="btn btn-sm btn-outline-success" wire:click="aceitarPedido({{ $pedido->p_id }}, {{ $pedido->user_id }}, {{ $pedido->dpt_id }})">
                        Aceitar
                    </button>
                    <button class="btn btn-sm btn-outline-warning" wire:click="recusarPedido({{ $pedido->p_id }})">
                        Recusar
                    </button>
                </td>
                @elseif($pedido->status == 'aceito')
                <td>
                    <button class="btn btn-sm btn-outline-warning" wire:click="desfazerPedido({{ $pedido->p_id }}, {{ $pedido->user_id }}, {{ $pedido->dpt_id }})">
                        Desfazer
                    </button>
                </td>
                @elseif($pedido->status == 'recusada')
                <td>
                    <button class="btn btn-sm btn-outline-danger" wire:click="desfazerPedido({{ $pedido->p_id }}, {{ $pedido->user_id }}, {{ $pedido->dpt_id }})">
                        Desfazer
                    </button>
                </td>
                @endif

            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $pedidos->links() }}

    <div class="modal fade" data-bs-backdrop="static" id="criarLider">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-4">Crair Liderança</h1>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md">
                            <label for="user">Membro</label>
                            <select class="form-select" name="user" id="user" wire:model="user">
                                <option value="">Select...</option>
                                @foreach ($allUsers as $user)
                                <option value="{{ $user->id }}">{{ $user->apelido }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md">
                            <label for="dpt">Departamento</label>
                            <select class="form-select" name="dpt" id="dpt" wire:model="dpt">
                                <option value="">Select...</option>
                                @foreach ($allDpts as $dpt)
                                <option value="{{ $dpt->id }}">{{ $dpt->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-danger me-1" data-bs-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="button" class="btn btn-outline-primary" wire:click="criarLider" data-bs-dismiss="modal">
                            Criar liderança
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
