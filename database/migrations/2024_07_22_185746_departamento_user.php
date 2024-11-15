<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('departamento_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('departamento_id')->constrained('departamentos');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('departamento_usuario');
    }
};
