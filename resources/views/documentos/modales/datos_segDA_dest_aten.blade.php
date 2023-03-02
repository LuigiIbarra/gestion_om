    <div class="modal fade" id="ADASeguimModal" tabindex="-1" aria-labelledby="ADASeguimModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ADASeguimModalLabel">Seguimiento Atención Dirección Administrativa</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formDAsegatt" method="POST" action="{{ url('destatencion/seguimiento') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="d-none">
                            <input type="text" name="id_dest_at" id="id_dest_at" value="{{ $destAt->iid_destinatario_atencion }}">
                            <input type="text" name="id_docto"   id="id_docto"   value="{{ $documento->iid_documento }}">
                            <input type="text" name="id_area"    id="id_area"    value="{{ $destAt->iid_adscripcion }}">
                        </div>
                        @include('documentos.datos_modal_atencion')
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <img src="{{ asset('bootstrap-icons-1.5.0/x-lg.svg') }}" width="18" height="18">
                                <span>&nbsp;Cerrar</span>
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <img src="{{ asset('bootstrap-icons-1.5.0/save.svg') }}" width="18" height="18">
                                <span>&nbsp;Actualizar</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>