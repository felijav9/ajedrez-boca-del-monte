<?php

namespace App\Models\ProtejoMiMente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partida extends Model
{
    use HasFactory;

    protected $connection = 'sistema';

    protected $table = 'partidas';

    protected $fillable = [
        'ronda_id',
        'blancas_id',
        'negras_id',
        'mesa',
        'resultado',
        'finalizada'
    ];

    public function ronda()
    {
        return $this->belongsTo(Ronda::class);
    }

    public function blancas()
    {
        return $this->belongsTo(Jugador::class, 'blancas_id');
    }

    public function negras()
    {
        return $this->belongsTo(Jugador::class, 'negras_id');
    }
}
