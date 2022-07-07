                <label><b><i>SEGUIMIENTO GESTIÓN TECNOLÓGICA</i></b></label>
                <hr>
                <div class="row">
                    <div class="col" id="divGTsegnumdoc">
                        <label for="GTnum_doc_seguim" class="col-form-label text-md-right">Número de Documento:</label>
                        <input type="text" id="GTnum_doc_seguim" name="GTnum_doc_seguim" class="form-control" data-target="#GTnum_doc_seguim" value="{{ $destAt->cnum_docto_resp }}" maxlength="100" {{ $noeditar }} />
                    </div>
                    <div class="col" id="divGTsegtipodoc">
                        <label for="GTtipo_doc_seg" class="col-form-label text-md-right">Tipo de Documento:</label>
                        <select class="form-control m-bot15" id="GTtipo_doc_seg" name="GTtipo_doc_seg" {{ $noeditar }}>
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
                    <div class="col" id="divGTsegestatus">
                        <label for="GTestatus_doc_seg" class="col-form-label text-md-right">Estatus:</label>
                        <select class="form-control m-bot15" id="GTestatus_doc_seg" name="GTestatus_doc_seg" {{ $noeditar }}>
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
                    <div class="col" id="divGTfecseg">
                        <label for="GTfecha_seguimiento" class="col-form-label text-md-right">Fecha de Seguimiento:</label>
                        <input type="date" id="GTfecha_seguimiento" name="GTfecha_seguimiento" class="form-control" data-target="#GTfecha_seguimiento" value="{{ $destAt->dfecha_concluido }}" maxlength="10" {{ $noeditar }}/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4" id="divGTsegmnt">
                        <label for="GTseguimiento" class="col-form-label text-md-right">Seguimiento:</label>
                        <textarea id="GTseguimiento" name="GTseguimiento" class="form-control" data-target="#GTseguimiento" {{ $noeditar }}>{{ $destAt->crespuesta }}</textarea>
                    </div>
                    <div class="col-4" id="divGTsegarchivo">
                        <label for="GTarchivo_seguim" class="col-form-label text-md-right">Archivo Dígital:</label>
                        <input type="file" id="GTarchivo_seguim" name="GTarchivo_seguim" class="form-control" data-target="#GTarchivo_seguim" {{ $noeditar }}/>
                        <a href="{{url('pdf/'.substr($destAt->cruta_archivo_respuesta,strrpos($destAt->cruta_archivo_respuesta,'pdf/')+4))}}" target="_blank">{{substr($destAt->cruta_archivo_respuesta,strrpos($destAt->cruta_archivo_respuesta,'pdf/')+4)}}</a>
                    </div>
                </div>