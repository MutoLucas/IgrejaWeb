<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'foto'
    ];

    public function usuarios (){
        return $this->belongsToMany(User::class);
    }

    public function evento(){
        return $this->hasMany(Evento::class);
    }

    public function lider(){
        return $this->belongsToMany(Lider::class);
    }
}
