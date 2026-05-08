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
        Schema::create('rondas', function (Blueprint $table) {

            $table->id();

            $table->foreignId('torneo_evento_id')
                ->constrained('torneo_eventos')
                ->onDelete('cascade');

            $table->integer('numero');

            $table->boolean('finalizada')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rondas');
    }
};
