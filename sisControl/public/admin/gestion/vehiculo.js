
new Vue({
    el: '#vehiculo',
    created: function(){
        this.getKeeps();
        this.getClientes();
        this.getAseguradoras();
    },
    data: {
        keeps: [], clientes: [], aseguradoras: [],
        newCliente: '', newPlaca: '', newMarca: '', newModelo: '', newAnio: '', newAseguradora: '', newComplemento: '', newComentario: '',
        fillKeep: {'id': '', 'cliente': '', 'placa': '', 'marca': '', 'modelo': '', 'anio': '', 'aseguradora': '', 'complemento': '', 'comentario': ''},
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
        getClientes: function () {
            var urlKeeps ='listcliente';
            axios.get(urlKeeps).then(response => {
                this.clientes = response.data
            });
        },
        getAseguradoras: function () {
            var urlKeeps ='listaseguradora';
            axios.get(urlKeeps).then(response => {
                this.aseguradoras = response.data
            });
        },
        getKeeps: function(page){
            var urlKeeps ='vehiculo?page='+page;
            axios.get(urlKeeps).then(response => {
                this.keeps = response.data.vehiculos.data
                this.pagination = response.data.pagination
            });
        },
        deleteKeep: function(keep){
            var urlKeep = 'vehiculo/'+keep.id;
            axios.delete(urlKeep).then(response => {
                this.getKeeps(this.pagination.current_page);
                toastr.success('Eliminado correctamente');
            });
        },
        editKeep: function(keep){

            this.fillKeep.id            = keep.id;
            this.fillKeep.cliente       = keep.cliente;
            this.fillKeep.placa         = keep.placa;
            this.fillKeep.marca         = keep.marca;
            this.fillKeep.modelo        = keep.modelo;
            this.fillKeep.anio          = keep.anio;
            this.fillKeep.aseguradora   = keep.aseguradora;
            this.fillKeep.complemento   = keep.complemento;
            this.fillKeep.comentario    = keep.comentario;

            $('#edit').modal('show');
        },
        updateKeep: function(id){
            var urlKeep = 'vehiculo/'+id;
            axios.put(urlKeep,this.fillKeep).then(response => {
                this.getKeeps(this.pagination.current_page);
                this.fillKeep = {'id': '', 'cliente': '', 'placa': '', 'marca': '', 'modelo': '', 'anio': '', 'aseguradora': '', 'complemento': '', 'comentario': ''};
                this.errors = [];
                $('#edit').modal('hide');
                toastr.success('Vehiculo actualizado con exito');
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        createKeep: function(){
            var urlKeep ='vehiculo';
            axios.post(urlKeep, {
                cliente:     this.newCliente,
                placa:       this.newPlaca,
                marca:       this.newMarca,
                modelo:      this.newModelo,
                anio:        this.newAnio,
                aseguradora: this.newAseguradora,
                complemento: this.newComplemento,
                comentario:  this.newComentario,
                estado:      1
            }).then(response =>{
                this.getKeeps();
                this.newPlaca  = '';
                this.newMarca  = '';
                this.newModelo = '';
                this.newAnio   = '';
                this.newAseguradora = '';
                this.newComplemento = '';
                this.newComentario  = '';
                this.errors = [];
                $('#create').modal('hide');
                toastr.success('Vehiculo agregado con exito');
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        changePage: function (page) {
            this.pagination.current_page = page;
            this.getKeeps(page);
        }
    }
});