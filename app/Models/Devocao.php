<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devocao extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_novo_nasci',
        'rhema',
        'batismo_aguas',
        'tipo_batismo_aguas',
        'batismo_espirito',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
