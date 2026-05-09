<?php

namespace App\Models\ProtejoMiMente;

use Illuminate\Database\Eloquent\Model;

class Ronda extends Model
{
    protected $table = 'sistema.rondas';

    protected $fillable = [
        'torneo_evento_id',
        'numero',
        'finalizada',
    ];

    /*
    |------------------------------------------------------------------
    | RELACIONES
    |------------------------------------------------------------------
    */

    public function torneoEvento()
    {
        return $this->belongsTo(
            TorneoEvento::class,
            'torneo_evento_id'
        );
    }

    // opcional: acceso indirecto al torneo
    public function torneo()
    {
        return $this->torneoEvento?->torneo();
    }
}