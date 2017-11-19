<?php

namespace sisControl;

use Illuminate\Database\Eloquent\Model;

class dtlCotizacion extends Model
{
    protected $fillable = [
        'id',
        'cotizacion',
        'repuesto',
        'user',
        'cantidad',
        'monto',
    ];
}
