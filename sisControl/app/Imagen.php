<?php

namespace sisControl;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $fillable = [
        'dtlproyecto',
        'nombre',
        'ruta',
        'estado'
    ];
}
