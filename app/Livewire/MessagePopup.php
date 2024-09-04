<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Dado;
use App\Models\Endereco;
use App\Models\Devocao;
use App\Models\Escolaridade;

class MessagePopup extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $userId;

    public function mount(){
        $this->userId = auth()->user()->id;
    }

    public function render()
    {

        $queryDado = Dado::where('user_id',$this->userId)->first();
        //dd($queryDado->id);

        $queryEndereco = Endereco::where('user_id',$this->userId)->first();
        //dd($queryEndereco);

        $queryDevocao = Devocao::where('user_id',$this->userId)->first();
        //dd($queryDevocao);

        $queryEscolaridade = Escolaridade::where('user_id',$this->userId)->first();
        //dd($queryEscolaridade);

        return view('livewire.message-popup', ['dado' => $queryDado, 'endereco' => $queryEscolaridade, 'devocao' => $queryDevocao, 'escolaridade' => $queryEscolaridade]);
    }
}
