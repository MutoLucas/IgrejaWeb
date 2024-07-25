<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\DepartamentoUsuario;
use App\Models\User;

class Dpt extends Controller
{
    public function index(Request $request){
        if(auth()->user()->tipo != 'admin' && auth()->user()->tipo != 'pastor' && auth()->user()->tipo != 'lider'){
            return back()->with('error', 'você precisa de permissão para fazer isso');
        }

        $dpts = Departamento::where('nome', 'like', '%'.$request->busca.'%')->paginate(4);
        //$dpts->toArray;
        //dd($dpts);


        for($x = 0; $x<count($dpts);$x++){
            $dpts[$x]['qtdPessoa'] = $qtdPessoa = DepartamentoUsuario::where('departamento_id','=',$dpts[$x]->id)->count();
        }
        //dd($dpts);

        $allDpt = Departamento::all();
        $allUser = User::where('id', '!=', 1)->get();
        //dd($allDpt);


        return view('pages.dpt.dpt_home', compact('dpts','allDpt','allUser'));
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
        //dd($request);

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

        $dpt = Departamento::find($id);
        $dpt->delete();

        return redirect()->route('dpt.index')->with('success', 'Departamento Excluido com sucesso');
    }
}
