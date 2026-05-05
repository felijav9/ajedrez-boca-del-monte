<?php

namespace App\Livewire\Sistema\ProtejoMiMente;

use App\Models\ProtejoMiMente\Torneo;
use Flux\Flux;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class TorneosProtejo extends Component
{
    use WithPagination;

    public $search = '';
    public $year = '2026';
    public $torneoSeleccionado = null;

    // 🔥 NUEVO: categoría seleccionada para resultados
    public $categoriaSeleccionada = null;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function setYear($year)
    {
        $this->year = $year;
        $this->resetPage();
    }

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

    public function openTorneo($id)
    {
        $this->torneoSeleccionado = Torneo::with([
            'imagenes',
            'resultados.jugador',
            'resultados.equipo',
            'participaciones.categoria',
            'participaciones.equipo'
        ])->find($id);

        Flux::modal('torneo-detalle')->show();
    }

    // 🔥 NUEVO: abrir resultados por categoría
    public function openResultados($categoriaId)
    {
        $this->categoriaSeleccionada = $categoriaId;
        Flux::modal('resultados-categoria')->show();
    }

    public function render()
    {
        return view('livewire.sistema.protejo-mi-mente.torneos-protejo');
    }

    

    
}