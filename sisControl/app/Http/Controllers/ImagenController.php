<?php

namespace sisControl\Http\Controllers;

use Illuminate\Http\Request;
use sisControl\Imagen;

class ImagenController extends Controller
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
    public function index()
    {
        $project = Imagen::orderBy('id', 'DESC')->get();
        return $project;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$imagen = Imagen::findORFail($id);
        $imagen = Imagen::where('dtlproyecto','=',$id)->get();
        return $imagen;
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
        Imagen::where('id','=',$request->id)->update(['dtlproyecto' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imagen = Imagen::findORFail($id);
        $imagen->delete();

        if(file_exists(public_path() . '/imagenes/proyectos/' . $imagen->nombre )) {
            unlink(public_path() . '/imagenes/proyectos/' . $imagen->nombre );
        } else {
            dd('El archivo no existe.');
        }
    }
    /**
    * Sube y guarda las imagenes en servidor
    *
    * @return Response
    */
    public function upload(Request $request)
    {
        $file = $request->file('file');
        $path = public_path() . '/imagenes/proyectos';
        $fileName = uniqid() . $file->getClientOriginalName();
    
        $file->move($path, $fileName);
    
        $image = new Imagen();
        $image->dtlproyecto = 0; //$id;
        //$image->user_id = auth()->user()->id;
        $image->nombre = $fileName;
        $image->estado = 1;
        $image->ruta = '../imagenes/proyectos/' . $fileName;
        $image->save();

        return $image;
    }
}
