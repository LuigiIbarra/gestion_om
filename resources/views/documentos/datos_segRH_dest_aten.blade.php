    <div class="modal fade" id="RHSeguimModal" tabindex="-1" aria-labelledby="RHSeguimModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="RHSeguimModalLabel">Seguimiento Recursos Humanos</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formRHsegatt" method="POST" action="{{ url('destatencion/RHseguimiento') }}">
                    @csrf
                        <div class="d-none">
                            <input type="text" name="rhdaid_docto" id="rhdaid_docto" value="{{ $documento->iid_documento }}">
                        </div>
                        <div class="row">
                            <div class="col" id="divRHsegnumdoc">
                                <label for="RHnum_doc_seguim" class="col-form-label text-md-right">Número de Documento:</label>
                                <input type="text" id="RHnum_doc_seguim" name="RHnum_doc_seguim" class="form-control" data-target="#RHnum_doc_seguim" value="{{ $destAt->cnum_docto_resp }}" maxlength="100" {{ $noeditar }} />
                            </div>
                            <div class="col" id="divRHsegtipodoc">
                                <label for="RHtipo_doc_seg" class="col-form-label text-md-right">Tipo de Documento:</label>
                                <select class="form-control m-bot15" id="RHtipo_doc_seg" name="RHtipo_doc_seg" {{ $noeditar }}>
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
                            <div class="col" id="divRHsegestatus">
                                <label for="RHestatus_doc_seg" class="col-form-label text-md-right">Estatus:</label>
                                <select class="form-control m-bot15" id="RHestatus_doc_seg" name="RHestatus_doc_seg" {{ $noeditar }}>
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
                            <div class="col" id="divRHfecseg">
                                <label for="RHfecha_seguimiento" class="col-form-label text-md-right">Fecha de Seguimiento:</label>
                                <input type="date" id="RHfecha_seguimiento" name="RHfecha_seguimiento" class="form-control" data-target="#RHfecha_seguimiento" value="{{ $destAt->dfecha_concluido }}" maxlength="10" {{ $noeditar }}/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" id="divRHsegmnt">
                                <label for="RHseguimiento" class="col-form-label text-md-right">Seguimiento:</label>
                                <textarea id="RHseguimiento" name="RHseguimiento" class="form-control" data-target="#RHseguimiento" {{ $noeditar }}>{{ $destAt->crespuesta }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" id="divRHsegarchivo">
                                <label for="RHarchivo_seguim" class="col-form-label text-md-right">Archivo Dígital:</label>
                                <input type="file" id="RHarchivo_seguim" name="RHarchivo_seguim" class="form-control" data-target="#RHarchivo_seguim" {{ $noeditar }}/>
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