<form method="post" v-on:submit.prevent="updateKeep(fillKeep.id)">
    <div class="modal fade" id="edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                    <h4>Actualizar cliente</h4>
                </div>
                <div class="modal-body">
                    <label for="nombre">Nombres</label>
                    <input type="text" name="nombre" class="form-control" v-model="fillKeep.nombre">
                    <label for="apellido">Apellidos</label>
                    <input type="text" name="apellido" class="form-control" v-model="fillKeep.apellido">
                    <label for="documento">Numero de documento</label>
                    <input type="text" name="documento" class="form-control" v-model="fillKeep.documento">
                    <label for="correo">Correo electronico</label>
                    <input type="text" name="correo" class="form-control" v-model="fillKeep.correo">
                    <label for="telefono">Numero de telefono</label>
                    <input type="text" name="telefono" class="form-control" v-model="fillKeep.telefono">
                    <span v-for="error in errors" class="text-danger">@{{ error }}</span>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" value="Actualizar">
                </div>
            </div>
        </div>
    </div>
</form>