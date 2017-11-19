
new Vue({
    el: '#clienteproyecto',
    created: function(){
    },
    data: {
        keeps: [],
        errors: [],
        clientes: [],
        lkCliente: '',
        /* -----------------------------------------------
        ** Objetos para la tabla maestra
        ** ----------------------------------------------- */ 
        dtlKeeps: [], dtlImages: [],
        findCliente: '', findProyecto: '', findPlaca: '', findCorreo: '',
        fillKeep: {'cliente': '', 'proyecto': '', 'placa': '', 'correo': ''},
        lookKeep: {'id': '', 'titulo': '', 'cliente': '', 'nomcliente': '', 'telcliente': '', 'vehiculo': '', 'nomvehiculo': '', 'descripcion': '', 'progreso': '', 'estado': ''},
    },
    methods: {
        /* -----------------------------------------------
        ** Metodos para obtener datos
        ** ----------------------------------------------- */ 
        getKeeps: function(){
            
            if ((this.findCliente).length > 0 && (this.findProyecto).length > 0 && (this.findPlaca).length > 0 && (this.findCorreo).length > 0) {
                //var urlKeeps ='/proyecto/cliente/'+this.findCliente+'/'+this.findProyecto+'/'+this.findPlaca+'/'+this.findCorreo;
                var urlKeeps ='/consulta/proyecto';
                alert(urlKeeps);
                axios.get(urlKeeps).then(response => {
                    var json = response.data.proyecto

                    alert(json);

                    //this.getKeepsGnr(this.keeps);


                    // if ((this.keeps.id).length > 0) {
                    //     getKeepsGnr(this.keeps);
                    // } else {
                    //     toastr.warning('Los datos ingresados no retornaron resultados.');
                    // }
                });
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
            
            $('#detalleProyecto').removeClass('hidden');
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