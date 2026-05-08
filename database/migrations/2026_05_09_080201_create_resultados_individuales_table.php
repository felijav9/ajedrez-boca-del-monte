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
        Schema::connection('sistema')->create('resultados_individuales', function (Blueprint $table) {
            $table->id();
             $table->foreignId('torneo_id')
                ->constrained('torneos')
                ->cascadeOnDelete();

            $table->foreignId('jugador_id')
                ->constrained('jugadores')
                ->cascadeOnDelete();

            $table->integer('posicion')->nullable();

            $table->enum('medalla', ['gold', 'silver', 'bronze'])->nullable();

            // NUEVO CAMPO
             $table->foreignId('torneo_evento_id')
            ->nullable()
            ->constrained('torneo_eventos')
            ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultados_individuales');
    }
};
