
new Vue({
    el: '#proveedor',
    created: function(){
        this.getKeeps();
    },
    data: {
        keeps: [],
        newKeepNombre: '', newKeepDescripcion: '', newKeepDireccion: '', newKeepTelefono: '',
        fillKeep: {'id': '', 'nombre': '', 'descripcion': '', 'direccion': '', 'telefono': ''},
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
            var urlKeeps ='proveedor?page='+page;
            axios.get(urlKeeps).then(response => {
                this.keeps = response.data.proveedores.data;
                this.pagination = response.data.pagination;
            });
        },
        deleteKeep: function(keep){
            var urlKeep = 'proveedor/'+keep.id;
            axios.delete(urlKeep).then(response => {
                this.getKeeps(this.pagination.current_page);
                toastr.success('Eliminado correctamente');
            });
        },
        editKeep: function(keep){
            this.fillKeep.id          = keep.id;
            this.fillKeep.nombre      = keep.nombre;
            this.fillKeep.descripcion = keep.descripcion;
            this.fillKeep.direccion   = keep.direccion;
            this.fillKeep.telefono    = keep.telefono;
            $('#edit').modal('show');
        },
        updateKeep: function(id){
            var urlKeep = 'proveedor/'+id;
            axios.put(urlKeep,this.fillKeep).then(response => {
                this.getKeeps(this.pagination.current_page);
                this.fillKeep = {'id': '', 'nombre': '', 'descripcion': '', 'direccion': '', 'telefono': ''};
                this.errors = [];
                $('#edit').modal('hide');
                toastr.success('Proveedor actualizado con exito');
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        createKeep: function(){
            var urlKeep ='proveedor';
            axios.post(urlKeep, {
                nombre: this.newKeepNombre,
                descripcion: this.newKeepDescripcion,
                direccion: this.newKeepDireccion,
                telefono: this.newKeepTelefono
            }).then(response =>{
                this.getKeeps();
                this.newKeepNombre = '';
                this.newKeepDescripcion = '';
                this.newKeepDireccion = '';
                this.newKeepTelefono = '';
                this.errors = [];
                $('#create').modal('hide');
                toastr.success('Proveedor agregado con exito');
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