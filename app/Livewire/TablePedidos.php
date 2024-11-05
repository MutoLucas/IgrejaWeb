<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Departamento;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Pedido;
use App\Models\lider;
use Livewire\WithPagination;

class TablePedidos extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $buscaNome;
    public $buscaDpt;
    public $buscaStatus;
    public $buscaData;
    public $dpt;
    public $user;

    public function mount(){
        $this->buscaNome = null;
        $this->buscaDpt =null;
        $this->buscaStatus = null;
        $this->buscaData = null;
        $this->dpt = null;
        $this->user = null;
    }

    public function render(){
        $allDpts = Departamento::orderBy('nome','asc')->get();
        $allUsers = User::where('id', '!=', 1)->orderBy('apelido','asc')->get();

        $query = DB::table('pedidos as p')
        ->join('departamentos as d', 'd.id', '=', 'p.departamento_id')
        ->join('users as u', 'u.id', '=', 'p.user_id')
        ->select('u.id as user_id', 'd.id as dpt_id', 'p.id as p_id', 'u.apelido', 'd.nome', 'p.status')
        ->selectRaw('DATE_FORMAT(p.updated_at, "%d-%m-%Y") as data')
        ->where('u.apelido','like','%'.$this->buscaNome.'%')
        ->where('d.nome','like','%'.$this->buscaDpt.'%')
        ->where('p.status','like','%'.$this->buscaStatus.'%')
        ->where('p.created_at','like','%'.$this->buscaData.'%')
        ->orderBy('u.apelido','asc')
        ->paginate(4);
        //dd($query);

        return view('livewire.table-pedidos',[
            'allDpts' => $allDpts,
            'pedidos' => $query,
            'allUsers' => $allUsers]);
    }

    public function buscarPedido(){
        $this->render();
    }

    public function resetBusca(){
        $this->reset();
    }

    public function aceitarPedido($p_id, $user_id, $dpt_id){
        //dd($p_id, $user_id, $dpt_id);
        $pedido = Pedido::where('id',$p_id)->first();
        if($pedido){
            $pedido->status = 'aceito';
            $pedido->save();
            lider::create([
                'user_id' => $user_id,
                'departamento_id' => $dpt_id
            ]);

            $this->reset();
        }else{
            return redirect()->route('pedidos.index')->with('error', 'Pedido não encontrado');
        }

    }

    public function desfazerPedido($p_id, $user_id, $dpt_id){
        //dd($p_id, $user_id, $dpt_id);
        $pedido = Pedido::where('id',$p_id)->first();

        if($pedido){
            $lideranca = lider::where('user_id',$user_id)->where('departamento_id',$dpt_id)->first();
            if($lideranca){
                $lideranca->delete();
            }

            $pedido->status = 'pendente';
            $pedido->save();

            $this->reset();
        }else{
            return redirect()->route('pedidos.index')->with('error', 'Pedido não encontrado');
        }
    }

    public function recusarPedido($p_id){
        //dd($p_id, $user_id, $dpt_id);
        $pedido = Pedido::where('id',$p_id)->first();

        if($pedido){
            $pedido->status = 'recusada';
            $pedido->save();

            $this->reset();
        }else{
            return redirect()->route('pedidos.index')->with('error', 'Pedido não encontrado');
        }
    }

    public function criarLider(){
        //dd($this->user, $this->dpt);

        $verificacao = Pedido::where('user_id', $this->user)->where('departamento_id', $this->dpt)->exists();
        //dd($verificacao);

        if($verificacao){
            return redirect()->route('pedidos.index')->with('error','Pedido para esta liderança já existente');
        }else{
            Pedido::create([
                'user_id' => $this->user,
                'departamento_id' => $this->dpt
            ]);

            $this->reset();
        }
    }
}
