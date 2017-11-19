<?php

namespace sisControl\Http\Controllers;

use Illuminate\Support\Facades\DB;
use sisControl\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
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
    public function list(Request $request)
    {
        $proveedors = DB::table('proveedors')
        ->select(
              DB::raw("CONCAT('Nombre: ',nombre,', Telefono: ',telefono) as nomproveedor")
             ,'id')
        ->orderBy('id', 'ASC')->get();

        return $proveedors;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function look()
    {
        return view('admin.catalogos.proveedor.proveedores');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = Proveedor::orderBy('id', 'DESC')->paginate(7);
        return [
            'pagination' => [
               'total'        => $proveedores->total(),
               'current_page' => $proveedores->currentPage(),
               'per_page'     => $proveedores->perPage(),
               'last_page'    => $proveedores->lastPage(),
               'from'         => $proveedores->firstItem(),
               'to'           => $proveedores->lastPage()
            ],
            'proveedores'    => $proveedores
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
            'nombre'      => 'required',
            'descripcion' => 'required',
            'direccion'   => 'required',
            'telefono'    => 'required',
        ]);
        Proveedor::create($request->all());
        return;
    }
    /**
     * Display the specified resource.
     *
     * @param  \sisControl\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show(Proveedor $proveedor)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \sisControl\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Proveedor $proveedor)
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
            'nombre'      => 'required',
            'descripcion' => 'required',
            'direccion'   => 'required',
            'telefono'    => 'required',
        ]);
        Proveedor::find($id)->update($request->all());
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
        $proveedor = Proveedor::findORFail($id);
        $proveedor->delete();
    }
}
