                <label><b><i>SEGUIMIENTO OBRAS, MANTENIMIENTO Y SERVICIOS</i></b></label>
                <hr>
                <div class="row">
                    <div class="col" id="divOBsegnumdoc">
                        <label for="OBnum_doc_seguim" class="col-form-label text-md-right">Número de Documento:</label>
                        <input type="text" id="OBnum_doc_seguim" name="OBnum_doc_seguim" class="form-control" data-target="#OBnum_doc_seguim" value="{{ $destAt->cnum_docto_resp }}" maxlength="100" {{ $noeditar }} />
                    </div>
                    <div class="col" id="divOBsegtipodoc">
                        <label for="OBtipo_doc_seg" class="col-form-label text-md-right">Tipo de Documento:</label>
                        <select class="form-control m-bot15" id="OBtipo_doc_seg" name="OBtipo_doc_seg" {{ $noeditar }}>
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
                    <div class="col" id="divOBsegestatus">
                        <label for="OBestatus_doc_seg" class="col-form-label text-md-right">Estatus:</label>
                        <select class="form-control m-bot15" id="OBestatus_doc_seg" name="OBestatus_doc_seg" {{ $noeditar }}>
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
                    <div class="col" id="divOBfecseg">
                        <label for="OBfecha_seguimiento" class="col-form-label text-md-right">Fecha de Seguimiento:</label>
                        <input type="date" id="OBfecha_seguimiento" name="OBfecha_seguimiento" class="form-control" data-target="#OBfecha_seguimiento" value="{{ $destAt->dfecha_concluido }}" maxlength="10" {{ $noeditar }}/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4" id="divOBsegmnt">
                        <label for="OBseguimiento" class="col-form-label text-md-right">Seguimiento:</label>
                        <textarea id="OBseguimiento" name="OBseguimiento" class="form-control" data-target="#OBseguimiento" {{ $noeditar }}>{{ $destAt->crespuesta }}</textarea>
                    </div>
                    <div class="col-4" id="divOBsegarchivo">
                        <label for="OBarchivo_seguim" class="col-form-label text-md-right">Archivo Dígital:</label>
                        <input type="file" id="OBarchivo_seguim" name="OBarchivo_seguim" class="form-control" data-target="#OBarchivo_seguim" {{ $noeditar }}/>
                        <a href="{{url('pdf/'.substr($destAt->cruta_archivo_respuesta,strrpos($destAt->cruta_archivo_respuesta,'pdf/')+4))}}" target="_blank">{{substr($destAt->cruta_archivo_respuesta,strrpos($destAt->cruta_archivo_respuesta,'pdf/')+4)}}</a>
                    </div>
                </div>