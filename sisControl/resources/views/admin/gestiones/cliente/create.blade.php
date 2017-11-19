<form method="post" v-on:submit.prevent="createKeep">
    <div class="modal fade" id="create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                    <h4>Nuevo cliente</h4>
                </div>
                <div class="modal-body">
                    <label for="nombre">Nombres</label>
                    <input id="focus" type="text" name="nombre" class="form-control" v-model="newKeepNombre">
                    <label for="apellido">Apellidos</label>
                    <input type="text" name="apellido" class="form-control" v-model="newKeepApellido">
                    <label for="documento">Numero de documento</label>
                    <input type="text" name="documento" class="form-control" v-model="newKeepDocumento">
                    <label for="correo">Correo electronico</label>
                    <input type="text" name="correo" class="form-control" v-model="newKeepCorreo">
                    <label for="telefono">Telefono</label>
                    <input type="text" name="telefono" class="form-control" v-model="newKeepTelefono">
                    <span v-for="error in errors" class="text-danger">@{{ error }}</span>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" value="Guardar">
                </div>
            </div>
        </div>
    </div>
</form>