<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao',
        'data'
    ];

    public function usuario (){
        return $this->belongsTo(User::class);
    }

    public function departamento (){
        return $this->belongsTo(Departamento::class);
    }
}
