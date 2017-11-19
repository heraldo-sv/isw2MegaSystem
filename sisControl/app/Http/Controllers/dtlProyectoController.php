<?php

namespace sisControl\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use sisControl\Proyecto;
use sisControl\dtlProyecto;

class dtlProyectoController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function look()
    {
        return view('admin.procesos.proyecto.dtlproyectos');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dtlProyectos = dtlProyecto::orderBy('id', 'DESC')->paginate(15);
        return [
            'pagination' => [
            'total'        => $dtlProyectos->total(),
            'current_page' => $dtlProyectos->currentPage(),
            'per_page'     => $dtlProyectos->perPage(),
            'last_page'    => $dtlProyectos->lastPage(),
            'from'         => $dtlProyectos->firstItem(),
            'to'           => $dtlProyectos->lastPage()
            ],
            'dtlproyectos'    => $dtlProyectos
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
            'proyecto'    => 'required',
            'user'        => 'required',
            'titulo'      => 'required',
            'etapa'       => 'required',
            'descripcion' => 'required',
        ]);
        $dtlProyecto = dtlProyecto::create($request->all());
        Proyecto::where('id','=',$request->proyecto)->update(['progreso' => $request->etapa]);
        return $dtlProyecto;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $dtlProyectos = dtlProyecto::where('proyecto', '=', $id)->orderBy('id', 'DESC')->get();
        $dtlProyectos = DB::table('dtl_proyectos')
        ->where('proyecto', '=', $id)
        ->leftJoin('users', 'dtl_proyectos.user', '=', 'users.id')
        ->select('dtl_proyectos.id'
                ,'dtl_proyectos.proyecto'
                ,'dtl_proyectos.user'
                ,'users.name as nomuser'
                ,'dtl_proyectos.titulo'
                ,'dtl_proyectos.etapa'
                ,'dtl_proyectos.descripcion'
                ,'dtl_proyectos.created_at'
                ,'dtl_proyectos.updated_at')
        ->orderBy('dtl_proyectos.id', 'DESC')->get();
        return $dtlProyectos;
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
        //
    }
}
