                <div class="row">
                    <div class="col" id="divfolio">
                        <label for="folio_documento" class="col-form-label text-md-right">Número de Folio:</label>
                        <input type="text" id="folio_documento" name="folio_documento" class="form-control" data-target="#folio_documento" value="{{ $documento->cfolio }}" required {{ $noeditar }}/>
                    </div>
                    <div class="col" id="divrecepcion">
                        <label for="recepcion_documento" class="col-form-label text-md-right">Fecha de Recepcion:</label>
                        <input type="date" id="recepcion_documento" name="recepcion_documento" class="form-control" data-target="#recepcion_documento" value="{{ $documento->dfecha_recepcion }}" maxlength="10" required {{ $noeditar }}/>
                    </div>
                    <div class="col" id="divnumdoc">
                        <label for="numero_documento" class="col-form-label text-md-right">Número de Documento:</label>
                        <input type="text" onkeypress="return textonly(event);" id="numero_documento" name="numero_documento" class="form-control" data-target="#numero_documento" value="{{ $documento->cnumero_documento }}" maxlength="100" required {{ $noeditar }} />
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col" id="divfecdoc">
                        <label for="fecha_documento" class="col-form-label text-md-right">Fecha del Documento:</label>
                        <input type="date" id="fecha_documento" name="fecha_documento" class="form-control" data-target="#fecha_documento" value="{{ $documento->dfecha_documento }}" maxlength="10" required {{ $noeditar }}/>
                    </div>
                    <div class="col" id="divtipodoc">
                        <label for="tipo_documento" class="col-form-label text-md-right">Tipo de Documento:</label>
                        <select class="form-control m-bot15" name="tipo_documento" required {{ $noeditar }}>
                            <option value="">Elija un Tipo de Documento...</option>
                            @foreach($listTipoDocumento as $indice=>$tipos_docs)
                                @if($tipos_docs->iid_tipo_documento==$documento->iid_tipo_documento)
                                    <option value="{{$tipos_docs->iid_tipo_documento}}" selected>{{$tipos_docs->cdescripcion_tipo_documento}}</option>
                                @else
                                    <option value="{{$tipos_docs->iid_tipo_documento}}">{{$tipos_docs->cdescripcion_tipo_documento}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col" id="divtipoanexo">
                        <label for="tipo_anexo" class="col-form-label text-md-right">Tipo de Anexo:</label>
                        <select class="form-control m-bot15" name="tipo_anexo" required {{ $noeditar }}>
                            <option value="">Elija un Tipo de Anexo...</option>
                            @foreach($listTipoAnexo as $indice=>$tipos_anexo)
                                @if($tipos_anexo->iid_tipo_anexo==$documento->iid_tipo_anexo)
                                    <option value="{{$tipos_anexo->iid_tipo_anexo}}" selected>{{$tipos_anexo->cdescripcion_tipo_anexo}}</option>
                                @else
                                    <option value="{{$tipos_anexo->iid_tipo_anexo}}">{{$tipos_anexo->cdescripcion_tipo_anexo}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <hr>
                <label>REMITENTE</label>
                <div class="row" id="divremitente">
                    <div class="col-4" id="divnombre">
                        <label for="nombre_remitente" class="col-form-label text-md-right">Nombre:</label>
                        <select class="form-control m-bot15" name="nombre_remitente" required {{ $noeditar }}>
                        <option value="">Elija un Remitente...</option>
                        @foreach($listPersonal as $indice=>$remitente)
                            @if($remitente->iid_personal==$documento->iid_personal_remitente)
                                <option value="{{$remitente->iid_personal}}" selected>{{$remitente->cnombre_personal.' '.$remitente->cpaterno_personal.' '.$remitente->cmaterno_personal}}</option>
                            @else
                                <option value="{{$remitente->iid_personal}}">{{$remitente->cnombre_personal.' '.$remitente->cpaterno_personal.' '.$remitente->cmaterno_personal}}</option>
                            @endif
                        @endforeach
                        </select>
                    </div>
                    <div class="col-4" id="divpuesto">
                        <label for="puesto_remitente" class="col-form-label text-md-right">Puesto:</label>
                        <select class="form-control m-bot15" name="puesto_remitente" required {{ $noeditar }}>
                        <option value="">Elija un Puesto...</option>
                        @foreach($listPuesto as $indice=>$puesto)
                            @if($puesto->iid_puesto==$pers_remitente->iid_puesto)
                                <option value="{{$puesto->iid_puesto}}" selected>{{$puesto->cdescripcion_puesto}}</option>
                            @else
                                <option value="{{$puesto->iid_puesto}}">{{$puesto->cdescripcion_puesto}}</option>
                            @endif
                        @endforeach
                        </select>
                    </div>
                    <div class="col-4" id="divarea">
                        <label for="area_remitente" class="col-form-label text-md-right">Adscripción:</label>
                        <select class="form-control m-bot15" name="area_remitente" required {{ $noeditar }}>
                        <option value="">Elija un Adscripción...</option>
                        @foreach($listAdscripcion as $indice=>$adscripcion)
                            @if($adscripcion->iid_adscripcion==$pers_remitente->iid_adscripcion)
                                <option value="{{$adscripcion->iid_adscripcion}}" selected>{{$adscripcion->cdescripcion_adscripcion}}</option>
                            @else
                                <option value="{{$adscripcion->iid_adscripcion}}">{{$adscripcion->cdescripcion_adscripcion}}</option>
                            @endif
                        @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <hr>
                <div class="row">
                    <div class="col" id="divestatus">
                        <label for="estatus_documento" class="col-form-label text-md-right">Estatus:</label>
                        <select class="form-control m-bot15" name="estatus_documento" required {{ $noeditar }}>
                            <option value="">Elija un Estatus...</option>
                            @foreach($listEstatus as $indice=>$estatus)
                                @if($estatus->iid_estatus_documento==$documento->iid_estatus_documento)
                                    <option value="{{$estatus->iid_estatus_documento}}" selected>{{$estatus->cdescripcion_estatus_documento}}</option>
                                @else
                                    <option value="{{$estatus->iid_estatus_documento}}">{{$estatus->cdescripcion_estatus_documento}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col" id="divprioridad">
                        <label for="prioridad_documento" class="col-form-label text-md-right">Prioridad:</label>
                        <select class="form-control m-bot15" name="prioridad_documento" required {{ $noeditar }}>
                            <option value="">Elija una Prioridad...</option>
                            @foreach($listPrioridad as $indice=>$prioridad)
                                @if($prioridad->iid_prioridad_documento==$documento->iid_prioridad_documento)
                                    <option value="{{$prioridad->iid_prioridad_documento}}" selected>{{$prioridad->cdescripcion_prioridad_documento}}</option>
                                @else
                                    <option value="{{$prioridad->iid_prioridad_documento}}">{{$prioridad->cdescripcion_prioridad_documento}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col" id="divfoliorel">
                        <label for="folio_relacionado" class="col-form-label text-md-right">Folio Relacionado:</label>
                        <input type="text" id="folio_relacionado" name="folio_relacionado" class="form-control" data-target="#folio_relacionado" value="{{ $documento->cfolio_relacionado }}" {{ $noeditar }}/>
                    </div>
                    <div class="col" id="divnomarchs">
                        <label for="nomenclatura_archivistica" class="col-form-label text-md-right">Nomenclatura Archivistica:</label>
                        <input type="text" onkeypress="return textonly(event);" id="nomenclatura_archivistica" name="nomenclatura_archivistica" class="form-control" data-target="#nomenclatura_archivistica" value="{{ $documento->cnomenclatura_archivistica }}" maxlength="100" {{ $noeditar }} />
                    </div>
                </div>
                <br>
                <hr>
                <label>DESTINATARIO(S) DE COPIA DE CONOCIMIENTO</label>
                <div class="row" id="divdestinatariocc">
                    <div class="col-4" id="divnombre">
                        <label for="nombre_destinatariocc" class="col-form-label text-md-right">Nombre:</label>
                        <select class="form-control m-bot15" name="nombre_destinatariocc" {{ $noeditar }}>
                        <option value="">Elija un Destinatario Copia Conocimiento...</option>
                        @foreach($listPersonal as $indice=>$destincc)
                            @if($destincc->iid_personal==$pers_cncmnt->iid_personal)
                                <option value="{{$destincc->iid_personal}}" selected>{{$destincc->cnombre_personal.' '.$destincc->cpaterno_personal.' '.$destincc->cmaterno_personal}}</option>
                            @else
                                <option value="{{$destincc->iid_personal}}">{{$destincc->cnombre_personal.' '.$destincc->cpaterno_personal.' '.$destincc->cmaterno_personal}}</option>
                            @endif
                        @endforeach
                        </select>
                    </div>
                    <div class="col-4" id="divpuesto">
                        <label for="puesto_conocimiento" class="col-form-label text-md-right">Puesto:</label>
                        <select class="form-control m-bot15" name="puesto_conocimiento" {{ $noeditar }}>
                        <option value="">Elija un Puesto...</option>
                        @foreach($listPuesto as $indice=>$puesto)
                            @if($puesto->iid_puesto==$pers_cncmnt->iid_puesto)
                                <option value="{{$puesto->iid_puesto}}" selected>{{$puesto->cdescripcion_puesto}}</option>
                            @else
                                <option value="{{$puesto->iid_puesto}}">{{$puesto->cdescripcion_puesto}}</option>
                            @endif
                        @endforeach
                        </select>
                    </div>
                    <div class="col-4" id="divarea">
                        <label for="area_conocimiento" class="col-form-label text-md-right">Adscripción:</label>
                        <select class="form-control m-bot15" name="area_conocimiento" {{ $noeditar }}>
                        <option value="">Elija un Adscripción...</option>
                        @foreach($listAdscripcion as $indice=>$adscripcion)
                            @if($adscripcion->iid_adscripcion==$pers_cncmnt->iid_adscripcion)
                                <option value="{{$adscripcion->iid_adscripcion}}" selected>{{$adscripcion->cdescripcion_adscripcion}}</option>
                            @else
                                <option value="{{$adscripcion->iid_adscripcion}}">{{$adscripcion->cdescripcion_adscripcion}}</option>
                            @endif
                        @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <div>
                    <a href="#" data-toggle="tooltip" data-html="true" title="Nuevo">
                        + Agregar Destinatario
                    </a>
                </div>
                <div id="divMasDestinsConoc">
                </div>
                <br>
                <div class="row">
                    <div class="col-4" id="divimportancia">
                        <label for="importancia_contenido" class="col-form-label text-md-right">Importancia del Contenido:</label>
                        <select class="form-control m-bot15" name="importancia_contenido" {{ $noeditar }}>
                            <option value="">Elija una Importancia...</option>
                            @foreach($listImportancia as $indice=>$importancia)
                                @if($importancia->iid_importancia_contenido==$documento->iid_importancia_contenido)
                                    <option value="{{$importancia->iid_importancia_contenido}}" selected>{{$importancia->cdescripcion_importancia_contenido}}</option>
                                @else
                                    <option value="{{$importancia->iid_importancia_contenido}}">{{$importancia->cdescripcion_importancia_contenido}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4" id="divtema">
                        <label for="tema" class="col-form-label text-md-right">Tema:</label>
                        <select class="form-control m-bot15" name="tema" {{ $noeditar }}>
                            <option value="">Elija un Tema...</option>
                            @foreach($listTema as $indice=>$tema)
                                @if($tema->iid_tema==$documento->iid_tema)
                                    <option value="{{$tema->iid_tema}}" selected>{{$tema->cdescripcion_tema}}</option>
                                @else
                                    <option value="{{$tema->iid_tema}}">{{$tema->cdescripcion_tema}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col" id="divtipoasunto">
                        <label for="tipo_asunto" class="col-form-label text-md-right">Tipo de Asunto:</label>
                        <select class="form-control m-bot15" name="tipo_asunto" {{ $noeditar }}>
                            <option value="">Elija un Asunto...</option>
                            @foreach($listAsunto as $indice=>$asunto)
                                @if($asunto->iid_tipo_asunto==$documento->iid_tipo_asunto)
                                    <option value="{{$asunto->iid_tipo_asunto}}" selected>{{$asunto->cdescripcion_tipo_asunto}}</option>
                                @else
                                    <option value="{{$asunto->iid_tipo_asunto}}">{{$asunto->cdescripcion_tipo_asunto}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <hr>
                <div class="row">
                    <div class="col" id="divinstruccion">
                        <label for="instruccion" class="col-form-label text-md-right">Instrucción:</label>
                        <select class="form-control m-bot15" name="instruccion" required {{ $noeditar }}>
                            <option value="">Elija una Instrucción...</option>
                            @foreach($listInstruccion as $indice=>$instruccion)
                                @if($instruccion->iid_instruccion==$documento->iid_instruccion)
                                    <option value="{{$instruccion->iid_instruccion}}" selected>{{$instruccion->cdescripcion_instruccion}}</option>
                                @else
                                    <option value="{{$instruccion->iid_instruccion}}">{{$instruccion->cdescripcion_instruccion}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col" id="divtermino">
                        <label for="fecha_termino" class="col-form-label text-md-right">Fecha de Término:</label>
                        <input type="date" id="fecha_termino" name="fecha_termino" class="form-control" data-target="#fecha_termino" value="{{ $documento->dfecha_termino }}" maxlength="10" {{ $noeditar }}/>
                    </div>
                    <div class="col" id="divasunto">
                        <label for="asunto" class="col-form-label text-md-right">Asunto:</label>
                        <!--
                        <input type="text" onkeypress="return textonly(event);" id="asunto" name="asunto" class="form-control" data-target="#asunto" value="{{ $documento->casunto }}" maxlength="500" required {{ $noeditar }} />
                            -->
                        <textarea name="asunto" class="form-control" data-target="#asunto" required {{ $noeditar }}>{{ $documento->casunto }}</textarea>
                    </div>
                    <div class="col" id="divobservaciones">
                        <label for="observaciones" class="col-form-label text-md-right">Observaciones:</label>
                        <!--
                        <input type="text" onkeypress="return textonly(event);" id="observaciones" name="observaciones" class="form-control" data-target="#observaciones" value="{{ $documento->cobservaciones }}" maxlength="500" {{ $noeditar }} />
                            -->
                        <textarea name="observaciones" class="form-control" data-target="#observaciones" {{ $noeditar }}>{{ $documento->cobservaciones }}</textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4" id="divdestinatn">
                        <label for="destinatario_atencion" class="col-form-label text-md-right">Destinatarios para Atención:</label>
                        
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="destin2" name="destin2">
                            @else
                                {{$check=''}}
                                @foreach($destinAtt as $indice=>$destAt)
                                    @if($destinAtt_total>0 && $destAt->iid_adscripcion==2)
                                        <input type="checkbox" id="destin2" name="destin2" checked {{$noeditar}}>
                                        {{$check=' '}}
                                    @endif
                                @endforeach
                                @if($check=='')
                                    <input type="checkbox" id="destin2" name="destin2" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="destin2">OOFMTSJCDMX</label>
                        </div>
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="destin12" name="destin12">
                            @else
                                {{$check=''}}
                                @foreach($destinAtt as $indice=>$destAt)
                                    @if($destinAtt_total>0 && $destAt->iid_adscripcion==12)
                                        <input type="checkbox" id="destin12" name="destin12" checked {{$noeditar}}>
                                        {{$check=' '}}
                                    @endif
                                @endforeach
                                @if($check=='')
                                    <input type="checkbox" id="destin12" name="destin12" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="destin12">DEP</label>
                        </div>
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="destin14" name="destin14">
                            @else
                                {{$check=''}}
                                @foreach($destinAtt as $indice=>$destAt)
                                    @if($destinAtt_total>0 && $destAt->iid_adscripcion==14)
                                        <input type="checkbox" id="destin14" name="destin14" checked {{$noeditar}}>
                                        {{$check=' '}}
                                    @endif
                                @endforeach
                                @if($check=='')
                                    <input type="checkbox" id="destin14" name="destin14" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="destin14">DEGT</label>
                        </div>
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="destin15" name="destin15">
                            @else
                                {{$check=''}}
                                @foreach($destinAtt as $indice=>$destAt)
                                    @if($destinAtt_total>0 && $destAt->iid_adscripcion==15)
                                        <input type="checkbox" id="destin15" name="destin15" checked {{$noeditar}}>
                                        {{$check=' '}}
                                    @endif
                                @endforeach
                                @if($check=='')
                                    <input type="checkbox" id="destin15" name="destin15" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="destin15">DERH</label>
                        </div>
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="destin16" name="destin16">
                            @else
                                {{$check=''}}
                                @foreach($destinAtt as $indice=>$destAt)
                                    @if($destinAtt_total>0 && $destAt->iid_adscripcion==16)
                                        <input type="checkbox" id="destin16" name="destin16" checked {{$noeditar}}>
                                        {{$check=' '}}
                                    @endif
                                @endforeach
                                @if($check=='')
                                    <input type="checkbox" id="destin16" name="destin16" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="destin16">DEOMS</label>
                        </div>
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="destin17" name="destin17">
                            @else
                                {{$check=''}}
                                @foreach($destinAtt as $indice=>$destAt)
                                    @if($destinAtt_total>0 && $destAt->iid_adscripcion==17)
                                        <input type="checkbox" id="destin17" name="destin17" checked {{$noeditar}}>
                                        {{$check=' '}}
                                    @endif
                                @endforeach
                                @if($check=='')
                                    <input type="checkbox" id="destin17" name="destin17" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="destin17">DERM</label>
                        </div>
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="destin18" name="destin18">
                            @else
                                {{$check=''}}
                                @foreach($destinAtt as $indice=>$destAt)
                                    @if($destinAtt_total>0 && $destAt->iid_adscripcion==18)
                                        <input type="checkbox" id="destin18" name="destin18" checked {{$noeditar}}>
                                        {{$check=' '}}
                                    @endif
                                @endforeach
                                @if($check=='')
                                    <input type="checkbox" id="destin18" name="destin18" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="destin18">DERF</label>
                        </div>
                        
                        <div class="col">
                            <input type="checkbox" id="destin999" name="destin999" {{$noeditar}}>
                            <label for="destin999">OTRO</label>
                        </div>
                        @if($destinAtt_total>0)
                            <select class="form-control m-bot15" name="dest_att[]" multiple disabled>
                                @foreach($listDestinAtn as $indice=>$atencion)
                                    @foreach($destinAtt as $indice=>$attncn)
                                        @if($attncn->iid_adscripcion==$atencion->iid_adscripcion)
                                            <option value="{{$atencion->iid_adscripcion}}">{{$atencion->cdescripcion_adscripcion}}</option>
                                        @endif
                                    @endforeach
                                @endforeach
                            </select>
                        @endif
                        <select class="form-control m-bot15" name="destinatario_atencion[]" multiple="" {{ $noeditar }}>
                            @foreach($listDestinAtn as $indice=>$atencion)
                                <option value="{{$atencion->iid_adscripcion}}">{{$atencion->cdescripcion_adscripcion}}</option>
                            @endforeach
                            <option value="999">OTRO</option>
                        </select>
                    </div>
                    <div class="col-4" id="divdestinconoc">
                        <label for="destinatario_conocimiento" class="col-form-label text-md-right">Destinatarios para Conocimiento:</label>
                        <select class="form-control m-bot15" name="destinatario_conocimiento[]" multiple="" {{ $noeditar }}>
                            @foreach($listDestinConoc as $indice=>$conocimiento)
                                @if($conocimiento->iid_adscripcion==$documento->iid_adscripcion)
                                    <option value="{{$conocimiento->iid_adscripcion}}" selected>{{$conocimiento->cdescripcion_adscripcion}}</option>
                                @else
                                    <option value="{{$conocimiento->iid_adscripcion}}">{{$conocimiento->cdescripcion_adscripcion}}</option>
                                @endif
                            @endforeach
                            <option value="999">OTRO</option>
                        </select>
                    </div>
                    <div class="col" id="divarchivo">
                        <label for="archivo" class="col-form-label text-md-right">Archivo Dígital:</label>
                        <input type="file" id="archivo" name="archivo" class="form-control" data-target="#archivo" {{ $noeditar }}/>
                        <a href="{{url(substr($documento->cruta_archivo_documento,strrpos($documento->cruta_archivo_documento,'pdf/')))}}" target="_blank">{{substr($documento->cruta_archivo_documento,strrpos($documento->cruta_archivo_documento,'pdf/'))}}</a>
                    </div>
                </div>
                <br>