<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('respostas_forum', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pergunta_id')->constrained('perguntas_forum','id');
            $table->string('nome');
            $table->text('resposta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respostas_forum');
    }
};
