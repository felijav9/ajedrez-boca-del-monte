<?php

namespace App\Livewire\Sistema\ProtejoMiMente;

use App\Models\ProtejoMiMente\Ronda;
use App\Models\ProtejoMiMente\Torneo;
use App\Models\ProtejoMiMente\TorneoEvento;
use App\Traits\DataTable;
use App\Traits\Interact;
use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\Computed;

class RegistroRondas extends Component
{
    use DataTable, Interact;

    public array $headers = [
        ['index' => 'id', 'label' => '#'],
        ['index' => 'torneo', 'label' => 'Torneo'],
        ['index' => 'evento', 'label' => 'Evento'],
        ['index' => 'numero', 'label' => 'Ronda'],
        ['index' => 'estado', 'label' => 'Estado'],
        ['index' => 'actions', 'label' => ''],
    ];

    public $ronda_id = null;

    public $torneo_id = null;
    public $torneo_evento_id = null;

    public $numero = null;
    public $finalizada = false;

    public $selectedRonda = null;
    public $rondaToDelete = null;

    public $is_editing = false;

    /* =========================
        LISTADO
    ==========================*/
    #[Computed]
    public function rows()
    {
        return Ronda::with(['torneoEvento.torneo'])
            ->latest()
            ->paginate($this->per_page);
    }

    /* =========================
        TORNEOS
    ==========================*/
    #[Computed]
    public function torneos()
    {
        return Torneo::orderBy('nombre')->get();
    }

    /* =========================
        EVENTOS
    ==========================*/
    #[Computed]
    public function eventos()
    {
        if (!$this->torneo_id) return collect();

        return TorneoEvento::where('torneo_id', $this->torneo_id)
            ->orderBy('nombre')
            ->get();
    }

    /* =========================
        EVENTO ACTUAL
    ==========================*/
    #[Computed]
    public function evento()
    {
        return TorneoEvento::find($this->torneo_evento_id);
    }

    /* =========================
        RONDAS DISPONIBLES
    ==========================*/
    #[Computed]
    public function numerosDisponibles()
    {
        if (!$this->torneo_evento_id) return [];

        $evento = $this->evento;

        if (!$evento) return [];

        $query = Ronda::where('torneo_evento_id', $this->torneo_evento_id);

        if ($this->is_editing && $this->ronda_id) {
            $query->where('id', '!=', $this->ronda_id);
        }

        $usados = $query->pluck('numero')->toArray();

        return collect(range(1, (int) $evento->total_rondas))
            ->reject(fn ($n) => in_array($n, $usados))
            ->values()
            ->toArray();
    }

    /* =========================
        REACTIVIDAD
    ==========================*/
    public function updatedTorneoId()
    {
        if ($this->is_editing) return;

        $this->torneo_evento_id = null;
        $this->numero = null;
    }

    public function updatedTorneoEventoId()
    {
        if ($this->is_editing) return;

        $this->numero = null;
    }

    /* =========================
        CREATE
    ==========================*/
    public function openCreateModal()
    {
        $this->resetForm();
        Flux::modal('ronda-form')->show();
    }

    public function save()
    {
        $this->validate([
            'torneo_id' => 'required|exists:sistema.torneos,id',
            'torneo_evento_id' => 'required|exists:sistema.torneo_eventos,id',
            'numero' => 'required|integer|min:1',
        ]);

        $exists = Ronda::where('torneo_evento_id', $this->torneo_evento_id)
            ->where('numero', $this->numero)
            ->exists();

        if ($exists) {
            $this->addError('numero', 'Esta ronda ya existe');
            return;
        }

        Ronda::create([
            'torneo_id' => $this->torneo_id,
            'torneo_evento_id' => $this->torneo_evento_id,
            'numero' => $this->numero,
            'finalizada' => $this->finalizada,
        ]);

        $this->toastSuccess('Ronda creada');

        Flux::modals()->close();
        $this->resetForm();
    }

    /* =========================
        EDIT
    ==========================*/
    public function edit($id)
    {
        $ronda = Ronda::findOrFail($id);

        $this->is_editing = true;

        $this->ronda_id = $ronda->id;
        $this->torneo_id = $ronda->torneo_id;
        $this->torneo_evento_id = $ronda->torneo_evento_id;
        $this->numero = $ronda->numero;
        $this->finalizada = $ronda->finalizada;

        Flux::modal('ronda-form')->show();
    }

    /* =========================
        UPDATE
    ==========================*/
    public function update()
    {
        $ronda = Ronda::findOrFail($this->ronda_id);

        $this->validate([
            'numero' => 'required|integer|min:1',
        ]);

        $exists = Ronda::where('torneo_evento_id', $this->torneo_evento_id)
            ->where('numero', $this->numero)
            ->where('id', '!=', $this->ronda_id)
            ->exists();

        if ($exists) {
            $this->addError('numero', 'Ya existe esta ronda');
            return;
        }

        $ronda->update([
            'numero' => $this->numero,
            'finalizada' => $this->finalizada,
        ]);

        $this->toastSuccess('Actualizado');

        Flux::modals()->close();
        $this->resetForm();
    }

    /* =========================
        VIEW / DELETE
    ==========================*/
    public function view($id)
    {
        $this->selectedRonda = Ronda::with('torneoEvento.torneo')->findOrFail($id);
        Flux::modal('view-ronda')->show();
    }

    public function confirmDelete($id)
    {
        $this->rondaToDelete = Ronda::findOrFail($id);
        Flux::modal('confirm-delete')->show();
    }

    public function destroy()
    {
        $this->rondaToDelete->delete();
        $this->toastWarning('Eliminado');
        Flux::modals()->close();
    }

    /* =========================
        RESET
    ==========================*/
    private function resetForm()
    {
        $this->reset([
            'ronda_id',
            'torneo_id',
            'torneo_evento_id',
            'numero',
            'finalizada',
            'is_editing',
        ]);

        $this->finalizada = false;
    }

    public function render()
    {
        return view('livewire.sistema.protejo-mi-mente.registro-rondas');
    }
}