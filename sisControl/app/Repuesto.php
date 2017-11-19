<?php

namespace sisControl;

use Illuminate\Database\Eloquent\Model;

class Repuesto extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'proveedor',
        'valor',
        'estado'
    ];
}
