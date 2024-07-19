<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto',
        'descricao'
    ];

    public function user(){
        return $this->balongsTo(User::class);
    }

    public function comentario(){
        return $this->hasMany(Comentario::class);
    }
}
