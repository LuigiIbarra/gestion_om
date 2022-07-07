                <label><b><i>SEGUIMIENTO OFICIALIA MAYOR</i></b></label>
                <hr>
                <div class="row">
                    <div class="col" id="divOMsegnumdoc">
                        <label for="OMnum_doc_seguim" class="col-form-label text-md-right">Número de Documento:</label>
                        <input type="text" id="OMnum_doc_seguim" name="OMnum_doc_seguim" class="form-control" data-target="#OMnum_doc_seguim" value="{{ $destAt->cnum_docto_resp }}" maxlength="100" {{ $noeditar }} />
                    </div>
                    <div class="col" id="divOMsegtipodoc">
                        <label for="OMtipo_doc_seg" class="col-form-label text-md-right">Tipo de Documento:</label>
                        <select class="form-control m-bot15" id="OMtipo_doc_seg" name="OMtipo_doc_seg" {{ $noeditar }}>
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
                    <div class="col" id="divOMsegestatus">
                        <label for="OMestatus_doc_seg" class="col-form-label text-md-right">Estatus:</label>
                        <select class="form-control m-bot15" id="OMestatus_doc_seg" name="OMestatus_doc_seg" {{ $noeditar }}>
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
                    <div class="col" id="divOMfecseg">
                        <label for="OMfecha_seguimiento" class="col-form-label text-md-right">Fecha de Seguimiento:</label>
                        <input type="date" id="OMfecha_seguimiento" name="OMfecha_seguimiento" class="form-control" data-target="#OMfecha_seguimiento" value="{{ $destAt->dfecha_concluido }}" maxlength="10" {{ $noeditar }}/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4" id="divOMsegmnt">
                        <label for="OMseguimiento" class="col-form-label text-md-right">Seguimiento:</label>
                        <textarea id="OMseguimiento" name="OMseguimiento" class="form-control" data-target="#OMseguimiento" {{ $noeditar }}>{{ $destAt->crespuesta }}</textarea>
                    </div>
                    <div class="col-4" id="divOMsegarchivo">
                        <label for="OMarchivo_seguim" class="col-form-label text-md-right">Archivo Dígital:</label>
                        <input type="file" id="OMarchivo_seguim" name="OMarchivo_seguim" class="form-control" data-target="#OMarchivo_seguim" {{ $noeditar }}/>
                        <a href="{{url('pdf/'.substr($destAt->cruta_archivo_respuesta,strrpos($destAt->cruta_archivo_respuesta,'pdf/')+4))}}" target="_blank">{{substr($destAt->cruta_archivo_respuesta,strrpos($destAt->cruta_archivo_respuesta,'pdf/')+4)}}</a>
                    </div>
                </div>