<?php

namespace sisControl;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $fillable = [
        'titulo',
        'cliente',
        'vehiculo',
        'descripcion',
        'progreso',
        'estado'
    ];
    /**
     * Un Cliente puede tener muchos Proyecto.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class,'id');
    }
}
