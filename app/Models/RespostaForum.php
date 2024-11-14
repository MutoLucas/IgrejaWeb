<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespostaForum extends Model
{
    use HasFactory;

    protected $table = "respostas_forum";

    protected $fillable = [
        'pergunta_id',
        'nome',
        'resposta'
    ];
}
