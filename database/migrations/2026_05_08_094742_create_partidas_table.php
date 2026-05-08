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
        Schema::create('partidas', function (Blueprint $table) {

            $table->id();

            $table->foreignId('ronda_id')
                ->constrained('rondas')
                ->onDelete('cascade');

            $table->foreignId('blancas_id')
                ->constrained('jugadores');

            $table->foreignId('negras_id')
                ->constrained('jugadores');

            $table->integer('mesa')->nullable();

            $table->string('resultado')->nullable();
            // 1-0
            // 0-1
            // 1/2-1/2

            $table->boolean('finalizada')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partidas');
    }
};
