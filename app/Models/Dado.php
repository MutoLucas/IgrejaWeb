<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dado extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'user_id',
        'foto',
        'sexo',
        'rg',
        'cpf',
        'naturalidade',
        'uf_naturalidade',
        'data_nasci',
        'estado_civil',
        'telefone'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
