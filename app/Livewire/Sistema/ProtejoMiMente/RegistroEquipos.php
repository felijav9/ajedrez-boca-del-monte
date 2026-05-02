<?php

namespace App\Livewire\Sistema\ProtejoMiMente;

use App\Models\ProtejoMiMente\Equipo;
use App\Models\ProtejoMiMente\Torneo;
use App\Traits\DataTable;
use App\Traits\Interact;
use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\Computed;

class RegistroEquipos extends Component
{
    use DataTable, Interact;

    public array $headers = [
        ['index' => 'id', 'label' => '#', 'align' => 'center'],
        ['index' => 'nombre', 'label' => 'Equipo'],
        ['index' => 'torneo', 'label' => 'Torneo'],
        ['index' => 'actions', 'label' => ''],
    ];

    public $nombre, $torneo_id, $equipo_id;
    public $equipoToDelete;

    #[Computed]
    public function rows()
    {
        return Equipo::with('torneo')
            ->when($this->search, function ($q) {
                $q->where('nombre', 'like', "%{$this->search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate($this->per_page);
    }

    #[Computed]
    public function torneos()
    {
        return Torneo::orderBy('fecha_inicio', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.sistema.protejo-mi-mente.registro-equipos');
    }

    public function openCreateModal()
    {
        $this->resetData();
        Flux::modal('equipo-form')->show();
    }

    public function save()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'torneo_id' => 'required|exists:torneos,id',
        ]);

        try {
            Equipo::create([
                'nombre' => $this->nombre,
                'torneo_id' => $this->torneo_id,
            ]);

            $this->toastSuccess('Equipo creado');
            Flux::modals()->close();
            $this->resetData();

        } catch (\Throwable $th) {
            $this->toastError($th->getMessage());
        }
    }

    public function edit($id)
    {
        $equipo = Equipo::findOrFail($id);

        $this->equipo_id = $equipo->id;
        $this->nombre = $equipo->nombre;
        $this->torneo_id = $equipo->torneo_id;

        Flux::modal('equipo-form')->show();
    }

    public function update()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'torneo_id' => 'required|exists:torneos,id',
        ]);

        try {
            $equipo = Equipo::findOrFail($this->equipo_id);

            $equipo->update([
                'nombre' => $this->nombre,
                'torneo_id' => $this->torneo_id,
            ]);

            $this->toastSuccess('Equipo actualizado');
            Flux::modals()->close();
            $this->resetData();

        } catch (\Throwable $th) {
            $this->toastError($th->getMessage());
        }
    }

    public function confirmDelete($id)
    {
        $this->equipoToDelete = Equipo::findOrFail($id);
        Flux::modal('confirm-delete')->show();
    }

    public function destroy()
    {
        try {
            $this->equipoToDelete->delete();

            $this->toastWarning('Equipo eliminado');
            Flux::modals()->close();

        } catch (\Throwable $th) {
            $this->toastError($th->getMessage());
        }
    }

    public function resetData()
    {
        $this->reset([
            'nombre',
            'torneo_id',
            'equipo_id'
        ]);
    }
}