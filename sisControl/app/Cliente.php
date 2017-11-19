<?php

namespace sisControl;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nombre',
        'apellido',
        'documento',
        'correo',
        'telefono'
    ];
    /**
     * Un Cliente puede tener muchos Proyecto.
     */
    public function proyecto()
    {
        return $this->hasMany(Proyecto::class,'cliente');
    }
}
