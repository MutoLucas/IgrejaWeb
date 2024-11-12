<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Escolaridade;
use App\Models\Devocao;
use App\Models\Dado;
use App\Models\Endereco;
use Illuminate\Support\Facades\DB;

class ListagemMembros extends Controller
{
    public function showListagem(){
        if(auth()->user()->tipo != 'pastor' && auth()->user()->tipo != 'admin'){
            return back()->with('error','Você não tem permissão á esta área');
        }else{

            $membros = DB::table('users as u')
            ->join('dados as d', 'd.user_id', '=', 'u.id')
            ->select(
                'u.id',
                'd.foto',
                'd.nome',
                DB::raw("CONCAT('(', SUBSTRING(d.telefone, 1, 2), ') ',SUBSTRING(d.telefone, 3, 5), '-',SUBSTRING(d.telefone, 8, 4)) as telefone"),'u.email')
            ->where('u.id', '!=', 1)
            ->where('u.id', '!=', auth()->user()->id)
            ->paginate(4);

            //dd($membros);

            return view('pages.membros.listmembros', ['membros' => $membros]);
        }

    }

    public function showMembro(String $id){
        //dd($id);

        $user = User::where('id',$id)->first();
        $dados = Dado::where('user_id',$id)->first();
        $escolaridade = Escolaridade::where('user_id',$id)->first();
        $devocao = Devocao::where('user_id',$id)->first();
        $endereco = Endereco::where('user_id',$id)->first();
        //dd($user);

        return view('pages.membros.showmembro', ['user' => $user, 'dado' => $dados, 'escolaridade' => $escolaridade, 'devocao' => $devocao, 'endereco' => $endereco]);
    }


}
