<?php

namespace App\Livewire\Sistema\ProtejoMiMente;

use App\Models\ProtejoMiMente\Jugador;
use App\Traits\DataTable;
use App\Traits\Interact;
use Flux\Flux;
use Livewire\Attributes\Computed;
use Livewire\Component;

use App\Models\ProtejoMiMente\ResultadoIndividual;




class RegistroJugadores extends Component
{
    use DataTable, Interact;
    public $showResultsModal = false;
    public $selectedJugador = null;
    public $resultados = [];

    public array $headers = [
        ['index' => 'id', 'label' => '#', 'align' => 'center'],
        ['index' => 'nombre_completo', 'label' => 'Nombre completo'],
        ['index' => 'genero', 'label' => 'Género', 'align' => 'center'],
        ['index' => 'edad', 'label' => 'Edad', 'align' => 'center'],
        ['index' => 'fecha_nacimiento', 'label' => 'Fecha Nac.', 'align' => 'center'],
        ['index' => 'elos', 'label' => 'ELOs', 'align' => 'center'],
        ['index' => 'actions', 'label' => ''],
    ];

    // Propiedades del formulario
    public $nombre, $apellido, $genero, $edad, $fecha_nacimiento;
    public $elo_clasico, $elo_rapido, $elo_blitz, $jugador_id;
    public $confirmingDelete = false;
    public $jugadorToDelete = null;
    /**
     * Lógica de búsqueda y paginación
     */
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
                        ->orWhere('genero', 'like', $search)
                        ->orWhere('edad', 'like', $search)
                        ->orWhere('fecha_nacimiento', 'like', $search)
                        ->orWhere('elo_clasico', 'like', $search)
                        ->orWhere('elo_rapido', 'like', $search)
                        ->orWhere('elo_blitz', 'like', $search)
                        ->orWhere('id', 'like', $search);
                });
            })
            ->orderBy('apellido', 'asc')
            ->paginate($this->per_page);
    }

    public function render()
    {
        // Ya no pasamos compact('rows') porque accedemos vía $this->rows en la vista
        return view('livewire.sistema.protejo-mi-mente.registro-jugadores');
    }


    public function openCreateModal()
    {
        $this->resetData();
        Flux::modal('jugador-form')->show();
    }

    public function save()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'genero' => 'required|in:masculino,femenino',
            'edad' => 'required|integer|min:1',
            'fecha_nacimiento' => 'nullable|date',
            'elo_clasico' => 'nullable|integer',
            'elo_rapido' => 'nullable|integer',
            'elo_blitz' => 'nullable|integer',
        ]);

        try {
            Jugador::create([
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'genero' => $this->genero,
                'edad' => $this->edad,
                'fecha_nacimiento' => $this->fecha_nacimiento ?: null,
                'elo_clasico' => $this->elo_clasico,
                'elo_rapido' => $this->elo_rapido,
                'elo_blitz' => $this->elo_blitz,
            ]);

            $this->toastSuccess('Jugador creado');
            $this->resetData();
            Flux::modals()->close();
        } catch (\Throwable $th) {
            $this->toastError($th->getMessage());
        }
    }

    public function edit($id)
    {
        $jugador = Jugador::findOrFail($id);

        $this->jugador_id = $jugador->id;
        $this->nombre = $jugador->nombre;
        $this->apellido = $jugador->apellido;
        $this->genero = strtolower($jugador->genero);
        $this->edad = $jugador->edad;
        $this->fecha_nacimiento = $jugador->fecha_nacimiento;
        $this->elo_clasico = $jugador->elo_clasico;
        $this->elo_rapido = $jugador->elo_rapido;
        $this->elo_blitz = $jugador->elo_blitz;

        Flux::modal('jugador-form')->show();
    }

    public function update()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'genero' => 'required|in:masculino,femenino',
            'edad' => 'required|integer|min:1',
            'fecha_nacimiento' => 'nullable|date',
            'elo_clasico' => 'nullable|integer',
            'elo_rapido' => 'nullable|integer',
            'elo_blitz' => 'nullable|integer',
        ]);

        try {
            $jugador = Jugador::findOrFail($this->jugador_id);

            $jugador->update([
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'genero' => strtolower($this->genero),
                'edad' => $this->edad,
                'fecha_nacimiento' => $this->fecha_nacimiento ?: null,
                'elo_clasico' => $this->elo_clasico,
                'elo_rapido' => $this->elo_rapido,
                'elo_blitz' => $this->elo_blitz,
            ]);

            $this->toastSuccess('Jugador actualizado');
            $this->resetData();
            Flux::modals()->close();
        } catch (\Throwable $th) {
            $this->toastError($th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            Jugador::findOrFail($id)->delete();
            $this->toastWarning('Jugador eliminado');
            $this->resetData();
        } catch (\Throwable $th) {
            $this->toastError($th->getMessage());
        }
    }

    public function resetData()
    {
        $this->reset([
            'nombre',
            'apellido',
            'genero',
            'edad',
            'fecha_nacimiento',
            'elo_clasico',
            'elo_rapido',
            'elo_blitz',
            'jugador_id'
        ]);
        $this->fecha_nacimiento = null;
    }
    public function confirmDelete($id)
    {
        $this->jugadorToDelete = Jugador::findOrFail($id);
        $this->confirmingDelete = true;

        Flux::modal('confirm-delete')->show();
    }
    public function destroy()
    {
        try {
            $this->jugadorToDelete->delete();

            $this->toastWarning('Eliminado correctamente');

            $this->confirmingDelete = false;
            $this->jugadorToDelete = null;

            Flux::modals()->close();
        } catch (\Throwable $th) {
            $this->toastError($th->getMessage());
        }
    }
    public function openResults($id)
    {
        $this->selectedJugador = Jugador::findOrFail($id);

        $this->resultados = ResultadoIndividual::with('torneo')
            ->where('jugador_id', $id)
            ->orderByRaw('posicion IS NULL, posicion ASC')
            ->get()
            ->toArray();
        $this->showResultsModal = true;

        Flux::modal('results-modal')->show();
    }
    public function getBestMedalsProperty()
    {
        return ResultadoIndividual::with('torneo')
            ->where('jugador_id', $this->selectedJugador?->id)
            ->orderBy('posicion', 'asc')
            ->get();
    }
}
