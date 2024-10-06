<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Departamento;
use App\Models\Pedido;


class TablePedidosUsers extends Component
{

    public $allDpts;
    public $dptSolicitacao;

    public function mount(){
        $this->allDpts = Departamento::orderBy('nome','asc')->get();
        $this->dptSolicitacao = null;
    }

    public function render()
    {
        return view('livewire.table-pedidos-users', ['allDpts' => $this->allDpts]);
    }

    public function enviarSolicitacao(){
        //dd($this->dptSolicitacao);

        $dpt = Departamento::where('id',$this->dptSolicitacao)->get();
        //dd($dpt);

        $verifacao = Pedido::where('user_id',auth()->user()->id)->where('departamento',$this->dptSolicitacao)->get();
        //dd($verifacao);

        if($verifacao->count() > 0){
            return redirect()->route('pedidos.index')->with('error','Já existe uma solicitação aberta apra esse departamento');
        }else{
            Pedido::Create([
                'user_id' => auth()->user()->id,
                'departamento' => $this->dptSolicitacao,
                'status' => 'pendente'
            ]);
        }
    }
}
