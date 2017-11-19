@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
        <div id="cliente" class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Gestión de clientes</h2>
                        <a id="new" href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#create"> Nuevo cliente</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-sm-12">
                            <table id="datatable" class="table dataTable no-footer table-hover" role="grid" aria-describedby="datatable_info">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Numero documento</th>
                                        <th>Correo electronico</th>
                                        <th>Telefono</th>
                                        <th colspan="2">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="keep in keeps">
                                        <td>@{{ keep.id }}</td>
                                        <td>@{{ keep.nombre }}</td>
                                        <td>@{{ keep.apellido }}</td>
                                        <td>@{{ keep.documento }}</td>
                                        <td>@{{ keep.correo }}</td>
                                        <td>@{{ keep.telefono }}</td>
                                        
                                        <td><a href="#" class="glyphicon glyphicon-pencil pull-right" v-on:click.prevent="editKeep(keep)" ></a></td>
                                        <td><a href="#" class="glyphicon glyphicon-trash" v-on:click.prevent="deleteKeep(keep)"></a></td>
                                        
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
                            @include('admin.gestiones.cliente.create')
                            @include('admin.gestiones.cliente.update')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection

@push('scripts')
    <script src="{{ asset("admin/gestion/cliente.js") }}"></script>
@endpush