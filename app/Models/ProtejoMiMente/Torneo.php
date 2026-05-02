<?php

namespace App\Models\ProtejoMiMente;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Torneo extends Model
{
    use HasFactory;

    protected $table = 'torneos';

    protected $connection = 'sistema';

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'lugar',
        'tipo',
    ];

    public function jugadores()
    {
        return $this->belongsToMany(Jugador::class, 'torneos_jugadores')
            ->withPivot('equipo_id', 'categoria')
            ->withTimestamps();
    }

    public function imagenes()
    {
        return $this->hasMany(TorneoImagen::class);
    }

    public function resultados()
    {
        return $this->hasMany(ResultadoIndividual::class);
    }

    public function equipos()
    {
        return $this->hasMany(Equipo::class);
    }

    // esto es opcional
    public function participaciones()
    {
        return $this->hasMany(TorneoJugador::class);
    }

    // PARA PLANTILLAS
    public function portada()
    {
        return $this->imagenes()->where('tipo', 'portada')->first();
    }

    public function imagenGold()
    {
        return $this->imagenes()->where('tipo', 'gold')->first();
    }

    public function imagenSilver()
    {
        return $this->imagenes()->where('tipo', 'silver')->first();
    }

    public function imagenBronze()
    {
        return $this->imagenes()->where('tipo', 'bronze')->first();
    }

    public function imagenGanadores()
    {
        return $this->imagenes()->where('tipo', 'ganadores')->first();
    }

  /*   public function galeria()
    {
        return $this->imagenes()->where('tipo', 'galeria')->get();
    } */

     public function imagenTalleres()
    {
        return $this->imagenes()->where('tipo', 'imagen_talleres')->get();
    }

     public function imagenTorneos()
    {
        return $this->imagenes()->where('tipo', 'imagen_torneos')->get();
    }


    // 🔥 TOP 3
    public function top3()
    {
        return $this->resultados()
            ->with('jugador')
            ->whereIn('posicion', [1, 2, 3])
            ->orderBy('posicion')
            ->get();
    }

    // 🔥 OPCIONAL PRO
    public function imagenPorTipo($tipo)
    {
        return $this->imagenes()->where('tipo', $tipo)->first();
    }
}
