<form method="post" v-on:submit.prevent="createKeep">
    <div class="modal fade" id="create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                    <h4>Nuevo vehiculo</h4>
                </div>
                <div class="modal-body">
                    <label for="cliente">Cliente</label>
                    <select name="cliente" id="selCli01" class="form-control" v-model="newCliente">
                        <option v-for="cliente in clientes" v-bind:value="cliente.id">@{{ cliente.cliente }}</option>
                    </select>
                    <label for="placa">Placa</label>
                    <input id="focus" type="text" name="placa" class="form-control" v-model="newPlaca">
                    <label for="marca">Marca</label>
                    <input type="text" name="marca" class="form-control" v-model="newMarca">
                    <label for="modelo">Modelo</label>
                    <input type="text" name="modelo" class="form-control" v-model="newModelo">
                    <label for="anio">Año</label>
                    <input type="text" name="anio" class="form-control" v-model="newAnio">
                    <label for="aseguradora">Aseguradora</label>
                    <select name="aseguradora" id="selAse01" class="form-control" v-model="newAseguradora">
                        <option v-for="aseguradora in aseguradoras" v-bind:value="aseguradora.id">@{{ aseguradora.aseguradora }}</option>
                    </select>
                    <label for="complemento">Complemento</label>
                    <textarea name="complemento" class="form-control" v-model="newComplemento"></textarea>
                    <label for="comentario">Comentario</label>
                    <textarea name="comentario" class="form-control" v-model="newComentario"></textarea>
                    <span v-for="error in errors" class="text-danger">@{{ error }}</span>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" value="Guardar">
                </div>
            </div>
        </div>
    </div>
</form>