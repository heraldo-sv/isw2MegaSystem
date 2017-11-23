<form method="post" v-on:submit.prevent="updateKeep(fillKeep.id)">
    <div class="modal fade" id="edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                    <h4>Actualizar vehiculo</h4>
                </div>
                <div class="modal-body">
                    <label for="cliente">Cliente</label>
                    <select name="cliente" id="selCli01" class="form-control" v-model="fillKeep.cliente">
                        <option v-for="cliente in clientes" v-bind:value="cliente.id">@{{ cliente.cliente }}</option>
                    </select>
                    <label for="placa">Placa</label>
                    <input id="focus" type="text" name="placa" class="form-control" v-model="fillKeep.placa">
                    <label for="marca">Marca</label>
                    <input type="text" name="marca" class="form-control" v-model="fillKeep.marca">
                    <label for="modelo">Modelo</label>
                    <input type="text" name="modelo" class="form-control" v-model="fillKeep.modelo">
                    <label for="anio">Año</label>
                    <input type="text" name="anio" class="form-control" v-model="fillKeep.anio">
                    <label for="aseguradora">Aseguradora</label>
                    <select name="aseguradora" id="selAse01" class="form-control" v-model="fillKeep.aseguradora">
                        <option v-for="aseguradora in aseguradoras" v-bind:value="aseguradora.id">@{{ aseguradora.aseguradora }}</option>
                    </select>
                    <label for="complemento">Complemento</label>
                    <textarea name="complemento" class="form-control" v-model="fillKeep.complemento"></textarea>
                    <label for="comentario">Comentario</label>
                    <textarea name="comentario" class="form-control" v-model="fillKeep.comentario"></textarea>
                    <span v-for="error in errors" class="text-danger">@{{ error }}</span>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" value="Actualizar">
                </div>
            </div>
        </div>
    </div>
</form>