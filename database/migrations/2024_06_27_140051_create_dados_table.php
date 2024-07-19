<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('dados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id')->onDelete('cascade');
            $table->string('nome');
            $table->string('foto', 255)->nullable();
            $table->enum('sexo', ['M', 'F'])->nullable();
            $table->string('cpf', 11)->nullable();
            $table->string('rg', 11)->nullable();
            $table->string('naturalidade', 255)->nullable();
            $table->string('uf_naturalidade', 2)->nullable();
            $table->date('data_nasci')->nullable();
            $table->enum('estado_civil', ['solteiro', 'casado', 'viuvo', 'divorciado', 'separado', 'uniao_estavel'])->nullable();
            $table->string('telefone', 45)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dados');
    }
};
