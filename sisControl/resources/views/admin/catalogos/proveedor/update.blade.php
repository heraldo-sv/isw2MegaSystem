<form method="post" v-on:submit.prevent="updateKeep(fillKeep.id)">
    <div class="modal fade" id="edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                    <h4>Actualizar proveedor</h4>
                </div>
                <div class="modal-body">
                    <label for="nombre">Nombre</label>
                    <input id="focus" type="text" name="nombre" class="form-control" v-model="fillKeep.nombre">
                    <label for="description">Descripción</label>
                    <input type="text" name="descripcion" class="form-control" v-model="fillKeep.descripcion">
                    <label for="direccion">Dirección</label>
                    <input type="text" name="direccion" class="form-control" v-model="fillKeep.direccion">
                    <label for="telefono">Telefono</label>
                    <input id="focus" type="text" name="telefono" class="form-control" v-model="fillKeep.telefono">
                    <span v-for="error in errors" class="text-danger">@{{ error }}</span>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" value="Actualizar">
                </div>
            </div>
        </div>
    </div>
</form>