<form method="post" v-on:submit.prevent="createKeep">
    <div class="modal fade" id="create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                    <h4>Nuevo repuesto</h4>
                </div>
                <div class="modal-body">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" v-model="newKeepNombre">
                    <label for="description">Descripción</label>
                    <input type="text" name="descripcion" class="form-control" v-model="newKeepDescripcion">
                    <label for="proveedor">Proveedor</label>
                    <select name="proveedor" v-model="newKeepProveedor" class="form-control">
                        <option v-for="proveedor in proveedors" v-bind:value="proveedor.id">@{{ proveedor.nomproveedor }}</option>
                    </select>
                    <label for="valor">Valor</label>
                    <input type="text" name="valor" class="form-control" v-model="newKeepValor">
                    <span v-for="error in errors" class="text-danger">@{{ error }}</span>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" value="Guardar">
                </div>
            </div>
        </div>
    </div>
</form>