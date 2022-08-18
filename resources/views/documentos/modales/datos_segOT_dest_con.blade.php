    <div class="modal fade" id="COTSeguimModal" tabindex="-1" aria-labelledby="COTSeguimModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="COTSeguimModalLabel">Seguimiento Conocimiento OTRO</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formOTsegcon" method="POST" action="{{ url('destconoc/seguimiento') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="d-none">
                            <input type="text" name="id_dest_cn" id="id_dest_cn" value="{{ $destCn->iid_destinatario_conocimiento }}">
                            <input type="text" name="id_docto"   id="id_docto"   value="{{ $documento->iid_documento }}">
                            <input type="text" name="id_area"    id="id_area"    value="{{ $destCn->iid_adscripcion }}">
                        </div>
                        <div class="row">
                            <div class="col" id="divotraads">
                                <label for="otra_ads" class="col-form-label text-md-right">Descripción del Área/Razón Social Persona Física:</label>
                                <input type="text" id="otra_ads" name="otra_ads" class="form-control" data-target="#otra_ads" value="{{ $destCn->cdescrip_otra_adscrip }}" maxlength="100" {{ $noeditar }} />
                            </div>
                        </div>
                        @include('documentos.datos_modal_conocimiento')
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