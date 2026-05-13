<?php

namespace App\Livewire\Sistema\ProtejoMiMente;

use App\Models\ProtejoMiMente\ResultadoIndividual;
use App\Models\ProtejoMiMente\Jugador;
use Flux\Flux;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination; // 1. Importar paginación

class MedalleroGeneral extends Component
{
    use WithPagination; // 2. Usar el trait

    public $selectedJugador = null;
    public $resultados = [];
    public $search = '';

    // Resetear la página cuando se busca algo nuevo
    public function updatedSearch()
    {
        $this->resetPage();
    }

    /**
     * Obtenemos la data base y calculamos el ranking
     * Lo hacemos en un método separado para que el render sea limpio
     */


    public function getMedalleroData()
{
    // 1. Consulta base con criterio de fecha para desempate
    $data = DB::connection('sistema')
        ->table('resultados_individuales as r')
        ->join('jugadores as j', 'j.id', '=', 'r.jugador_id')
        // Unimos con torneos para obtener la fecha real si no está en resultados
        ->join('torneos as t', 't.id', '=', 'r.torneo_id') 
        ->select(
            'j.id',
            DB::raw("CONCAT(j.nombre, ' ', j.apellido) as nombre_completo"),
            DB::raw('SUM(CASE WHEN r.posicion = 1 THEN 1 ELSE 0 END) as oros'),
            DB::raw('SUM(CASE WHEN r.posicion = 2 THEN 1 ELSE 0 END) as platas'),
            DB::raw('SUM(CASE WHEN r.posicion = 3 THEN 1 ELSE 0 END) as bronces'),
            DB::raw('SUM(CASE WHEN r.posicion IN (1,2,3) THEN 1 ELSE 0 END) as total'),
            // Obtenemos la fecha del torneo más reciente donde ganó medalla
            DB::raw('MAX(t.fecha_fin) as ultima_medalla_fecha') 
        )
        ->when($this->search, function($query) {
            $query->where(DB::raw("CONCAT(j.nombre, ' ', j.apellido)"), 'like', '%' . $this->search . '%');
        })
        ->groupBy('j.id', 'j.apellido', 'j.nombre')
        ->havingRaw('oros > 0 OR platas > 0 OR bronces > 0')
        // Orden principal por medallas
        ->orderByDesc('oros')
        ->orderByDesc('platas')
        ->orderByDesc('bronces')
        // 🔥 CRITERIO DE DESEMPATE: El que ganó más recientemente va primero
        ->orderByDesc('ultima_medalla_fecha') 
        ->get();

    // 2. Calcular el ranking (Lógica de empate se mantiene igual)
    $posicion = 0;
    $last = null;
    $contador = 0;

    $ranking = $data->map(function ($item) use (&$posicion, &$last, &$contador) {
        $contador++;
        $current = "{$item->oros}-{$item->platas}-{$item->bronces}";

        if ($current !== $last) {
            $posicion = $contador;
        }

        $item->rank = $posicion;
        $last = $current;
        return $item;
    });

    // 3. PAGINACIÓN MANUAL
    $perPage = 10;
    $currentPage = \Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1;

    return new \Illuminate\Pagination\LengthAwarePaginator(
        $ranking->forPage($currentPage, $perPage),
        $ranking->count(),
        $perPage,
        $currentPage,
        ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
    );
}

    public function openDetalle($jugadorId)
    {
        $this->selectedJugador = Jugador::find($jugadorId);

        $this->resultados = ResultadoIndividual::with('torneo')
            ->where('jugador_id', $jugadorId)
            ->whereIn('posicion', [1, 2, 3])
            ->orderBy('posicion')
            ->get()
            ->toArray();

        Flux::modal('detalle-medallero')->show();
    }

    public function render()
    {
        return view('livewire.sistema.protejo-mi-mente.medallero-general', [
            'medallero' => $this->getMedalleroData() // Pasamos la data paginada
        ]);
    }
}