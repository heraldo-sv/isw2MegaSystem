@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
        <div id="aseguradora" class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Catalogo de aseguradoras</h2>
                        <a id="new" href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#create"> Nueva aseguradora</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-sm-12">
                            <table id="datatable" class="table dataTable no-footer table-hover" role="grid" aria-describedby="datatable_info">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" style="width: 263px;" aria-sort="ascending">Nombre</th>
                                        <th>Descripción</th>
                                        <th colspan="2">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="keep in keeps">
                                        <td>@{{ keep.id }}</td>
                                        <td>@{{ keep.nombre }}</td>
                                        <td>@{{ keep.descripcion }}</td>
                                        
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
                            @include('admin.catalogos.aseguradora.create')
                            @include('admin.catalogos.aseguradora.update')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection

@push('scripts')
    <script src="{{ asset("admin/catalogo/aseguradora.js") }}"></script>
@endpush