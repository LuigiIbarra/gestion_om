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
                            <div class="col" id="divnomotrapersona">
                                <label for="otro_nombre" class="col-form-label text-md-right">Nombre:</label>
                                <input type="text" id="otro_nombre" name="otro_nombre" class="form-control" data-target="#otro_nombre" value="{{ $destCn->cdescrip_otra_adscrip }}" maxlength="100" {{ $noeditar }} />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" id="divpatotrapersona">
                                <label for="otro_paterno" class="col-form-label text-md-right">Paterno:</label>
                                <input type="text" id="otro_paterno" name="otro_paterno" class="form-control" data-target="#otro_paterno" value="{{ $destCn->cdescrip_otra_adscrip }}" maxlength="100" {{ $noeditar }} />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" id="divmatotrapersona">
                                <label for="otro_materno" class="col-form-label text-md-right">Materno:</label>
                                <input type="text" id="otro_materno" name="otro_materno" class="form-control" data-target="#otro_materno" value="{{ $destCn->cdescrip_otra_adscrip }}" maxlength="100" {{ $noeditar }} />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" id="divotropuesto">
                                <label for="otro_puesto" class="col-form-label text-md-right">Puesto:</label>
                                <input type="text" id="otro_puesto" name="otro_puesto" class="form-control" data-target="#otro_puesto" value="{{ $destCn->cdescrip_otra_adscrip }}" maxlength="100" {{ $noeditar }} />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" id="divotraads">
                                <label for="otra_adscripcion" class="col-form-label text-md-right">Área/Razón Social:</label>
                                <input type="text" id="otra_adscripcion" name="otra_adscripcion" class="form-control" data-target="#otra_adscripcion" value="{{ $destCn->cdescrip_otra_adscrip }}" maxlength="100" {{ $noeditar }} />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" id="divtipodoc">
                                <label for="tipo_adscripcion" class="col-form-label text-md-right">Tipo de Adscripción:</label>
                                <select class="form-control m-bot15" id="tipo_adscripcion" name="tipo_adscripcion" required {{ $noeditar }}>
                                    <option value="">Elija un Tipo de Adscripción...</option>
                                    @foreach($listTipoArea as $indice=>$tipo_area)
                                        <option value="{{$tipo_area->iid_tipo_area}}">{{$tipo_area->cdescripcion_tipo_area}}</option>
                                    @endforeach
                                </select>
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