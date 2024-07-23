<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\DepartamentoUsuario;
use App\Models\User;

class Dpt extends Controller
{
    public function index(Request $request){
        $dpts = Departamento::where('nome', 'like', '%'.$request->busca.'%')->orderBy('nome', 'asc')->paginate(3);
        //dd($dpts);

        foreach($dpts as $dpt){
            $dptQtdPessoa[] = DepartamentoUsuario::where('departamento_id', $dpt->id)->count();
        }

        $allDpt = Departamento::all();
        $allUser = User::all();
        //dd($allUser);

        $pessoa_dpt = [];



        return view('pages.dpt.dpt_home', compact('dpts','dptQtdPessoa'));
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
