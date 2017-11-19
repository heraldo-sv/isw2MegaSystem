<?php

namespace sisControl;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'direccion',
        'telefono',
        'estado'
    ];
}
