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
        Schema::create('torneo_evento_clasificaciones', function (Blueprint $table) {

            $table->id();

            $table->foreignId('torneo_evento_id')
                ->constrained('torneo_eventos')
                ->onDelete('cascade');

            $table->foreignId('jugador_id')
                ->constrained('jugadores')
                ->onDelete('cascade');

            $table->integer('posicion')->nullable();

            // PUNTOS
            $table->decimal('pts', 5, 2)->default(0);

            // DESEMPATES
            $table->decimal('bhc1', 8, 2)->nullable();
            $table->decimal('bh', 8, 2)->nullable();
            $table->decimal('sb', 8, 2)->nullable();
            $table->decimal('ps', 8, 2)->nullable();
            $table->decimal('de', 8, 2)->nullable();

            // ESTADISTICAS
            $table->integer('win')->default(0);
            $table->integer('draw')->default(0);
            $table->integer('lose')->default(0);

            // Blancas ganadas
            $table->integer('bwg')->default(0);

            $table->integer('rating')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('torneo_evento_clasificaciones');
    }
};
