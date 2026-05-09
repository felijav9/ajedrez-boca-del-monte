<?php

namespace App\Livewire\Sistema\ProtejoMiMente;

use App\Models\ProtejoMiMente\Partida;
use App\Models\ProtejoMiMente\Torneo;
use App\Models\ProtejoMiMente\TorneoEvento;
use App\Models\ProtejoMiMente\TorneoEventoClasificacion;
use Illuminate\Support\Collection;
use Livewire\Component;

class RegistroClasificacionesEvento extends Component
{
    public $torneo_id = null;
    public $torneo_evento_id = null;

    public bool $modoGlobal = false;

    public bool $verPartidasModal = false;
    public $jugadorSeleccionado = null;

    /* =========================
        TORNEOS
    ==========================*/
    public function torneos()
    {
        return Torneo::orderBy('nombre')->get();
    }

    public function eventos()
    {
        if (!$this->torneo_id) return collect();

        return TorneoEvento::where('torneo_id', $this->torneo_id)
            ->orderBy('nombre')
            ->get();
    }

    /* =========================
        PARTIDAS EVENTO
    ==========================*/
    private function partidasEvento(): Collection
    {
        if (!$this->torneo_evento_id) return collect();

        return Partida::with(['ronda.torneoEvento', 'blancas', 'negras'])
            ->whereHas('ronda', fn($q) =>
                $q->where('torneo_evento_id', $this->torneo_evento_id)
            )
            ->get();
    }

    /* =========================
        PARTIDAS TORNEO (GLOBAL)
    ==========================*/
    private function partidasTorneo(): Collection
    {
        if (!$this->torneo_id) return collect();

        return Partida::with(['ronda.torneoEvento', 'blancas', 'negras'])
            ->whereHas('ronda.torneoEvento', fn($q) =>
                $q->where('torneo_id', $this->torneo_id)
            )
            ->get();
    }

    /* =========================
        MOTOR DE PUNTOS
    ==========================*/
    private function calcularClasificacion($partidas)
    {
        $tabla = [];

        foreach ($partidas as $p) {
            foreach (['blancas', 'negras'] as $color) {

                $j = $p->{$color};
                if (!$j) continue;

                $id = $j->id;

                if (!isset($tabla[$id])) {
                    $tabla[$id] = [
                        'jugador' => $j,
                        'pts' => 0,
                    ];
                }

                if ($p->resultado === '1-0' && $color === 'blancas') {
                    $tabla[$id]['pts'] += 1;
                }

                if ($p->resultado === '0-1' && $color === 'negras') {
                    $tabla[$id]['pts'] += 1;
                }

                if ($p->resultado === '0.5-0.5') {
                    $tabla[$id]['pts'] += 0.5;
                }
            }
        }

        return collect($tabla)
            ->sortByDesc('pts')
            ->values()
            ->map(function ($c) {
                return [
                    'jugador' => $c['jugador'],
                    'pts' => $c['pts'],
                ];
            });
    }

    /* =========================
        EVENTO
    ==========================*/
    public function getClasificacionesProperty()
    {
        return $this->calcularClasificacion(
            $this->partidasEvento()
        );
    }

    /* =========================
        GLOBAL
    ==========================*/
    public function getClasificacionesGlobalProperty()
    {
        return $this->calcularClasificacion(
            $this->partidasTorneo()
        );
    }

    /* =========================
        PUBLICAR (NO BORRAR)
    ==========================*/
    public function publicar()
    {
        foreach ($this->clasificaciones as $c) {

            TorneoEventoClasificacion::updateOrCreate(
                [
                    'torneo_evento_id' => $this->torneo_evento_id,
                    'jugador_id' => $c['jugador']->id,
                ],
                [
                    'posicion' => 0,
                    'pts' => $c['pts'],
                ]
            );
        }

        $this->dispatch('toast', message: 'Clasificación publicada correctamente');
    }

    /* =========================
        MODAL PARTIDAS AGRUPADAS POR EVENTO
    ==========================*/
    public function verPartidas($jugadorId)
    {
        $this->jugadorSeleccionado = $jugadorId;
        $this->verPartidasModal = true;
    }

    public function getPartidasAgrupadasProperty()
    {
        if (!$this->jugadorSeleccionado) return collect();

        $partidas = $this->modoGlobal
            ? $this->partidasTorneo()
            : $this->partidasEvento();

        $filtradas = $partidas->filter(fn($p) =>
            $p->blancas_id == $this->jugadorSeleccionado ||
            $p->negras_id == $this->jugadorSeleccionado
        );

        return $filtradas->groupBy(function ($p) {
            return $p->ronda?->torneoEvento?->nombre ?? 'Sin evento';
        })->map(function ($grupo) {
            return $grupo->sortBy(fn($p) => $p->ronda?->numero)->values();
        });
    }

    /* ========================= */
    public function updatedTorneoId()
    {
        $this->torneo_evento_id = null;
    }

    public function render()
    {
        return view('livewire.sistema.protejo-mi-mente.registro-clasificaciones-evento');
    }
}