<?php

namespace sisControl\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use sisControl\dtlCotizacion;
use sisControl\Repuesto;
use sisControl\Cotizacion;

class dtlCotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'cotizacion' => 'required',
            'repuesto'   => 'required',
            'cantidad'   => 'required'
        ]);

        $repuesto = Repuesto::findOrFail($request->repuesto);

        $dtlCotizacion = new dtlCotizacion();

        $dtlCotizacion->cotizacion = $request->cotizacion;
        $dtlCotizacion->repuesto   = $request->repuesto;
        $dtlCotizacion->user       = auth()->user()->id;
        $dtlCotizacion->cantidad   = $request->cantidad;
        $dtlCotizacion->monto      = floatval($dtlCotizacion->cantidad) * floatval($repuesto->valor);
        $dtlCotizacion->save();
        
        $total = DB::table('dtl_cotizacions')->where('cotizacion','=',$request->cotizacion)->sum('monto');
        Cotizacion::where('id','=',$request->cotizacion)->update(['precio' => $total]);

        return $dtlCotizacion;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dtlProyectos = DB::table('dtl_cotizacions as a')
        ->leftJoin('repuestos as b','a.repuesto','=','b.id')
        ->select('a.id'
                ,'a.cotizacion'
                ,'a.repuesto'
                ,'a.user'
                ,'a.cantidad'
                ,DB::raw("CONCAT('$',FORMAT(a.monto,2)) as monto")
                ,'a.created_at'
                ,'a.updated_at'
                ,'b.nombre'
                ,'b.descripcion'
                ,DB::raw("CONCAT('$',FORMAT(b.valor,2)) as valor"))
        ->where('a.cotizacion', '=', $id)
        ->orderBy('a.id', 'DESC')->paginate(7);

        return [
            'pagination' => [
            'total'        => $dtlProyectos->total(),
            'current_page' => $dtlProyectos->currentPage(),
            'per_page'     => $dtlProyectos->perPage(),
            'last_page'    => $dtlProyectos->lastPage(),
            'from'         => $dtlProyectos->firstItem(),
            'to'           => $dtlProyectos->lastPage()
            ],
            'dtlProyectos'    => $dtlProyectos
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \sisControl\dtlCotizacion  $dtlCotizacion
     * @return \Illuminate\Http\Response
     */
    public function edit(dtlCotizacion $dtlCotizacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \sisControl\dtlCotizacion  $dtlCotizacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, dtlCotizacion $dtlCotizacion)
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
        $dtlCotizacion = dtlCotizacion::findORFail($id);
        $dtlCotizacion->delete();

        $total = DB::table('dtl_cotizacions')->where('cotizacion','=',$dtlCotizacion->cotizacion)->sum('monto');
        Cotizacion::where('id','=',$dtlCotizacion->cotizacion)->update(['precio' => $total]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSum($id)
    {
        $total = DB::table('dtl_cotizacions')->where('cotizacion','=',$id)->sum('monto');
        return $total;
    }
}
