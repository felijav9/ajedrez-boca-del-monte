<?php

namespace App\Livewire\Sistema\ProtejoMiMente;

use Livewire\Component;

class Dashboard extends Component
{
    // No necesitamos la propiedad $view para las rutas públicas 
    // porque son redirecciones de página completa.

    public function goToMedallero()
    {
        return redirect()->route('protejo-mi-mente.medallero');
    }

    public function goToJugadores()
    {
        return redirect()->route('protejo-mi-mente.jugadores-protejo');
    }

    public function goToTorneos()
    {
        return redirect()->route('protejo-mi-mente.torneos-protejo');
    }



    public function render()
    {
        return view('livewire.sistema.protejo-mi-mente.dashboard');
    }
}