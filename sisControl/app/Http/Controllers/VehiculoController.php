<?php

namespace sisControl\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use sisControl\Vehiculo;

class VehiculoController extends Controller
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
        return view('admin.gestiones.vehiculo.vehiculos');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       #$vehiculos = Vehiculo::orderBy('id', 'DESC')->paginate(7);
        $vehiculos = DB::table('vehiculos as a')
        ->leftJoin('clientes     as b', 'a.cliente',      '=', 'b.id')
        ->leftJoin('aseguradoras as c', 'a.aseguradora',  '=', 'c.id')
        ->select('a.id' 
                ,'a.cliente' 
                ,DB::raw("CONCAT(b.nombre,' ',b.apellido) as nomcliente")
                ,'a.placa' 
                ,'a.marca' 
                ,'a.modelo' 
                ,'a.anio'
                ,'a.aseguradora'
                ,'c.nombre as nomaseguradora'
                ,'a.complemento' 
                ,'a.comentario' 
                ,'a.estado' 
                ,'a.created_at' 
                ,'a.updated_at')
        ->orderBy('a.id', 'DESC')->paginate(7);

        return [
            'pagination' => [
               'total'        => $vehiculos->total(),
               'current_page' => $vehiculos->currentPage(),
               'per_page'     => $vehiculos->perPage(),
               'last_page'    => $vehiculos->lastPage(),
               'from'         => $vehiculos->firstItem(),
               'to'           => $vehiculos->lastPage()
            ],
            'vehiculos'       => $vehiculos
        ];
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function list($id)
    {
        $vehiculos = DB::table('vehiculos as c')
        ->select(
              DB::raw("CONCAT('Placa: ',c.placa,' - Marca: ',c.marca,', ','Modelo: ',c.modelo,', ','Año: ',c.anio) as nomvehiculo")
             ,'c.id')
        ->where('c.cliente','=',$id)
        ->orderBy('c.id', 'ASC')->get();

        return $vehiculos;
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
            'cliente'       => 'required',
            'placa'         => 'required',
            'marca'         => 'required',
            'modelo'        => 'required',
            'anio'          => 'required',
            'aseguradora'   => 'required',
            'complemento'   => 'required',
            'comentario'    => 'required',
            'estado'        => 'required',
        ]);
        Vehiculo::create($request->all());
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehiculos = Vehiculo::findORFail($id);
        $vehiculos->delete();
    }
}
