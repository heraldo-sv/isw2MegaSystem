@extends('layouts.blank')

@push('stylesheets')
    
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
        <div id="proyecto">
            <div id="maestroProyecto" class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Maestro proyecto</h2>
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
                                        {{--  <select id="selCli01" class="select2-clientes form-control">
                                            <option v-for="cliente in clientes" v-bind:value="cliente.id">@{{ cliente.cliente }}</option>
                                        </select>  
                                        <a id="btn" href="#" class="btn btn-danger pull-right" data-toggle="modal" data-target="#dtlimage">Test</a>
                                        --}}
                                    </div>
                                    <div class="col-md-7 col-sm-12 col-xs-12 form-group">
                                        <a id="btn_proyecto" href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#createMaster"> Nuevo proyecto</a>    
                                    </div>
                                </div>
                                <table id="datatable" class="table dataTable no-footer table-hover" role="grid" aria-describedby="datatable_info">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre cliente</th>
                                            <th>Vehiculo</th>
                                            <th>Titulo proyecto</th>
                                            <th>Progreso</th>
                                            <th>Estado</th>
                                            <th colspan="2">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="keep in keeps">
                                            <td>@{{ keep.id }}</td>
                                            <td>@{{ keep.nomcliente }}</td>
                                            <td>@{{ keep.nomvehiculo }}</td>
                                            <td>@{{ keep.titulo }}</td>
                                            <td>@{{ keep.nomprogreso }}</td>
                                            <td>@{{ keep.nomestado }}</td>
                                            
                                            <td><a href="#" title="Ver detalles" class="glyphicon glyphicon glyphicon-th-list pull-right" v-on:click.prevent="getKeepsGnr(keep)" ></a></td>
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
            <div id="detalleProyecto" class="row hidden">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>
                                Detalle proyecto
                                <i id="pro" class="fa fa-dot-circle-o hide" style="color:#1abb9c" data-toggle="tooltip" data-placement="right" title="" data-original-title="En proceso"></i>
                                <i id="pau" class="fa fa-dot-circle-o hide" style="color: rgb(226, 226, 0)" data-toggle="tooltip" data-placement="right" title="" data-original-title="En pausa"></i>
                                <i id="fin" class="fa fa-dot-circle-o hide" data-toggle="tooltip" data-placement="right" title="" data-original-title="Finalizado"></i>
                                <i id="can" class="fa fa-circle-o hide" data-toggle="tooltip" data-placement="right" title="" data-original-title="Cancelado"></i>
                            </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a id="dtl" class="collapse-link">
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
                                <a id="btn_etapa" href="#" class="btn btn-danger pull-right"    data-toggle="modal" data-target="#changeDetail" class="form-group">Cambio de etapa</a>
                                <a id="btn_entrada" href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#createDetail" class="form-group">Nueva entrada</a>    
                                <br><br>
                                <div id="wizard" class="form_wizard wizard_horizontal">
                                    <div class="content">
                                        <div class="form-horizontal form-label-left">
                                            <div class="form-group">
                                                <label for="titulo" class="control-label col-md-2 col-sm-2 col-xs-12">Titulo:</label>
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <input type="text" name="titulo" readonly="readonly" class="form-control col-md-7 col-xs-12" v-model="lookKeep.titulo">
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
                                                    <label for="telefono" class="control-label col-md-2 col-sm-2 col-xs-12">Telefono:</label>
                                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                                        <input type="text" name="telefono" readonly="readonly" class="form-control col-md-7 col-xs-12" v-model="lookKeep.telcliente">
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
                                                <label for="descripcion" class="control-label col-md-2 col-sm-2 col-xs-12">Descripción:</label>
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <textarea name="descripcion" class="form-control col-md-7 col-xs-12" readonly="readonly" v-model="lookKeep.descripcion"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <ul class="wizard_steps anchor">
                                        <li>
                                            <a id="eta1" href="#" class="disabled">
                                                <span class="step_no">1</span>
                                                <span class="step_descr">
                                                    Etapa 1<br>
                                                    <small>Ingreso de vehiculos</small>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a id="eta2" href="#" class="disabled">
                                                <span class="step_no">2</span>
                                                <span class="step_descr">
                                                    Etapa 2<br>
                                                    <small>Desarrollo de actividades</small>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a id="eta3" href="#" class="disabled">
                                                <span class="step_no">3</span>
                                                <span class="step_descr">
                                                    Etapa 3<br>
                                                    <small>Finalización de actividades</small>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a id="eta4" href="#" class="disabled">
                                                <span class="step_no">4</span>
                                                <span class="step_descr">
                                                    Etapa 4<br>
                                                    <small>Entregado, cierre de proyecto</small>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <ul class="list-unstyled timeline">
                                    <li v-for="dtlKeep in dtlKeeps">
                                        <div class="block">
                                            <div class="tags">
                                                <a href="" class="tag">
                                                    <span>Etapa @{{ dtlKeep.etapa }}</span>
                                                </a>
                                            </div>
                                            <div class="block_content">
                                                <h2 class="title">
                                                    <a>@{{ dtlKeep.titulo }}</a>
                                                </h2>
                                                <div class="byline">
                                                    <span>@{{ dtlKeep.created_at }}</span> por <a>@{{ dtlKeep.nomuser }}</a>
                                                </div>
                                                <p class="excerpt">
                                                    @{{ dtlKeep.descripcion }}
                                                </p>
                                                <button id="btn_getImage" type="button" class="btn btn-info btn-xs" v-on:click.prevent="dtlGetImage(dtlKeep)">Capturas</button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.procesos.proyecto.createMaster')
            @include('admin.procesos.proyecto.updateMaster')
            @include('admin.procesos.proyecto.createDetail')
            @include('admin.procesos.proyecto.changeDetail')
            @include('admin.procesos.proyecto.photoDetail')
            @include('admin.procesos.proyecto.photoShow')
            <input type="hidden" id="flag" value="1">
            <input type="hidden" id="chg">
            <input type="hidden" id="hst" value="{{ Request::root() }}">
        </div>
    </div>
    <!-- /page content -->
@endsection

@push('scripts')
    <script src="{{ asset("admin/proceso/proyecto.js") }}"></script>
@endpush