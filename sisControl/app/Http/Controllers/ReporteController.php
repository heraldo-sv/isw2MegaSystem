<?php

namespace sisControl\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use sisControl\Cliente;
use sisControl\Proveedor;

class ReporteController extends Controller
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
    public function cliente(Request $request)
    {
        $clientes = Cliente::orderBy('id', 'DESC')->get();
        return view('admin.reportes.cliente',['clientes' => $clientes]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function proveedor(Request $request)
    {
        $proveedores = Proveedor::orderBy('id', 'DESC')->get();
        return view('admin.reportes.proveedor',['proveedores' => $proveedores]);
    }
}
