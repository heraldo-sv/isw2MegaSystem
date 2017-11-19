<form method="post" v-on:submit.prevent="createKeep">
    <div class="modal fade" id="create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                    <h4>Nuevo proveedor</h4>
                </div>
                <div class="modal-body">
                    <label for="nombre">Nombre</label>
                    <input id="focus" type="text" name="nombre" class="form-control" v-model="newKeepNombre">
                    <label for="description">Descripción</label>
                    <input type="text" name="descripcion" class="form-control" v-model="newKeepDescripcion">
                    <label for="direccion">Dirección</label>
                    <input type="text" name="direccion" class="form-control" v-model="newKeepDireccion">
                    <label for="telefono">Telefono</label>
                    <input id="focus" type="text" name="telefono" class="form-control" v-model="newKeepTelefono">
                    <span v-for="error in errors" class="text-danger">@{{ error }}</span>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" value="Guardar">
                </div>
            </div>
        </div>
    </div>
</form>