<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProtejoMiMente\ResultadoIndividual;

class ResultadoIndividualSeeder extends Seeder
{
    public function run(): void
    {
        ResultadoIndividual::truncate();

        // TORNEO DECEMBER
        $pos = 1;
        ResultadoIndividual::create(['torneo_id'=>1,'jugador_id'=>25,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>1,'jugador_id'=>26,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>1,'jugador_id'=>49,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>1,'jugador_id'=>7,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>1,'jugador_id'=>22,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>1,'jugador_id'=>30,'posicion'=>$pos++,'medalla'=>null]);


        // PRIMER TORNEO POR EQUIPOS
        // gold
        ResultadoIndividual::create(['torneo_id'=>2,'jugador_id'=>50,'posicion'=> 1,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>2,'jugador_id'=>51,'posicion'=> 1,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>2,'jugador_id'=>52,'posicion'=> 1,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>2,'jugador_id'=>53,'posicion'=> 1,'medalla'=>null]);

        // silver
        ResultadoIndividual::create(['torneo_id'=>2,'jugador_id'=>54,'posicion'=> 2,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>2,'jugador_id'=>7,'posicion'=> 2,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>2,'jugador_id'=>55,'posicion'=> 2,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>2,'jugador_id'=>56,'posicion'=> 2,'medalla'=>null]);

        // bronze
        ResultadoIndividual::create(['torneo_id'=>2,'jugador_id'=>57,'posicion'=> 3,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>2,'jugador_id'=>58,'posicion'=> 3,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>2,'jugador_id'=>59,'posicion'=> 3,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>2,'jugador_id'=>60,'posicion'=> 3,'medalla'=>null]);

        // TORNEO 3 NAVIDEÑO
        $pos = 1;
        ResultadoIndividual::create(['torneo_id'=>3,'jugador_id'=>7,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>3,'jugador_id'=>30,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>3,'jugador_id'=>32,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>3,'jugador_id'=>33,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>3,'jugador_id'=>29,'posicion'=>$pos++,'medalla'=>null]);

        // TORNEO 4
        $pos = 1;
        ResultadoIndividual::create(['torneo_id'=>4,'jugador_id'=>22,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>4,'jugador_id'=>2,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>4,'jugador_id'=>7,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>4,'jugador_id'=>19,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>4,'jugador_id'=>25,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>4,'jugador_id'=>3,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>4,'jugador_id'=>26,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>4,'jugador_id'=>28,'posicion'=>$pos++,'medalla'=>null]);

        // TORNEO 5
        $pos = 1;
        ResultadoIndividual::create(['torneo_id'=>5,'jugador_id'=>2,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>5,'jugador_id'=>22,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>5,'jugador_id'=>5,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>5,'jugador_id'=>19,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>5,'jugador_id'=>6,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>5,'jugador_id'=>7,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>5,'jugador_id'=>40,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>5,'jugador_id'=>41,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>5,'jugador_id'=>9,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>5,'jugador_id'=>42,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>5,'jugador_id'=>13,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>5,'jugador_id'=>43,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>5,'jugador_id'=>44,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>5,'jugador_id'=>45,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>5,'jugador_id'=>30,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>5,'jugador_id'=>48,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>5,'jugador_id'=>46,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>5,'jugador_id'=>18,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>5,'jugador_id'=>10,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>5,'jugador_id'=>47,'posicion'=>$pos++,'medalla'=>null]);

        // TORNEO 6
        $pos = 1;
        ResultadoIndividual::create(['torneo_id'=>6,'jugador_id'=>2,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>6,'jugador_id'=>21,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>6,'jugador_id'=>13,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>6,'jugador_id'=>18,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>6,'jugador_id'=>39,'posicion'=>$pos++,'medalla'=>null]);

        // TORNEO 7
        $pos = 1;
        ResultadoIndividual::create(['torneo_id'=>7,'jugador_id'=>36,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>7,'jugador_id'=>37,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>7,'jugador_id'=>7,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>7,'jugador_id'=>3,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>7,'jugador_id'=>38,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>7,'jugador_id'=>9,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>7,'jugador_id'=>10,'posicion'=>$pos++,'medalla'=>null]);

        // TORNEO 8 - SUB 18
        $pos = 1;
        ResultadoIndividual::create(['torneo_id'=>8,'jugador_id'=>2,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>8,'jugador_id'=>21,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>8,'jugador_id'=>7,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>8,'jugador_id'=>22,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>8,'jugador_id'=>20,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>8,'jugador_id'=>5,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>8,'jugador_id'=>1,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>8,'jugador_id'=>3,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>8,'jugador_id'=>8,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>8,'jugador_id'=>24,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>8,'jugador_id'=>18,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>8,'jugador_id'=>13,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>8,'jugador_id'=>34,'posicion'=>$pos++,'medalla'=>null]);

        // TORNEO 8 - SUB 10
        $pos = 1;
        ResultadoIndividual::create(['torneo_id'=>8,'jugador_id'=>6,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>8,'jugador_id'=>9,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>8,'jugador_id'=>11,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>8,'jugador_id'=>16,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>8,'jugador_id'=>10,'posicion'=>$pos++,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>8,'jugador_id'=>12,'posicion'=>$pos++,'medalla'=>null]);

        // TORNEO 9 (por orden general)
        ResultadoIndividual::create(['torneo_id'=>9,'jugador_id'=>1,'posicion'=> 1,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>9,'jugador_id'=>9,'posicion'=>1,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>9,'jugador_id'=>15,'posicion'=>1,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>9,'jugador_id'=>2,'posicion'=>2,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>9,'jugador_id'=>3,'posicion'=>2,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>9,'jugador_id'=>16,'posicion'=>2,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>9,'jugador_id'=>23,'posicion'=>2,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>9,'jugador_id'=>7,'posicion'=>3,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>9,'jugador_id'=>8,'posicion'=>3,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>9,'jugador_id'=>13,'posicion'=>3,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>9,'jugador_id'=>14,'posicion'=>3,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>9,'jugador_id'=>5,'posicion'=>4,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>9,'jugador_id'=>18,'posicion'=>4,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>9,'jugador_id'=>10,'posicion'=>4,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>9,'jugador_id'=>17,'posicion'=>4,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>9,'jugador_id'=>19,'posicion'=>5,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>9,'jugador_id'=>20,'posicion'=>5,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>9,'jugador_id'=>6,'posicion'=>5,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>9,'jugador_id'=>12,'posicion'=>5,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>9,'jugador_id'=>4,'posicion'=>6,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>9,'jugador_id'=>24,'posicion'=>6,'medalla'=>null]);
        ResultadoIndividual::create(['torneo_id'=>9,'jugador_id'=>35,'posicion'=>6,'medalla'=>null]);
    }
}