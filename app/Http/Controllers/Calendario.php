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
        return view('pages.calendario.homeCalendario');
    }

}
