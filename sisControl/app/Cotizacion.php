<?php

namespace sisControl;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    protected $fillable = [
        'titulo',
        'cliente',
        'vehiculo',
        'descripcion',
        'estado',
        'precio',
        'user',
    ];
}
