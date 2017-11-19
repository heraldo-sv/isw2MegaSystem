<?php

namespace sisControl;

use Illuminate\Database\Eloquent\Model;

class Aseguradora extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion'
    ];
}
