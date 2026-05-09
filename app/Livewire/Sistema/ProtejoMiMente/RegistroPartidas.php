<?php

namespace App\Livewire\Sistema\ProtejoMiMente;

use App\Models\ProtejoMiMente\Partida;
use App\Models\ProtejoMiMente\Ronda;
use App\Models\ProtejoMiMente\Torneo;
use App\Models\ProtejoMiMente\TorneoEvento;
use App\Models\ProtejoMiMente\Jugador;
use App\Traits\DataTable;
use App\Traits\Interact;
use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\Computed;

class RegistroPartidas extends Component
{
    use DataTable, Interact;

    public array $headers = [
        ['index' => 'id', 'label' => '#'],
        ['index' => 'evento', 'label' => 'Evento'],
        ['index' => 'ronda', 'label' => 'Ronda'],
        ['index' => 'mesa', 'label' => 'Mesa'],
        ['index' => 'blancas', 'label' => 'Blancas'],
        ['index' => 'negras', 'label' => 'Negras'],
        ['index' => 'resultado', 'label' => 'Resultado'],
        ['index' => 'estado', 'label' => 'Estado'],
        ['index' => 'actions', 'label' => ''],
    ];

    public $partida_id = null;

    // 🔥 FILTROS NUEVOS
    public $torneo_id = null;
    public $torneo_evento_id = null;

    public $ronda_id = null;
    public $blancas_id = null;
    public $negras_id = null;

    public $mesa = null;
    public $resultado = null;
    public $finalizada = false;

    /* =========================
        TORNEOS
    ==========================*/
    #[Computed]
    public function torneos()
    {
        return Torneo::orderBy('nombre')->get();
    }

    /* =========================
        EVENTOS (DEPENDE DEL TORNEO)
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
        RONDAS (DEPENDE EVENTO)
    ==========================*/
    #[Computed]
    public function rondas()
    {
        if (!$this->torneo_evento_id) return collect();

        return Ronda::where('torneo_evento_id', $this->torneo_evento_id)
            ->orderBy('numero')
            ->get();
    }

    /* =========================
        JUGADORES (DEPENDE TORNEO)
    ==========================*/
    #[Computed]
    public function jugadores()
    {
        if (!$this->torneo_id) return collect();

        return Jugador::whereHas('torneos', function ($q) {
            $q->where('torneos.id', $this->torneo_id);
        })->orderBy('nombre')->get();
    }

    /* =========================
        LISTADO
    ==========================*/
    #[Computed]
    public function rows()
    {
        return Partida::with([
            'ronda.torneoEvento',
            'blancas',
            'negras'
        ])
        ->latest()
        ->paginate($this->per_page);
    }

    /* =========================
        REACTIVIDAD EN CADENA
    ==========================*/
    public function updatedTorneoId()
    {
        $this->torneo_evento_id = null;
        $this->ronda_id = null;
        $this->blancas_id = null;
        $this->negras_id = null;
    }

    public function updatedTorneoEventoId()
    {
        $this->ronda_id = null;
    }

    /* =========================
        CREATE
    ==========================*/
    public function openCreateModal()
    {
        $this->reset([
            'partida_id',
            'torneo_id',
            'torneo_evento_id',
            'ronda_id',
            'blancas_id',
            'negras_id',
            'mesa',
            'resultado',
            'finalizada'
        ]);

        Flux::modal('partida-form')->show();
    }

    /* =========================
        SAVE
    ==========================*/
    public function save()
    {
        $this->validate([
            'torneo_evento_id' => 'required|exists:sistema.torneo_eventos,id',
            'ronda_id' => 'required|exists:sistema.rondas,id',
            'blancas_id' => 'required|exists:sistema.jugadores,id',
            'negras_id' => 'required|exists:sistema.jugadores,id',
        ]);

        if ($this->blancas_id === $this->negras_id) {
            $this->addError('negras_id', 'No puede jugar contra sí mismo');
            return;
        }

        Partida::create([
            'ronda_id' => $this->ronda_id,
            'blancas_id' => $this->blancas_id,
            'negras_id' => $this->negras_id,
            'mesa' => $this->mesa,
            'resultado' => $this->resultado,
            'finalizada' => $this->finalizada,
        ]);

        $this->toastSuccess('Partida creada');
        Flux::modals()->close();
    }

    /* =========================
        EDIT
    ==========================*/
    public function edit($id)
    {
        $p = Partida::findOrFail($id);

        $this->partida_id = $p->id;
        $this->torneo_evento_id = $p->ronda->torneo_evento_id;
        $this->ronda_id = $p->ronda_id;

        $this->blancas_id = $p->blancas_id;
        $this->negras_id = $p->negras_id;

        $this->mesa = $p->mesa;
        $this->resultado = $p->resultado;
        $this->finalizada = $p->finalizada;

        Flux::modal('partida-form')->show();
    }

    /* =========================
        UPDATE
    ==========================*/
    public function update()
    {
        $p = Partida::findOrFail($this->partida_id);

        $p->update([
            'ronda_id' => $this->ronda_id,
            'blancas_id' => $this->blancas_id,
            'negras_id' => $this->negras_id,
            'mesa' => $this->mesa,
            'resultado' => $this->resultado,
            'finalizada' => $this->finalizada,
        ]);

        $this->toastSuccess('Actualizado');
        Flux::modals()->close();
    }

    /* =========================
        DELETE
    ==========================*/
    public function destroy($id)
    {
        Partida::findOrFail($id)->delete();
        $this->toastWarning('Eliminado');
    }

    public function render()
    {
        return view('livewire.sistema.protejo-mi-mente.registro-partidas');
    }
}