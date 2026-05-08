<?php

namespace App\Models\ProtejoMiMente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResultadoIndividual extends Model
{
    use HasFactory;
    protected $table = 'resultados_individuales';
    protected $connection = 'sistema';
    protected $fillable = [
        'torneo_id',
        'jugador_id',
        'posicion',
        'medalla',
        'torneo_evento_id'
    ];
    public function torneo()
    {
        return $this->belongsTo(Torneo::class);
    }

    public function jugador()
    {
        return $this->belongsTo(Jugador::class);
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
