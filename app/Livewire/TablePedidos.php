<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Departamento;
use Illuminate\Support\Facades\DB;

class TablePedidos extends Component
{

    public $allDpts;

    public function mount(){
        $this->allDpts = Departamento::orderBy('nome','asc')->get();
    }

    public function render()
    {
        return view('livewire.table-pedidos', ['allDpts' => $this->allDpts]);
    }

}
