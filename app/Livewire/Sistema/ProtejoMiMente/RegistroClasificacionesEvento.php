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

    public bool $ordenGuardado = false;

    // MODAL
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
        PARTIDAS DEL EVENTO
    ==========================*/
    private function partidas(): Collection
    {
        if (!$this->torneo_evento_id) return collect();

        return Partida::with(['ronda', 'blancas', 'negras'])
            ->whereHas('ronda', fn($q) =>
                $q->where('torneo_evento_id', $this->torneo_evento_id)
            )
            ->get();
    }

    /* =========================
        CLASIFICACIÓN + EMPATES + PODIO
        (CORRECTO PARA MEDALLAS)
    ==========================*/
    public function getClasificacionesProperty()
    {
        $tabla = [];

        foreach ($this->partidas() as $p) {
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

                // puntos
                if ($p->resultado === '1-0' && $color === 'blancas') {
                    $tabla[$id]['pts']++;
                }

                if ($p->resultado === '0-1' && $color === 'negras') {
                    $tabla[$id]['pts']++;
                }

                if ($p->resultado === '0.5-0.5') {
                    $tabla[$id]['pts'] += 0.5;
                }
            }
        }

        // ordenar por puntos
        $collection = collect($tabla)
            ->sortByDesc('pts')
            ->values();

        // =========================
        // RANKING CON EMPATES + PODIO REAL
        // =========================
        $result = [];
        $lastPts = null;
        $rank = 0;
        $position = 0;

        foreach ($collection as $i => $c) {

            if ($lastPts !== $c['pts']) {
                $position++;
                $rank = $position;
                $lastPts = $c['pts'];
            }

            $result[] = [
                'rank' => $rank,
                'jugador' => $c['jugador'],
                'pts' => $c['pts'],
            ];
        }

        return collect($result);
    }

    /* =========================
        PUBLICAR
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
                    'posicion' => $c['rank'],
                    'pts' => $c['pts'],
                ]
            );
        }

        $this->ordenGuardado = true;

        $this->dispatch('toast', message: 'Clasificación publicada correctamente');
    }

    /* =========================
        MODAL PARTIDAS
    ==========================*/
    public function verPartidas($jugadorId)
    {
        $this->jugadorSeleccionado = $jugadorId;
        $this->verPartidasModal = true;
    }

    public function getPartidasJugadorProperty()
    {
        if (!$this->jugadorSeleccionado) return collect();

        return $this->partidas()
            ->filter(function ($p) {
                return $p->blancas_id == $this->jugadorSeleccionado
                    || $p->negras_id == $this->jugadorSeleccionado;
            })
            ->sortBy(fn($p) => $p->ronda?->numero) // 👈 AQUÍ EL FIX
            ->values();
    }

    /* ========================= */
    public function updatedTorneoId()
    {
        $this->torneo_evento_id = null;
        $this->ordenGuardado = false;
    }

    public function updatedTorneoEventoId()
    {
        $this->ordenGuardado = false;
    }

    /* ========================= */
    public function render()
    {
        return view('livewire.sistema.protejo-mi-mente.registro-clasificaciones-evento');
    }
}