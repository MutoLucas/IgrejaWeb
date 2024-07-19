<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escolaridade extends Model
{
    use HasFactory;

    protected $fillable = [
        'grau_instrucao',
        'formacao',
        'proficao',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
