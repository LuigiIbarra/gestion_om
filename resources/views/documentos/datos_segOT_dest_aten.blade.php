    <div class="modal fade" id="OTSeguimModal" tabindex="-1" aria-labelledby="OTSeguimModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="OTSeguimModalLabel">Seguimiento OTRO</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formOTsegatt" method="POST" action="{{ url('destatencion/OTseguimiento') }}">
                    @csrf
                        <div class="d-none">
                            <input type="text" name="otdaid_docto" id="otdaid_docto" value="{{ $documento->iid_documento }}">
                        </div>
                        <div class="row">
                            <div class="col" id="divOTotraads">
                                <label for="OTotra_ads" class="col-form-label text-md-right">Descripción del Área/Razón Social Persona Física:</label>
                                <input type="text" id="OTotra_ads" name="OTotra_ads" class="form-control" data-target="#OTotra_ads" value="{{ $destAt->cdescrip_otra_adscrip }}" maxlength="100" {{ $noeditar }} />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" id="divOTsegnumdoc">
                                <label for="OTnum_doc_seguim" class="col-form-label text-md-right">Número de Documento:</label>
                                <input type="text" id="OTnum_doc_seguim" name="OTnum_doc_seguim" class="form-control" data-target="#OTnum_doc_seguim" value="{{ $destAt->cnum_docto_resp }}" maxlength="100" {{ $noeditar }} />
                            </div>
                            <div class="col" id="divOTsegtipodoc">
                                <label for="OTtipo_doc_seg" class="col-form-label text-md-right">Tipo de Documento:</label>
                                <select class="form-control m-bot15" id="OTtipo_doc_seg" name="OTtipo_doc_seg" {{ $noeditar }}>
                                    <option value="">Elija un Tipo de Documento...</option>
                                    @foreach($listTipoDocumento as $indice=>$tipos_docs)
                                        @if($tipos_docs->iid_tipo_documento==$destAt->iid_tipo_documento)
                                            <option value="{{$tipos_docs->iid_tipo_documento}}" selected>{{$tipos_docs->cdescripcion_tipo_documento}}</option>
                                        @else
                                            <option value="{{$tipos_docs->iid_tipo_documento}}">{{$tipos_docs->cdescripcion_tipo_documento}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" id="divOTsegestatus">
                                <label for="OTestatus_doc_seg" class="col-form-label text-md-right">Estatus:</label>
                                <select class="form-control m-bot15" id="OTestatus_doc_seg" name="OTestatus_doc_seg" {{ $noeditar }}>
                                    <option value="">Elija un Estatus...</option>
                                    @foreach($listEstatus as $indice=>$estatus)
                                        @if($estatus->iid_estatus_documento==$destAt->iid_estatus_documento)
                                            <option value="{{$estatus->iid_estatus_documento}}" selected>{{$estatus->cdescripcion_estatus_documento}}</option>
                                        @else
                                            <option value="{{$estatus->iid_estatus_documento}}">{{$estatus->cdescripcion_estatus_documento}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col" id="divOTfecseg">
                                <label for="OTfecha_seguimiento" class="col-form-label text-md-right">Fecha de Seguimiento:</label>
                                <input type="date" id="OTfecha_seguimiento" name="OTfecha_seguimiento" class="form-control" data-target="#OTfecha_seguimiento" value="{{ $destAt->dfecha_concluido }}" maxlength="10" {{ $noeditar }}/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" id="divOTsegmnt">
                                <label for="OTseguimiento" class="col-form-label text-md-right">Seguimiento:</label>
                                <textarea id="OTseguimiento" name="OTseguimiento" class="form-control" data-target="#OTseguimiento" {{ $noeditar }}>{{ $destAt->crespuesta }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" id="divOTsegarchivo">
                                <label for="OTarchivo_seguim" class="col-form-label text-md-right">Archivo Dígital:</label>
                                <input type="file" id="OTarchivo_seguim" name="OTarchivo_seguim" class="form-control" data-target="#OTarchivo_seguim" {{ $noeditar }}/>
                                <a href="{{url('pdf/'.substr($destAt->cruta_archivo_respuesta,strrpos($destAt->cruta_archivo_respuesta,'pdf/')+4))}}" target="_blank">{{substr($destAt->cruta_archivo_respuesta,strrpos($destAt->cruta_archivo_respuesta,'pdf/')+4)}}</a>
                            </div>
                        </div>
                        <br>
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