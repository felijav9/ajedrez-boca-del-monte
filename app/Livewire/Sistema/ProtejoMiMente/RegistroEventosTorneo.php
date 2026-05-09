<?php

namespace App\Livewire\Sistema\ProtejoMiMente;

use App\Models\ProtejoMiMente\Torneo;
use App\Models\ProtejoMiMente\TorneoEvento;
use App\Traits\DataTable;
use App\Traits\Interact;
use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\Computed;

class RegistroEventosTorneo extends Component
{
    use DataTable, Interact;

    public array $headers = [
        ['index' => 'id', 'label' => '#'],
        ['index' => 'torneo', 'label' => 'Torneo'],
        ['index' => 'nombre', 'label' => 'Evento'],
        ['index' => 'tipo', 'label' => 'Tipo'],
        ['index' => 'rondas', 'label' => 'Rondas'],
        ['index' => 'estado', 'label' => 'Estado'],
        ['index' => 'actions', 'label' => ''],
    ];

    public $torneo_id;
    public $torneo_evento_id;

    public $nombre;
    public $tipo = 'individual';
    public $total_rondas = 5;
    public $finalizado = false;

    public $selectedEvento;
    public $eventoToDelete;

    #[Computed]
    public function rows()
    {
        return TorneoEvento::with('torneo')
            ->when($this->search, function ($query) {
                $query->where('nombre', 'like', "%{$this->search}%");
            })
            ->latest()
            ->paginate($this->per_page);
    }

    #[Computed]
    public function torneos()
    {
        return Torneo::orderBy('nombre')->get();
    }

    public function render()
    {
        return view(
            'livewire.sistema.protejo-mi-mente.registro-eventos-torneo'
        );
    }

    public function openCreateModal()
    {
        $this->resetData();

        Flux::modal('evento-form')->show();
    }

    public function save()
    {
        $this->validate([
            'torneo_id' => 'required|exists:sistema.torneos,id',
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string',
            'total_rondas' => 'required|integer|min:1',
        ]);

        TorneoEvento::create([
            'torneo_id' => $this->torneo_id,
            'nombre' => $this->nombre,
            'tipo' => $this->tipo,
            'total_rondas' => $this->total_rondas,
            'finalizado' => $this->finalizado,
        ]);

        $this->toastSuccess(
            'Evento registrado correctamente'
        );

        Flux::modals()->close();

        $this->resetData();
    }

    public function edit($id)
    {
        $evento = TorneoEvento::findOrFail($id);

        $this->torneo_evento_id = $evento->id;
        $this->torneo_id = $evento->torneo_id;
        $this->nombre = $evento->nombre;
        $this->tipo = $evento->tipo;
        $this->total_rondas = $evento->total_rondas;
        $this->finalizado = $evento->finalizado;

        Flux::modal('evento-form')->show();
    }

    public function update()
    {
        $this->validate([
            'torneo_id' => 'required|exists:sistema.torneos,id',
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string',
            'total_rondas' => 'required|integer|min:1',
        ]);

        $evento = TorneoEvento::findOrFail(
            $this->torneo_evento_id
        );

        $evento->update([
            'torneo_id' => $this->torneo_id,
            'nombre' => $this->nombre,
            'tipo' => $this->tipo,
            'total_rondas' => $this->total_rondas,
            'finalizado' => $this->finalizado,
        ]);

        $this->toastSuccess(
            'Evento actualizado correctamente'
        );

        Flux::modals()->close();

        $this->resetData();
    }

    public function view($id)
    {
        $this->selectedEvento = TorneoEvento::with('torneo')
            ->findOrFail($id);

        Flux::modal('view-evento')->show();
    }

    public function confirmDelete($id)
    {
        $this->eventoToDelete = TorneoEvento::findOrFail($id);

        Flux::modal('confirm-delete')->show();
    }

    public function destroy()
    {
        $this->eventoToDelete->delete();

        $this->toastWarning(
            'Evento eliminado correctamente'
        );

        Flux::modals()->close();

        $this->resetData();
    }

    public function resetData()
    {
        $this->reset([
            'torneo_id',
            'torneo_evento_id',
            'nombre',
            'tipo',
            'total_rondas',
            'finalizado',
            'selectedEvento',
            'eventoToDelete',
        ]);

        $this->tipo = 'individual';
        $this->total_rondas = 5;
        $this->finalizado = false;
    }
}