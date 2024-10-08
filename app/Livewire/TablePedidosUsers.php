<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Departamento;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;


class TablePedidosUsers extends Component
{

    public $allDpts;
    public $dptSolicitacao;
    public $buscaNome;
    public $buscaStatus;
    public $buscaData;

    public function mount(){
        $this->dptSolicitacao = null;
        $this->buscaNome = null;
        $this->buscaStatus = null;
        $this->buscaData = null;
    }

    public function render()
    {
        $this->allDpts = Departamento::orderBy('nome','asc')->get();

        $query = DB::table('pedidos as p')
        ->join('departamentos as d', 'd.id', '=', 'p.departamento_id')
        ->selectRaw('DATE_FORMAT(p.created_at, "%d-%m-%Y") as data, p.status, d.nome')
        ->where('p.user_id', auth()->user()->id)
        ->where('p.created_at', 'like', '%'.$this->buscaData.'%')
        ->where('d.nome', 'like', '%'.$this->buscaNome.'%')
        ->where('p.status', 'like', '%'.$this->buscaStatus.'%')
        ->orderBy('p.created_at', 'asc')
        ->get();
        //dd($query);

        return view('livewire.table-pedidos-users', ['allDpts' => $this->allDpts], ['pedidos' => $query]);
    }

    public function enviarSolicitacao(){
        //dd($this->dptSolicitacao);

        $dpt = Departamento::where('id',$this->dptSolicitacao)->get();
        //dd($dpt);

        $verifacao = Pedido::where('user_id',auth()->user()->id)->where('departamento_id',$this->dptSolicitacao)->get();
        //dd($verifacao);

        if($verifacao->count() > 0){
            return redirect()->route('pedidos.index')->with('error','Já existe uma solicitação aberta apra esse departamento');
        }else{
            Pedido::Create([
                'user_id' => auth()->user()->id,
                'departamento_id' => $this->dptSolicitacao,
                'status' => 'pendente'
            ]);
        }
    }

    public function buscaPedido(){
        $this->render();
    }

    public function resetBusca(){
        $this->reset();
        $this->render();
    }
}
