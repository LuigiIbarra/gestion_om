                <label><b><i>SEGUIMIENTO RECURSOS MATERIALES</i></b></label>
                <hr>
                <div class="row">
                    <div class="col" id="divRMsegnumdoc">
                        <label for="RMnum_doc_seguim" class="col-form-label text-md-right">Número de Documento:</label>
                        <input type="text" id="RMnum_doc_seguim" name="RMnum_doc_seguim" class="form-control" data-target="#RMnum_doc_seguim" value="{{ $destAt->cnum_docto_resp }}" maxlength="100" {{ $noeditar }} />
                    </div>
                    <div class="col" id="divRMsegtipodoc">
                        <label for="RMtipo_doc_seg" class="col-form-label text-md-right">Tipo de Documento:</label>
                        <select class="form-control m-bot15" id="RMtipo_doc_seg" name="RMtipo_doc_seg" {{ $noeditar }}>
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
                    <div class="col" id="divRMsegestatus">
                        <label for="RMestatus_doc_seg" class="col-form-label text-md-right">Estatus:</label>
                        <select class="form-control m-bot15" id="RMestatus_doc_seg" name="RMestatus_doc_seg" {{ $noeditar }}>
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
                    <div class="col" id="divRMfecseg">
                        <label for="RMfecha_seguimiento" class="col-form-label text-md-right">Fecha de Seguimiento:</label>
                        <input type="date" id="RMfecha_seguimiento" name="RMfecha_seguimiento" class="form-control" data-target="#RMfecha_seguimiento" value="{{ $destAt->dfecha_concluido }}" maxlength="10" {{ $noeditar }}/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4" id="divRMsegmnt">
                        <label for="RMseguimiento" class="col-form-label text-md-right">Seguimiento:</label>
                        <textarea id="RMseguimiento" name="RMseguimiento" class="form-control" data-target="#RMseguimiento" {{ $noeditar }}>{{ $destAt->crespuesta }}</textarea>
                    </div>
                    <div class="col-4" id="divRMsegarchivo">
                        <label for="RMarchivo_seguim" class="col-form-label text-md-right">Archivo Dígital:</label>
                        <input type="file" id="RMarchivo_seguim" name="RMarchivo_seguim" class="form-control" data-target="#RMarchivo_seguim" {{ $noeditar }}/>
                        <a href="{{url('pdf/'.substr($destAt->cruta_archivo_respuesta,strrpos($destAt->cruta_archivo_respuesta,'pdf/')+4))}}" target="_blank">{{substr($destAt->cruta_archivo_respuesta,strrpos($destAt->cruta_archivo_respuesta,'pdf/')+4)}}</a>
                    </div>
                </div>