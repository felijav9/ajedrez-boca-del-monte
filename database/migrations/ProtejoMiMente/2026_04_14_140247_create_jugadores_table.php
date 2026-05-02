<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('sistema')->create('jugadores', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->string('apellido')->nullable();
            $table->integer('elo_blitz')->nullable();
            $table->integer('elo_rapido')->nullable();
            $table->integer('elo_clasico')->nullable();
            $table->integer('edad')->nullable();
            // genero (puedes usar string simple o enum si quieres más control)
            $table->string('genero')->nullable(); 
            // ejemplo valores: masculino, femenino, otro
            $table->date('fecha_nacimiento')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::connection('sistema')->dropIfExists('jugadores');
    }
};