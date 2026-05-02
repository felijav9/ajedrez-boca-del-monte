<?php

namespace App\Livewire\Sistema\ProtejoMiMente;

use App\Models\ProtejoMiMente\Jugador;
use App\Models\ProtejoMiMente\ResultadoIndividual;
use App\Traits\DataTable;
use App\Traits\Interact;
use Flux\Flux;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class JugadoresProtejo extends Component
{
    // Al usar DataTable, la propiedad $per_page ya está definida ahí.
    use DataTable, Interact, WithPagination;

    public $selectedJugador = null;
    public $resultados = [];
    
    // OPCIONAL: Si quieres asegurarte de que inicie en 10
    public function mount()
    {
        $this->per_page = 10;
    }

    public array $headers = [
        ['index' => 'id', 'label' => '#', 'align' => 'center'],
        ['index' => 'nombre_completo', 'label' => 'Jugador'],
        ['index' => 'genero', 'label' => 'Género', 'align' => 'center'],
        ['index' => 'edad', 'label' => 'Edad', 'align' => 'center'],
        ['index' => 'elos', 'label' => 'Ratings ELO', 'align' => 'center'],
        ['index' => 'actions', 'label' => '', 'align' => 'right'],
    ];

    #[Computed]
    public function rows()
    {
        return Jugador::query()
            ->when($this->search, function ($query) {
                $search = '%' . $this->search . '%';
                $query->where(function ($q) use ($search) {
                    $q->where('nombre', 'like', $search)
                        ->orWhere('apellido', 'like', $search)
                        ->orWhereRaw("CONCAT(nombre, ' ', apellido) LIKE ?", [$search])
                        ->orWhere('id', 'like', $search);
                });
            })
            ->orderBy('apellido', 'asc')
            ->paginate($this->per_page); // Usamos la propiedad del Trait
    }

    public function openResults($id)
    {
        $this->selectedJugador = Jugador::findOrFail($id);

        $this->resultados = ResultadoIndividual::with('torneo')
            ->where('jugador_id', $id)
            ->orderByRaw('posicion IS NULL, posicion ASC')
            ->get()
            ->toArray();

        Flux::modal('results-modal')->show();
    }

    public function render()
    {
        return view('livewire.sistema.protejo-mi-mente.jugadores-protejo');
    }
}