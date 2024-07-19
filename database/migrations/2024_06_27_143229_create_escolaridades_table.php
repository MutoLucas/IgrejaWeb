<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('escolaridades', function (Blueprint $table) {
            $table->id();
            $table->enum('grau_instrucao', ['f_i', 'f_c', 'm_i', 'm_c', 's_i', 's_c', 'pos', 'mest', 'dout'])->nullable();
            $table->string('formacao', 255)->nullable();
            $table->string('proficao', 255)->nullable();
            $table->foreignId('user_id')->constrined('users', 'id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('escolaridades');
    }
};
