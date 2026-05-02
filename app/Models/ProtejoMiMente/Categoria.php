<?php

namespace App\Models\ProtejoMiMente;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $connection = 'sistema';

    protected $fillable = ['nombre'];

    public function torneosJugadores()
    {
        return $this->hasMany(TorneoJugador::class);
    }
}