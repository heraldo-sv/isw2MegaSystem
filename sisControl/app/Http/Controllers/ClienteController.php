<?php

namespace sisControl\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use sisControl\Cliente;
use sisControl\Proyecto;

class ClienteController extends Controller
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
        return view('admin.gestiones.cliente.clientes');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clientes = Cliente::orderBy('id', 'DESC')->paginate(7);
        return [
            'pagination' => [
               'total'        => $clientes->total(),
               'current_page' => $clientes->currentPage(),
               'per_page'     => $clientes->perPage(),
               'last_page'    => $clientes->lastPage(),
               'from'         => $clientes->firstItem(),
               'to'           => $clientes->lastPage()
            ],
            'clientes'        => $clientes
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $clientes = DB::table('clientes')
        ->select(
              DB::raw("CONCAT(id,' - Nombre: ',nombre,' ',apellido,', Telefono: ',telefono,', Correo: ',correo) as cliente")
             ,'id')
        ->orderBy('id', 'ASC')->get();

        return $clientes;
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
            'nombre'    => 'required',
            'apellido'  => 'required',
            'documento' => 'required',
            'correo'    => 'required',
            'telefono'  => 'required',
        ]);
        Cliente::create($request->all());
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
        $clientes = Cliente::findOrFail($id);
        return $clientes;
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
            'nombre'    => 'required',
            'apellido'  => 'required',
            'documento' => 'required',
            'correo'    => 'required',
            'telefono'  => 'required'
        ]);
        Cliente::find($id)->update($request->all());
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
        $clientes = Cliente::findORFail($id);
        $clientes->delete();
    }
    /**
     * Get the Cliente that owns the Proyecto.
     */
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
}
