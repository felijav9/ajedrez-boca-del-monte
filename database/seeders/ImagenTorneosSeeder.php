<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProtejoMiMente\TorneoImagen;

class ImagenTorneosSeeder extends Seeder
{
    public function run(): void
    {
        // TORNEO 1 → plantilla 1 (3 medallistas)
        TorneoImagen::insert([
            [
                'torneo_id' => 1,
                'ruta' => 'img/december2022_portada.jpg',
                'tipo' => 'portada'
            ],
            // ganadores
             [
                'torneo_id' => 1,
                'ruta' => 'img/ganadoresdecember2022.jpg',
                'tipo' => 'ganadores'
            ],
           
            // talleres y torneos
             [
                'torneo_id' => 1,
                'ruta' => 'img/talleres2022_1.jpg',
                'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 1,
               'ruta' => 'img/talleres2022_2.jpg',
               'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 1,
                'ruta' => 'img/talleres2022_3.jpg',
               'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 1,
                'ruta' => 'img/talleres2022_5.jpg',
               'tipo' => 'imagen_talleres'
            ],

            [
                'torneo_id' => 1,
               'ruta' => 'img/torneo2022_1.jpg',
               'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 1,
                'ruta' => 'img/torneo2022_2.jpg',
               'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 1,
                'ruta' => 'img/torneo2022_3.jpg',
               'tipo' => 'imagen_torneos'
            ],
             
        ]);

        //  TORNEO 2 → plantilla 2 (foto grupal)
        TorneoImagen::insert([
             [
                'torneo_id' => 2,
                'ruta' => 'img/june2023_portada.jpg',
                'tipo' => 'portada'
            ],
            // medallistas
            [
                'torneo_id' => 2,
                'ruta' => 'img/2023_june_gold.jpg',
                'tipo' => 'gold'
            ],
            [
                'torneo_id' => 2,
                'ruta' => 'img/2023_june_silver.jpg',
                'tipo' => 'silver'
            ],
            [
                'torneo_id' => 2,
                'ruta' => 'img/2023_june_bronze.jpg',
                'tipo' => 'bronze'
            ],
            // talleres
             [
                'torneo_id' => 2,
                'ruta' => 'img/2023_talleresjune1.jpg',
               'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 2,
               'ruta' => 'img/2023_talleresjune2.jpg',
                'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 2,
                'ruta' => 'img/2023_talleresjune3.jpg',
               'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 2,
                'ruta' => 'img/2023_talleresjune4.jpeg',
               'tipo' => 'imagen_talleres'
            ],
            // torneos
            [
                'torneo_id' => 2,
                'ruta' => 'img/2023_june_tournament_1.jpg',

                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 2,
                'ruta' => 'img/2023_june_tournament_2.jpg',
               'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 2,
                'ruta' => 'img/2023_june_tournament_3.jpg',
               'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 2,
                'ruta' => 'img/2023_june_tournament_4.jpg',
               'tipo' => 'imagen_torneos'
            ],

            
            
             // TORNEO 3 DICIEMBRE 2023 PORTADA
            [
                'torneo_id' => 3,
                'ruta' => 'img/december2023_portada.jpg',
                'tipo' => 'portada'
            ],

             // medallistas
            [
                'torneo_id' => 3,
                'ruta' => 'img/2023_decembergold.jpg',
                'tipo' => 'gold'
            ],
            [
                'torneo_id' => 3,
                'ruta' => 'img/2023_decembersilver.jpg',
                'tipo' => 'silver'
            ],
            [
                'torneo_id' => 3,
                'ruta' => 'img/2023_decemberbronze.jpg',
                'tipo' => 'bronze'
            ],
            // talleres
            [
                'torneo_id' => 3,
                'ruta' => 'img/2023_decembertalleres1.jpg',
               'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 3,
                'ruta' => 'img/2023_decembertalleres2.jpg',
               'tipo' => 'imagen_talleres'
            ],

            // torneos
            [
                'torneo_id' => 3,
                'ruta' => 'img/2023_dectorneos1.jpg',
               'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 3,
                'ruta' => 'img/2023_dectorneos2.jpg',
               'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 3,
                'ruta' => 'img/2023_dectorneos3.jpg',
               'tipo' => 'imagen_torneos'
            ],

             // TORNEO 4 JULIO 2024 PORTADA
             [
                'torneo_id' => 4,
                'ruta' => 'img/june2024_portada.jpg',
                'tipo' => 'portada'
            ],
            // ganadores
            [
                'torneo_id' => 4,
                'ruta' => 'img/2024_juneganadores.jpg',
                'tipo' => 'ganadores'
            ],
            // talleres
            [
                'torneo_id' => 4,
                'ruta' => 'img/2024_junetalleres11.jpg',
               'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 4,
                'ruta' => 'img/2024_junetalleres2.jpg',
               'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 4,
                'ruta' => 'img/2024_junetalleres3.jpg.jpg',
               'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 4,
                'ruta' => 'img/2024_junetalleres4.jpg.jpg',
               'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 4,
                'ruta' => 'img/2024_junetalleres5.jpg.jpg',
               'tipo' => 'imagen_talleres'
            ],
            // torneos
            [
                'torneo_id' => 4,
                'ruta' => 'img/2024_june_talleres1.jpg',
               'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 4,
                'ruta' => 'img/2024_june_talleres2.jpg',
               'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 4,
                'ruta' => 'img/2024_june_talleres3.jpg',
               'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 4,
                'ruta' => 'img/2024_june_talleres4.jpg',
               'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 4,
                'ruta' => 'img/2024_june_talleres5.jpg',
               'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 4,
                'ruta' => 'img/2024_june_talleres6.jpg',
               'tipo' => 'imagen_torneos'
            ],

            [
                'torneo_id' => 4,
                'ruta' => 'img/2024_june_talleres7.jpg',
               'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 4,
                'ruta' => 'img/2024_june_talleres8.jpg',
               'tipo' => 'imagen_torneos'
            ],
             [
                'torneo_id' => 4,
                'ruta' => 'img/2024_june_talleres8.jpg',
               'tipo' => 'imagen_torneos'
            ],
             [
                'torneo_id' => 4,
                'ruta' => 'img/2024_june_talleres9.jpg',
               'tipo' => 'imagen_torneos'
            ],
             [
                'torneo_id' => 4,
                'ruta' => 'img/2024_june_talleres10.jpg',
               'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 4,
                'ruta' => 'img/2024_june_talleres11.jpg',
               'tipo' => 'imagen_torneos'
            ],



            
             // TORNEO 5 JUNIO 2025 PORTADA
             [
                'torneo_id' => 5,
                'ruta' => 'img/june2025-portada.jpeg',
                'tipo' => 'portada'
            ],
            // ganadores
            [
                'torneo_id' => 5,
               'ruta' => 'img/2025_ganadores_torneo_junio.jpeg',
               'tipo' => 'ganadores'
            ],
            // talleres
            [
                'torneo_id' => 5,
               'ruta' => 'img/2025_juniotalleres1.jpeg',
               'tipo' => 'imagen_talleres'
            ],
             [
                'torneo_id' => 5,
               'ruta' => 'img/2025_juniotalleres2.jpeg',
               'tipo' => 'imagen_talleres'
            ],
             [
                'torneo_id' => 5,
               'ruta' => 'img/2025_juniotalleres3.jpeg',
               'tipo' => 'imagen_talleres'
            ],
             [
                'torneo_id' => 5,
               'ruta' => 'img/2025_juniotalleres4.jpeg',
               'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 5,
               'ruta' => 'img/2025_juniotalleres5.jpg',
               'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 5,
               'ruta' => 'img/2025_juniotalleres6.jpg',
               'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 5,
               'ruta' => 'img/2025_juniotalleres7.jpg',
               'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 5,
               'ruta' => 'img/2025_juniotalleres8.jpg',
               'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 5,
               'ruta' => 'img/2025_juniotalleres9.jpg',
               'tipo' => 'imagen_talleres'
            ],
            // torneos
             [
                'torneo_id' => 5,
                'ruta' => 'img/2025_junio_torneo1.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 5,
                'ruta' => 'img/2025_junio_torneo2.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 5,
                'ruta' => 'img/2025_junio_torneo3.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 5,
                'ruta' => 'img/2025_junio_torneo4.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 5,
                'ruta' => 'img/2025_junio_torneo5.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 5,
                'ruta' => 'img/2025_junio_torneo6.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 5,
                'ruta' => 'img/2025_junio_torneo7.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 5,
                'ruta' => 'img/2025_junio_torneo8.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 5,
                'ruta' => 'img/2025_junio_torneo9.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 5,
                'ruta' => 'img/2025_junio_torneo10.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 5,
                'ruta' => 'img/2025_junio_torneo11.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 5,
                'ruta' => 'img/2025_junio_torneo12.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 5,
                'ruta' => 'img/2025_junio_torneo13.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 5,
                'ruta' => 'img/2025_junio_torneo14.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 5,
                'ruta' => 'img/2025_junio_torneo15.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 5,
                'ruta' => 'img/2025_junio_torneo16.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 5,
                'ruta' => 'img/2025_junio_torneo17.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 5,
                'ruta' => 'img/2025_junio_torneo18.jpeg',
                'tipo' => 'imagen_torneos'
            ],



            // TORNEO 6 NAVIDEÑO
             [
                'torneo_id' => 6,
                'ruta' => 'img/december2025-portada.jpeg',
                'tipo' => 'portada'
            ],
            [
                'torneo_id' => 6,
               'ruta' => 'img/2025_decganadores.jpeg',
               'tipo' => 'ganadores'
            ],
             [
                'torneo_id' => 6,
               'ruta' => 'img/2025_dec_talleres1.jpeg',
               'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 6,
               'ruta' => 'img/2025_dec_talleres2.jpeg',
               'tipo' => 'imagen_talleres'
            ],
             [
                'torneo_id' => 6,
               'ruta' => 'img/2025_dec_torneo1.jpeg',
               'tipo' => 'imagen_torneos'
            ],
              [
                'torneo_id' => 6,
               'ruta' => 'img/2025_dec_torneo2.jpeg',
               'tipo' => 'imagen_torneos'
            ],
             [
                'torneo_id' => 6,
               'ruta' => 'img/2025_dec_torneo3.jpeg',
               'tipo' => 'imagen_torneos'
            ],
             [
                'torneo_id' => 6,
               'ruta' => 'img/2025_dec-torneo4.jpeg',
               'tipo' => 'imagen_torneos'
            ],


            // TORNEO 7 NEW YEAR
             [
                'torneo_id' => 7,
                'ruta' => 'img/december2025-newyear-portada.jpg',
                'tipo' => 'portada'
            ],
            // ganadores
             [
                'torneo_id' => 7,
                'ruta' => 'img/2025_decnew_ganadoresstrue.png',
                'tipo' => 'ganadores'
            ],
            // talleres
             [
                'torneo_id' => 7,
                'ruta' => 'img/2025_decnew_talleres1.jpeg',
                'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 7,
                'ruta' => 'img/2025_decnew_talleres2.jpeg',
                'tipo' => 'imagen_talleres'
            ],

            // TORNEOS
            [
                'torneo_id' => 7,
                'ruta' => 'img/2025_decnew_torneo1.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 7,
                'ruta' => 'img/2025_decnew_torneo2.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 7,
                'ruta' => 'img/2025_decnew_torneo3.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 7,
                'ruta' => 'img/2025_decnew_torneo4.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 7,
                'ruta' => 'img/2025_decnew_torneo44.png',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 7,
                'ruta' => 'img/2025_decnew_torneo5.png',
                'tipo' => 'imagen_torneos'
            ],
           
            [
                'torneo_id' => 7,
                'ruta' => 'img/2025_decnew_torneo6.png',
                'tipo' => 'imagen_torneos'
            ],
           
            [
                'torneo_id' => 7,
                'ruta' => 'img/2025_decnew_torneo7.png',
                'tipo' => 'imagen_torneos'
            ],
            

            // TORNEO 8 DIA CARIÑO
            [
                'torneo_id' => 8,
                'ruta' => 'img/february2026-portada.jpeg',
                'tipo' => 'portada'
            ],
            // ganadores
             [
                'torneo_id' => 8,
                'ruta' => 'img/2026_febwinsub-10.jpeg',
                'tipo' => 'bronze'
            ],
             [
                'torneo_id' => 8,
                'ruta' => 'img/2026_febwinsub-18.jpeg',
                'tipo' => 'silver'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_febreroganadores.jpg',
                'tipo' => 'gold'
            ],
            // talleres
             [
                'torneo_id' => 8,
                'ruta' => 'img/2026_febtalleres1.jpeg',
                'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_febtalleres2.jpeg',
                'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_febtalleres3.jpeg',
                'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_febtalleres4.jpeg',
                'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_febtalleres5.jpeg',
                'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_febtalleres6.jpeg',
                'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_febtalleres7.jpeg',
                'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_febtalleres8.jpeg',
                'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_febtalleres9.jpeg',
                'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_febtalleres10.jpeg',
                'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_febtalleres11.jpeg',
                'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_febtalleres12.jpeg',
                'tipo' => 'imagen_talleres'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_febtalleres13.jpeg',
                'tipo' => 'imagen_talleres'
            ],
            // torneo
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_torneo1.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_torneo2.jpg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_torneo3.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_torneo4.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_torneo5.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_torneo6.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_torneo7.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_torneo8.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_torneo9.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_torneo10.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_torneo11.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_torneo12.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_torneo13.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_torneo14.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_torneo15.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_torneo16.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_torneo17.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_torneo18.jpeg',
                'tipo' => 'imagen_torneos'
            ],
            [
                'torneo_id' => 8,
                'ruta' => 'img/2026_torneo19.jpeg',
                'tipo' => 'imagen_torneos'
            ],


            // TORNEO 9 EQUIPOS
            [
                'torneo_id' => 9,
                'ruta' => 'img/march2026-portada.jpeg',
                'tipo' => 'portada'
            ],
             //  ganadores
             [
                'torneo_id' => 9,
                'ruta' => 'img/2026_marchsilver.jpg',
                'tipo' => 'silver'
            ],
            [
                'torneo_id' => 9,
                'ruta' => 'img/2026_marchbronzee.jpg',
                'tipo' => 'bronze'
            ],
            [
                'torneo_id' => 9,
                'ruta' => 'img/2026_marchgold.jpeg',
                'tipo' => 'gold'
            ],
            // talleres imagen
            
    ['torneo_id' => 9, 'ruta' => 'img/2026_march1.jpeg', 'tipo' => 'imagen_talleres'],
    ['torneo_id' => 9, 'ruta' => 'img/2026_march2.jpeg', 'tipo' => 'imagen_talleres'],
    ['torneo_id' => 9, 'ruta' => 'img/2026_march3.jpeg', 'tipo' => 'imagen_talleres'],
    ['torneo_id' => 9, 'ruta' => 'img/2026_march4.jpeg', 'tipo' => 'imagen_talleres'],
    ['torneo_id' => 9, 'ruta' => 'img/2026_march5.jpeg', 'tipo' => 'imagen_talleres'],
    ['torneo_id' => 9, 'ruta' => 'img/2026_march6.jpeg', 'tipo' => 'imagen_talleres'],
    ['torneo_id' => 9, 'ruta' => 'img/2026_march7.jpeg', 'tipo' => 'imagen_talleres'],
    ['torneo_id' => 9, 'ruta' => 'img/2026_march8.jpeg', 'tipo' => 'imagen_talleres'],
    ['torneo_id' => 9, 'ruta' => 'img/2026_march9.jpeg', 'tipo' => 'imagen_talleres'],
    ['torneo_id' => 9, 'ruta' => 'img/2026_march10.jpeg', 'tipo' => 'imagen_talleres'],
    ['torneo_id' => 9, 'ruta' => 'img/2026_march11.jpeg', 'tipo' => 'imagen_talleres'],
    ['torneo_id' => 9, 'ruta' => 'img/2026_march12.jpeg', 'tipo' => 'imagen_talleres'],
    ['torneo_id' => 9, 'ruta' => 'img/2026_march13.jpeg', 'tipo' => 'imagen_talleres'],
    ['torneo_id' => 9, 'ruta' => 'img/2026_march14.jpeg', 'tipo' => 'imagen_talleres'],
    ['torneo_id' => 9, 'ruta' => 'img/2026_march15.jpeg', 'tipo' => 'imagen_talleres'],
    ['torneo_id' => 9, 'ruta' => 'img/2026_march16.jpeg', 'tipo' => 'imagen_talleres'],
    ['torneo_id' => 9, 'ruta' => 'img/2026_march17.jpeg', 'tipo' => 'imagen_talleres'],
        
            // torneos
           
                ['torneo_id' => 9, 'ruta' => 'img/2026_marchtaller1.jpeg', 'tipo' => 'imagen_torneos'],
                ['torneo_id' => 9, 'ruta' => 'img/2026_marchtaller2.jpeg', 'tipo' => 'imagen_torneos'],
                ['torneo_id' => 9, 'ruta' => 'img/2026_marchtaller3.jpeg', 'tipo' => 'imagen_torneos'],
                ['torneo_id' => 9, 'ruta' => 'img/2026_marchtaller4.jpeg', 'tipo' => 'imagen_torneos'],
                ['torneo_id' => 9, 'ruta' => 'img/2026_marchtaller5.jpeg', 'tipo' => 'imagen_torneos'],
                ['torneo_id' => 9, 'ruta' => 'img/2026_marchtaller6.jpeg', 'tipo' => 'imagen_torneos'],
                ['torneo_id' => 9, 'ruta' => 'img/2026_marchtaller7.jpeg', 'tipo' => 'imagen_torneos'],
                ['torneo_id' => 9, 'ruta' => 'img/2026_marchtaller8.jpeg', 'tipo' => 'imagen_torneos'],
                ['torneo_id' => 9, 'ruta' => 'img/2026_marchtaller9.jpeg', 'tipo' => 'imagen_torneos'],
                ['torneo_id' => 9, 'ruta' => 'img/2026_marchtaller10.jpeg', 'tipo' => 'imagen_torneos'],
                ['torneo_id' => 9, 'ruta' => 'img/2026_marchtaller11.jpeg', 'tipo' => 'imagen_torneos'],
                ['torneo_id' => 9, 'ruta' => 'img/2026_marchtaller12.jpeg', 'tipo' => 'imagen_torneos'],
                ['torneo_id' => 9, 'ruta' => 'img/2026_marchtaller13.jpeg', 'tipo' => 'imagen_torneos'],
                ['torneo_id' => 9, 'ruta' => 'img/2026_marchtaller14.jpeg', 'tipo' => 'imagen_torneos'],
                ['torneo_id' => 9, 'ruta' => 'img/2026_marchtaller15.jpeg', 'tipo' => 'imagen_torneos'],
                ['torneo_id' => 9, 'ruta' => 'img/2026_marchtaller16.jpeg', 'tipo' => 'imagen_torneos'],
                ['torneo_id' => 9, 'ruta' => 'img/2026_marchtaller17.jpeg', 'tipo' => 'imagen_torneos'],
                ['torneo_id' => 9, 'ruta' => 'img/2026_marchtaller18.jpeg', 'tipo' => 'imagen_torneos'],
                ['torneo_id' => 9, 'ruta' => 'img/2026_marchtaller19.jpeg', 'tipo' => 'imagen_torneos'],
                ['torneo_id' => 9, 'ruta' => 'img/2026_marchtaller20.jpeg', 'tipo' => 'imagen_torneos'],
                ['torneo_id' => 9, 'ruta' => 'img/2026_marchtaller21.jpeg', 'tipo' => 'imagen_torneos'],
                ['torneo_id' => 9, 'ruta' => 'img/2026_marchtaller22.jpeg', 'tipo' => 'imagen_torneos'],
                ['torneo_id' => 9, 'ruta' => 'img/2026_marchtaller23.jpeg', 'tipo' => 'imagen_torneos'],
                ['torneo_id' => 9, 'ruta' => 'img/2026_marchtaller24.jpeg', 'tipo' => 'imagen_torneos'],
                ['torneo_id' => 9, 'ruta' => 'img/2026_marchtaller25.jpeg', 'tipo' => 'imagen_torneos'],
            


            
            // TORNEO  técnico mayo855
            [
                'torneo_id' => 10,
                'ruta' => 'img/torneo_portada.jpg',
                'tipo' => 'portada'
            ],






        ]);
       
    }
}