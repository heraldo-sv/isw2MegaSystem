$(document).ready(function() {
    /* Oculta detalle proyecto */
    $('#dtl').click();
    /* Operaciones antes de abrir el modal de nuevo proyecto */
    $('#btn_proyecto').click(function () {
        $('#selCli02').val(null).trigger('change');
    });
    /* Operaciones antes de abrir el modal de nueva etapa */
    $('#btn_etapa').click(function () {
        $('#chg').val('etapa');
    });
    /* Operaciones antes de abrir el modal de cambio de etapa */
    $('#btn_entrada').click(function () {
        $('#chg').val('entrada');
    });
    /* Operaciones para Select2 JS */
    $('.select2-clientes').select2({
        placeholder: 'Seleccione un cliente',
        allowClear: true,
        language: {
            noResults: function (params) {
                return "Sin resultados.";
            }
          },
          closeOnSelect: true
    });
    /* Operaciones para Dropzone */
    Dropzone.options.dtlfileupload = {
        paramName: "file", // Las imágenes se van a usar bajo este nombre de parámetro
        maxFilesize: 2, // Tamaño máximo en MB
        acceptedFiles: ".jpeg,.jpg,.png,.JPEG,.JPG,.PNG",// Archivos permitidos
        addRemoveLinks: true, // Permite eliminar archivos cargados
        dictInvalidFileType: 'Arvhivo invalido', // Mensaje al seleccionar un archivo no valido
        dictDefaultMessage: 'Arrastrar o clic para subir una o varias imagenes', // Mensaje en el area del objeto
        dictRemoveFile: 'Remover imagen', // Descripción en el enlace para eliminar imagenes
        init: function() { // Eventos de Dropzone
            this.on("success", function(file, response) { // Al cargar correctamente una imagen
                var json = jQuery.parseJSON(file.xhr.response);
                var url = 'imagen/' + $('#hst').val();
                axios.put(url,json).then(response => {
                    toastr.success('Imagen: ' + file.name + ', Cargada con exito');
                });
            });
            this.on("removedfile", function(file, response) { // Al eliminar una imagen del listado
                var json = jQuery.parseJSON(file.xhr.response);
                var url = 'imagen/' + json.id;
                axios.delete(url).then(response => {
                    toastr.success('Imagen eliminada correctamente');
                });
            });
        }
    };
});

