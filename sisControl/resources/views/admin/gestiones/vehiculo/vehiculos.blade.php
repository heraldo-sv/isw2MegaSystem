@extends('layouts.blank')

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
        <div id="vehiculo" class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Gestión de vehiculos</h2>
                        <a id="new" href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#create"> Nuevo vehiculo</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-sm-12">
                            <table id="datatable" class="table dataTable no-footer table-hover" role="grid" aria-describedby="datatable_info">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Cliente</th>
                                        <th>Número de placa</th>
                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        <th>Año</th>
                                        <th>Aseguradora</th>
                                        <th colspan="2">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="keep in keeps">
                                        <td>@{{ keep.id }}</td>
                                        <td>@{{ keep.nomcliente }}</td>
                                        <td>@{{ keep.placa }}</td>
                                        <td>@{{ keep.marca }}</td>
                                        <td>@{{ keep.modelo }}</td>
                                        <td>@{{ keep.anio }}</td>
                                        <td>@{{ keep.nomaseguradora }}</td>
                                        
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
                            @include('admin.gestiones.vehiculo.create')
                            @include('admin.gestiones.vehiculo.update')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection

@push('scripts')
    <script src="{{ asset("admin/gestion/vehiculo.js") }}"></script>
@endpush