                        <div class="row">
                            <div class="col" id="divsegnumdoc">
                                <label for="num_doc_seguim" class="col-form-label text-md-right">Número de Documento:</label>
                                <input type="text" id="num_doc_seguim" name="num_doc_seguim" class="form-control" data-target="#num_doc_seguim" value="{{ $destAt->cnum_docto_resp }}" maxlength="100" {{ $noeditar }} />
                            </div>
                            <div class="col" id="divsegtipodoc">
                                <label for="tipo_doc_seg" class="col-form-label text-md-right">Tipo de Documento:</label>
                                <select class="form-control m-bot15" id="tipo_doc_seg" name="tipo_doc_seg" {{ $noeditar }}>
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
                            <div class="col" id="divsegestatus">
                                <label for="estatus_doc_seg" class="col-form-label text-md-right">Estatus:</label>
                                <select class="form-control m-bot15" id="estatus_doc_seg" name="estatus_doc_seg" {{ $noeditar }}>
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
                            <div class="col" id="divfecseg">
                                <label for="fecha_seguimiento" class="col-form-label text-md-right">Fecha de Seguimiento:</label>
                                <input type="date" id="fecha_seguimiento" name="fecha_seguimiento" class="form-control" data-target="#fecha_seguimiento" value="{{ $destAt->dfecha_concluido }}" maxlength="10" {{ $noeditar }}/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" id="divsegmnt">
                                <label for="seguimiento" class="col-form-label text-md-right">Seguimiento:</label>
                                <textarea id="seguimiento" name="seguimiento" class="form-control" data-target="#seguimiento" maxlength="500" {{ $noeditar }}>{{ $destAt->crespuesta }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" id="divsegarchivo">
                                <label for="daarchivo_seguim" class="col-form-label text-md-right">Archivo Dígital:</label>
                                <input type="file" id="daarchivo_seguim" name="daarchivo_seguim" class="form-control" data-target="#daarchivo_seguim" {{ $noeditar }}/>
                                <a href="{{url('pdf/'.substr($destAt->cruta_archivo_respuesta,strrpos($destAt->cruta_archivo_respuesta,'pdf/')+4))}}" target="_blank">{{substr($destAt->cruta_archivo_respuesta,strrpos($destAt->cruta_archivo_respuesta,'pdf/')+4)}}</a>
                            </div>
                        </div>
                        <br>