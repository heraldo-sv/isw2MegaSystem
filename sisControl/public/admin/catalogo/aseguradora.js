
new Vue({
    el: '#aseguradora',
    created: function(){
        this.getKeeps();
    },
    data: {
        keeps: [],
        newKeepName: '', newKeepDescription: '',
        fillKeep: {'id': '', 'nombre': '', 'descripcion': ''},
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
            var urlKeeps ='aseguradora?page='+page;
            axios.get(urlKeeps).then(response => {
                this.keeps = response.data.aseguradoras.data;
                this.pagination = response.data.pagination;
            });
        },
        deleteKeep: function(keep){
            var urlKeep = 'aseguradora/'+keep.id;
            axios.delete(urlKeep).then(response => {
                this.getKeeps(this.pagination.current_page);
                toastr.success('Eliminado correctamente');
            });
        },
        editKeep: function(keep){
            this.fillKeep.id          = keep.id;
            this.fillKeep.nombre      = keep.nombre;
            this.fillKeep.descripcion = keep.descripcion;
            $('#edit').modal('show');
        },
        updateKeep: function(id){
            var urlKeep = 'aseguradora/'+id;
            axios.put(urlKeep,this.fillKeep).then(response => {
                this.getKeeps(this.pagination.current_page);
                this.fillKeep = {'id': '', 'nombre': '', 'descripcion': ''};
                this.errors = [];
                $('#edit').modal('hide');
                toastr.success('Aseguradora actualizada con exito');
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        createKeep: function(){
            var urlKeep ='aseguradora';
            axios.post(urlKeep, {
                nombre: this.newKeepName,
                descripcion: this.newKeepDescription
            }).then(response =>{
                this.getKeeps();
                this.newKeepName = '';
                this.newKeepDescription = '';
                this.errors = [];
                $('#create').modal('hide');
                toastr.success('Nueva aseguradora agregada con exito');
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