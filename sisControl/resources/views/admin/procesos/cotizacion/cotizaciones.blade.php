@extends('layouts.blank')

@push('stylesheets')
    <!-- Clases para Slider -->
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
        <div id="cotizacion">
            <div id="maestroCotizacion" class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Maestro Cotización</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="close-link">
                                        <i class="fa fa-close"></i>
                                    </a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-md-5 col-sm-12 col-xs-12 form-group">
                                        
                                    </div>
                                    <div class="col-md-7 col-sm-12 col-xs-12 form-group">
                                        <a id="btn_cotizacion" href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#createMaster"> Nueva cotización</a>    
                                    </div>
                                </div>
                                <table id="datatable" class="table dataTable no-footer table-hover" role="grid" aria-describedby="datatable_info">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Titulo cotización</th>
                                            <th>Nombre cliente</th>
                                            <th>Vehiculo</th>
                                            <th>Estado</th>
                                            <th>precio</th>
                                            <th colspan="2">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="keep in keeps">
                                            <td>@{{ keep.id }}</td>
                                            <td>@{{ keep.titulo }}</td>
                                            <td>@{{ keep.nomcliente }}</td>
                                            <td>@{{ keep.nomvehiculo }}</td>
                                            <td>@{{ keep.nomestado }}</td>
                                            <td>@{{ keep.precio }}</td>
                                            
                                            <td><a :id="keep.id" href="#" title="Ver detalles" class="glyphicon glyphicon glyphicon-th-list pull-right" v-on:click.prevent="getKeepsGnr(keep)" ></a></td>
                                            <td><a href="#" title="Editar" class="glyphicon glyphicon-pencil pull-left" v-on:click.prevent="editKeep(keep)" ></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <nav>
                                    <ul class="pagination">
                                        <li v-if="pagination.current_page > 1">
                                            <a href="#" @click.prevent="changePage(pagination.current_page - 1)">
                                                <span>Atras</span>
                                            </a>
                                        </li>
                                        <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '' ]" >
                                            <a href="#" @click.prevent="changePage(page)">
                                                @{{ page }}
                                            </a>
                                        </li>
                                        <li v-if="pagination.current_page < pagination.last_page">
                                            <a href="#" @click.prevent="changePage(pagination.current_page + 1)">
                                                <span>Siguiente</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="detalleCotizacion" class="row hidden">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Detalle Cotización</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="close-link">
                                        <i class="fa fa-close"></i>
                                    </a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-sm-12">
                                <div class="form-horizontal form-label-left">
                                    <div class="form-group">
                                        <label for="titulo" class="control-label col-md-2 col-sm-2 col-xs-12">Titulo:</label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" name="titulo" readonly="readonly" class="form-control col-md-7 col-xs-12" v-model="lookKeep.titulo">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="user" class="control-label col-md-2 col-sm-2 col-xs-12">Empleado:</label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" name="user" readonly="readonly" class="form-control col-md-7 col-xs-12" v-model="lookKeep.nomuser">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nomcliente" class="control-label col-md-2 col-sm-2 col-xs-12">Cliente:</label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" name="cliente" readonly="readonly" class="hidden" v-model="lookKeep.cliente">
                                            <input type="text" name="nomcliente" readonly="readonly" class="form-control col-md-7 col-xs-12" v-model="lookKeep.nomcliente">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nomvehiculo" class="control-label col-md-2 col-sm-2 col-xs-12">Vehiculo:</label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" name="vehiculo" readonly="readonly" class="hidden" v-model="lookKeep.vehiculo">
                                            <input type="text" name="nomvehiculo" readonly="readonly" class="form-control col-md-7 col-xs-12" v-model="lookKeep.nomvehiculo">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha" class="control-label col-md-2 col-sm-2 col-xs-12">Fecha de creación:</label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" name="fecha" readonly="readonly" class="form-control col-md-7 col-xs-12" v-model="lookKeep.fecha">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="estado" class="control-label col-md-2 col-sm-2 col-xs-12">Estado:</label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" name="estado" readonly="readonly" class="form-control col-md-7 col-xs-12" v-model="lookKeep.nomestado">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="precio" class="control-label col-md-2 col-sm-2 col-xs-12">Precio:</label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" name="precio" readonly="readonly" class="form-control col-md-7 col-xs-12" v-model="lookKeep.precio">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="descripcion" class="control-label col-md-2 col-sm-2 col-xs-12">Descripción:</label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <textarea name="descripcion" class="form-control col-md-7 col-xs-12" readonly="readonly" v-model="lookKeep.descripcion"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="detalleRepuestos" class="row hidden">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Detalle Repuestos</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="close-link">
                                        <i class="fa fa-close"></i>
                                    </a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-md-5 col-sm-12 col-xs-12 form-group">
                                        
                                    </div>
                                    <div class="col-md-7 col-sm-12 col-xs-12 form-group">
                                        <a id="btn_repuesto" href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#createDetail"> Nuevo repuesto</a>    
                                    </div>
                                </div>
                                <table id="datatable" class="table dataTable no-footer table-hover" role="grid" aria-describedby="datatable_info">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre repuesto</th>
                                            <th>Descripción</th>
                                            <th>Proveedor</th>
                                            <th>Valor unitario</th>
                                            <th>cantidad</th>
                                            <th>monto</th>
                                            <th colspan="2">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="dtlKeep in dtlKeeps">
                                            <td>@{{ dtlKeep.id }}</td>
                                            <td>@{{ dtlKeep.nombre }}</td>
                                            <td>@{{ dtlKeep.descripcion }}</td>
                                            <td>@{{ dtlKeep.nomproveedor }}</td>
                                            <td>@{{ dtlKeep.valor }}</td>
                                            <td>@{{ dtlKeep.cantidad }}</td>
                                            <td>@{{ dtlKeep.monto }}</td>
                                            
                                            <td><a href="#" title="Eliminar" class="btn_eliminar glyphicon glyphicon glyphicon-trash pull-left" v-on:click.prevent="deleteDtlKeep(dtlKeep)" ></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                                {{--  <nav>
                                    <ul class="pagination">
                                        <li v-if="pagination.current_page > 1">
                                            <a href="#" @click.prevent="changePage(pagination.current_page - 1)">
                                                <span>Atras</span>
                                            </a>
                                        </li>
                                        <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '' ]" >
                                            <a href="#" @click.prevent="changePage(page)">
                                                @{{ page }}
                                            </a>
                                        </li>
                                        <li v-if="pagination.current_page < pagination.last_page">
                                            <a href="#" @click.prevent="changePage(pagination.current_page + 1)">
                                                <span>Siguiente</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>  --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.procesos.cotizacion.createMaster')
            @include('admin.procesos.cotizacion.updateMaster')
            @include('admin.procesos.cotizacion.createDetail')
            <input type="hidden" id="vhc" value="0">
        </div>
    </div>
    <!-- /page content -->
@endsection

@push('scripts')
    <script src="{{ asset("admin/proceso/cotizacion.js") }}"></script>
@endpush