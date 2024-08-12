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
    public function showCalendario(String $id){
        $user = User::find($id);
        //dd($tipo);

        if($user->tipo != 'admin' && $user->tipo != 'pastor' && $user->tipo != 'lider'){
            $users = User::where('id','!=',1)->get();
            //dd($users);

            $dpts = Departamento::get();
            //dd($dpts);

            $eventos = DB::table('eventos as e')->join('departamentos as de','de.id','=','e.departamento_id')->join('dados as da','da.user_id','=','e.user_id')->selectRaw('de.nome as departamento, da.nome, DATE_FORMAT(e.data,"%d-%m-%Y") as data, e.descricao')->where('e.user_id','=',$user->id)->get();
            //dd($eventos);

            return view('pages.calendario.homeCalendario', compact('users','dpts','eventos'))->with('mesage','Você ainda não tem escalas para cumprir');
        }

        $users = User::where('id','!=',1)->get();
        //dd($users);

        $dpts = Departamento::get();
        //dd($dpts);

        $eventos = DB::table('eventos as e')->join('departamentos as de','de.id','=','e.departamento_id')->join('dados as da','da.user_id','=','e.user_id')->selectRaw('e.id,de.nome as departamento, da.nome, DATE_FORMAT(e.data,"%d-%m-%Y") as data, e.descricao')->get();
        dd($eventos);

        return view('pages.calendario.homeCalendario', compact('users','dpts','eventos'));
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
