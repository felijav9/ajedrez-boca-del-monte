<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('sistema')->table('torneos_imagenes', function (Blueprint $table) {
            $table->string('tipo')->after('ruta');
        });
    }

    public function down(): void
    {
        Schema::connection('sistema')->table('torneos_imagenes', function (Blueprint $table) {
            $table->dropColumn('tipo');
        });
    }
};

