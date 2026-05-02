<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    protected $connection = 'sistema';
    public $timestamps = false;
    protected $fillable = ['nombre'];
}
