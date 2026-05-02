<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProtejoMiMente\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        Categoria::create([
            'nombre' => 'Libre',
        ]);

        Categoria::create([
            'nombre' => 'Sub-18',
        ]);

        Categoria::create([
            'nombre' => 'Sub-10',
        ]);
    }
}
