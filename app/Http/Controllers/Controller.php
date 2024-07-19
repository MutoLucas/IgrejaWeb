<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Escolaridade;
use App\Models\Devocao;
use App\Models\Dado;
use App\Models\Endereco;
use Illuminate\Support\Facades\Storage;

class Controller
{
    public function show_home(){
        return view('pages.home');
    }

    public function showEditUser(String $id){
        if(auth()->user()->id != $id){
            return back();
        }

        $user = User::find($id);
        //dd($user);

        return view('pages.cadastro.editar', compact('user'));
    }

    public function editUser(Request $request, string $id){
        //dd($request);
        //dd($id);

        $request['cpf'] = str_replace(['.','-'], '', $request->cpf);
        $request['rg'] = str_replace('.', '', $request->rg);
        $request['telefone'] = str_replace(['(',')',' ','-'], '', $request->telefone);

        $dadosEscolaridade = $request->only(['grau_instrucao','formacao','proficao']);
        $dadosDevocao = $request->only(['data_novo_nasci','rhema','batismo_aguas','tipo_batismo_aguas','batismo_espirito']);
        $dadosEndereco = $request->only(['endereco','cidade','uf','bairro','complemento']);
        $dadosUser = $request->only(['apelido','email']);
        $dadosPessoa = $request->only(['nome','sexo','cpf','rg','naturalidade','uf_naturalidade','data_nasci','estado_civil','telefone','foto']);

        //dd($dadosPessoa);

        $user = User::find($id);

        if($request->hasFile('foto')){
            $fotoExistente = $user->dado->foto;
            //dd($fotoExistente);
            Storage::disk('public')->delete($fotoExistente);
            $fotoPath = null;
            $arquivo = $request->file('foto');
            $fotoPath = $arquivo->store('foto_perfil', 'public');
            $dadosPessoa['foto'] = $fotoPath;
        }

        $user->update($dadosUser);

        $dadosEscolaridade['user_id'] = $id;
        $dadosDevocao['user_id'] = $id;
        $dadosEndereco['user_id'] = $id;

        $devocao = Devocao::where('user_id', $id)->First();
        $escolaridade = Escolaridade::where('user_id',$id)->First();
        $endereco = Endereco::where('user_id',$id)->First();
        $pessoa = Dado::where('user_id',$id)->First();

        if(empty($devocao)){
            Devocao::create($dadosDevocao);
        }else{
            $devocao->update($dadosDevocao);
        }

        if(empty($escolaridade)){
            Escolaridade::create($dadosEscolaridade);
        }else{
            $escolaridade->update($dadosEscolaridade);
        }

        if(empty($endereco)){
            Endereco::create($dadosEndereco);
        }else{
            $endereco->update($dadosEndereco);
        }

        if(empty($pessoa)){
            Dado::create($dadosPessoa);
        }else{
            $pessoa->update($dadosPessoa);
        }

        return redirect()->route('home.index')->with('success','Usuario Alterado com sucesso');


    }

}