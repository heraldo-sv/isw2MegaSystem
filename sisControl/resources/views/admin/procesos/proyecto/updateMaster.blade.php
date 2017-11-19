<form method="post" v-on:submit.prevent="updateKeep(fillKeep.id)">
    <div class="modal fade" id="updateMaster">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                    <h4>Actualizar proyecto</h4>
                </div>
                <div class="modal-body">
                    <label for="titulo">Titulo</label>
                    <input id="focus" type="text" name="titulo" class="form-control" disabled v-model="fillKeep.titulo">
                    <label for="cliente">Cliente</label>
                    <input type="text" name="cliente" class="form-control" disabled v-model="fillKeep.nomcliente">
                    <label for="vehiculo">Vehiculo</label>
                    <input type="text" name="vehiculo" class="form-control" disabled v-model="fillKeep.nomvehiculo">
                    <label for="estado">Estado</label>
                    <select name="estado" id="estado01" class="form-control">
                        <option v-for="estado in estados" v-bind:value="estado.codigo">@{{ estado.valor }}</option>
                    </select>
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" class="form-control" v-model="fillKeep.descripcion"></textarea>
                    <input type="hidden" name="progreso" v-model="newKeepProgreso">
                    <input type="hidden" name="progreso" v-model="newKeepEstado">
                    <span v-for="error in errors" class="text-danger">@{{ error }}</span>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" value="Guardar">
                </div>
            </div>
        </div>
    </div>
</form>