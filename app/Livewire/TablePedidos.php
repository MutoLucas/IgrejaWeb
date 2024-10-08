<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Departamento;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TablePedidos extends Component
{

    public $buscaNome;
    public $buscaDpt;
    public $buscaStatus;
    public $buscaData;

    public function mount(){
        $this->buscaNome = null;
        $this->buscaDpt =null;
        $this->buscaStatus = null;
        $this->buscaData = null;
    }

    public function render()
    {
        $allDpts = Departamento::orderBy('nome','asc')->get();
        $allUsers = User::orderBy('apelido','asc')->get();

        $query = DB::table('pedidos as p')
        ->join('departamentos as d', 'd.id', '=', 'p.departamento_id')
        ->join('users as u', 'u.id', '=', 'p.user_id')
        ->selectRaw('u.apelido, d.nome, p.status, DATE_FORMAT(p.created_at, "%d-%m-%Y") as data')
        ->where('u.apelido','like','%'.$this->buscaNome.'%')
        ->where('d.nome','like','%'.$this->buscaDpt.'%')
        ->where('p.status','like','%'.$this->buscaStatus.'%')
        ->where('p.created_at','like','%'.$this->buscaData.'%')
        ->orderBy('u.apelido','asc')
        ->get();
        //dd($query);

        return view('livewire.table-pedidos', ['allDpts' => $allDpts], ['pedidos' => $query], ['allUsers' => $allUsers]);
    }

    public function buscarPedido(){
        $this->render();
    }

    public function resetBusca(){
        $this->reset();
        $this->render();
    }

}
