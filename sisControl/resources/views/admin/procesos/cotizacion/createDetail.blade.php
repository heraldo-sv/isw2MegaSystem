<form id="dtlNewCotizacion" method="post" v-on:submit.prevent="dtlCreateKeep">
    <div class="modal fade" id="createDetail">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                    <h4>Nuevo repuesto</h4>
                </div>
                <div class="modal-body">
                    <label for="repuesto">Repuesto</label>
                    <select name="repuesto" id="selRep02" class="select2-repuestos disabled" style="width: 100%">
                        <option v-for="repuesto in repuestos" v-bind:value="repuesto.id">@{{ repuesto.repuesto }}</option>
                    </select>
                    <label for="cantidad">Cantidad</label>
                    <input type="text" name="cantidad" class="form-control" v-model="dtlKeepCantidad">
                    <span v-for="error in errors" class="text-danger">@{{ error }}</span>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" value="Guardar">
                </div>
            </div>
        </div>
    </div>
</form>