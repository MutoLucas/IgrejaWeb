<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Pedido extends Controller
{
    public function showPedidos(){

        if(auth()->user()->tipo == 'admin' || auth()->user()->tipo == 'pastor'){
            
        }

        return view('pages.pedido.homePedido');
    }
}
