<?php

namespace App\Livewire\Sistema\ProtejoMiMente;

use App\Models\ProtejoMiMente\Partida;
use App\Models\ProtejoMiMente\TorneoEvento;
use App\Models\ProtejoMiMente\TorneoEventoClasificacion;
use Illuminate\Support\Collection;
use Livewire\Component;

class RegistroClasificacionesEvento extends Component
{
    public $torneo_evento_id = null;
    public $editMode = false;

    public array $clasificacionesEdit = [];

    // 🔥 CONTROL DE ORDEN
    public bool $ordenGuardado = false;
    public array $ordenManual = [];

    /* ========================= */
    public function eventos()
    {
        return TorneoEvento::orderBy('nombre')->get();
    }

    /* ========================= */
    private function partidas(): Collection
    {
        if (!$this->torneo_evento_id) return collect();

        return Partida::with(['ronda', 'blancas', 'negras'])
            ->whereHas('ronda', fn($q) =>
                $q->where('torneo_evento_id', $this->torneo_evento_id)
            )
            ->get();
    }

    /* ========================= */
    public function getClasificacionesProperty()
    {
        if (!$this->torneo_evento_id) return collect();

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
                        'bhc1' => 0,
                        'bh' => 0,
                        'sb' => 0,
                        'ps' => 0,
                        'de' => 0,
                        'win' => 0,
                        'bwg' => 0,
                        'rating' => $j->elo_clasico ?? 0,
                    ];
                }

                // 🔥 puntos
                if ($p->resultado === '1-0' && $color === 'blancas') {
                    $tabla[$id]['pts']++;
                    $tabla[$id]['win']++;
                }

                if ($p->resultado === '0-1' && $color === 'negras') {
                    $tabla[$id]['pts']++;
                    $tabla[$id]['win']++;
                }

                if ($p->resultado === '0.5-0.5') {
                    $tabla[$id]['pts'] += 0.5;
                }
            }
        }

        $collection = collect($tabla);

        // =========================
        // 🔥 ORDEN FINAL
        // =========================

        if ($this->ordenGuardado && !empty($this->ordenManual)) {

            // 🟢 ORDEN FIJO (DESPUÉS DE GUARDAR)
            $collection = $collection->sortBy(function ($item, $id) {
                return $this->ordenManual[$id] ?? 999999;
            });

        } else {

            // 🔵 ORDEN AUTOMÁTICO
            $collection = $collection->sort(function ($a, $b) {
                return [
                    $b['pts'] <=> $a['pts'],
                    $b['win'] <=> $a['win'],
                    $b['bhc1'] <=> $a['bhc1'],
                    $b['bh'] <=> $a['bh'],
                    $b['sb'] <=> $a['sb'],
                    $b['ps'] <=> $a['ps'],
                    $b['de'] <=> $a['de'],
                    $b['bwg'] <=> $a['bwg'],
                    $b['rating'] <=> $a['rating'],
                ];
            });
        }

        return $collection->values()->map(function ($c, $i) {
            $c['posicion'] = $i + 1;
            return $c;
        });
    }

    /* ========================= */
    public function guardarOrden()
    {
        $this->ordenManual = [];

        foreach ($this->clasificaciones as $i => $c) {
            $id = $c['jugador']->id;
            $this->ordenManual[$id] = $i;
        }

        $this->ordenGuardado = true;

        $this->dispatch('toast', message: 'Orden guardado correctamente');
    }

    /* ========================= */
    public function updatedTorneoEventoId()
    {
        $this->clasificacionesEdit = [];
        $this->ordenManual = [];
        $this->ordenGuardado = false;
    }

    /* ========================= */
    public function publicar()
    {
        foreach ($this->clasificaciones as $c) {

            $id = $c['jugador']->id;

            TorneoEventoClasificacion::updateOrCreate(
                [
                    'torneo_evento_id' => $this->torneo_evento_id,
                    'jugador_id' => $id,
                ],
                [
                    'posicion' => $c['posicion'],
                    'pts' => $c['pts'],
                    'rating' => $c['rating'],

                    'bhc1' => $this->clasificacionesEdit[$id]['bhc1'] ?? 0,
                    'bh'   => $this->clasificacionesEdit[$id]['bh'] ?? 0,
                    'sb'   => $this->clasificacionesEdit[$id]['sb'] ?? 0,
                    'ps'   => $this->clasificacionesEdit[$id]['ps'] ?? 0,
                    'de'   => $this->clasificacionesEdit[$id]['de'] ?? 0,
                    'win'  => $this->clasificacionesEdit[$id]['win'] ?? 0,
                    'bwg'  => $this->clasificacionesEdit[$id]['bwg'] ?? 0,
                ]
            );
        }

        $this->editMode = false;
        $this->ordenGuardado = false;

        $this->dispatch('toast', message: 'Publicado correctamente');
    }

    public function render()
    {
        return view('livewire.sistema.protejo-mi-mente.registro-clasificaciones-evento');
    }
}