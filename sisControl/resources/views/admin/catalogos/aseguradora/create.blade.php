<form method="post" v-on:submit.prevent="createKeep">
    <div class="modal fade" id="create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                    <h4>Nueva aseguradora</h4>
                </div>
                <div class="modal-body">
                    <label for="name">Aseguradora</label>
                    <input id="focus" type="text" name="nombre" class="form-control" v-model="newKeepName">
                    <label for="description">Descripción</label>
                    <input type="text" name="descripcion" class="form-control" v-model="newKeepDescription">
                    <span v-for="error in errors" class="text-danger">@{{ error }}</span>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" value="Guardar">
                </div>
            </div>
        </div>
    </div>
</form>