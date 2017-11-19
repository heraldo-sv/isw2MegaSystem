<?php

namespace sisControl\Http\Controllers;

use Illuminate\Http\Request;
use sisControl\Aseguradora;

class AseguradoraController extends Controller
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
         return view('admin.catalogos.aseguradora.aseguradoras');
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
         $aseguradoras = Aseguradora::orderBy('id', 'DESC')->paginate(7);
         return [
             'pagination' => [
                'total'        => $aseguradoras->total(),
                'current_page' => $aseguradoras->currentPage(),
                'per_page'     => $aseguradoras->perPage(),
                'last_page'    => $aseguradoras->lastPage(),
                'from'         => $aseguradoras->firstItem(),
                'to'           => $aseguradoras->lastPage()
             ],
             'aseguradoras'    => $aseguradoras
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
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);
        Aseguradora::create($request->all());
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
        $aseguradoras = Aseguradora::findOrFail($id);
        return $aseguradoras;
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
            'descripcion' => 'required'
        ]);
        Aseguradora::find($id)->update($request->all());
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
        $aseguradoras = Aseguradora::findORFail($id);
        $aseguradoras->delete();
    }
}
