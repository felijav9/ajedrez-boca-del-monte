<?php

namespace Database\Seeders;

use App\Models\ProtejoMiMente\Torneo;
use Illuminate\Database\Seeder;

class TorneoSeeder extends Seeder
{
    public function run(): void
    {
        Torneo::create([
            'nombre' => 'Talleres y primer torneo navideño 2022',
            'descripcion' => 'Se realizaron talleres del 19 al 22 de diciembre donde se enseñó táctica, movimiento de piezas y jugadas básicas. El torneo se disputó el 23 de diciembre en 7 rondas bajo sistema suizo con ritmo 10+0. Los 8 mejores avanzaron a una fase eliminatoria hasta definir al campeón.

Este torneo marcó el inicio de la tradición navideña. Participaron varios jugadores de la comunidad tanto en los talleres como en el torneo.

El campeón fue Víctor Álvarez, quien logró el título con una actuación invicta. André obtuvo la medalla de plata, siendo su primera medalla en torneos, mientras que Felipe se llevó el bronce. Daniel Solís disputó su primer torneo y finalizó en cuarta posición.

Clasificaron 8 jugadores a la fase final. En semifinales, Víctor Álvarez venció a Daniel Solís para avanzar a la final, mientras que André superó a Felipe. En el duelo por el tercer lugar, Felipe venció a Daniel. En la final, Víctor derrotó a André para quedarse con la medalla de oro.',
            'fecha_inicio' => '2022-12-19',
            'fecha_fin' => '2022-12-23',
            'lugar' => 'Cubil Protejo Mi Comunidad',
            'tipo' => 'interno',
        ]);

        Torneo::create([
            'nombre' => 'Talleres y primer torneo por equipos 2023',
            'descripcion' => 'Se realizaron talleres el 26 y 27 de junio como parte del curso de vacaciones de medio año. El torneo por equipos se disputó el 28 de junio con la participación de 24 jugadores organizados en 6 equipos.

Fue el primer torneo por equipos en la historia del club y el que ha contado con mayor participación. Cada equipo eligió nombre y color, generando una competencia dinámica.

El equipo campeón fue “Los Chapines”, conformado por Alejandro, Fabián, Josué y Joshua. El segundo lugar lo obtuvo el equipo integrado por Uriel, Daniel Solís (quien consiguió su primera medalla tras haber quedado cuarto en 2022), Esteban y Elqin. El tercer lugar fue para el equipo “Las Barbies”, conformado por Sonia, Noemí, Reynita y Samantha, iniciando su presencia en el medallero del club.',
            'fecha_inicio' => '2023-06-26',
            'fecha_fin' => '2023-06-28',
            'lugar' => 'Cubil Protejo Mi Comunidad',
            'tipo' => 'interno',
        ]);

        Torneo::create([
            'nombre' => 'Talleres y segundo torneo navideño 2023',
            'descripcion' => 'Se realizaron talleres del 11 al 14 de diciembre enfocados en táctica y fundamentos. El torneo se jugó el 15 de diciembre bajo modalidad rápida 10+0 con 8 rondas.

El torneo fue muy reñido, especialmente entre Daniel Solís y Daniela Hernández, con una diferencia final de un punto.

Daniel Solís se consagró campeón, logrando su primer título tras haber obtenido previamente plata por equipos, consolidando así un gran año. Daniela Hernández obtuvo la medalla de plata y Viviana Gómez se llevó el bronce.',
            'fecha_inicio' => '2023-12-11',
            'fecha_fin' => '2023-12-15',
            'lugar' => 'Cubil Protejo Mi Comunidad',
            'tipo' => 'interno',
        ]);

        Torneo::create([
            'nombre' => 'Talleres y torneo de rápidas julio 2024',
            'descripcion' => 'Se realizaron talleres del 1 al 4 de julio enfocados en táctica, aperturas y control del tiempo. El torneo se disputó el 5 de julio bajo modalidad rápida 10+0 con 9 rondas.

Participó una nueva generación de jugadores junto con campeones anteriores como Daniel Solís y Víctor Álvarez.

El torneo fue muy competitivo, con varios jugadores disputando el título. Finalmente, Joaquín Méndez se coronó campeón luego de haber quedado quinto en 2022. David Nájera, nuevo jugador del club, obtuvo la medalla de plata con una destacada actuación. Daniel Solís logró el bronce tras competir con jugadores como Víctor Álvarez y Edgar González, consiguiendo así su primera medalla de bronce y su tercera medalla en total.',
            'fecha_inicio' => '2024-07-01',
            'fecha_fin' => '2024-07-05',
            'lugar' => 'Cubil Protejo Mi Comunidad',
            'tipo' => 'interno',
        ]);

        Torneo::create([
            'nombre' => 'Talleres y torneo blitz junio 2025',
            'descripcion' => 'Se realizaron talleres del 23 al 25 de junio enfocados en táctica y manejo del tiempo. El torneo se disputó el 26 de junio en modalidad blitz 5+0 con 8 rondas.

Tras no haberse realizado torneo navideño en 2024, se esperó un año para este evento. El título fue intensamente disputado entre el campeón reinante Joaquín Méndez, el excampeón Daniel Solís y el medallista de plata David Nájera.

Joaquín Méndez y David Nájera terminaron igualados en puntos, incluyendo una partida donde Joaquin logró tablas por ahogado. En el desempate, David Nájera se impuso de manera contundente y ganó su primer título y segunda medalla. Joaquín obtuvo la plata, sumando su segunda medalla.

Juan Diego Pacheco fue la sorpresa del torneo al quedarse con el bronce. Daniel Solís, tres veces medallista y campeón 2023, finalizó en sexta posición, lo cual fue un resultado inesperado.',
            'fecha_inicio' => '2025-06-23',
            'fecha_fin' => '2025-06-26',
            'lugar' => 'Cubil Protejo Mi Comunidad',
            'tipo' => 'interno',
        ]);

        Torneo::create([
            'nombre' => 'Talleres y tercer torneo navideño 2025',
            'descripcion' => 'Se retomó la tradición de los torneos navideños en un formato corto de dos días. Hubo ausencia de jugadores como Joaquín Méndez y Juan Diego Pacheco.

Daniel Solís y Gabriel participaron en la organización del evento.

David Nájera se consagró campeón, logrando su segundo título y tercera medalla, reafirmando su dominio y marcando una nueva rivalidad dentro del club. Steven Acevedo apareció como nuevo jugador destacado al obtener la medalla de plata. Karla Blanco, jugadora constante, consiguió la medalla de bronce.',
            'fecha_inicio' => '2025-12-11',
            'fecha_fin' => '2025-12-12',
            'lugar' => 'Cubil Protejo Mi Comunidad',
            'tipo' => 'interno',
        ]);

        Torneo::create([
            'nombre' => 'Talleres y primer torneo de Año Nuevo 2025',
            'descripcion' => 'Evento especial de fin de año con talleres y torneo en dos días, realizado en un ambiente entre amigos, modalidad rapidas 10+0, taller se llevo a cabo 29 de diciembre y torneo el 30 de diciembre conmemoración fin de año.

Hubo ausencia de jugadores como David Nájera, Víctor Álvarez y Joaquín Méndez. Se contó con la participación de jugadores federados como Iker Aguilar y Dayana Aguilar, quienes disputaron el título.

Dayana Aguilar se llevó la medalla de oro, mientras que Iker Aguilar obtuvo la plata.

El tercer lugar fue muy disputado entre Daniel Solís, Emily Aguilar y Christopher Díaz. Finalmente, Daniel Solís logró el bronce, alcanzando su cuarta medalla y su tercer bronce, mostrando recuperación tras su desempeño anterior.',
            'fecha_inicio' => '2025-12-29',
            'fecha_fin' => '2025-12-30',
            'lugar' => 'Cubil Protejo Mi Comunidad',
            'tipo' => 'interno',
        ]);

        Torneo::create([
            'nombre' => 'Talleres y primer torneo Día del Cariño 2026',
            'descripcion' => 'Se desarrolló dentro del programa “Protejo Mi Mente”, con talleres cada sábado 17 de enero, 24 de enero, 31 de enero y 7 de febrero, el torneo se llevo a cabo el 14 de febrero conmemoración dia del cariño.

Por primera vez el torneo se dividió en categorías sub-18 y sub-10, modalidad rapidas 10+0.

En sub-18, participaron excampeones como Daniel Solís, Joaquín Méndez y David Nájera. La lucha por el título fue entre David Nájera y Steven Acevedo. Ambos empataron en puntos, pero Steven perdió una partida clave contra Joaquín Méndez, lo que permitió que David, con mayor solidez, se quedara con el título y su tercera corona.

El bronce fue disputado entre varios jugadores, destacando Daniel Solís, Joaquín Méndez, Carlos Esteban y Juan Diego Pacheco. Finalmente, Daniel Solís obtuvo el bronce, alcanzando su quinta medalla total. Joaquín quedó cuarto, Carlos Esteban fue la sorpresa en quinto lugar y Juan Diego terminó sexto.

En sub-10, Emiliano Pacheco ganó el título con puntaje perfecto. Esteban Abril obtuvo la plata en su tercer torneo y Celeste Méndez consiguió el bronce. También participaron Ajbe Ortiz (4to), Alejandra Abril (5ta) y Saqmuj Aguilar (6to).',
            'fecha_inicio' => '2026-01-17',
            'fecha_fin' => '2026-02-14',
            'lugar' => 'Cubil Protejo Mi Comunidad',
            'tipo' => 'interno',
        ]);

        Torneo::create([
            'nombre' => 'Talleres y segundo torneo por equipos 2026',
            'descripcion' => 'Tras varias semanas de talleres y con nuevos jugadores incorporados al programa, se realizó el segundo torneo por equipos después de tres años.

Los mejores jugadores sub-18 fueron líderes de equipo. Hubo ausencias importantes el día del evento.

Changos FC logró un resultado histórico al ganar la medalla de oro con solo tres jugadores. Abner Utuy asumió el liderazgo ante la ausencia de Joaquín Méndez y obtuvo su primera medalla de oro. Esteban Abril también destacó, ganando su primer oro tras haber conseguido plata previamente, y Arnoldo Ovando fue el MVP del equipo.

El segundo lugar fue para Bloops, liderado por David Nájera, quien ganó todas sus partidas y alcanzó su quinta medalla. Christopher Díaz obtuvo su primera medalla, al igual que Ajbe Ortiz y Fernando Jolón, quienes fueron claves.

El tercer lugar fue para el equipo “Los Campeones”, liderado por Daniel Solís, quien alcanzó su sexta medalla y cuarto bronce. También destacaron David Nolasco, Karla Blanco y Andrea Roblero, todos aportando al resultado.

En cuarto lugar quedó el equipo Gambitos conformado por Juan Diego Pacheco, Alejandra Abril, Joshua Gramajo y Mario. En quinto lugar el equipo Gambito de Dama liderado por Edgar Gonzalez y conformado por Emiliano Pacheco, Carlos Esteban y Saqmuj Aguilar, y en sexto Apertura Maestra conformado por Kanek Ortiz, Andres Gomez y Nahil Ortiz.',
            'fecha_inicio' => '2026-02-21',
            'fecha_fin' => '2026-03-28',
            'lugar' => 'Cubil Protejo Mi Comunidad',
            'tipo' => 'interno',
        ]);

        Torneo::create([
        'nombre' => 'Talleres y primer torneo técnico 2026',
        'descripcion' => 'Primer torneo técnico con jornada completa de 9:00 am a 5:30 pm. 

        El ciclo inició el sábado 11 de abril con talleres semanales de ajedrez, evaluando la asistencia y constancia técnica, finalizando este sábado 9 de mayo con la competencia oficial.

        Cronograma del Torneo:
        • 09:00 am - 01:00 pm: Primera Fase (7 rondas rápidas 10+0).
        • 01:00 pm - 02:30 pm: Receso para descanso y almuerzo (cada jugador trae su alimento).
        • 02:30 pm - 05:30 pm: Segunda Fase (6-7 rondas blitz 5+0).

        Código de Vestimenta: Formal (Camisa formal o polo, se permite el uso de jeans decorosos). Participantes femeninas bajo el mismo estándar de formalidad.

        Premiación: Se sumará el puntaje acumulado de todo el día para determinar a los ganadores. Se otorgarán medallas de Oro, Plata y Bronce. Además, se premiará al Mejor Jugador, Mejor Jugadora y Mejor Sub-10 del torneo.',
            'fecha_inicio' => '2026-04-11',
            'fecha_fin' => '2026-05-09',
            'lugar' => 'Cubil Protejo Mi Comunidad',
            'tipo' => 'interno',
        ]);
    }
}
