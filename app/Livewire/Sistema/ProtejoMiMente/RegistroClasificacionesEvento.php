<?php

namespace App\Livewire\Sistema\ProtejoMiMente;

use App\Models\ProtejoMiMente\Partida;
use App\Models\ProtejoMiMente\TorneoEvento;
use App\Models\ProtejoMiMente\TorneoEventoClasificacion;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\Attributes\Computed;

class RegistroClasificacionesEvento extends Component
{
    public $torneo_evento_id = null;

    // =========================
    // EVENTOS
    // =========================
    #[Computed]
    public function eventos()
    {
        return TorneoEvento::orderBy('nombre')->get();
    }

    // =========================
    // PARTIDAS
    // =========================
    private function partidas(): Collection
    {
        if (!$this->torneo_evento_id) return collect();

        return Partida::with(['ronda', 'blancas', 'negras'])
            ->whereHas('ronda', function ($q) {
                $q->where('torneo_evento_id', $this->torneo_evento_id);
            })
            ->get();
    }

    // =========================
    // CLASIFICACIÓN DINÁMICA
    // =========================
    #[Computed]
    public function clasificaciones()
    {
        if (!$this->torneo_evento_id) return collect();

        $partidas = $this->partidas();

        $tabla = [];

        foreach ($partidas as $p) {

            foreach (['blancas', 'negras'] as $color) {

                $j = $p->{$color};
                if (!$j) continue;

                $id = $j->id;

                if (!isset($tabla[$id])) {
                    $tabla[$id] = [
                        'jugador' => $j,

                        'posicion' => 0,

                        'pts' => 0,

                        // EDITABLES (default 0)
                        'bhc1' => 0,
                        'bh' => 0,
                        'sb' => 0,
                        'ps' => 0,
                        'de' => 0,
                        'win' => 0,
                        'draw' => 0,
                        'lose' => 0,
                        'bwg' => 0,

                        'rating' => $j->elo_clasico ?? 0,

                        'pj' => 0,
                    ];
                }

                $tabla[$id]['pj']++;

                // RESULTADOS
                if ($p->resultado === '1-0') {

                    if ($color === 'blancas') {
                        $tabla[$id]['win']++;
                        $tabla[$id]['pts'] += 1;
                    } else {
                        $tabla[$id]['lose']++;
                    }

                } elseif ($p->resultado === '0-1') {

                    if ($color === 'negras') {
                        $tabla[$id]['win']++;
                        $tabla[$id]['pts'] += 1;
                    } else {
                        $tabla[$id]['lose']++;
                    }

                } elseif ($p->resultado === '0.5-0.5') {
                    $tabla[$id]['draw']++;
                    $tabla[$id]['pts'] += 0.5;
                }
            }
        }

        return collect($tabla)
            ->map(function ($c) {

                // valores base (editables)
                $c['bh'] = $c['bh'] ?: 0;
                $c['bhc1'] = $c['bhc1'] ?: 0;
                $c['sb'] = $c['sb'] ?: 0;
                $c['ps'] = $c['ps'] ?: 0;
                $c['de'] = $c['de'] ?: 0;
                $c['bwg'] = $c['bwg'] ?: 0;

                return $c;
            })
            ->sortByDesc('pts')
            ->values()
            ->map(function ($c, $i) {
                $c['posicion'] = $i + 1;
                return $c;
            });
    }

    // =========================
    // PUBLICAR (UPSERT)
    // =========================
    public function publicar()
    {
        if (!$this->torneo_evento_id) return;

        foreach ($this->clasificaciones as $c) {

            TorneoEventoClasificacion::updateOrCreate(
                [
                    'torneo_evento_id' => $this->torneo_evento_id,
                    'jugador_id' => $c['jugador']->id,
                ],
                [
                    'posicion' => $c['posicion'],
                    'pts' => $c['pts'],

                    'bhc1' => $c['bhc1'],
                    'bh' => $c['bh'],
                    'sb' => $c['sb'],
                    'ps' => $c['ps'],
                    'de' => $c['de'],

                    'win' => $c['win'],
                    'draw' => $c['draw'],
                    'lose' => $c['lose'],

                    'bwg' => $c['bwg'],
                    'rating' => $c['rating'],
                ]
            );
        }

        $this->dispatch('toast', message: 'Clasificación publicada correctamente');
    }

    public function render()
    {
        return view('livewire.sistema.protejo-mi-mente.registro-clasificaciones-evento');
    }
}