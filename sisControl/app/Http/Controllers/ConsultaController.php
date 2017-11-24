<?php

namespace sisControl\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use sisControl\Proyecto;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.gestiones.consulta.consultas');
    }
    /**
     * Store a newly created resource in storage.
     * @param  int     $proyecto
     * @param  string  $cliente
     * @param  string  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function show($proyecto, $cliente, $vehiculo)
    {
        $proyectos = DB::table('proyectos as a')
        ->leftJoin('clientes  as b', 'a.cliente',  '=', 'b.id')
        ->leftJoin('vehiculos as c', 'a.vehiculo', '=', 'c.id')
        ->leftJoin('catalogos as d', 'a.progreso', '=', 'd.codigo')
        ->leftJoin('catalogos as e', 'a.estado',   '=', 'e.codigo')
        ->select('a.id'
                ,'a.titulo'
                ,'a.cliente'
                ,DB::raw("CONCAT(b.nombre,' ',b.apellido) as nomcliente")
                ,'b.telefono as telcliente'
                ,'a.vehiculo'
                ,DB::raw("CONCAT('Marca: ',c.marca,', ','Modelo: ',c.modelo,', ','Año: ',c.anio) as nomvehiculo")
                ,'a.descripcion'
                ,'a.progreso'
                ,'d.valor as nomprogreso'
                ,'a.estado'
                ,'e.valor as nomestado'
                ,'a.created_at'
                ,'a.updated_at')
        ->where('d.llave', '=','PROGRESO')
        ->where('e.llave', '=','ESTADOPROY')
        // /* --- Filtros para consultas --- */
        ->where('a.id',       '=',$proyecto)
        ->where('b.documento','=',$cliente)
        ->where('c.placa',    '=',$vehiculo)
        // /* --- Filtros para consultas --- */
        ->orderBy('a.id', 'DESC')->get();

        return $proyectos;
    }
}
