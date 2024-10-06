<div class="col-sm text-center">
    <div class="container">
        <h1>Departamentos</h1>
        <div class="row">
            <div class="col-md">
                <input type="text" wire:model="busca" class="form-control border-primary" placeholder="Nome departamento">
            </div>

            <div class="col-md btn-group">
                <button type="button" class="btn btn-outline-primary" wire:click="resetBusca"><i class="bi bi-arrow-clockwise"></i></button>
                <button type="button" class="btn btn-sm btn-outline-primary" wire:click="buscarDpt"><i class="bi bi-search"></i></button>
                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-target="#criarDpt" data-bs-toggle="modal"><i class="bi bi-plus-lg"></i></button>
            </div>
        </div>

        <div class="container p-3 mt-2 shadow">
            <table class="table table-bordered shadow">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">qtdPessoas</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allDpts as $dpt)
                    <tr>
                        <td>{{ $dpt->nome }}</td>
                        <td>{{ $dpt->qtdPessoa }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger" wire:click="deleteDpt({{ $dpt->id }})"><i class="bi bi-building-dash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $allDpts->links() }}
        </div>
    </div>


    <div class="modal fade" id="criarDpt" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Criar Departamento</h3>
                </div>

                <div class="modal-body">
                    <div class="form-floating">
                        <input type="text" class="form-control border-primary" wire:model="nomeDpt">
                        <label for="">Nome do Departamento</label>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="d-flex justify-content-end">
                        <div>
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="cadastrar" wire:click="storeDpt">Cadastrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
