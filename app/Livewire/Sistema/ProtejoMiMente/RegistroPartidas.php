<?php

namespace App\Livewire\Sistema\ProtejoMiMente;

use App\Models\ProtejoMiMente\Partida;
use App\Models\ProtejoMiMente\Ronda;
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
        ['index' => 'mesa', 'label' => 'Mesa'], // 👈 AQUÍ
        ['index' => 'blancas', 'label' => 'Blancas'],
        ['index' => 'negras', 'label' => 'Negras'],
        ['index' => 'resultado', 'label' => 'Resultado'],
        ['index' => 'estado', 'label' => 'Estado'],
        ['index' => 'actions', 'label' => ''],
    ];

    public $partida_id = null;

    public $torneo_evento_id = null;
    public $ronda_id = null;

    public $blancas_id = null;
    public $negras_id = null;

    public $mesa = null;
    public $resultado = null;
    public $finalizada = false;

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
        EVENTOS
    ==========================*/
    #[Computed]
    public function eventos()
    {
        return TorneoEvento::orderBy('nombre')->get();
    }

    /* =========================
        RONDAS
    ==========================*/
    #[Computed]
    public function rondas()
    {
        if (!$this->torneo_evento_id) {
            return collect();
        }

        return Ronda::where('torneo_evento_id', $this->torneo_evento_id)
            ->orderBy('numero')
            ->get();
    }

    /* =========================
        JUGADORES POR TORNEO
    ==========================*/
    #[Computed]
    public function jugadores()
    {
        if (!$this->torneo_evento_id) {
            return collect();
        }

        $evento = TorneoEvento::find($this->torneo_evento_id);

        if (!$evento) {
            return collect();
        }

        return Jugador::whereHas('torneos', function ($q) use ($evento) {
            $q->where('torneos.id', $evento->torneo_id);
        })
        ->orderBy('nombre')
        ->get();
    }

    /* =========================
        REACTIVIDAD
    ==========================*/
    public function updatedTorneoEventoId()
    {
        $this->ronda_id = null;
        $this->blancas_id = null;
        $this->negras_id = null;
    }

    /* =========================
        CREATE
    ==========================*/
    public function openCreateModal()
    {
        $this->reset([
            'partida_id',
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
        SAVE (VALIDACIÓN FUERTE)
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
            $this->addError('negras_id', 'Un jugador no puede jugar contra sí mismo');
            return;
        }

        $exists = Partida::where('ronda_id', $this->ronda_id)
            ->where(function ($q) {
                $q->where(function ($x) {
                    $x->where('blancas_id', $this->blancas_id)
                      ->where('negras_id', $this->negras_id);
                })->orWhere(function ($x) {
                    $x->where('blancas_id', $this->negras_id)
                      ->where('negras_id', $this->blancas_id);
                });
            })
            ->exists();

        if ($exists) {
            $this->addError('blancas_id', 'Esta partida ya existe en esta ronda');
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
        $this->ronda_id = $p->ronda_id;
        $this->torneo_evento_id = $p->ronda->torneo_evento_id;

        $this->blancas_id = $p->blancas_id;
        $this->negras_id = $p->negras_id;

        $this->mesa = $p->mesa;
        $this->resultado = $p->resultado;
        $this->finalizada = $p->finalizada;

        Flux::modal('partida-form')->show();
    }

    /* =========================
        UPDATE (MISMAS VALIDACIONES)
    ==========================*/
    public function update()
    {
        $p = Partida::findOrFail($this->partida_id);

        $this->validate([
            'ronda_id' => 'required|exists:sistema.rondas,id',
            'blancas_id' => 'required|exists:sistema.jugadores,id',
            'negras_id' => 'required|exists:sistema.jugadores,id',
        ]);

        if ($this->blancas_id === $this->negras_id) {
            $this->addError('negras_id', 'Un jugador no puede jugar contra sí mismo');
            return;
        }

        $exists = Partida::where('ronda_id', $this->ronda_id)
            ->where('id', '!=', $this->partida_id)
            ->where(function ($q) {
                $q->where(function ($x) {
                    $x->where('blancas_id', $this->blancas_id)
                      ->where('negras_id', $this->negras_id);
                })->orWhere(function ($x) {
                    $x->where('blancas_id', $this->negras_id)
                      ->where('negras_id', $this->blancas_id);
                });
            })
            ->exists();

        if ($exists) {
            $this->addError('blancas_id', 'Ya existe esta partida en esta ronda');
            return;
        }

        $p->update([
            'ronda_id' => $this->ronda_id,
            'blancas_id' => $this->blancas_id,
            'negras_id' => $this->negras_id,
            'mesa' => $this->mesa,
            'resultado' => $this->resultado,
            'finalizada' => $this->finalizada,
        ]);

        $this->toastSuccess('Partida actualizada');
        Flux::modals()->close();
    }

    /* =========================
        DELETE
    ==========================*/
    public function destroy($id)
    {
        Partida::findOrFail($id)->delete();
        $this->toastWarning('Eliminada');
    }

    public function render()
    {
        return view('livewire.sistema.protejo-mi-mente.registro-partidas');
    }
}