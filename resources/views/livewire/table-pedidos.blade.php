
<div class="col-sm text-center">
    <h1>Pedidos De Usuários</h1>
    <div class="row">
        <div class="col-md input-group">
            <input type="text" wire:model="buscaPessoa" class="form-control border-primary" placeholder="Nome">
            <input type="text" wire:model="buscaDpt" class="form-control border-primary" placeholder="Departamento">
        </div>

        <div class="col-md btn-group">
            <button type="button" class="btn btn-outline-primary" wire:click="resetBusca"><i class="bi bi-arrow-clockwise"></i></button>
            <button type="button" class="btn btn-outline-primary" wire:click="buscar"><i class="bi bi-search"></i></button>
        </div>
    </div>
</div>

