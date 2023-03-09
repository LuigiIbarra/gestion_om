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
                            <input type="text" name="id_dest_cn"     id="id_dest_cn"     value="{{ $destCn->iid_destinatario_conocimiento }}">
                            <input type="text" name="id_docto"       id="id_docto"       value="{{ $documento->iid_documento }}">
                            <input type="text" name="id_area"        id="id_area"        value="{{ $destCn->iid_adscripcion }}">
                            <input type="text" name="idOtroPersonal" id="idOtroPersonal" value="{{ $destCn->iid_otro_personal }}">
                            <input type="text" name="idOtroPuesto"   id="idOtroPuesto"   value="{{ $destCn->iid_otro_puesto }}">
                            <input type="text" name="idOtraAdscrip"  id="idOtraAdscrip"  value="{{ $destCn->iid_otra_adscripcion }}">
                        </div>
                        <div class="row">
                            <div class="col-6" id="divbuscarotrap">
                                <label for="busca_otro_nombre" class="col-form-label text-md-right">Busca Nombre:</label>
                                <input type="text" id="busca_otro_nombre" name="busca_otro_nombre" class="form-control" data-target="#busca_otro_nombre" value="" maxlength="100" {{ $noeditar }} />
                            </div>
                            <div class="col-6" id="divnvonombre">
                                <label for="nuevo_nombre" class="col-form-label text-md-right">Nuevo Nombre:</label>
                                <input type="text" id="nuevo_nombre" name="nuevo_nombre" class="form-control" data-target="#nuevo_nombre" value="" maxlength="100" {{ $noeditar }} />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" id="divnomotrapersona">
                                <label for="otro_nombre" class="col-form-label text-md-right">Selecciona Nombre:</label>
                                <select class="form-control m-bot15" id="otro_nombre" name="otro_nombre" required {{ $noeditar }}>
                                    <option value="">Escriba un Nombre...</option>
                                    @foreach($listPersonal as $indice=>$otropers)
                                        @if ($otropers->iid_personal==$destCn->iid_otro_personal)
                                            <option value="{{ $otropers->iid_personal }}" selected>{{ $otropers->cnombre_personal.' '.$otropers->cpaterno_personal.' '.$otropers->cmaterno_personal }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row" id="divOtrosApellidos">
                            <div class="col" id="divpatotrapersona">
                                <label for="otro_paterno" class="col-form-label text-md-right">Paterno:</label>
                                <input type="text" id="otro_paterno" name="otro_paterno" class="form-control" data-target="#otro_paterno" value="" maxlength="100" {{ $noeditar }} />
                            </div>
                            <div class="col" id="divmatotrapersona">
                                <label for="otro_materno" class="col-form-label text-md-right">Materno:</label>
                                <input type="text" id="otro_materno" name="otro_materno" class="form-control" data-target="#otro_materno" value="" maxlength="100" {{ $noeditar }} />
                            </div>
                        </div>
                        <div id="divOtroPstoAdsc">
                            <div class="row">
                                <div class="col" id="divotropuesto">
                                    <label for="otro_puesto" class="col-form-label text-md-right">Puesto:</label>
                                    <select class="form-control m-bot15" id="otro_puesto" name="otro_puesto" required {{ $noeditar }}>
                                        <option value="">Escriba un Nombre...</option>
                                        @foreach($listPuesto as $indice=>$otropsto)
                                            @if ($otropsto->iid_puesto==$destCn->iid_otro_puesto)
                                                <option value="{{ $otropsto->iid_puesto }}" selected>{{ $otropsto->cdescripcion_puesto }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col" id="divotraads">
                                    <label for="otra_adscripcion" class="col-form-label text-md-right">Área/Razón Social:</label>
                                    <select class="form-control m-bot15" id="otra_adscripcion" name="otra_adscripcion" required {{ $noeditar }}>
                                        <option value="">Escriba un Nombre...</option>
                                        @foreach($listAdscripcion as $indice=>$otraadsc)
                                            @if ($otraadsc->iid_adscripcion==$destCn->iid_otra_adscripcion)
                                                <option value="{{ $otraadsc->iid_adscripcion }}" selected>{{ $otraadsc->cdescripcion_adscripcion }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="divNuevoPstoAdsc">
                            <div class="row">
                                <div class="col-6" id="divnvopuesto">
                                    <label for="otro_nvo_puesto" class="col-form-label text-md-right">Puesto:</label>
                                    <select class="form-control m-bot15" id="otro_nvo_puesto" name="otro_nvo_puesto" {{ $noeditar }}>
                                        <option value="">Elija un Puesto...</option>
                                        @foreach($listPuesto as $indice=>$psto)
                                            <option value="{{$psto->iid_puesto}}">{{$psto->cdescripcion_puesto}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6" id="divnvootropuesto">
                                    <label for="otra_desc_puesto" class="col-form-label text-md-right">Nuevo Puesto:</label>
                                    <input type="text" id="otra_desc_puesto" name="otra_desc_puesto" class="form-control" data-target="#otra_desc_puesto" value="" maxlength="100" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6" id="divnvaadsc">
                                    <label for="otra_nva_adscripcion" class="col-form-label text-md-right">Área/Razón Social:</label>
                                    <select class="form-control m-bot15" id="otra_nva_adscripcion" name="otra_nva_adscripcion" {{ $noeditar }}>
                                        <option value="">Elija una Adscripcion...</option>
                                        @foreach($listAdscripcion as $indice=>$adsc)
                                            <option value="{{$adsc->iid_adscripcion}}">{{$adsc->cdescripcion_adscripcion}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6" id="divnvootraadsc">
                                    <label for="otra_desc_adsc" class="col-form-label text-md-right">Nuevo Área/Razón Social:</label>
                                    <input type="text" id="otra_desc_adsc" name="otra_desc_adsc" class="form-control" data-target="#otra_desc_adsc" value="" maxlength="100" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col" id="divnvotipoadsc">
                                    <label for="nvo_tipo_adscripcion" class="col-form-label text-md-right">Tipo de Adscripción:</label>
                                    <select class="form-control m-bot15" id="nvo_tipo_adscripcion" name="nvo_tipo_adscripcion" {{ $noeditar }}>
                                        <option value="">Elija un Tipo de Adscripción...</option>
                                        @foreach($listTipoArea as $indice=>$tipo_area)
                                            <option value="{{$tipo_area->iid_tipo_area}}">{{$tipo_area->cdescripcion_tipo_area}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <center><div id="validaOtroPersonal"></div></center>
                        <hr>
                        <label><b>Seguimiento</b></label>
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