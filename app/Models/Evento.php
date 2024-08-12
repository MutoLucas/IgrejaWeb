<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao',
        'data',
        'user_id',
        'departamento_id'
    ];

    public function usuario (){
        return $this->belongsTo(User::class);
    }

    public function departamento (){
        return $this->belongsTo(Departamento::class);
    }

    public function dado(){
        return $this->belongsTo(Dado::class, 'user_id','user_id');
    }
}
