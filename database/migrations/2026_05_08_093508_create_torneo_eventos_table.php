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
        Schema::create('torneo_eventos', function (Blueprint $table) {

            $table->id();

            $table->foreignId('torneo_id')
                ->constrained('torneos')
                ->onDelete('cascade');

            $table->string('nombre');
            // Blitz
            // Rápidas
            // Clásico

            $table->string('tipo')->nullable();
            // individual
            // equipos
            // tecnico

            $table->integer('total_rondas')->nullable();

            $table->boolean('finalizado')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('torneo_eventos');
    }
};
