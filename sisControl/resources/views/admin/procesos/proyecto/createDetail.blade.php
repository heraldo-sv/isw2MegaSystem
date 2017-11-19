<form id="dtlNewProyecto" method="post" v-on:submit.prevent="dtlCreateKeep">
    <div class="modal fade" id="createDetail">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                    <h4>Nueva entrada</h4>
                </div>
                <div class="modal-body">
                    <label for="proyecto" class="hidden">Proyecto</label>
                    <input id="focus" type="text" name="proyecto" class="form-control hidden" v-model="dtlKeepProyecto">
                    <label for="user" class="hidden">Usuario</label>
                    <input type="text" name="user" class="form-control hidden" v-model="dtlKeepUser">
                    <label for="titulo">Titulo</label>
                    <input type="text" name="titulo" class="form-control" v-model="dtlKeepTitulo">
                    <label for="etapa" class="hidden">Etapa</label>
                    <input type="text" name="etapa" class="form-control hidden" v-model="dtlKeepEtapa">
                    <label for="descipcion">Descripción</label>
                    <textarea class="form-control" name="descipcion" v-model="dtlKeepDescripcion"></textarea>
                    <span v-for="error in errors" class="text-danger">@{{ error }}</span>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" value="Guardar">
                </div>
            </div>
        </div>
    </div>
</form>