<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\DepartamentoUsuario;
use App\Models\User;
use App\Models\Evento;
use Illuminate\Support\Facades\DB;

class Calendario extends Controller
{
    public function showCalendario(){
        if(auth()->check() && auth()->user()->tipo == 'pastor' || auth()->user()->tipo == 'admin'){
            return view('pages.calendario.homeCalendario');
        }else{
            return redirect()->back()->with('error','VocÊ não tem permissão para acessar esta área');
        }

    }

    public function criarEvento(Request $request){
        if(auth()->user()->tipo != 'admin' && auth()->user()->tipo != 'pastor' && auth()->user()->tipo != 'lider'){
            return back()->with('error', 'você precisa de permissão para fazer isso');
        }

        $date = date('N',strtotime($request->data));
        //dd($date);

        $eventoExistente = Evento::where('data','=',$request->data)->where('user_id','=',$request->user)->count();
        //dd($eventoExistente);

        if($eventoExistente >= 2 && $date === "7"){
            return back()->with('error','O membro não pode servir mais que duas vezes no domingo');
        }elseif($eventoExistente == 1 && $date != "7"){
            return back()->with('error','O membro já esta servindo nesta data');
        }

        //dd($request);
        Evento::create([
            'user_id' => $request->user,
            'departamento_id' => $request->departamento,
            'data' => $request->data,
            'descricao' => $request->descricao
        ]);

        return redirect()->route('calendario.index',auth()->user()->id)->with('success','Evento criado com sucesso');

    }

}
