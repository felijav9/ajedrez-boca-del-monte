<?php

namespace App\Models\ProtejoMiMente;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TorneoJugador extends Model
{
    protected $connection = 'sistema';
    protected $table = 'torneos_jugadores';

    protected $fillable = [
        'torneo_id',
        'jugador_id',
        'equipo_id',
        'categoria_id',
        'torneo_evento_id'

    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function jugador()
    {
        return $this->belongsTo(Jugador::class);
    }

    public function torneo()
    {
        return $this->belongsTo(Torneo::class);
    }

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
    public function torneoEvento()
    {
        return $this->belongsTo(TorneoEvento::class);
    }
}
