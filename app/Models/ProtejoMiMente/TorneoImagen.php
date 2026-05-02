<?php

namespace App\Models\ProtejoMiMente;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TorneoImagen extends Model
{
    use HasFactory;

    protected $connection = 'sistema';

    protected $table = 'torneos_imagenes';

    protected $fillable = [
        'torneo_id',
        'ruta',
        'tipo',
    ];

    public function torneo()
    {
        return $this->belongsTo(Torneo::class);
    }
}
