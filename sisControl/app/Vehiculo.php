<?php

namespace sisControl;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $fillable = [
        'cliente',
        'placa',
        'marca',
        'modelo',
        'anio',
        'aseguradora',
        'comentario',
        'estado'
    ];
}
