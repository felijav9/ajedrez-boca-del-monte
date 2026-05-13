
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('sistema')->table('torneos_jugadores', function (Blueprint $table) {

            $table->foreignId('torneo_evento_id')
                ->nullable()
                ->after('torneo_id')
                ->constrained('torneo_eventos')
                ->nullOnDelete();

        });
    }

    public function down(): void
    {
        Schema::connection('sistema')->table('torneos_jugadores', function (Blueprint $table) {

            $table->dropForeign(['torneo_evento_id']);
            $table->dropColumn('torneo_evento_id');

        });
    }
};