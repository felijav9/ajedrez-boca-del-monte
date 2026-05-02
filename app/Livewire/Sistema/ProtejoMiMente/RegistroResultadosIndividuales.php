<?php

namespace App\Livewire\Sistema\ProtejoMiMente;

use App\Models\ProtejoMiMente\ResultadoIndividual;
use App\Models\ProtejoMiMente\Torneo;
use App\Models\ProtejoMiMente\TorneoJugador;
use Flux\Flux;
use Livewire\Component;

class RegistroResultadosIndividuales extends Component
{
    public $torneos = [];

    public $torneo_id = null;

    public $jugadores = [];

    public function mount()
    {
        $this->torneos = Torneo::all();
    }

    public function updatedTorneoId($value)
    {
        if ($value) {
            $this->cargarJugadores();
        } else {
            $this->jugadores = [];
        }
    }

    public function cargarJugadores()
    {
        $resultados = ResultadoIndividual::where('torneo_id', $this->torneo_id)
            ->get()
            ->keyBy('jugador_id');

        $this->jugadores = TorneoJugador::with(['jugador', 'equipo'])
            ->where('torneo_id', $this->torneo_id)
            ->get()
            ->map(function ($item) use ($resultados) {

                $r = $resultados[$item->jugador_id] ?? null;

                $posicion = $r->posicion ?? null;

                return [
                    'jugador_id' => $item->jugador_id,
                    'nombre' => trim(
                        ($item->jugador?->apellido ?? '').' '.
                        ($item->jugador?->nombre ?? 'Jugador eliminado')
                    ),

                    'equipo' => $item->equipo?->nombre ?? null,

                    'posicion' => $posicion,
                    'medalla' => $this->calcularMedalla($posicion),
                ];
            })
            ->sortBy(fn ($item) => $item['posicion'] ?? 9999)
            ->values()
            ->toArray();
    }

    public function updatedJugadores($value, $key)
    {
        [$index, $field] = explode('.', $key);

        if ($field === 'posicion') {
            $posicion = $this->jugadores[$index]['posicion'];

            $this->jugadores[$index]['medalla'] = $this->calcularMedalla($posicion);
        }
    }

    private function calcularMedalla($posicion)
    {
        return match ((int) $posicion) {
            1 => 'gold',
            2 => 'silver',
            3 => 'bronze',
            default => null,
        };
    }

    // ======================
    // MODAL CONFIRMAR GUARDADO
    // ======================
    public function confirmarGuardar()
    {
        Flux::modal('confirm-save')->show();
    }

    // ======================
    // GUARDAR FINAL
    // ======================
    public function guardar()
    {
        foreach ($this->jugadores as $jugador) {

            if (! $jugador['posicion']) {
                continue;
            }

            ResultadoIndividual::updateOrCreate(
                [
                    'torneo_id' => $this->torneo_id,
                    'jugador_id' => $jugador['jugador_id'],
                ],
                [
                    'posicion' => $jugador['posicion'],
                    'medalla' => $jugador['medalla'],
                ]
            );
        }

        $this->cargarJugadores();

        Flux::modal('confirm-save')->close();

        $this->dispatch('toast', message: 'Resultados guardados correctamente');
    }

    public function render()
    {
        return view('livewire.sistema.protejo-mi-mente.registro-resultados-individuales');
    }
}
