
new Vue({
    el: '#cliente',
    created: function(){
        this.getKeeps();
    },
    data: {
        keeps: [],
        newKeepNombre: '', newKeepApellido: '', newKeepDocumento: '', newKeepCorreo: '', newKeepTelefono: '',
        fillKeep: {'id': '', 'nombre': '', 'apellido': '', 'documento': '', 'correo': '', 'telefono': ''},
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
        getKeeps: function(page){
            var urlKeeps ='cliente?page='+page;
            axios.get(urlKeeps).then(response => {
                this.keeps = response.data.clientes.data
                this.pagination = response.data.pagination
            });
        },
        deleteKeep: function(keep){
            var urlKeep = 'cliente/'+keep.id;
            axios.delete(urlKeep).then(response => {
                this.getKeeps(this.pagination.current_page);
                toastr.success('Eliminado correctamente');
            });
        },
        editKeep: function(keep){
            this.fillKeep.id          = keep.id;
            this.fillKeep.nombre      = keep.nombre;
            this.fillKeep.apellido    = keep.apellido;
            this.fillKeep.documento   = keep.documento;
            this.fillKeep.correo      = keep.correo;
            this.fillKeep.telefono    = keep.telefono;
            $('#edit').modal('show');
        },
        updateKeep: function(id){
            var urlKeep = 'cliente/'+id;
            axios.put(urlKeep,this.fillKeep).then(response => {
                this.getKeeps(this.pagination.current_page);
                this.fillKeep = {'id': '', 'nombre': '', 'apellido': '', 'documento': '', 'correo': '', 'telefono': ''};
                this.errors = [];
                $('#edit').modal('hide');
                toastr.success('Cliente actualizado con exito');
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        createKeep: function(){
            var urlKeep ='cliente';
            axios.post(urlKeep, {
                nombre: this.newKeepNombre,
                apellido: this.newKeepApellido,
                documento: this.newKeepDocumento,
                correo: this.newKeepCorreo,
                telefono: this.newKeepTelefono
            }).then(response =>{
                this.getKeeps();
                this.newKeepNombre = '';
                this.newKeepApellido = '';
                this.newKeepDocumento = '';
                this.newKeepCorreo = '';
                this.newKeepTelefono = '';
                this.errors = [];
                $('#create').modal('hide');
                toastr.success('Cliente agregado con exito');
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