<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Departamento;
use App\Models\Evento;
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
    }

    public function render()
    {
        if(auth()->user()->tipo == 'pastor' || auth()->user()->tipo == 'admin'){
            $allUser = User::where('id', '!=', 1)->get();
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

        }elseif(auth()->user()->tipo == 'usuario'){
            dd('Funfou');
        }

    }

    public function storeEvento(){
        $dataHoje = Carbon::now();

        if($this->dataEvento < $dataHoje){
            return redirect()->route('calendario.index')->with('error','A data não pode ser inferior a data de hoje');
        }

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




        $this->reset();
        $this->render();
    }

    public function excluirEvento($idEvento){
        //dd($idEvento);
        Evento::find($idEvento)->delete();

        $this->reset();
        $this->render();
    }

    public function resetBusca(){
        $this->reset();
        $this->render();
    }

    public function busca(){
        $this->render();
    }
}
