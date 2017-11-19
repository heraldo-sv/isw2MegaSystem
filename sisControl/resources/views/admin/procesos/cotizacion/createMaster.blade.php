<form method="post" v-on:submit.prevent="createKeep">
    <div class="modal fade" id="createMaster">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                    <h4>Nueva cotización</h4>
                </div>
                <div class="modal-body">
                    <label for="titulo">Titulo</label>
                    <input id="focus" type="text" name="titulo" class="form-control" v-model="newKeepTitulo">
                    <label for="cliente">Cliente</label>
                    <select name="cliente" v-model="newKeepCliente" class="form-control" v-on:change="getVehiculos">
                        <option v-for="cliente in clientes" v-bind:value="cliente.id">@{{ cliente.cliente }}</option>
                    </select>
                    <label for="vehiculo">Vehiculo</label>
                    <select name="vehiculo" v-model="newKeepVehiculo" class="form-control">
                        <option v-for="vehiculo in vehiculos" v-bind:value="vehiculo.id">@{{ vehiculo.nomvehiculo }}</option>
                    </select>
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" class="form-control" v-model="newKeepDescripcion"></textarea>
                    <input type="hidden" name="estado" v-model="newKeepEstado">
                    <input type="hidden" name="precio" v-model="newKeepPrecio">
                    <span v-for="error in errors" class="text-danger">@{{ error }}</span>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" value="Guardar">
                </div>
            </div>
        </div>
    </div>
</form>

