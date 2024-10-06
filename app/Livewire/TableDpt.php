<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\DepartamentoUsuario;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class TableDpt extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $nomeDpt;
    public $busca;

    public function mount(){
        $this->busca = null;
        $this->nomeDpt = null;
    }

    public function render(){
        //Pegando todos os departamentos pela busca
        if($this->busca){
            $allDpts = Departamento::where('nome','like','%'.$this->busca.'%')->paginate(4);
        }else{
            $allDpts = Departamento::paginate(4);
        }


        //adicionando a quantidade de pessoas vnculadas a cada departamento
        for($x = 0;$x<count($allDpts);$x++){
            $allDpts[$x]['qtdPessoa'] = $qtdPessoa = DepartamentoUsuario::where('departamento_id','=',$allDpts[$x]->id)->count();
        }
        //dd($allDpts);

        return view('livewire.table-dpt', ['allDpts' => $allDpts]);
    }

    public function storeDpt(){
        //dd($this->nomeDpt);

        if(Departamento::where('nome','like',$this->nomeDpt)->exists()){
            $this->reset();
            return redirect()->route('dpt.index')->with('error','Departamento já criado');
        }else{
            Departamento::create([
                'nome' => $this->nomeDpt
            ]);

            $this->reset();
            $this->render();
        }
    }

    public function buscarDpt(){
        $this->render();
    }

    public function resetBusca(){
        $this->reset();
        $this->render();
    }

    public function deleteDpt($idDpt){
        //dd($idDpt);

        if(Departamento::where('id',$idDpt)->exists() && DepartamentoUsuario::where('departamento_id',$idDpt)->exists()){
            DepartamentoUsuario::where('departamento_id',$idDpt)->delete();
            Departamento::where('id',$idDpt)->delete();

            $this->reset();
            $this->render();
        }elseif(Departamento::where('id',$idDpt)->exists() && DepartamentoUsuario::where('departamento_id',$idDpt)->count() == 0){
            Departamento::where('id',$idDpt)->delete();

            $this->reset();
            $this->render();
        }
    }

}
