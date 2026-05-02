<?php

namespace Database\Seeders;

use App\Models\ProtejoMiMente\Torneo;
use App\Models\ProtejoMiMente\TorneoJugador;
use Illuminate\Database\Seeder;

class TorneoJugadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // TORNEO NAVIDEÑO 2022
        TorneoJugador::create(['torneo_id' => 1, 'jugador_id' => 25, 'categoria_id' => 1]);
        TorneoJugador::create(['torneo_id' => 1, 'jugador_id' => 26, 'categoria_id' => 1]);
        TorneoJugador::create(['torneo_id' => 1, 'jugador_id' => 49, 'categoria_id' => 1]);
        TorneoJugador::create(['torneo_id' => 1, 'jugador_id' => 7,  'categoria_id' => 1]);
        TorneoJugador::create(['torneo_id' => 1, 'jugador_id' => 22, 'categoria_id' => 1]);
        TorneoJugador::create(['torneo_id' => 1, 'jugador_id' => 30, 'categoria_id' => 1]);
        // TORNEO  POR EQUIPOS 2023
        // GOLD
        TorneoJugador::create(['torneo_id' => 2, 'jugador_id' => 50, 'equipo_id' => 7, 'categoria_id' => 1]);
        TorneoJugador::create(['torneo_id' => 2, 'jugador_id' => 51, 'equipo_id' => 7,'categoria_id' => 1]);
        TorneoJugador::create(['torneo_id' => 2, 'jugador_id' => 52, 'equipo_id' => 7, 'categoria_id' => 1]);
        TorneoJugador::create(['torneo_id' => 2, 'jugador_id' => 53, 'equipo_id' => 7, 'categoria_id' => 1]);

        // SILVER
        TorneoJugador::create(['torneo_id' => 2, 'jugador_id' => 54, 'equipo_id' => 8, 'categoria_id' => 1]);
        TorneoJugador::create(['torneo_id' => 2, 'jugador_id' => 7,  'equipo_id' => 8, 'categoria_id' => 1]);
        TorneoJugador::create(['torneo_id' => 2, 'jugador_id' => 55, 'equipo_id' => 8, 'categoria_id' => 1]);
        TorneoJugador::create(['torneo_id' => 2, 'jugador_id' => 56, 'equipo_id' => 8, 'categoria_id' => 1]);

        // BRONZE
        TorneoJugador::create(['torneo_id' => 2, 'jugador_id' => 57,  'equipo_id' => 9, 'categoria_id' => 1]);
        TorneoJugador::create(['torneo_id' => 2, 'jugador_id' => 58, 'equipo_id' => 9, 'categoria_id' => 1]);
        TorneoJugador::create(['torneo_id' => 2, 'jugador_id' => 59, 'equipo_id' => 9, 'categoria_id' => 1]);
        TorneoJugador::create(['torneo_id' => 2, 'jugador_id' => 60, 'equipo_id' => 9, 'categoria_id' => 1]);

        // SEGUNDO TORNEO NAVIDEÑO 2023
        TorneoJugador::create(['torneo_id' => 3, 'jugador_id' => 7,  'categoria_id' => 1]);
        TorneoJugador::create(['torneo_id' => 3, 'jugador_id' => 30, 'categoria_id' => 1]);
        TorneoJugador::create(['torneo_id' => 3, 'jugador_id' => 32, 'categoria_id' => 1]);
        TorneoJugador::create(['torneo_id' => 3, 'jugador_id' => 33, 'categoria_id' => 1]);
        TorneoJugador::create(['torneo_id' => 3, 'jugador_id' => 29, 'categoria_id' => 1]);
        // TORNEO RAPIDAS 2024
        TorneoJugador::create([
            'torneo_id' => 4,
            'jugador_id' => 22,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 4,
            'jugador_id' => 2,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 4,
            'jugador_id' => 7,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 4,
            'jugador_id' => 19,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 4,
            'jugador_id' => 3,
            'categoria_id' => 1,
        ]);

        TorneoJugador::create([
            'torneo_id' => 4,
            'jugador_id' => 25,
            'categoria_id' => 1,
        ]);

        TorneoJugador::create([
            'torneo_id' => 4,
            'jugador_id' => 26,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 4,
            'jugador_id' => 28,
            'categoria_id' => 1,
        ]);
        // TORNEO MEDIO AÑO 2025 RAPIDAS
        TorneoJugador::create([
            'torneo_id' => 5,
            'jugador_id' => 2,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 5,
            'jugador_id' => 22,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 5,
            'jugador_id' => 5,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 5,
            'jugador_id' => 19,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 5,
            'jugador_id' => 6,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 5,
            'jugador_id' => 7,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 5,
            'jugador_id' => 40,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 5,
            'jugador_id' => 41,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 5,
            'jugador_id' => 9,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 5,
            'jugador_id' => 42,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 5,
            'jugador_id' => 13,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 5,
            'jugador_id' => 43,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 5,
            'jugador_id' => 44,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 5,
            'jugador_id' => 45,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 5,
            'jugador_id' => 30,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 5,
            'jugador_id' => 30,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 5,
            'jugador_id' => 48,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 5,
            'jugador_id' => 46,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 5,
            'jugador_id' => 18,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 5,
            'jugador_id' => 10,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 5,
            'jugador_id' => 47,
            'categoria_id' => 1,
        ]);


        // TORNEO NAVIDEÑO 2025
        TorneoJugador::create([
            'torneo_id' => 6,
            'jugador_id' => 2,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 6,
            'jugador_id' => 21,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 6,
            'jugador_id' => 13,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 6,
            'jugador_id' => 18,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 6,
            'jugador_id' => 39,
            'categoria_id' => 1,
        ]);

        // TORNEO FIN AÑO 2025
        TorneoJugador::create([
            'torneo_id' => 7,
            'jugador_id' => 36,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 7,
            'jugador_id' => 37,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 7,
            'jugador_id' => 7,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 7,
            'jugador_id' => 3,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 7,
            'jugador_id' => 38,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 7,
            'jugador_id' => 9,
            'categoria_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 7,
            'jugador_id' => 10,
            'categoria_id' => 1,
        ]);

        // TORNEO DIA CARIÑO 2026
        // sub-18
        TorneoJugador::create([
            'torneo_id' => 8,
            'jugador_id' => 2,
            'categoria_id' => 2,
        ]);
        TorneoJugador::create([
            'torneo_id' => 8,
            'jugador_id' => 21,
            'categoria_id' => 2,
        ]);
        TorneoJugador::create([
            'torneo_id' => 8,
            'jugador_id' => 7,
            'categoria_id' => 2,
        ]);
        TorneoJugador::create([
            'torneo_id' => 8,
            'jugador_id' => 22,
            'categoria_id' => 2,
        ]);
        TorneoJugador::create([
            'torneo_id' => 8,
            'jugador_id' => 20,
            'categoria_id' => 2,
        ]);
        TorneoJugador::create([
            'torneo_id' => 8,
            'jugador_id' => 5,
            'categoria_id' => 2,
        ]);
        TorneoJugador::create([
            'torneo_id' => 8,
            'jugador_id' => 1,
            'categoria_id' => 2,
        ]);
        TorneoJugador::create([
            'torneo_id' => 8,
            'jugador_id' => 3,
            'categoria_id' => 2,
        ]);
        TorneoJugador::create([
            'torneo_id' => 8,
            'jugador_id' => 8,
            'categoria_id' => 2,
        ]);
        TorneoJugador::create([
            'torneo_id' => 8,
            'jugador_id' => 24,
            'categoria_id' => 2,
        ]);
        TorneoJugador::create([
            'torneo_id' => 8,
            'jugador_id' => 18,
            'categoria_id' => 2,
        ]);
        TorneoJugador::create([
            'torneo_id' => 8,
            'jugador_id' => 13,
            'categoria_id' => 2,
        ]);
        TorneoJugador::create([
            'torneo_id' => 8,
            'jugador_id' => 34,
            'categoria_id' => 2,
        ]);
        // sub-10
        TorneoJugador::create([
            'torneo_id' => 8,
            'jugador_id' => 6,
            'categoria_id' => 3,
        ]);
        TorneoJugador::create([
            'torneo_id' => 8,
            'jugador_id' => 9,
            'categoria_id' => 3,
        ]);
        TorneoJugador::create([
            'torneo_id' => 8,
            'jugador_id' => 11,
            'categoria_id' => 3,
        ]);
        TorneoJugador::create([
            'torneo_id' => 8,
            'jugador_id' => 16,
            'categoria_id' => 3,
        ]);
        TorneoJugador::create([
            'torneo_id' => 8,
            'jugador_id' => 10,
            'categoria_id' => 3,
        ]);
        TorneoJugador::create([
            'torneo_id' => 8,
            'jugador_id' => 12,
            'categoria_id' => 3,
        ]);

        // team finals march
        // changos fc
        TorneoJugador::create([
            'torneo_id' => 9,
            'jugador_id' => 1,
            'categoria_id' => 1,
            'equipo_id' => 1,
        ]);

        TorneoJugador::create([
            'torneo_id' => 9,
            'jugador_id' => 9,
            'categoria_id' => 1,
            'equipo_id' => 1,
        ]);
        TorneoJugador::create([
            'torneo_id' => 9,
            'jugador_id' => 15,
            'categoria_id' => 1,
            'equipo_id' => 1,
        ]);
        // bloops
        TorneoJugador::create([
            'torneo_id' => 9,
            'jugador_id' => 2,
            'categoria_id' => 1,
            'equipo_id' => 2,
        ]);
        TorneoJugador::create([
            'torneo_id' => 9,
            'jugador_id' => 3,
            'categoria_id' => 1,
            'equipo_id' => 2,
        ]);
        TorneoJugador::create([
            'torneo_id' => 9,
            'jugador_id' => 16,
            'categoria_id' => 1,
            'equipo_id' => 2,
        ]);
        TorneoJugador::create([
            'torneo_id' => 9,
            'jugador_id' => 23,
            'categoria_id' => 1,
            'equipo_id' => 2,
        ]);
        // los campeones
        TorneoJugador::create([
            'torneo_id' => 9,
            'jugador_id' => 7,
            'categoria_id' => 1,
            'equipo_id' => 6,
        ]);
        TorneoJugador::create([
            'torneo_id' => 9,
            'jugador_id' => 8,
            'categoria_id' => 1,
            'equipo_id' => 6,
        ]);

        TorneoJugador::create([
            'torneo_id' => 9,
            'jugador_id' => 13,
            'categoria_id' => 1,
            'equipo_id' => 6,
        ]);
        TorneoJugador::create([
            'torneo_id' => 9,
            'jugador_id' => 14,
            'categoria_id' => 1,
            'equipo_id' => 6,
        ]);

        // gambitos
        TorneoJugador::create([
            'torneo_id' => 9,
            'jugador_id' => 5,
            'categoria_id' => 1,
            'equipo_id' => 4,
        ]);
        TorneoJugador::create([
            'torneo_id' => 9,
            'jugador_id' => 18,
            'categoria_id' => 1,
            'equipo_id' => 4,
        ]);
        TorneoJugador::create([
            'torneo_id' => 9,
            'jugador_id' => 10,
            'categoria_id' => 1,
            'equipo_id' => 4,
        ]);
        TorneoJugador::create([
            'torneo_id' => 9,
            'jugador_id' => 17,
            'categoria_id' => 1,
            'equipo_id' => 4,
        ]);
        // gambito de dama
        TorneoJugador::create([
            'torneo_id' => 9,
            'jugador_id' => 19,
            'categoria_id' => 1,
            'equipo_id' => 5,
        ]);
        TorneoJugador::create([
            'torneo_id' => 9,
            'jugador_id' => 20,
            'categoria_id' => 1,
            'equipo_id' => 5,
        ]);
        TorneoJugador::create([
            'torneo_id' => 9,
            'jugador_id' => 6,
            'categoria_id' => 1,
            'equipo_id' => 5,
        ]);
        TorneoJugador::create([
            'torneo_id' => 9,
            'jugador_id' => 12,
            'categoria_id' => 1,
            'equipo_id' => 5,
        ]);
        // apertura maestra
        TorneoJugador::create([
            'torneo_id' => 9,
            'jugador_id' => 4,
            'categoria_id' => 1,
            'equipo_id' => 3,
        ]);
        TorneoJugador::create([
            'torneo_id' => 9,
            'jugador_id' => 24,
            'categoria_id' => 1,
            'equipo_id' => 3,
        ]);
        TorneoJugador::create([
            'torneo_id' => 9,
            'jugador_id' => 35,
            'categoria_id' => 1,
            'equipo_id' => 3,
        ]);
    }
}
