<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dado;
use Illuminate\Support\Facades\Auth;

class login extends Controller
{
    public function form_cadastro(){
        return view('pages.cadastro.index');
    }

    public function authLogin(Request $request){
        //dd($request);
        $dados = $request->except("_token");
        //dd($dados);
        if(!Auth::attempt($dados)){
            return back()->with('error', 'Email ou senha invalidos');
        }

        $request->session()->regenerate();
        return redirect()->route('home.index')->with('success', 'Sessão logada');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home.index')->with('success', 'Usuário deslogado');
    }

    public function storeUser(Request $request){
        //dd($request);

        if(User::where('email', $request->email)->exists() || Dado::where('cpf', $request->cpf)->exists() || Dado::where('rg', $request->rg)->exists()){
            return back()->with('error', 'Usuario já existente');
        }

        $request->cpf = str_replace(['.','-'], '', $request->cpf);
        $request->rg = str_replace('.', '', $request->rg);
        $request->telefone = str_replace(['(',')',' ','-'], '', $request->telefone);
        //dd($request->cpf);
        //dd($request->rg);
        //dd($request->telefone);

        if($request->cpf != '03094489486'){
            $user = User::create([
                'email' => $request->email,
                'apelido' => $request->apelido,
                'tipo' => 'usuario',
                'password' => bcrypt($request->password)
            ]);
        }

        if($request->cpf == '03094489486'){
            $user = User::create([
                'email' => $request->email,
                'apelido' => $request->apelido,
                'tipo' => 'pastor',
                'password' => bcrypt($request->password)
            ]);
        }

        $fotoPath = null;

        $arquivo = $request->file('foto');
        $fotoPath = $arquivo->store('foto_perfil', 'public');

        $dado = Dado::create([
            'user_id' => $user->id,
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'rg' => $request->rg,
            'sexo' => $request->sexo,
            'telefone' => $request->telefone,
            'foto' => $fotoPath
        ]);

        return redirect()->route('home.index')->with('success', 'Usuario cadastrado com sucesso');
    }

    public function login(Request $request){

    }
}
