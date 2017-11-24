
new Vue({
    el: '#consulta',
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
        findProyecto: '', findCliente: '', findVehiculo: '',
        fillKeep: {'cliente': '', 'proyecto': '', 'placa': '', 'correo': ''},
        lookKeep: {'id': '', 'titulo': '', 'cliente': '', 'nomcliente': '', 'telcliente': '', 'vehiculo': '', 'nomvehiculo': '', 'descripcion': '', 'progreso': '', 'estado': ''},
    },
    methods: {
        /* -----------------------------------------------
        ** Metodos para obtener datos
        ** ----------------------------------------------- */ 
        getKeeps: function(){
            
            if ((this.findCliente).length > 0 && (this.findProyecto).length > 0 && (this.findVehiculo).length > 0) {
                var urlKeeps ='/consults/'+this.findProyecto+'/'+this.findCliente+'/'+this.findVehiculo;
                axios.get(urlKeeps).then(response => {
                    this.keeps = response.data[0];
                    if (this.keeps.id === undefined) {
                        toastr.warning('Los datos ingresados no retornaron resultados.');
                    } else {
                        this.getKeepsGnr(this.keeps);
                    }


                    // if (this.keeps.id > 0) {
                    //     this.getKeepsGnr(this.keeps);
                    // } else {
                    //     toastr.warning('Los datos ingresados no retornaron resultados.');
                    // }
                });
            }
        },
        getKeepsGnr: function(keep){
            
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

            this.getKeepsDtl(keep.id);

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