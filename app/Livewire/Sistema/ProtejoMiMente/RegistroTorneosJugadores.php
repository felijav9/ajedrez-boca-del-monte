<?php

namespace App\Livewire\Sistema\ProtejoMiMente;

use App\Models\ProtejoMiMente\TorneoJugador;
use App\Models\ProtejoMiMente\Torneo;
use App\Models\ProtejoMiMente\Jugador;
use App\Models\ProtejoMiMente\Equipo;
use App\Models\ProtejoMiMente\Categoria;
use App\Traits\DataTable;
use App\Traits\Interact;
use Flux\Flux;
use Livewire\Attributes\Computed;
use Livewire\Component;

class RegistroTorneosJugadores extends Component
{
    use DataTable, Interact;

    public array $headers = [
        ['index' => 'id', 'label' => '#', 'align' => 'center'],
        ['index' => 'torneo', 'label' => 'Torneo'],
        ['index' => 'jugador', 'label' => 'Jugador'],
        ['index' => 'equipo', 'label' => 'Equipo'],
        ['index' => 'categoria', 'label' => 'Categoría'],
        ['index' => 'actions', 'label' => ''],
    ];

    public $torneo_id, $jugador_id, $equipo_id, $categoria_id;
    public $registro_id;
    public $deleteTarget;

    // ======================
    // TABLE
    // ======================
    #[Computed]
    public function rows()
    {
        return TorneoJugador::with(['torneo', 'jugador', 'equipo', 'categoria'])
            ->when($this->search, function ($q) {
                $q->whereHas('jugador', function ($q2) {
                    $q2->where('nombre', 'like', "%{$this->search}%")
                        ->orWhere('apellido', 'like', "%{$this->search}%");
                });
            })
            ->orderBy('id', 'desc')
            ->paginate($this->per_page);
    }

    // ======================
    // COMBOS
    // ======================
    #[Computed]
    public function torneos()
    {
        return Torneo::orderBy('nombre')->get();
    }

    #[Computed]
    public function jugadores()
    {
        return Jugador::orderBy('apellido')->get();
    }

    #[Computed]
    public function equipos()
    {
        return Equipo::orderBy('nombre')->get();
    }

    #[Computed]
    public function categorias()
    {
        return Categoria::orderBy('nombre')->get();
    }

    public function render()
    {
        return view('livewire.sistema.protejo-mi-mente.registro-torneos-jugadores');
    }

    // ======================
    // NORMALIZE (CLAVE 🔥)
    // ======================
    private function normalize()
    {
        $this->equipo_id = $this->equipo_id ?: null;
        $this->categoria_id = $this->categoria_id ?: null;
    }

    // ======================
    // CREATE
    // ======================
    public function openCreateModal()
    {
        $this->resetForm();
        Flux::modal('form')->show();
    }

    public function save()
    {
        $this->normalize();

        $this->validate([
            'torneo_id' => 'required|exists:torneos,id',
            'jugador_id' => 'required|exists:jugadores,id',
            'equipo_id' => 'nullable|exists:equipos,id',
            'categoria_id' => 'nullable|exists:categorias,id',
        ]);

        TorneoJugador::create([
            'torneo_id' => $this->torneo_id,
            'jugador_id' => $this->jugador_id,
            'equipo_id' => $this->equipo_id,
            'categoria_id' => $this->categoria_id,
        ]);

        $this->toastSuccess('Registro creado');
        Flux::modals()->close();
        $this->resetForm();
    }

    // ======================
    // EDIT
    // ======================
    public function edit($id)
    {
        $r = TorneoJugador::findOrFail($id);

        $this->registro_id = $r->id;
        $this->torneo_id = $r->torneo_id;
        $this->jugador_id = $r->jugador_id;
        $this->equipo_id = $r->equipo_id;
        $this->categoria_id = $r->categoria_id;

        Flux::modal('form')->show();
    }

    public function update()
    {
        $this->normalize();

        $this->validate([
            'torneo_id' => 'required|exists:torneos,id',
            'jugador_id' => 'required|exists:jugadores,id',
            'equipo_id' => 'nullable|exists:equipos,id',
            'categoria_id' => 'nullable|exists:categorias,id',
        ]);

        $r = TorneoJugador::findOrFail($this->registro_id);

        $r->update([
            'torneo_id' => $this->torneo_id,
            'jugador_id' => $this->jugador_id,
            'equipo_id' => $this->equipo_id,
            'categoria_id' => $this->categoria_id,
        ]);

        $this->toastSuccess('Actualizado');
        Flux::modals()->close();
        $this->resetForm();
    }

    // ======================
    // DELETE
    // ======================
    public function confirmDelete($id)
    {
        $this->deleteTarget = TorneoJugador::findOrFail($id);
        Flux::modal('delete')->show();
    }

    public function destroy()
    {
        $this->deleteTarget->delete();

        $this->toastWarning('Eliminado');
        Flux::modals()->close();
    }

    // ======================
    // RESET
    // ======================
    public function resetForm()
    {
        $this->reset([
            'torneo_id',
            'jugador_id',
            'equipo_id',
            'categoria_id',
            'registro_id'
        ]);
    }
}