<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

/* -- Rutas de la entidad: Home */
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout');

/* -- Rutas de la entidad: Catalogo */
Route::get('catalogo', 'CatalogoController@index')->name('Catalogo');
Route::get('catalogoconfig/{config}', 'CatalogoController@getControl')->name('CatalogoConfig');

/* -- Rutas de la entidad: Aseguradora */
Route::resource('aseguradora','AseguradoraController',['except' => 'show','create','edit']);
Route::get('/aseguradoras', 'AseguradoraController@look')->name('Aseguradora');
Route::get('/listaseguradora', 'AseguradoraController@list')->name('ListAseguradora');

/* -- Rutas de la entidad: Proveedor */
Route::resource('proveedor','ProveedorController',['except' => 'create','edit']);
Route::get('/proveedores', 'ProveedorController@look')->name('Proveedor');
Route::get('/listproveedor','ProveedorController@list')->name('ListProveedor');

/* -- Rutas de la entidad: Repuestos */
Route::resource('repuesto','RepuestoController',['except' => 'create','edit']);
Route::get('/repuestos', 'RepuestoController@look')->name('Repuesto');
Route::get('/listrepuesto','RepuestoController@list')->name('ListRepuesto');

/* -- Rutas de la entidad: Cliente */
Route::resource('cliente','ClienteController',['except' => 'create','edit']);
Route::get('/clientes', 'ClienteController@look')->name('Proyecto');
Route::get('/listcliente', 'ClienteController@list')->name('ListCliente');

/* -- Rutas de la entidad: Vehiculo */
Route::resource('vehiculo','VehiculoController',['except' => 'create','edit']);
Route::get('/vehiculos', 'VehiculoController@look')->name('Vehiculo');
Route::get('/listvehiculo/{id}', 'VehiculoController@list')->name('ListVehiculo');

/* -- Rutas de la entidad: Cotizacion */
Route::resource('cotizacion','CotizacionController',['except' => 'create','edit']);
Route::get('/cotizaciones', 'CotizacionController@look')->name('Cotizacion');

/* -- Rutas de la entidad: dtlCotizacion */
Route::resource('dtlcotizacion','dtlCotizacionController',['except' => 'create','edit']);
Route::get('/dtlcotizacionsuma/{id}', 'dtlCotizacionController@getSum')->name('SumaCotizacion');

/* -- Rutas de la entidad: Proyecto */
Route::resource('proyecto','ProyectoController',['except' => 'create','edit']);
Route::get('/proyectos', 'ProyectoController@look')->name('Proyecto');

/* -- Rutas de la entidad: dtlProyecto */
Route::resource('dtlproyecto','dtlProyectoController',['except' => 'create','edit']);
Route::get('/dtlproyectos', 'dtlProyectoController@look')->name('dtlProyecto');

/* -- Rutas para funciones de carga de imagenes */
Route::resource('imagen','ImagenController',['except' => 'create','store','edit']);
Route::post('/proyecto/imagenes', 'ImagenController@upload')->name('SubirFotos');

/* -- Rutas para la gestión de consultas */
Route::get('/consulta', 'ConsultaController@index')->name('ConsultaClientes');
Route::get('/consults/{proyecto}/{cliente}/{vehiculo}', 'ConsultaController@show')->name('ConsultaProyecto');

/* -- Rutas para generar reportes */

Route::get('/reporte/clientes', 'ReporteController@cliente')->name('ReporteClientes');
Route::get('/reporte/proveedor', 'ReporteController@proveedor')->name('ReporteProveedor');