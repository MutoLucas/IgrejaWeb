<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Departamento;
use App\Models\DepartamentoUsuario as DU;
use App\Models\Evento;
use App\Models\lider;
use Carbon\Carbon;

class Calendario extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $id;
    public $idPessoa;
    public $idDpt;
    public $dataEvento;
    public $desc;
    public $buscaApelido;
    public $buscaDpt;
    public $buscaData;
    public $buscaDptServi;
    public $buscaDataServi;
    public $dptLider;

    public function mount(){
        $this->id = auth()->user()->id;
        $this->dptLider =
        $this->idPessoa = null;
        $this->idDpt = null;
        $this->dataEvento = null;
        $this->desc = null;
        $this->buscaApelido = null;
        $this->buscaDpt = null;
        $this->buscaData = null;
        $this->buscaDptServi = null;
        $this->buscaDataServi = null;

    }

    public function render()
    {
        if(auth()->user()->tipo == 'pastor' || auth()->user()->tipo == 'admin'){
            $allUser = User::where('id', '!=', 1)->where('tipo','!=','pastor')->get();
            //dd($allUser);

            $allDpt = Departamento::get();
            //dd($allDpt);

            $query = DB::table('eventos as e')->join('users as u', 'u.id', '=', 'e.user_id')
            ->join('departamentos as d', 'd.id', '=', 'e.departamento_id')
            ->selectRaw('e.id, u.apelido, DATE_FORMAT(e.data, "%d-%m-%Y") as data, e.descricao, d.nome')
            ->where('u.apelido', 'like', '%'.$this->buscaApelido.'%')
            ->where('e.data', 'like', '%'.$this->buscaData.'%')
            ->where('d.nome', 'like', '%'.$this->buscaDpt.'%')
            ->orderBy('e.data', 'asc')
            ->get();
            //dd($query);

            return view('livewire.calendario', ['allUser' => $allUser, 'allDpt' => $allDpt, 'eventos' => $query]);
        }elseif(auth()->user()->tipo == 'lider'){
            //Pegando todos os usuarios
            $allUser = User::where('id', '!=', 1)->where('id', '!=', auth()->user()->id)->where('tipo','!=','pastor')->get();
            //dd($allUser);

            $allDpt = lider::join('departamentos', 'departamentos.id', '=', 'lideres.departamento_id')
            ->select('lideres.*', 'departamentos.*')
            ->where('lideres.user_id',auth()->user()->id)
            ->paginate(4);
            //dd($allDpt);

            $query = DB::table('eventos as e')->join('users as u', 'u.id', '=', 'e.user_id')
            ->join('departamentos as d', 'd.id', '=', 'e.departamento_id')
            ->join('lideres as l','l.departamento_id','=','d.id')
            ->selectRaw('e.id, u.apelido, DATE_FORMAT(e.data, "%d-%m-%Y") as data, e.descricao, d.nome')
            ->where('u.apelido', 'like', '%'.$this->buscaApelido.'%')
            ->where('e.data', 'like', '%'.$this->buscaData.'%')
            ->where('d.nome', 'like', '%'.$this->buscaDpt.'%')
            ->where('l.user_id',auth()->user()->id)
            ->orderBy('e.data', 'asc')
            ->get();
            //dd($query);

            $queryServi = DB::table('eventos as e')
            ->join('departamentos as d', 'e.departamento_id', '=', 'd.id')
            ->selectRaw(' DATE_FORMAT(e.data, "%d-%m-%Y") as data, d.nome, e.descricao')
            ->where('e.user_id',auth()->user()->id)
            ->where('e.data','like', '%'.$this->buscaDataServi.'%')
            ->where('d.nome', 'like', '%'.$this->buscaDptServi.'%')
            ->orderBy('e.data', 'asc')
            ->get();
            //dd($query);


            return view('livewire.calendario', ['allUser' => $allUser, 'allDpt' => $allDpt, 'eventos' => $query, 'queryServi' => $queryServi]);
        }elseif(auth()->user()->tipo == 'usuario'){
            $query = DB::table('eventos as e')
            ->join('departamentos as d', 'e.departamento_id', '=', 'd.id')
            ->selectRaw(' DATE_FORMAT(e.data, "%d-%m-%Y") as data, d.nome, e.descricao')
            ->where('e.user_id',auth()->user()->id)
            ->where('e.data','like', '%'.$this->buscaData.'%')
            ->where('d.nome', 'like', '%'.$this->buscaDpt.'%')
            ->orderBy('e.data', 'asc')
            ->get();
            //dd($query);

            return view('livewire.calendario', ['eventos' => $query]);
        }

    }

    public function storeEvento(){
        $dataHoje = Carbon::now();
        $pertence = DU::where('user_id',$this->idPessoa)->where('departamento_id',$this->idDpt)->get();
        //dd($pertence->count());

        if($pertence->count() < 1){
            return redirect()->route('calendario.index')->with('error','Este membro não pertence a este departamento');
        }

        if($this->dataEvento < $dataHoje){
            return redirect()->route('calendario.index')->with('error','A data não pode ser inferior a data de hoje');
        }

        $tipoUser = User::where('id',$this->idPessoa)->first();
        //dd($tipoUser);
        if($tipoUser->tipo === 'pastor'){
            return redirect()->route('calendario.index')->with('error','Pastores não servem nos departamentos');
        }

        $lider = lider::where('user_id',$this->idPessoa)->where('departamento_id',$this->idDpt)->get();
        //dd($lider->count());
        if($lider->count() != 0){
            return redirect()->route('calendario.index')->with('error','Este menbro é lider deste departamento');
        }else{
            $query = DB::table('eventos as e')->select('data', 'user_id', 'departamento_id')->where('data', $this->dataEvento)->where('user_id', $this->idPessoa)->get();
            //dd($query);

            if($query->count() == 0){
                Evento::create([
                    'descricao' => $this->desc,
                    'data' => $this->dataEvento,
                    'user_id' => $this->idPessoa,
                    'departamento_id' => $this->idDpt
                ]);
            }elseif($query->count() == 1){
                $data = $query->first();
                $data = $data->data;
                //dd($data);
                $carbonDate = Carbon::parse($data);
                if($carbonDate->isSunday()){
                    Evento::create([
                        'descricao' => $this->desc,
                        'data' => $this->dataEvento,
                        'user_id' => $this->idPessoa,
                        'departamento_id' => $this->idDpt
                    ]);
                }else{
                    return redirect()->route('calendario.index')->with('error','Um membro não pode servir duas vezes neste dia');
                }
            }elseif($query->count() > 1){
                return redirect()->route('calendario.index')->with('error','Um membro não pode servir mais de duas vezes em um domingo');
            }
        }

        $this->reset();
    }

    public function excluirEvento($idEvento){
        //dd($idEvento);
        Evento::find($idEvento)->delete();

        $this->reset();
    }

    public function resetBusca(){
        $this->reset();
    }

    public function busca(){
        $this->render();
    }

    public function buscaServi(){
        $this->render();
    }

    public function resetBuscaServi(){
        $this->reset();
    }
}
