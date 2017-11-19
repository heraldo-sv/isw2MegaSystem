<?php

namespace sisControl;

use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    protected $fillable = [
        'llave',
        'codigo',
        'valor',
        'descripcion',
        'estado'
    ];
}
