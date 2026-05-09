<?php

use App\Livewire\Sistema\ProtejoMiMente\RegistroCategorias;
use App\Livewire\Sistema\ProtejoMiMente\RegistroEquipos;
use App\Livewire\Sistema\ProtejoMiMente\RegistroJugadores;
use App\Livewire\Sistema\ProtejoMiMente\RegistroTorneos;
use App\Livewire\Sistema\ProtejoMiMente\RegistroTorneosJugadores;
use App\Livewire\Sistema\ProtejoMiMente\RegistroResultadosIndividuales;
use App\Livewire\Sistema\ProtejoMiMente\RegistroEventosTorneo;
use App\Livewire\Sistema\ProtejoMiMente\RegistroRondas;
use App\Livewire\Sistema\ProtejoMiMente\RegistroPartidas;
use App\Livewire\Sistema\ProtejoMiMente\RegistroClasificacionesEvento;


use Illuminate\Support\Facades\Route;

Route::prefix('protejo-mi-mente')->group(function () {

    // rutas publicas
    Route::view('medallero', 'sistema.protejo-mi-mente.medallero')
        ->name('protejo-mi-mente.medallero');
    // resultado jugadores individuales
    Route::view('jugadores-protejo', 'sistema.protejo-mi-mente.jugadores-protejo')
        ->name('protejo-mi-mente.jugadores-protejo');
    // torneos protejo
    Route::view('torneos-protejo', 'sistema.protejo-mi-mente.torneos-protejo')
        ->name('protejo-mi-mente.torneos-protejo');

        // RUTAS PROTEGIDAS
    Route::get('registro-jugadores', RegistroJugadores::class)
        ->middleware(['can:page.view.protejo-mi-mente.registro-jugadores'])
        ->name('protejo-mi-mente.registro-jugadores');
    Route::get('registro-torneos', RegistroTorneos::class)
        ->middleware(['can:page.view.protejo-mi-mente.registro-torneos'])
        ->name('protejo-mi-mente.registro-torneos');
    Route::get('registro-equipos', RegistroEquipos::class)
        ->middleware(['can:page.view.protejo-mi-mente.registro-equipos'])
        ->name('protejo-mi-mente.registro-equipos');
    Route::get('ingreso-jugadores-torneos', RegistroTorneosJugadores::class)
        ->middleware(['can:page.view.protejo-mi-mente.ingreso-jugadores-torneos'])
        ->name('protejo-mi-mente.ingreso-jugadores-torneos');
    Route::get('registro-categorias', RegistroCategorias::class)
        ->middleware(['can:page.view.protejo-mi-mente.registro-categorias'])
        ->name('protejo-mi-mente.registro-categorias');
    Route::get('registro-resultados-individuales', RegistroResultadosIndividuales::class)
        ->middleware(['can:page.view.protejo-mi-mente.registro-resultados-individuales'])
        ->name('protejo-mi-mente.registro-resultados-individuales');
        // nuevas tareas panel
    Route::get('registro-eventos-torneo', RegistroEventosTorneo::class)
        ->middleware(['can:page.view.protejo-mi-mente.registro-eventos-torneos'])
        ->name('protejo-mi-mente.registro-eventos-torneo');
    Route::get('registro-rondas', RegistroRondas::class)
        ->middleware(['can:page.view.protejo-mi-mente.registro-rondas'])
        ->name('protejo-mi-mente.registro-rondas');
    Route::get('registro-partidas', RegistroPartidas::class)
        ->middleware(['can:page.view.protejo-mi-mente.registro-partidas'])
        ->name('protejo-mi-mente.registro-partidas');
    Route::get('registro-clasificaciones-evento', RegistroClasificacionesEvento::class)
        ->middleware(['can:page.view.protejo-mi-mente.registro-clasificaciones-evento'])
        ->name('protejo-mi-mente.registro-clasificaciones-evento');
});
