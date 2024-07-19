<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('devocaos', function (Blueprint $table) {
            $table->id();
            $table->date('data_novo_nasci')->nullable();
            $table->enum('rhema', ['sim', 'nao', 'cursando'])->nullable();
            $table->enum('batismo_aguas', ['sim', 'nao'])->nullable();
            $table->enum('tipo_batismo_aguas', ['imersao', 'aspersao'])->nullable();
            $table->enum('batismo_espirito', ['sim', 'nao'])->nullable();
            $table->foreignId('user_id')->constrined('users', 'id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('devocoes');
    }
};
