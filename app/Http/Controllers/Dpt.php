<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\DepartamentoUsuario;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Dpt extends Controller
{
    public function index(){
        if(auth()->user()->tipo != 'admin' && auth()->user()->tipo != 'pastor' && auth()->user()->tipo != 'lider'){
            return back()->with('error', 'você precisa de permissão para fazer isso');
        }

        return view('pages.dpt.dpt_home');
    }

    public function adicionarPessoa(Request $request, string $idDpt){
        //dd($request);
        if(auth()->user()->tipo != 'admin' && auth()->user()->tipo != 'pastor' && auth()->user()->tipo != 'lider'){
            return back()->with('error', 'você precisa de permissão para fazer isso');
        }

        $dpt = Departamento::find($idDpt);
        //dd($dpt);
        $user = User::find($request->pessoa);
        //dd($user);

        if(DepartamentoUsuario::where('user_id',$user->id)->where('departamento_id',$dpt->id)->exists()){
            return back()->with('error','Este membro já faz parte deste departamento');
        }else{
            DepartamentoUsuario::create([
                'user_id' => $user->id,
                'departamento_id' => $dpt->id
            ]);

            return redirect()->route('dpt.index')->with('success','Membro adicionado ao departamento');
        }


    }

    public function criarDpt(Request $request){
        dd($request);
        if(auth()->user()->tipo != 'admin' && auth()->user()->tipo != 'pastor'){
            return back()->with('error', 'você precisa de permissão para fazer isso');
        }

        if(empty($request->nome)){
            return back()->with('error', 'É necessario escolher um nome para o Departamento');
        }

        if(Departamento::where('nome', 'like', $request->nome)->exists()){
            return back()->with('error', 'Departamento já existente');
        }

        Departamento::create([
            'nome' => $request->nome
        ]);

        return redirect()->route('dpt.index')->with('success', 'Departamento criado com sucesso');
    }

    public function excluirDpt(string $id){
        //dd($id);
        if(auth()->user()->tipo != 'admin' && auth()->user()->tipo != 'pastor'){
            return back()->with('error', 'você precisa de permissão para fazer isso');
        }

        $dptUser = DepartamentoUsuario::where('departamento_id',$id)->get();
        //dd($dptUser);

        foreach ($dptUser as $key){
            $key->delete();
        }
        $dpt = Departamento::find($id);
        $dpt->delete();

        return redirect()->route('dpt.index')->with('success', 'Departamento Excluido com sucesso');
    }

    public function desvincularpessoa(string $nome_pessoa, string $nome_dpt){
        if(auth()->user()->tipo != 'admin' && auth()->user()->tipo != 'pastor' && auth()->user()->tipo != 'lider'){
            return back()->with('error', 'você precisa de permissão para fazer isso');
        }

        $user = User::where('apelido',$nome_pessoa)->first();
        $dpt = Departamento::where('nome',$nome_dpt)->first();
        //dd($user,$dpt);

        if(!$user || !$dpt){
            return back()->with('error','Usuário ou Departamento não encontrados');
        }

        if(DepartamentoUsuario::where('user_id',$user->id)->where('departamento_id',$dpt->id)->exists()){
            DepartamentoUsuario::where('user_id',$user->id)->where('departamento_id',$dpt->id)->delete();
            return back()->with('success','Usuário desvinculado com sucesso');
        }

    }
}
