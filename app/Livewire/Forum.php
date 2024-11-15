<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\PerguntaForum;
use App\Models\RespostaForum;
use Illuminate\Support\Facades\DB;

class Forum extends Component
{

    public $nomePessoa;
    public $pergunta;
    public $textoPergunta;
    public $recaptchaToken;
    public $resposta;
    public $nomeBusca;
    public $assuntoBusca;

    public function mount(){
        $this->nomePessoa = null;
        $this->pergunta = null;
        $this->textoPergunta = null;
        $this->resposta = null;
        $this->nomeBusca = null;
        $this->assuntoBusca = null;
    }

    public function render()
    {

        $perguntas = PerguntaForum::select('id','pessoa', 'pergunta', 'texto','created_at')
        ->where('pergunta','like','%'.$this->assuntoBusca.'%')
        ->where('pessoa','like','%'.$this->nomeBusca.'%')
        ->get();
        //dd($perguntas);
        $respostas = RespostaForum::select('id','pergunta_id','nome','resposta','created_at')->get();
        //dd($respostas);
        return view('livewire.forum', ['perguntas' => $perguntas, 'respostas' => $respostas]);
    }

    public function criarPergunta(){
        //dd($this->nomePessoa, $this->pergunta, $this->textoPergunta, $this->recaptchaToken);

        if(empty($this->recaptchaToken)){
            return back()->with('error', 'Você precisa responder o reCaptcha');
        }else{
            $url = "https://www.google.com/recaptcha/api/siteverify";
            $secret = "6Lcev34qAAAAAJUMzuFtLtQe_0mtRFT73j1Vlcqh";
            $response = $this->recaptchaToken;

            $call = curl_init($url);
            curl_setopt($call, CURLOPT_POST, 1);
            curl_setopt($call, CURLOPT_POSTFIELDS, http_build_query([
                'secret' => $secret,
                'response' => $response
            ]));
            curl_setopt($call, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($call, CURLOPT_HEADER, 0);
            curl_setopt($call, CURLOPT_FOLLOWLOCATION, true);

            $resultado = curl_exec($call);
            $resultado = json_decode($resultado);
            //dd($resultado);

            if($resultado->success === false){
                return back()->with('error', 'Captcha Inválido');
            }
        }

        if($this->nomePessoa === null){
            PerguntaForum::create([
                'pessoa' => auth()->user()->apelido,
                'pergunta' => $this->pergunta,
                'texto' => $this->textoPergunta
            ]);
        }else{
            PerguntaForum::create([
                'pessoa' => $this->nomePessoa,
                'pergunta' => $this->pergunta,
                'texto' => $this->textoPergunta
            ]);
        }

        $this->reset();
        return redirect()->route('forum.index')->with('success','Pergunta criada com sucesso');

    }

    public function excluirPergunta($idPergunta){
        //dd($idPergunta);

        RespostaForum::where('pergunta_id',$idPergunta)->delete();
        PerguntaForum::where('id',$idPergunta)->delete();
        session()->flash('successFlash','Pergunta Excluida com sucesso');
        $this->reset();
    }

    public function criarResposta($idPergunta){
        //dd($idPergunta, $this->resposta);
        if($this->resposta === null){
            $this->reset();
            Session()->flash('error','Favor, preencher o campo de resposta');
        }else{
            RespostaForum::create([
                'pergunta_id' => $idPergunta,
                'nome' => auth()->user()->apelido,
                'resposta' => $this->resposta
            ]);

            $this->reset();
            Session()->flash('successFlash','Resposta enviada com sucesso');
        }
    }

    public function excluirResposta($idResposta){
        RespostaForum::where('id',$idResposta)->delete();
        $this->reset();
        session()->flash('successFlash','Resposta excluida com sucesso');
    }

    public function busca(){
        $this->render();
    }

    public function resetBusca(){
        $this->reset();
    }
}
