<?php

namespace App\Models\ProtejoMiMente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TorneoEventoClasificacion extends Model
{
      use HasFactory;

    protected $connection = 'sistema';

    protected $table = 'torneo_evento_clasificaciones';

    protected $fillable = [
        'torneo_evento_id',
        'jugador_id',
        'posicion',
        'pts',
        'bhc1',
        'bh',
        'sb',
        'ps',
        'de',
        'win',
        'draw',
        'lose',
        'bwg',
        'rating'
    ];

    public function torneoEvento()
    {
        return $this->belongsTo(TorneoEvento::class);
    }

    public function jugador()
    {
        return $this->belongsTo(Jugador::class);
    }
}
