<?php

namespace sisControl\Http\Controllers;

use sisControl\Repuesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $clientes = DB::table('repuestos')
        ->select(
              DB::raw("CONCAT(id,' - Nombre: ',nombre,', Valor: $',valor,', Proveedor: ',proveedor) as repuesto")
             ,'id')
        ->orderBy('id', 'ASC')->get();

        return $clientes;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $repuestos = DB::table('repuestos as a')
        ->leftJoin('proveedors as b','a.proveedor','=','b.id')
        ->select('a.id'
                ,'a.nombre'
                ,'a.descripcion'
                ,'a.proveedor'
                ,DB::raw("CONCAT('Nombre: ',b.nombre,', Telefono: ',b.telefono) as nomproveedor")
                ,'a.valor'
                ,'a.estado'
                ,'a.created_at'
                ,'a.updated_at')
        ->orderBy('a.id', 'DESC')->paginate(7);

        return [
            'pagination' => [
               'total'        => $repuestos->total(),
               'current_page' => $repuestos->currentPage(),
               'per_page'     => $repuestos->perPage(),
               'last_page'    => $repuestos->lastPage(),
               'from'         => $repuestos->firstItem(),
               'to'           => $repuestos->lastPage()
            ],
            'repuestos'       => $repuestos
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function look()
    {
        return view('admin.catalogos.repuesto.repuestos');
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
            'proveedor'   => 'required',
            'valor'       => 'required',
        ]);
        Repuesto::create($request->all());
        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  \sisControl\Repuesto  $repuesto
     * @return \Illuminate\Http\Response
     */
    public function show(Repuesto $repuesto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \sisControl\Repuesto  $repuesto
     * @return \Illuminate\Http\Response
     */
    public function edit(Repuesto $repuesto)
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
        $this->validate($request,[
            'nombre'      => 'required',
            'descripcion' => 'required',
            'proveedor'   => 'required',
            'valor'       => 'required',
        ]);
        Repuesto::find($id)->update($request->all());
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
        $repuestos = Repuesto::findORFail($id);
        $repuestos->delete();
    }
}
