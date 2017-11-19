<?php

namespace sisControl\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use sisControl\Proyecto;
use sisControl\Cliente;

class ProyectoController extends Controller
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function look()
    {
        return view('admin.procesos.proyecto.proyectos');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$proyectos = Proyecto::orderBy('id', 'DESC')->paginate(7);
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
        ->orderBy('a.id', 'DESC')->paginate(7);

        return [
            'pagination' => [
            'total'        => $proyectos->total(),
            'current_page' => $proyectos->currentPage(),
            'per_page'     => $proyectos->perPage(),
            'last_page'    => $proyectos->lastPage(),
            'from'         => $proyectos->firstItem(),
            'to'           => $proyectos->lastPage()
            ],
            'proyectos'    => $proyectos
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'titulo'      => 'required',
            'cliente'     => 'required',
            'vehiculo'    => 'required',
            'descripcion' => 'required',
            'progreso'    => 'required',
            'estado'      => 'required',
        ]);
        Proyecto::create($request->all());
        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proyectos = Proyecto::findOrFail($id);
        return $proyectos;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'titulo'      => 'required',
            'cliente'     => 'required',
            'vehiculo'    => 'required',
            'descripcion' => 'required',
            'progreso'    => 'required',
            'estado'      => 'required',
        ]);
        Proyecto::find($id)->update($request->all());
        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
