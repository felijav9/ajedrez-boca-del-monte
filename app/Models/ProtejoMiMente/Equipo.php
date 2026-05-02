<?php

namespace App\Models\ProtejoMiMente;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;
    protected $connection = 'sistema';

    protected $fillable = [
        'nombre',
        'torneo_id'
    ];

    protected $table = 'equipos';
    public function torneo()
    {
        return $this->belongsTo(Torneo::class);
    }

    public function jugadores()
    {
        return $this->belongsToMany(Jugador::class, 'torneos_jugadores')
            ->withPivot('torneo_id')
            ->wherePivot('torneo_id', $this->torneo_id);
    }
}
