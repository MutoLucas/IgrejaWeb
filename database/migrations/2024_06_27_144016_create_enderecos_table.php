<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->string('endereco', 255)->nullable();
            $table->string('cidade', 255)->nullable();
            $table->string('uf', 2)->nullable();
            $table->string('bairro', 255)->nullable();
            $table->string('complemento', 255)->nullable();
            $table->foreignId('user_id')->constrined('users', 'id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enderecos');
    }
};
