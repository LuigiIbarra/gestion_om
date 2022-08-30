                    <div class="row">
                        <div class="col-4" id="divnombre">
                            <label for="nombre_destinatariocc" class="col-form-label text-md-right">Nombre:</label>
                            <input type="text" onkeypress="return textonly(event);" id="nombre_destinatariocc" name="nombre_destinatariocc" class="form-control" data-target="#nombre_destinatariocc" value="{{ $personal->cnombre_personal.' '.$personal->cpaterno_personal.' '.$personal->cmaterno_personal }}" maxlength="50" required readonly />
                        </div>
                        <div class="col-4" id="divpuesto">
                            <label for="puesto_conocimiento" class="col-form-label text-md-right">Puesto:</label>
                            <select class="form-control m-bot15" id="puesto_conocimiento" name="puesto_conocimiento" readonly>
                                <option value="">Escriba un Nombre...</option>
                                <option value="$personal->puesto->iid_puesto" selected>{{$personal->puesto->cdescripcion_puesto}}</option>
                            </select>
                        </div>
                        <div class="col-4" id="divarea">
                            <label for="area_conocimiento" class="col-form-label text-md-right">Adscripción:</label>
                            <select class="form-control m-bot15" id="area_conocimiento" name="area_conocimiento" readonly>
                                <option value="">Escriba un Nombre...</option>
                                <option value="$personal->adscripcion->iid_adscripcion" selected>{{$personal->adscripcion->cdescripcion_adscripcion}}</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <center><div id="validaPersonalDest"></div></center>
                    <br>
                    <label><b><i>SEGUIMIENTO</i></b></label>
                    <div class="row">
                        <div class="col" id="divsegnumdoc">
                            <label for="num_doc_seguim" class="col-form-label text-md-right">Número de Documento:</label>
                            <input type="text" id="num_doc_seguim" name="num_doc_seguim" class="form-control" data-target="#num_doc_seguim" value="{{ $personal_conocimiento->cnum_docto_seguim }}" maxlength="100" {{ $noeditar }} />
                        </div>
                        <div class="col" id="divsegtipodoc">
                            <label for="tipo_doc_seg" class="col-form-label text-md-right">Tipo de Documento:</label>
                            <select class="form-control m-bot15" id="tipo_doc_seg" name="tipo_doc_seg" {{ $noeditar }}>
                                <option value="">Elija un Tipo de Documento...</option>
                                @foreach($listTipoDocumento as $indice=>$tipos_docs)
                                    @if($tipos_docs->iid_tipo_documento==$personal_conocimiento->iid_tipo_documento)
                                        <option value="{{$tipos_docs->iid_tipo_documento}}" selected>{{$tipos_docs->cdescripcion_tipo_documento}}</option>
                                    @else
                                        <option value="{{$tipos_docs->iid_tipo_documento}}">{{$tipos_docs->cdescripcion_tipo_documento}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col" id="divsegestatus">
                            <label for="estatus_doc_seg" class="col-form-label text-md-right">Estatus:</label>
                            <select class="form-control m-bot15" id="estatus_doc_seg" name="estatus_doc_seg" {{ $noeditar }}>
                                <option value="">Elija un Estatus...</option>
                                @foreach($listEstatus as $indice=>$estatus)
                                    @if($estatus->iid_estatus_documento==$personal_conocimiento->iid_estatus_documento)
                                        <option value="{{$estatus->iid_estatus_documento}}" selected>{{$estatus->cdescripcion_estatus_documento}}</option>
                                    @else
                                        <option value="{{$estatus->iid_estatus_documento}}">{{$estatus->cdescripcion_estatus_documento}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col" id="divfecseg">
                            <label for="fecha_seguimiento" class="col-form-label text-md-right">Fecha de Seguimiento:</label>
                            <input type="date" id="fecha_seguimiento" name="fecha_seguimiento" class="form-control" data-target="#fecha_seguimiento" value="{{ $personal_conocimiento->dfecha_seguimiento }}" maxlength="10" {{ $noeditar }}/>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-4" id="divsegmnt">
                            <label for="seguimiento" class="col-form-label text-md-right">Seguimiento:</label>
                            <textarea id="seguimiento" name="seguimiento" class="form-control" data-target="#seguimiento" {{ $noeditar }}>{{ $personal_conocimiento->cseguimiento }}</textarea>
                        </div>
                        <div class="col-4" id="divsegarchivo">
                            <label for="archivo_seguim" class="col-form-label text-md-right">Archivo Dígital:</label>
                            <input type="file" id="archivo_seguim" name="archivo_seguim" class="form-control" data-target="#archivo_seguim" {{ $noeditar }}/>
                            <a href="{{url('pdf/'.substr($personal_conocimiento->cruta_archivo_seguim,strrpos($personal_conocimiento->cruta_archivo_seguim,'pdf/')+4))}}" target="_blank">{{substr($personal_conocimiento->cruta_archivo_seguim,strrpos($personal_conocimiento->cruta_archivo_seguim,'pdf/')+4)}}</a>
                        </div>
                    </div>
                    <br>