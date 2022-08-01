    <div class="modal fade" id="DCPLSeguimModal" tabindex="-1" aria-labelledby="DCPLSeguimModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="DCPLSeguimModalLabel">Seguimiento Conocimiento Planeación</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formDCPLsegcon" method="POST" action="{{ url('destconoc/PLseguimiento') }}">
                    @csrf
                        <div class="d-none">
                            <input type="text" name="pldcid_docto" id="pldcid_docto" value="{{ $documento->iid_documento }}">
                        </div>
                        <div class="row">
                            <div class="col" id="divDCPLsegnumdoc">
                                <label for="DCPLnum_doc_seguim" class="col-form-label text-md-right">Número de Documento:</label>
                                <input type="text" id="DCPLnum_doc_seguim" name="DCPLnum_doc_seguim" class="form-control" data-target="#DCPLnum_doc_seguim" value="{{ $destCn->cnum_docto_seguim }}" maxlength="100" {{ $noeditar }} />
                            </div>
                            <div class="col" id="divDCPLsegtipodoc">
                                <label for="DCPLtipo_doc_seg" class="col-form-label text-md-right">Tipo de Documento:</label>
                                <select class="form-control m-bot15" id="DCPLtipo_doc_seg" name="DCPLtipo_doc_seg" {{ $noeditar }}>
                                    <option value="">Elija un Tipo de Documento...</option>
                                    @foreach($listTipoDocumento as $indice=>$tipos_docs)
                                        @if($tipos_docs->iid_tipo_documento==$destCn->iid_tipo_documento)
                                            <option value="{{$tipos_docs->iid_tipo_documento}}" selected>{{$tipos_docs->cdescripcion_tipo_documento}}</option>
                                        @else
                                            <option value="{{$tipos_docs->iid_tipo_documento}}">{{$tipos_docs->cdescripcion_tipo_documento}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" id="divDCPLsegestatus">
                                <label for="DCPLestatus_doc_seg" class="col-form-label text-md-right">Estatus:</label>
                                <select class="form-control m-bot15" id="DCPLestatus_doc_seg" name="DCPLestatus_doc_seg" {{ $noeditar }}>
                                    <option value="">Elija un Estatus...</option>
                                    @foreach($listEstatus as $indice=>$estatus)
                                        @if($estatus->iid_estatus_documento==$destCn->iid_estatus_documento)
                                            <option value="{{$estatus->iid_estatus_documento}}" selected>{{$estatus->cdescripcion_estatus_documento}}</option>
                                        @else
                                            <option value="{{$estatus->iid_estatus_documento}}">{{$estatus->cdescripcion_estatus_documento}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col" id="divDCPLfecseg">
                                <label for="DCPLfecha_seguimiento" class="col-form-label text-md-right">Fecha de Seguimiento:</label>
                                <input type="date" id="DCPLfecha_seguimiento" name="DCPLfecha_seguimiento" class="form-control" data-target="#DCPLfecha_seguimiento" value="{{ $destCn->dfecha_seguimiento }}" maxlength="10" {{ $noeditar }}/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" id="divDCPLsegmnt">
                                <label for="DCPLseguimiento" class="col-form-label text-md-right">Seguimiento:</label>
                                <textarea id="DCPLseguimiento" name="DCPLseguimiento" class="form-control" data-target="#DCPLseguimiento" {{ $noeditar }}>{{ $destCn->cseguimiento }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" id="divDCPLsegarchivo">
                                <label for="DCPLarchseguim" class="col-form-label text-md-right">Archivo Dígital:</label>
                                <input type="file" id="DCPLarchseguim" name="DCPLarchseguim" class="form-control" data-target="#DCPLarchseguim" {{ $noeditar }}/>
                                <a href="{{url('pdf/'.substr($destCn->cruta_archivo_seguim,strrpos($destCn->cruta_archivo_seguim,'pdf/')+4))}}" target="_blank">{{substr($destCn->cruta_archivo_seguim,strrpos($destCn->cruta_archivo_seguim,'pdf/')+4)}}</a>
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