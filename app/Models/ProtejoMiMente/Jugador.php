<?php

namespace App\Models\ProtejoMiMente;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    use HasFactory;
    protected $table = 'jugadores';
    protected $connection = 'sistema';
    protected $fillable = [
        'nombre',
        'apellido',
        'genero',
        'edad',
        'fecha_nacimiento',
        'elo_blitz',
        'elo_rapido',
        'elo_clasico'
    ];
    public function torneos()
    {
        return $this->belongsToMany(Torneo::class, 'torneos_jugadores')
            ->withPivot('equipo_id', 'categoria')
            ->withTimestamps();
    }
    public function resultados()
    {
        return $this->hasMany(ResultadoIndividual::class);
    }

    // opcional
    public function participaciones()
    {
        return $this->hasMany(TorneoJugador::class);
    }
}
