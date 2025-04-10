<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lider extends Model
{
    use HasFactory;

    protected $table = 'lideres';

    protected $fillable = [
        'user_id',
        'departamento_id'
    ];

    public function user(){
        return $this->hasMany(User::class);
    }

    public function departamento(){
        return $this->hasMany(Departamento::class);
    }
}
