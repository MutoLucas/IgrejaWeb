<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;

class Email extends Controller
{
    public function catchEmail(){
        return view('email.catchEmail');
    }

    public function catchToken(){
        return view('email.catchToken');
    }

    public function verifySendEmail(Request $request){
        //dd($request);

        if(!User::where('email',$request->email)->exists()){
            return back()->with('error','Email não cadastrado');
        }else{
            $token = bin2hex(random_bytes(5));
            $user = User::where('email',$request->email)->first();
            $user->remember_token = $token;
            $user->save();

            $send = Mail::to($user->email)->send(new SendEmail([
                'fromEmail' => 'mail@igreja.com',
                'fromName' => 'igrejaName',
                'subject' => 'Recuperação de Senha',
                'message' => $token
            ]));

            if(!$send){
                return back()->with('error','Algo deu errado com o envio, favor tentar novamente');
            }else{
                return redirect()->route('email.token');
            }
        }
    }

    public function verifyToken(Request $request){
        //dd($request);

        if(!User::where('remember_token',$request->token)->exists()){
            return back()->with('error','Token invalido, favor reescrever o token');
        }else{
            $user = User::where('remember_token',$request->token)->first();
            //dd($user->email);
            return view('email.modificarSenha', ['email' => $user->email]);
        }
    }

    public function modificarSenha($email, Request $request){
        //dd($email, $request);

        $user = User::where('email',$email)->first();
        //dd($user);
        $user->password = bcrypt($request->password);
        $user->remember_token = null;
        $user->save();

        return redirect()->route('home.index')->with('success','Senha alterada com sucesso');
    }
}

