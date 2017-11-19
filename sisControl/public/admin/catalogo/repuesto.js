
new Vue({
    el: '#repuesto',
    created: function(){
        this.getKeeps();
        this.getProveedor();
    },
    data: {
        keeps: [], proveedors: [],
        newKeepNombre: '', newKeepDescripcion: '', newKeepProveedor: '', newKeepValor: '',
        fillKeep: {'id': '', 'nombre': '', 'descripcion': '', 'proveedor': '', 'nomproveedor': '', 'valor': ''},
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
        getProveedor: function () {
            var urlKeeps ='listproveedor';
            axios.get(urlKeeps).then(response => {
                this.proveedors = response.data
            });
        },
        getKeeps: function(page){
            var urlKeeps ='repuesto?page='+page;
            axios.get(urlKeeps).then(response => {
                this.keeps = response.data.repuestos.data;
                this.pagination = response.data.pagination;
            });
        },
        deleteKeep: function(keep){
            var urlKeep = 'repuesto/'+keep.id;
            axios.delete(urlKeep).then(response => {
                this.getKeeps(this.pagination.current_page);
                toastr.success('Eliminado correctamente');
            });
        },
        editKeep: function(keep){
            this.fillKeep.id          = keep.id;
            this.fillKeep.nombre      = keep.nombre;
            this.fillKeep.descripcion = keep.descripcion;
            this.fillKeep.proveedor   = keep.proveedor;
            this.fillKeep.valor       = keep.valor;
            $('#edit').modal('show');
        },
        updateKeep: function(id){
            var urlKeep = 'repuesto/'+id;
            axios.put(urlKeep,this.fillKeep).then(response => {
                this.getKeeps(this.pagination.current_page);
                this.fillKeep = {'id': '', 'nombre': '', 'descripcion': '', 'proveedor': '', 'valor': ''};
                this.errors = [];
                $('#edit').modal('hide');
                toastr.success('Repuesto actualizado con exito');
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        createKeep: function(){
            var urlKeep ='repuesto';
            axios.post(urlKeep, {
                nombre: this.newKeepNombre,
                descripcion: this.newKeepDescripcion,
                proveedor: this.newKeepProveedor,
                valor: this.newKeepValor
            }).then(response =>{
                this.getKeeps();
                this.newKeepNombre = '';
                this.newKeepDescripcion = '';
                this.newKeepProveedor = '';
                this.newKeepValor = '';
                this.errors = [];
                $('#create').modal('hide');
                toastr.success('Repuesto agregado con exito');
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