    <div class="modal fade" id="DCOMSeguimModal" tabindex="-1" aria-labelledby="DCOMSeguimModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="DCOMSeguimModalLabel">Seguimiento Conocimiento Oficialía Mayor</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formDCOMsegatt" method="POST" action="{{ url('destconoc/OMseguimiento') }}">
                    @csrf
                        <div class="d-none">
                            <input type="text" name="omdcid_docto" id="omdcid_docto" value="{{ $documento->iid_documento }}">
                        </div>
                        <div class="row">
                            <div class="col" id="divDCOMsegnumdoc">
                                <label for="DCOMnum_doc_seguim" class="col-form-label text-md-right">Número de Documento:</label>
                                <input type="text" id="DCOMnum_doc_seguim" name="DCOMnum_doc_seguim" class="form-control" data-target="#DCOMnum_doc_seguim" value="{{ $destAt->cnum_docto_seguim }}" maxlength="100" {{ $noeditar }} />
                            </div>
                            <div class="col" id="divDCOMsegtipodoc">
                                <label for="DCOMtipo_doc_seg" class="col-form-label text-md-right">Tipo de Documento:</label>
                                <select class="form-control m-bot15" id="DCOMtipo_doc_seg" name="DCOMtipo_doc_seg" {{ $noeditar }}>
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
                            <div class="col" id="divDCOMsegestatus">
                                <label for="DCOMestatus_doc_seg" class="col-form-label text-md-right">Estatus:</label>
                                <select class="form-control m-bot15" id="DCOMestatus_doc_seg" name="DCOMestatus_doc_seg" {{ $noeditar }}>
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
                            <div class="col" id="divDCOMfecseg">
                                <label for="DCOMfecha_seguimiento" class="col-form-label text-md-right">Fecha de Seguimiento:</label>
                                <input type="date" id="DCOMfecha_seguimiento" name="DCOMfecha_seguimiento" class="form-control" data-target="#DCOMfecha_seguimiento" value="{{ $destAt->dfecha_seguimiento }}" maxlength="10" {{ $noeditar }}/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" id="divDCOMsegmnt">
                                <label for="DCOMseguimiento" class="col-form-label text-md-right">Seguimiento:</label>
                                <textarea id="DCOMseguimiento" name="DCOMseguimiento" class="form-control" data-target="#DCOMseguimiento" {{ $noeditar }}>{{ $destAt->cseguimiento }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" id="divDCOMsegarchivo">
                                <label for="DCOMarchivo_seguim" class="col-form-label text-md-right">Archivo Dígital:</label>
                                <input type="file" id="DCOMarchivo_seguim" name="DCOMarchivo_seguim" class="form-control" data-target="#DCOMarchivo_seguim" {{ $noeditar }}/>
                                <a href="{{url('pdf/'.substr($destAt->cruta_archivo_seguim,strrpos($destAt->cruta_archivo_seguim,'pdf/')+4))}}" target="_blank">{{substr($destAt->cruta_archivo_seguim,strrpos($destAt->cruta_archivo_seguim,'pdf/')+4)}}</a>
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