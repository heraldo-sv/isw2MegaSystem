<?php

namespace sisControl;

use Illuminate\Database\Eloquent\Model;

class dtlProyecto extends Model
{
    protected $fillable = [
        'id',
        'proyecto',
        'user',
        'titulo',
        'etapa',
        'descripcion'
    ];
}
