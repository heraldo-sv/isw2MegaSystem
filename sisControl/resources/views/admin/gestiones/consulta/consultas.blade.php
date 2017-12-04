@extends('layouts.outfit')

@section('main_container')
    <!-- page content -->
    <div class="right_col" role="main">
        <div id="consulta">
            <div class="login_wrapper" style="max-width: 800px;">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Consulta de proyectos</h2>
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
                                <!-- start form for validation -->
                                <form id="demo-form2" data-parsley-validate method="get" role="search" v-on:submit.prevent="getKeeps">
                                    <label for="proyecto">Número único proyecto: *</label>
                                    <input type="text" id="proyecto" class="form-control" name="proyecto" data-parsley-pattern="^[0-9]*$" required v-model="findProyecto" />
                                    <label for="cliente">Número documento cliente: *</label>
                                    <input type="text" id="cliente" class="form-control" name="cliente" data-parsley-pattern="^[0-9\-]*$" required v-model="findCliente"/>
                                    <label for="placa">Número de placa del vehículo: *</label>
                                    <input type="text" id="placa" class="form-control" name="placa" data-parsley-pattern="^[0-9\-\A-Z]*$" required v-model="findVehiculo" />
                                    {{--  <label for="correo">Correo electrónico: *</label>
                                    <input type="email" id="correo" class="form-control" name="correo" data-parsley-trigger="change" required v-model="findCorreo" />  --}}
                                    <!-- <label for="message">Message (20 chars min, 100 max) :</label>
                                    <textarea id="message" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                                    data-parsley-validation-threshold="10"></textarea> -->
                                    <br/>
                                    <input type="submit" class="btn btn-primary" value="Consultar información">
                                    <a href="{{ url('/') }}">Pagina principal</a>
                                    <br/>
                                    <span class="parsley-required" style="color: red" v-for="error in errors" class="text-danger">@{{ error }}</span>
                                </form>
                                <!-- end form for validations -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="detalleProyecto" class="login_wrapper hidden" style="max-width: 1200px;">
                <div class="row">
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
                                <div id="wizard" class="form_wizard wizard_horizontal">
                                    <!-- Datos principales del proyecto -->
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
                                    <!-- Datos principales del proyecto -->
                                    <div class="ln_solid"></div>
                                    <!-- Etapas del proyecto -->
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
                                    <!-- Etapas del proyecto -->
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
            @include('admin.procesos.proyecto.photoShow')
        </div>
    </div>
    <!-- /page content -->
@endsection

@push('scripts')
    <script src="{{ asset("admin/gestion/consulta.js") }}"></script>
@endpush
