<?php

namespace App\Livewire\Sistema\ProtejoMiMente;

use App\Models\ProtejoMiMente\Torneo;
use App\Traits\DataTable;
use App\Traits\Interact;
use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\Computed;

class RegistroTorneos extends Component
{
    use DataTable, Interact;

    public array $headers = [
        ['index' => 'id', 'label' => '#'],
        ['index' => 'nombre', 'label' => 'Nombre'],
        ['index' => 'fechas', 'label' => 'Fechas'],
        ['index' => 'lugar', 'label' => 'Lugar'],
        ['index' => 'tipo', 'label' => 'Tipo'], // 👈 NUEVO
        ['index' => 'actions', 'label' => ''],
    ];

    public $nombre, $descripcion, $fecha_inicio, $fecha_fin, $lugar, $tipo = 'interno';
    public $torneo_id;

    public $selectedTorneo;
    public $torneoToDelete;

    #[Computed]
    public function rows()
    {
        return Torneo::query()
            ->when($this->search, function ($q) {
                $q->where('nombre', 'like', "%{$this->search}%")
                  ->orWhere('lugar', 'like', "%{$this->search}%");
            })
            ->orderBy('fecha_inicio', 'desc')
            ->paginate($this->per_page);
    }

    public function render()
    {
        return view('livewire.sistema.protejo-mi-mente.registro-torneos');
    }

    public function openCreateModal()
    {
        $this->resetData();
        Flux::modal('torneo-form')->show();
    }

    public function save()
    {
        $this->validate([
            'nombre' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'tipo' => 'required|in:interno,externo',
        ]);

        Torneo::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'lugar' => $this->lugar,
            'tipo' => $this->tipo, // 👈 NUEVO
        ]);

        $this->toastSuccess('Torneo creado');
        Flux::modals()->close();
        $this->resetData();
    }

    public function edit($id)
    {
        $t = Torneo::findOrFail($id);

        $this->torneo_id = $t->id;
        $this->nombre = $t->nombre;
        $this->descripcion = $t->descripcion;
        $this->fecha_inicio = $t->fecha_inicio;
        $this->fecha_fin = $t->fecha_fin;
        $this->lugar = $t->lugar;
        $this->tipo = $t->tipo; // 👈 NUEVO

        Flux::modal('torneo-form')->show();
    }

    public function update()
    {
        $t = Torneo::findOrFail($this->torneo_id);

        $this->validate([
            'nombre' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'tipo' => 'required|in:interno,externo',
        ]);

        $t->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'lugar' => $this->lugar,
            'tipo' => $this->tipo, // 👈 NUEVO
        ]);

        $this->toastSuccess('Actualizado');
        Flux::modals()->close();
        $this->resetData();
    }

    public function view($id)
    {
        $this->selectedTorneo = Torneo::findOrFail($id);
        Flux::modal('view-torneo')->show();
    }

    public function confirmDelete($id)
    {
        $this->torneoToDelete = Torneo::findOrFail($id);
        Flux::modal('confirm-delete')->show();
    }

    public function destroy()
    {
        $this->torneoToDelete->delete();

        $this->toastWarning('Eliminado');
        Flux::modals()->close();
    }

    public function resetData()
    {
        $this->reset([
            'nombre',
            'descripcion',
            'fecha_inicio',
            'fecha_fin',
            'lugar',
            'torneo_id',
            'tipo'
        ]);

        $this->tipo = 'interno'; // 👈 default
    }
}