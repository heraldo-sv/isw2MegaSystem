<form method="post" v-on:submit.prevent="createKeep">
    <div class="modal fade" id="createMaster">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                    <h4>Nuevo proyecto</h4>
                </div>
                <div class="modal-body">
                    <label for="titulo">Titulo</label>
                    <input id="focus" type="text" name="titulo" class="form-control" v-model="newKeepTitulo">
                    <label for="cliente">Cliente</label>
                    <select name="cliente" id="selCli02" class="select2-clientes disabled" style="width: 100%">
                        <option v-for="cliente in clientes" v-bind:value="cliente.id">@{{ cliente.cliente }}</option>
                    </select>
                    <label for="vehiculo">Vehiculo</label>
                    <input type="text" name="vehiculo" class="form-control" v-model="newKeepVehiculo">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" class="form-control" v-model="newKeepDescripcion"></textarea>
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