new Vue({
    el: '#proyecto',
    created: function(){
        this.getKeeps();
        this.getClientes();
        this.getEstados();
    },
    data: {
        errors: [],
        pagination: {
            'total'         : 0,
            'current_page'  : 0,
            'per_page'      : 0,
            'last_page'     : 0,
            'from'          : 0,
            'to'            : 0
        },
        offSet: 2,
        clientes: [], estados: [],
        lkCliente: '',
        /* -----------------------------------------------
        ** Objetos para la tabla maestra
        ** ----------------------------------------------- */ 
        keeps: [],
        newKeepTitulo: '', newKeepCliente: '', newKeepVehiculo: '', newKeepDescripcion: '', newKeepProgreso: '', newKeepEstado: '',
        fillKeep: {'id': '', 'titulo': '', 'cliente': '', 'nomcliente': '', 'vehiculo': '', 'nomvehiculo': '', 'descripcion': '', 'progreso': '', 'estado': ''},
        /* -----------------------------------------------
        ** Objetos para la tabla detalle
        ** ----------------------------------------------- */ 
        dtlKeeps: [], dtlImages: [],
        dtlKeepProyecto: '', dtlKeepUser: '', dtlKeepTitulo: '', dtlKeepEtapa: '', dtlKeepDescripcion: '',
        filldtlKeep: {'id': '', 'proyecto': '', 'user': '', 'titulo': '', 'etapa': '', 'descripcion': ''},
        lookKeep: {'id': '', 'titulo': '', 'cliente': '', 'nomcliente': '', 'telcliente': '', 'vehiculo': '', 'nomvehiculo': '', 'descripcion': '', 'progreso': '', 'estado': ''},
    },
    computed: {
        isActived: function () {
            return this.pagination.current_page;
        },
        pagesNumber: function () {
            if (!this.pagination.to) {
                return [];
            }
            var from = this.pagination.current_page - this.offSet; // TODO offSet
            if (from < 1) { from = 1; }
            var to = from + (this.offSet*2); // TODO
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },
    methods: {
        changePage: function (page) {
            this.pagination.current_page = page;
            this.getKeeps(page);
        },
        generalValidation: function (keep) {
            switch (keep.estado) {
                case 1: // En Progreso
                    
                    break;
                case 2: // En pausa
                    break;
                case 3: // Finalizado
                    toastr.info('El proyecto se encuentra finalizado y no puede modificarse');
                    return false;
                case 4: // Cancelado
                    toastr.warning('El proyecto se encuentra cancelado y no puede modificarse');
                    return false;
            }
            return true;
        },
        getClientes: function () {
            var urlKeeps ='listcliente';
            axios.get(urlKeeps).then(response => {
                this.clientes = response.data
            });
        },
        getEstados: function () {
            var urlKeeps ='catalogoconfig/ESTADOPROY';
            axios.get(urlKeeps).then(response => {
                this.estados = response.data
            });
        },
        /* -----------------------------------------------
        ** Metodos para la tabla maestra
        ** ----------------------------------------------- */ 
        getKeeps: function(page){
            var urlKeeps ='proyecto?page='+page;
            axios.get(urlKeeps).then(response => {
                this.keeps = response.data.proyectos.data
                this.pagination = response.data.pagination
            });
        },
        deleteKeep: function(keep){
            var urlKeep = 'proyecto/'+keep.id;
            axios.delete(urlKeep).then(response => {
                this.getKeeps(this.pagination.current_page);
                toastr.success('Proyecto eliminado correctamente');
            });
        },
        editKeep: function(keep){
            if (this.generalValidation(keep)) {
                this.fillKeep.id          = keep.id;
                this.fillKeep.titulo      = keep.titulo;
                this.fillKeep.cliente     = keep.cliente;
                this.fillKeep.nomcliente  = keep.nomcliente;
                this.fillKeep.vehiculo    = keep.vehiculo;
                this.fillKeep.nomvehiculo = keep.nomvehiculo;
                this.fillKeep.descripcion = keep.descripcion;
                this.fillKeep.progreso    = keep.progreso;
                this.fillKeep.estado      = keep.estado;
                $("#estado01").val(keep.estado);
                $('#updateMaster').modal('show');
            }
        },
        updateKeep: function(id){
            var urlKeep = 'proyecto/'+id;
            this.fillKeep.estado = $("#estado01").val();
            axios.put(urlKeep,this.fillKeep).then(response => {
                this.getKeeps(this.pagination.current_page);
                this.getEstado(this.fillKeep.estado);
                this.fillKeep = {'id': '', 'titulo': '', 'cliente': '', 'vehiculo': '', 'descripcion': '', 'progreso': '', 'estado': ''};
                this.errors = [];
                $('#updateMaster').modal('hide');
                toastr.success('Proyecto actualizado con exito');
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        createKeep: function(){
            var urlKeep ='proyecto';
            axios.post(urlKeep, {
                titulo: this.newKeepTitulo,
                cliente: $('#selCli02').select2('val'), //this.newKeepCliente,
                vehiculo: this.newKeepVehiculo,
                descripcion: this.newKeepDescripcion,
                progreso: 1, //this.newKeepProgreso,
                estado: 1 //this.newKeepEstado
            }).then(response =>{
                this.getKeeps();
                this.newKeepTitulo ='';
                this.newKeepCliente = '';
                this.newKeepVehiculo = '';
                this.newKeepDescripcion = '';
                this.newKeepProgreso = '';
                this.newKeepEstado = '';
                this.errors = [];
                $('#createMaster').modal('hide');
                toastr.success('Proyecto agregado con exito');
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        /* -----------------------------------------------
        ** Metodos para la tabla detalle
        ** ----------------------------------------------- */
        getKeepsDtl: function (id) {
            var urlKeeps ='dtlproyecto/'+id;
            axios.get(urlKeeps).then(response => {
                this.dtlKeeps = response.data
            });
        },
        getEtapa: function (etapa) {
            $('#eta1').addClass('disabled').removeClass('done').removeClass('selected');
            $('#eta2').addClass('disabled').removeClass('done').removeClass('selected');
            $('#eta3').addClass('disabled').removeClass('done').removeClass('selected');
            $('#eta4').addClass('disabled').removeClass('done').removeClass('selected');
            switch (etapa) {
                case 1: // Etapa 1: Ingreso
                    $('#eta1').addClass('done').removeClass('disabled');
                    $('#eta2').addClass('disabled');
                    $('#eta3').addClass('disabled');
                    $('#eta4').addClass('disabled');
                    break;
                case 2: // Etapa 2: Desarrollo
                    $('#eta1').addClass('selected').removeClass('disabled').removeClass('done');
                    $('#eta2').addClass('done').removeClass('disabled');
                    $('#eta3').addClass('disabled');
                    $('#eta4').addClass('disabled');
                    break;
                case 3: // Etapa 3: Finalización
                    $('#eta1').addClass('selected').removeClass('disabled').removeClass('done');
                    $('#eta2').addClass('selected').removeClass('disabled').removeClass('done');
                    $('#eta3').addClass('done').removeClass('disabled');
                    $('#eta4').addClass('disabled');
                    break;
                case 4: // Etapa 4: Entregado
                    $('#eta1').addClass('selected').removeClass('disabled').removeClass('done');
                    $('#eta2').addClass('selected').removeClass('disabled').removeClass('done');
                    $('#eta3').addClass('selected').removeClass('disabled').removeClass('done');
                    $('#eta4').addClass('done').removeClass('disabled');

                    $('#btn_etapa').addClass('disabled');
                    $('#btn_entrada').addClass('disabled');

                    break;
            }
        },
        getEstado: function (estado) {
            switch (parseInt(estado)) {
                case 1: // En Progreso
                    $('#pro').removeClass('hide');
                    $('#pau').addClass('hide');
                    $('#fin').addClass('hide');
                    $('#can').addClass('hide');

                    $('#btn_entrada').removeClass('disabled');
                    $('#btn_etapa').removeClass('disabled');
                    
                    break;
                case 2: // En pausa
                    $('#pro').addClass('hide');
                    $('#pau').removeClass('hide');
                    $('#fin').addClass('hide');
                    $('#can').addClass('hide');

                    $('#btn_entrada').removeClass('disabled');
                    $('#btn_etapa').addClass('disabled');
                    
                    break;
                case 3: // Finalizado
                    $('#pro').addClass('hide');
                    $('#pau').addClass('hide');
                    $('#fin').removeClass('hide');
                    $('#can').addClass('hide');
                    
                    $('#btn_entrada').addClass('disabled');
                    $('#btn_etapa').addClass('disabled');
                    
                    break;
                case 4: // Cancelado
                    $('#pro').addClass('hide');
                    $('#pau').addClass('hide');
                    $('#fin').addClass('hide');
                    $('#can').removeClass('hide');

                    $('#btn_entrada').addClass('disabled');
                    $('#btn_etapa').addClass('disabled');
                    
                    break;
            }
        },
        getKeepsGnr: function(keep){
            
            this.getKeepsDtl(keep.id);
            
            this.lookKeep.titulo      = keep.titulo;
            this.lookKeep.cliente     = keep.cliente;
            this.lookKeep.nomcliente  = keep.nomcliente;
            this.lookKeep.telcliente  = keep.telcliente;
            this.lookKeep.vehiculo    = keep.vehiculo;
            this.lookKeep.nomvehiculo = keep.nomvehiculo;
            this.lookKeep.descripcion = keep.descripcion;
            this.lookKeep.progreso    = keep.progreso;
            this.lookKeep.estado      = keep.estado;

            this.dtlKeepProyecto      = keep.id;
            this.dtlKeepEtapa         = keep.progreso;
            this.dtlKeepUser          = $('#apk').val(); //.. Identificador usuario

            this.getEstado(keep.estado);
            this.getEtapa(keep.progreso);

            if ($('#flag').val() == '1') { $('#dtl').click(); $('#flag').val('0'); }
            $('#detalleProyecto').removeClass('hidden');
        },
        dtlCreateKeep: function(){
            var urlKeep ='dtlproyecto';
            if ($('#chg').val() == 'etapa') {
                this.dtlKeepEtapa += 1;
            }
            axios.post(urlKeep, {
                proyecto: this.dtlKeepProyecto,
                user: this.dtlKeepUser,
                titulo: this.dtlKeepTitulo,
                etapa: this.dtlKeepEtapa,
                descripcion: this.dtlKeepDescripcion
            }).then(response =>{
                this.dtlKeeps = response.data;
                this.getKeepsDtl(this.dtlKeeps.proyecto);
                switch ($('#chg').val()) {
                    case 'etapa':
                        this.getKeeps(this.pagination.current_page);
                        this.getEtapa(this.dtlKeepEtapa);
                        $('#changeDetail').modal('hide');
                        toastr.success('Cambio de etapa generada con exito');
                        break;
                    case 'entrada':
                        $('#createDetail').modal('hide');
                        toastr.success('Entrada generada con exito');
                        break;
                }
              /*this.dtlKeepUser = '';
                this.dtlKeepProyecto = '';
                this.dtlKeepEtapa = '';*/
                this.dtlKeepTitulo = '';
                this.dtlKeepDescripcion = '';
                this.errors = [];
                this.dtlCreImage(this.dtlKeeps);
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        dtlCreImage: function (dtlKeeps) {
            $('#hst').val(dtlKeeps.id);
            $('#dtlfile').modal('show');
        },
        dtlDeteleImage: function (keep) {
            var urlKeep = 'imagen/' + keep.id;
            axios.delete(url).then(response => {
                toastr.success('Imagen eliminada correctamente');
            });
        },
        dtlGetImage: function (dtlKeeps) {
            var urlKeeps ='imagen/'+dtlKeeps.id;
            axios.get(urlKeeps).then(response => {
                this.dtlImages = response.data;
                $('#carousel_li_active').addClass('active');
                $('#carousel_di_active').addClass('active');
                $('.carousel-it-active').removeClass('active');
                $('#dtlimage').modal('show');
            });
        }
    }
});