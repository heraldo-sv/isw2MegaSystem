<?php

namespace sisControl\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use sisControl\Cotizacion;
use sisControl\Proyecto;

class CotizacionController extends Controller
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
        return view('admin.procesos.cotizacion.cotizaciones');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$cotizaciones = Cotizacion::orderBy('id', 'DESC')->paginate(7);
        $cotizaciones = DB::table('cotizacions as a')
        ->leftJoin('clientes  as b', 'a.cliente',  '=', 'b.id')
        ->leftJoin('vehiculos as c', 'a.vehiculo', '=', 'c.id')
        ->leftJoin('catalogos as d', 'a.estado',   '=', 'd.codigo')
        ->leftJoin('users     as e', 'a.user',     '=', 'e.id')
        ->select('a.id'
                ,'a.titulo'
                ,'a.cliente'
                ,DB::raw("CONCAT(b.nombre,' ',b.apellido) as nomcliente")
                ,'a.vehiculo'
                ,DB::raw("CONCAT('Marca: ',c.marca,', ','Modelo: ',c.modelo,', ','Año: ',c.anio) as nomvehiculo")
                ,'a.descripcion'
                ,'a.estado'
                ,'d.valor as nomestado'
                ,'a.precio'
                ,'a.user'
                ,'e.name as nomuser'
                ,'a.created_at'
                ,'a.updated_at')
        ->where('d.llave', '=','COTESTADO')
        ->orderBy('a.id', 'DESC')->paginate(7);

        return [
            'pagination' => [
            'total'        => $cotizaciones->total(),
            'current_page' => $cotizaciones->currentPage(),
            'per_page'     => $cotizaciones->perPage(),
            'last_page'    => $cotizaciones->lastPage(),
            'from'         => $cotizaciones->firstItem(),
            'to'           => $cotizaciones->lastPage()
            ],
            'cotizaciones'    => $cotizaciones
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
        $request->user = auth()->user()->id;
        $this->validate($request,[
            'titulo'        => 'required',
            'cliente'       => 'required',
            'vehiculo'      => 'required',
            'descripcion'   => 'required',
            'estado'        => 'required',
            'precio'        => 'required'
        ]);

        //Cotizacion::create($request->all());

        $cotizacion = new Cotizacion();

        $cotizacion->titulo       = $request->titulo;
        $cotizacion->cliente      = $request->cliente;
        $cotizacion->vehiculo     = $request->vehiculo;
        $cotizacion->descripcion  = $request->descripcion;
        $cotizacion->estado       = $request->estado;
        $cotizacion->precio       = $request->precio;
        $cotizacion->user         = auth()->user()->id;
        $cotizacion->save();

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
        //
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
            'estado'      => 'required',
            'precio'      => 'required',
        ]);
        Cotizacion::find($id)->update($request->all());
        
        # Creación de proyecto si la cotización fue pagada
        if ($request->estado = 2) { # 2: Pagada

            $proyecto = new Proyecto;
            
            $proyecto->titulo       = $request->titulo;
            $proyecto->cliente      = $request->cliente;
            $proyecto->vehiculo     = $request->vehiculo;
            $proyecto->descripcion  = $request->descripcion;
            $proyecto->progreso     = 1;
            $proyecto->estado       = 1;
            $proyecto->save();
        }
        
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
