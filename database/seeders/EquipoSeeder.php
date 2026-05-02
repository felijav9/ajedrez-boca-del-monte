<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProtejoMiMente\Equipo;

class EquipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Equipo::create([
            'nombre'           => 'Changos FC',
            'torneo_id'         => 9
        ]);
        Equipo::create([
            'nombre'           => 'Bloops',
            'torneo_id'         => 9
        ]);
        Equipo::create([
            'nombre'           => 'Apertura Maestra',
            'torneo_id'         => 9
        ]);
        Equipo::create([
            'nombre'           => 'Gambitos',
            'torneo_id'         => 9
        ]);
        Equipo::create([
            'nombre'           => 'Gambito de Dama',
            'torneo_id'         => 9
        ]);
        Equipo::create([
            'nombre'           => 'Los campeones',
            'torneo_id'         => 9
        ]);
        Equipo::create([
            'nombre'           => 'Los chapines',
            'torneo_id'         => 2
        ]);
        Equipo::create([
            'nombre'           => 'Equipo',
            'torneo_id'         => 2
        ]);
        Equipo::create([
            'nombre'           => 'Barbies',
            'torneo_id'         => 2
        ]);
    }
}
