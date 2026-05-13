<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProtejoMiMente\Torneo;
use App\Models\ProtejoMiMente\TorneoImagen;

class TorneoMayoSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Usamos updateOrCreate para evitar errores de duplicidad de ID
        // Busca por ID 10, si existe actualiza los datos, si no, lo crea.
        Torneo::updateOrCreate(
            ['id' => 10],
            [
                'nombre' => 'Talleres y primer torneo técnico 2026',
                'descripcion' => "Primer torneo técnico con jornada completa de 9:00 am a 5:30 pm.\n\n" .
                    "El proceso de formación fue del 11 de abril y finalizó el 2 de mayo. Para el torneo clasificaron los jugadores constantes en talleres y se evaluó tanto rápidas como blitz. El ciclo inició el sábado 11 de abril con talleres semanales de ajedrez, evaluando la asistencia y constancia técnica, finalizando este sábado 9 de mayo con la competencia oficial.\n\n" .
                    "Cronograma del Torneo:\n" .
                    "• 09:00 am - 01:00 pm: Primera Fase (7 rondas rápidas 10+0).\n" .
                    "• 01:00 pm - 02:30 pm: Receso para descanso y almuerzo (cada jugador trae su alimento).\n" .
                    "• 02:30 pm - 05:30 pm: Segunda Fase (6-7 rondas blitz 5+0).\n\n" .
                    "Código de Vestimenta: Formal (Camisa formal o polo, se permite el uso de jeans decorosos). Participantes femeninas bajo el mismo estándar de formalidad.\n\n" .
                    "Premiación: Se sumará el puntaje acumulado de todo el día para determinar a los ganadores. Se otorgarán medallas de Oro, Plata y Bronce. Además, se premiará al Mejor Jugador, Mejor Jugadora y Mejor Sub-10 del torneo.\n\n" .
                    "Resumen del Torneo:\n" .
                    "Este se realizó el sábado 9 de mayo, se comenzó con 7 partidas rápidas de 10+0, desde el comienzo el oro fue peleado principalmente entre Daniel Solis 6 veces medallista, Christopher Diaz medallista de plata por equipos y el jugador nuevo Andres Gomez que es fue solo su segundo torneo participando, en rápidas 10+0 Andres Gomez domino, su mejor evento e hizo 7/7 teniendo victorias claves sobre Daniel y Christopher y asegurando puntos cruciales en la primera parte y demostrando un excelente nivel ajedrecístico y evolución, Daniel hizo 6/7 venciendo a Chris y Christopher 5/7 un gran desempeño y mucha confianza para el después de esa plata por equipos. De igual manera el 4to y 5to puesto estuvo peleado entre varios jugadores, Emiliano Pacheco, David Nolasco, Juan Diego Pacheco y Joshua Gramajo, una competencia muy cerrada entre ellos.\n\n" .
                    "Por la tarde fue blitz 5+0, esta etapa de Blitz Christopher Diaz lo domino con 6/7 y siendo el único en vencer a el futuro campeón Andres Gomez, podía ganar la medalla de plata pero perdió frente a Daniel Solis una partida y la diferencia fue entre ellos de 1 punto, Daniel Solis seguía presionado por ese oro, venciendo a Christopher pero perdiendo frente a Andres Gomez en una de las mejores partidas del torneo, Daniel cometio un movimiento ilegal y a Andres Gomez se le agregaron los 30 segundos necesarios para que cerrara esa partida con jaque mate, esa ilegal lo ayudo, y para Andres Gomez blitz no es su mejor estilo pero hizo lo que tenia que hacer y pese a ir liderando el torneo y perder frente a Christopher logro cuidar ese puesto, vencio a Daniel y logro coronarse con el campeón del torneo logrando su primer medalla en el club y su primer medalla de oro con una actuación impecable demostrando gran dominio en rápidas y blitz, Daniel gana la medalla de plata, 7ma medalla, pese a no ganar su segundo oro demostró un gran nivel ajedrecístico y se posiciono entre los mejores, Christopher Diaz muestra una gran evolución, plata por equipos y ahora consiguió su primer bronce individual sin duda demuestra una gran evolución en su nivel y consigue su segunda medalla.\n\n" .
                    "El 4to puesto se lo llevo Emiliano Pacheco con una actuación muy buena y siendo además el mejor sub-10 gran logro para este jugador.\n\n" .
                    "El 5to puesto fue para Joshua Gramajo, quien tuvo una actuación muy buena y demostró una gran mejora respecto al torneo anterior.\n\n" .
                    "Posiciones Finales:\n" .   
                    "6to David Nolasco, 7mo Esteban Abril, 8vo Juan Diego Pacheco, 9na Alejandra Abril, 10ma saqmuj Aguilar y 11vo Fernando Jolon.\n\n" .
                    "Premios especiales: Andres Gomez mejor jugador del torneo, Alejandra Abril mejor jugadora torneo y Emiliano Pacheco mejor sub-10",
                'fecha_inicio' => '2026-04-11',
                'fecha_fin' => '2026-05-09',
                'lugar' => 'Cubil Protejo Mi Comunidad',
                'tipo' => 'interno',
                'estado' => 'finalizado',
            ]
        );


        // nuevo ciclo 

       Torneo::updateOrCreate(
            ['id' => 11],
            [
                'nombre' => 'Nuevo Ciclo de Talleres Mayo-Junio 2026',
                'descripcion' => "¡El ajedrez no se detiene!\n\n" .
                "Damos inicio a un nuevo ciclo de talleres a partir del sábado 16 de mayo, con nuevos retos, estrategias y espacios de crecimiento competitivo para todos los miembros del club.\n\n" .
                "Durante este ciclo se llevará control de asistencia y participación, además de preparar a los jugadores para futuros eventos y competencias del club.\n\n" .
                "Cada entrenamiento es una oportunidad para descubrir quién será el próximo campeón del club.\n\n" .
                "Quedan cordialmente invitados todos los integrantes a continuar fortaleciendo su nivel dentro y fuera del tablero.\n\n" .
                "¡Nos vemos en el tablero!",
                'fecha_inicio' => '2026-05-16',
                'fecha_fin' => '2026-06-13',
                'lugar' => 'Cubil Protejo Mi Comunidad',
                'tipo' => 'interno',
            ]
        );
        
        // 2. Limpiamos las imágenes previas de este torneo antes de insertarlas
        // Esto evita que las rutas se dupliquen cada vez que ejecutas el seeder.
        TorneoImagen::where('torneo_id', 10)->delete();

        // 3. Inserción de Imágenes
        TorneoImagen::insert([
            ['torneo_id' => 10, 'ruta' => 'img/2026_portadamayo.jpeg', 'tipo' => 'portada'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_mayganadores.jpeg', 'tipo' => 'ganadores'],
            
            // Imagen talleres (2 al 22)
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytall2.jpeg', 'tipo' => 'imagen_talleres'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytall3.jpeg', 'tipo' => 'imagen_talleres'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytall4.jpeg', 'tipo' => 'imagen_talleres'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytall5.jpeg', 'tipo' => 'imagen_talleres'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytall6.jpeg', 'tipo' => 'imagen_talleres'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytall7.jpeg', 'tipo' => 'imagen_talleres'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytall8.jpeg', 'tipo' => 'imagen_talleres'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytall9.jpeg', 'tipo' => 'imagen_talleres'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytall10.jpeg', 'tipo' => 'imagen_talleres'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytall11.jpeg', 'tipo' => 'imagen_talleres'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytall12.jpeg', 'tipo' => 'imagen_talleres'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytall13.jpeg', 'tipo' => 'imagen_talleres'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytall14.jpeg', 'tipo' => 'imagen_talleres'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytall15.jpeg', 'tipo' => 'imagen_talleres'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytall16.jpeg', 'tipo' => 'imagen_talleres'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytall17.jpeg', 'tipo' => 'imagen_talleres'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytall18.jpeg', 'tipo' => 'imagen_talleres'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytall19.jpeg', 'tipo' => 'imagen_talleres'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytall20.jpeg', 'tipo' => 'imagen_talleres'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytall21.jpeg', 'tipo' => 'imagen_talleres'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytall22.jpeg', 'tipo' => 'imagen_talleres'],

            // Imagen torneos (1 al 26)
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytour1.jpeg', 'tipo' => 'imagen_torneos'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytour2.jpeg', 'tipo' => 'imagen_torneos'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytour3.jpeg', 'tipo' => 'imagen_torneos'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytour4.jpeg', 'tipo' => 'imagen_torneos'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytour5.jpeg', 'tipo' => 'imagen_torneos'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytour6.jpeg', 'tipo' => 'imagen_torneos'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytour7.jpeg', 'tipo' => 'imagen_torneos'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytour8.jpeg', 'tipo' => 'imagen_torneos'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytour9.jpeg', 'tipo' => 'imagen_torneos'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytour10.jpeg', 'tipo' => 'imagen_torneos'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytour11.jpeg', 'tipo' => 'imagen_torneos'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytour13.jpeg', 'tipo' => 'imagen_torneos'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytour14.jpeg', 'tipo' => 'imagen_torneos'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytour15.jpeg', 'tipo' => 'imagen_torneos'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytour16.jpeg', 'tipo' => 'imagen_torneos'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytour17.jpeg', 'tipo' => 'imagen_torneos'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytour18.jpeg', 'tipo' => 'imagen_torneos'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytour19.jpeg', 'tipo' => 'imagen_torneos'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytour20.jpeg', 'tipo' => 'imagen_torneos'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytour21.jpeg', 'tipo' => 'imagen_torneos'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytour22.jpeg', 'tipo' => 'imagen_torneos'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytour23.jpeg', 'tipo' => 'imagen_torneos'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytour24.jpeg', 'tipo' => 'imagen_torneos'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytour25.jpeg', 'tipo' => 'imagen_torneos'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_maytour26.jpeg', 'tipo' => 'imagen_torneos'],
            ['torneo_id' => 10, 'ruta' => 'img/2026_mayresults.jpeg', 'tipo' => 'imagen_torneos'],
        ]);
    }
}