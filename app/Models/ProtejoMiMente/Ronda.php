<?php

namespace App\Models\ProtejoMiMente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ronda extends Model
{
    use HasFactory;

    protected $connection = 'sistema';

    protected $table = 'rondas';

    protected $fillable = [
        'torneo_evento_id',
        'numero',
        'finalizada'
    ];

    public function torneoEvento()
    {
        return $this->belongsTo(TorneoEvento::class);
    }

    public function partidas()
    {
        return $this->hasMany(Partida::class);
    }
}
