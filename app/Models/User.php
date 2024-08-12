<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'tipo',
        'apelido',
        'email',
        'password',
        'RemenberToken'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function dado(){
        return $this->hasOne(Dado::class);
    }

    public function departamentos (){
        return $this->belongsToMany(Departamento::class);
    }

    public function escolaridade (){
        return $this->hasOne(Escolaridade::class);
    }

    public function endereco (){
        return $this->hasOne(Endereco::class);
    }

    public function devocao (){
        return $this->hasOne(Devocao::class);
    }

    public function post (){
        return $this->hasMany(Post::class);
    }

    public function comentario (){
        return $this->hasMany(Comentario::class);
    }

    public function evento(){
        return $this->hasMany(Evento::class);
    }
}
