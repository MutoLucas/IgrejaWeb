<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartamentoUsuario extends Model
{
    use HasFactory;

    protected $table = "Departamento_user";

    protected $fillable =  [
        'user_id',
        'departamento_id'
    ];
}
