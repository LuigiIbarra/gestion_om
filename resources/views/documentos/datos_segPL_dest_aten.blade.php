                <label><b><i>SEGUIMIENTO PLANEACIÓN</i></b></label>
                <hr>
                <div class="row">
                    <div class="col" id="divPLsegnumdoc">
                        <label for="PLnum_doc_seguim" class="col-form-label text-md-right">Número de Documento:</label>
                        <input type="text" id="PLnum_doc_seguim" name="PLnum_doc_seguim" class="form-control" data-target="#PLnum_doc_seguim" value="{{ $destAt->cnum_docto_resp }}" maxlength="100" {{ $noeditar }} />
                    </div>
                    <div class="col" id="divPLsegtipodoc">
                        <label for="PLtipo_doc_seg" class="col-form-label text-md-right">Tipo de Documento:</label>
                        <select class="form-control m-bot15" id="PLtipo_doc_seg" name="PLtipo_doc_seg" {{ $noeditar }}>
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
                    <div class="col" id="divPLsegestatus">
                        <label for="PLestatus_doc_seg" class="col-form-label text-md-right">Estatus:</label>
                        <select class="form-control m-bot15" id="PLestatus_doc_seg" name="PLestatus_doc_seg" {{ $noeditar }}>
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
                    <div class="col" id="divPLfecseg">
                        <label for="PLfecha_seguimiento" class="col-form-label text-md-right">Fecha de Seguimiento:</label>
                        <input type="date" id="PLfecha_seguimiento" name="PLfecha_seguimiento" class="form-control" data-target="#PLfecha_seguimiento" value="{{ $destAt->dfecha_concluido }}" maxlength="10" {{ $noeditar }}/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4" id="divPLsegmnt">
                        <label for="PLseguimiento" class="col-form-label text-md-right">Seguimiento:</label>
                        <textarea id="PLseguimiento" name="PLseguimiento" class="form-control" data-target="#PLseguimiento" {{ $noeditar }}>{{ $destAt->crespuesta }}</textarea>
                    </div>
                    <div class="col-4" id="divPLsegarchivo">
                        <label for="PLarchivo_seguim" class="col-form-label text-md-right">Archivo Dígital:</label>
                        <input type="file" id="PLarchivo_seguim" name="PLarchivo_seguim" class="form-control" data-target="#PLarchivo_seguim" {{ $noeditar }}/>
                        <a href="{{url('pdf/'.substr($destAt->cruta_archivo_respuesta,strrpos($destAt->cruta_archivo_respuesta,'pdf/')+4))}}" target="_blank">{{substr($destAt->cruta_archivo_respuesta,strrpos($destAt->cruta_archivo_respuesta,'pdf/')+4)}}</a>
                    </div>
                </div>