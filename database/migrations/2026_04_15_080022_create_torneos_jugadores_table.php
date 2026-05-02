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
        Schema::connection('sistema')->create('torneos_jugadores', function (Blueprint $table) {
            $table->id();

            $table->foreignId('torneo_id')
                ->constrained('torneos')
                ->cascadeOnDelete();

            $table->foreignId('jugador_id')
                ->constrained('jugadores')
                ->cascadeOnDelete();

            $table->foreignId('equipo_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('categoria_id')
                ->nullable()
                ->constrained('categorias')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('torneos_jugadores');
    }
};
