<div class="modal fade" id="dtlfile">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
                <h4>Carga de imagenes</h4>
            </div>
            <div class="modal-body">
                {{--  <form action="{{ asset('/proyecto/'.$project->id.'/imagenes') }}" class="dropzone" id="dtlfileupload">  --}}
                {{--  <form action="{{ asset('') }}" class="dropzone" id="dtlfileupload">  --}}
                <form action="{{ asset('/proyecto/imagenes') }}" class="dropzone" enctype="multipart/form-data" id="dtlfileupload">
                    
                    {{ csrf_field() }}
                </form>
            </div>
            <div class="modal-footer">
                <a id="btn_finalizar" href="#" class="btn btn-success" data-dismiss="modal">Finalizar</a>
            </div>
        </div>
    </div>
</div>