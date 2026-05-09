<?php

namespace App\Models\ProtejoMiMente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TorneoEvento extends Model
{
    use HasFactory;

    protected $connection = 'sistema';

    protected $table = 'torneo_eventos';

    protected $fillable = [
        'torneo_id',
        'nombre',
        'tipo',
        'total_rondas',
        'finalizado'
    ];


    
    public function torneo()
    {
        return $this->belongsTo(Torneo::class);
    }

    public function rondas()
    {
        return $this->hasMany(Ronda::class);
    }

    public function clasificaciones()
    {
        return $this->hasMany(TorneoEventoClasificacion::class);
    }

    public function jugadores()
    {
        return $this->hasMany(TorneoJugador::class);
    }

    public function resultados()
    {
        return $this->hasMany(ResultadoIndividual::class);
}


public function partidas()
{
    return $this->hasManyThrough(
        Partida::class,
        Ronda::class,
        'torneo_evento_id', // FK en rondas
        'ronda_id',         // FK en partidas
        'id',
        'id'
    );
}
    
}
