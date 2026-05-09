<?php

namespace App\Livewire\Sistema\ProtejoMiMente;

use App\Models\ProtejoMiMente\Partida;
use App\Models\ProtejoMiMente\Torneo;
use App\Models\ProtejoMiMente\TorneoEvento;
use Flux\Flux;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class TorneosProtejo extends Component
{
    use WithPagination;

    public $categoriaSeleccionada = null;

    public $search = '';

    public $year = '2026';

    public $torneoSeleccionado = null;

    // 🔥 LIVE RESULTS
    public $liveClasificaciones = [];

    // 🆕 MODAL PARTIDAS
    public $jugadorSeleccionado = null;

    

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function setYear($year)
    {
        $this->year = $year;
        $this->resetPage();
    }

    // =========================
    // TORNEOS
    // =========================
    #[Computed]
    public function torneos()
    {
        return Torneo::query()
            ->with(['imagenes'])
            ->whereYear('fecha_inicio', $this->year)
            ->when($this->search, function ($q) {
                $search = $this->search;

                $q->where(function ($sub) use ($search) {
                    $sub->where('nombre', 'like', "%{$search}%")
                        ->orWhere('lugar', 'like', "%{$search}%")
                        ->orWhereHas('jugadores', function ($q2) use ($search) {
                            $q2->where('nombre', 'like', "%{$search}%")
                                ->orWhere('apellido', 'like', "%{$search}%");
                        })
                        ->orWhereHas('participaciones.equipo', function ($q3) use ($search) {
                            $q3->where('nombre', 'like', "%{$search}%");
                        });
                });
            })
            ->orderBy('fecha_inicio', 'asc')
            ->paginate(9);
    }

    // =========================
    // OPEN TORNEO
    // =========================
    public function openTorneo($id)
    {
        $this->torneoSeleccionado = Torneo::with([
            'imagenes',
            'resultados.jugador',
            'resultados.equipo',
            'participaciones.categoria',
            'participaciones.equipo',
        ])->find($id);

        Flux::modal('torneo-detalle')->show();
    }

    // =========================
    // LIVE RESULTS (ARREGLADO)
    // =========================

    public function openLiveResults($torneoId)
    {
        $this->torneoSeleccionado = Torneo::findOrFail($torneoId);

        // 🔥 traer TODOS los eventos del torneo
        $eventos = TorneoEvento::where('torneo_id', $torneoId)->pluck('id');

        if ($eventos->isEmpty()) {
            $this->liveClasificaciones = collect();
            Flux::modal('live-results')->show();

            return;
        }

        // 🔥 USAR TABLA REAL DE CLASIFICACIÓN
        $clasificaciones = \App\Models\ProtejoMiMente\TorneoEventoClasificacion::with('jugador')
            ->whereIn('torneo_evento_id', $eventos)
            ->get();

        // 🔥 AGRUPAR POR JUGADOR SUMANDO TODOS LOS EVENTOS
        $tabla = [];

        foreach ($clasificaciones as $c) {

            $id = $c->jugador_id;

            if (! isset($tabla[$id])) {
                $tabla[$id] = [
                    'jugador' => $c->jugador,
                    'pts' => 0,
                ];
            }

            $tabla[$id]['pts'] += (float) $c->pts;
        }

        $this->liveClasificaciones = collect($tabla)
            ->sortByDesc('pts')
            ->values();

        Flux::modal('live-results')->show();
    }

    // =========================
    // VER PARTIDAS (FIX)
    // =========================
    public function verPartidas($jugadorId)
    {
        $this->jugadorSeleccionado = $jugadorId;

        Flux::modal('partidas-jugador')->show();
    }

    // =========================
    // PARTIDAS AGRUPADAS (FIX REAL)
    // =========================
   
    #[Computed]
public function partidasAgrupadas()
{
    if (! $this->jugadorSeleccionado || ! $this->torneoSeleccionado) {
        return collect();
    }

    $eventos = TorneoEvento::where('torneo_id', $this->torneoSeleccionado->id)->get();

    if ($eventos->isEmpty()) {
        return collect();
    }

    $partidas = Partida::with(['ronda.torneoEvento', 'blancas', 'negras'])
        ->whereHas('ronda', fn($q) =>
            $q->whereIn('torneo_evento_id', $eventos->pluck('id'))
        )
        ->get()
        ->filter(fn($p) =>
            $p->blancas_id == $this->jugadorSeleccionado ||
            $p->negras_id == $this->jugadorSeleccionado
        );

    $clasificaciones = \App\Models\ProtejoMiMente\TorneoEventoClasificacion::where('jugador_id', $this->jugadorSeleccionado)
        ->whereIn('torneo_evento_id', $eventos->pluck('id'))
        ->get()
        ->keyBy('torneo_evento_id');

    return $partidas->groupBy(function ($p) {
        return $p->ronda?->torneoEvento?->nombre ?? 'Sin evento';
    })->map(function ($partidasEvento) use ($clasificaciones) {

        $eventoId = $partidasEvento->first()?->ronda?->torneo_evento_id;

        return [
            'pts' => $clasificaciones[$eventoId]->pts ?? 0,
            'partidas' => $partidasEvento,
        ];
    });
}


    // =========================
    // RENDER
    // =========================
    public function render()
    {
        return view('livewire.sistema.protejo-mi-mente.torneos-protejo');
    }

    // =========================
    // RESULTADOS CATEGORÍA
    // =========================
    public function openResultados($categoriaId)
    {
        $this->categoriaSeleccionada = $categoriaId;

        Flux::modal('resultados-categoria')->show();
    }





#[Computed]
public function emparejamientos()
{
    if (! $this->torneoSeleccionado) {
        return collect();
    }

    return Partida::with([
            'ronda.torneoEvento',
            'blancas',
            'negras'
        ])
        ->whereHas('ronda.torneoEvento', function ($q) {
            $q->where('torneo_id', $this->torneoSeleccionado->id);
        })
        ->get()
        ->groupBy(fn($p) => $p->ronda?->torneoEvento?->nombre ?? 'Sin evento')
        ->map(function ($eventos) {
            return $eventos->groupBy(fn($p) => $p->ronda?->numero ?? 0)
                           ->sortKeys();
        });
}

public function openEmparejamientos($torneoId)
{
    $this->torneoSeleccionado = Torneo::findOrFail($torneoId);

    Flux::modal('emparejamientos')->show();
}

}
