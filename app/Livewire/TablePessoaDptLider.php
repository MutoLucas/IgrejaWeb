<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\DepartamentoUsuario;
use App\Models\User;
use App\Models\Pedido;
use App\Models\lider;
use App\Models\Evento;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;


class TablePessoaDptLider extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['addMembroDpt' => 'render', 'removeMembroDpt' => 'render', 'storeDpt' => 'render'];

    public $idPessoa;
    public $idDpt;
    public $buscaPessoa;
    public $buscaDpt;

    public function mount(){
        $this->idPessoa = null;
        $this->idDpt = null;
        $this->buscaPessoa = null;
        $this->bsucaDpt = null;
    }

    public function render(){
        //Pegando todos os usuarios
        $allUser = User::where('id', '!=', 1)->where('id', '!=', auth()->user()->id)->get();
        //dd($allUser);

        $allDpt = lider::join('departamentos', 'departamentos.id', '=', 'lideres.departamento_id')
        ->select('lideres.*', 'departamentos.*')
        ->where('lideres.user_id',auth()->user()->id)
        ->paginate(4);
        //dd($allDpt);

        $pessoaDpt = DB::table('departamento_user as du')
        ->join('users as u', 'u.id', '=', 'du.user_id')
        ->join('departamentos as d', 'd.id', '=', 'du.departamento_id')
        ->join('lideres as l','l.departamento_id','=','du.departamento_id')
        ->select('du.id','u.apelido as nome','u.id as user_id','d.id as departamento_id','d.nome as departamento')
        ->where('u.apelido','like','%'.$this->buscaPessoa.'%')
        ->where('d.nome','like','%'.$this->buscaDpt.'%')
        ->where('u.id', '!=', auth()->user()->id)
        ->where('l.user_id',auth()->user()->id)
        ->paginate(4,['*','pessoaPage']);
        //dd($pessoaDpt);

        return view('livewire.table-pessoa-dpt', ['allUser' => $allUser, 'allDpt' => $allDpt, 'pessoaDpt' => $pessoaDpt]);
    }

    public function storeRelacionamento(){
        //dd($this->idPessoa, $this->idDpt);

        if(lider::where('user_id',$this->idPessoa)->where('departamento_id',$this->idDpt)->exists()){
            return redirect()->route('dpt.index')->with('error','Este membro é lider deste departamento');
        }else{
            if(DepartamentoUsuario::where('user_id',$this->idPessoa)->where('departamento_id',$this->idDpt)->exists()){
                return redirect()->route('dpt.index')->with('error','Este relacionamento já existe');
            }else{
                DepartamentoUsuario::create([
                    'user_id' => $this->idPessoa,
                    'departamento_id' => $this->idDpt
                ]);

                $this->dispatch('addMembroDpt');
                $this->reset();
            }
        }

    }

    public function buscar(){
        //dd($this->buscaPessoa, $this->buscaDpt);

        $this->render();
    }

    public function resetBusca(){
        $this->reset();
        $this->render();
    }

    public function deleteRelacionamento($idPessoa, $idDpt){
        //dd($idPessoa,$idDpt);

        if(DepartamentoUsuario::where('user_id',$idPessoa)->where('departamento_id',$idDpt)->exists() || Evento::where('user_id',$idPessoa)->exists()){

            if(Evento::where('user_id',$idPessoa)->exists()){
                Evento::where('user_id',$idPessoa)->delete();
            }

            if(DepartamentoUsuario::where('user_id',$idPessoa)->where('departamento_id',$idDpt)->exists()){
                DepartamentoUsuario::where('user_id',$idPessoa)->where('departamento_id',$idDpt)->delete();
            }


            $this->dispatch('removeMembroDpt');
            $this->reset();
        }else{
            return redirect()->route('dpt.index')->with('error','Este relacionamento não funciona');
        }

    }
}
