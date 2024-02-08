                <div class="row">
                    <div class="col" id="divfolio">
                        <label for="folio_documento" class="col-form-label text-md-right">Número de Folio:</label>
                        <input type="text" id="folio_documento" name="folio_documento" class="form-control" data-target="#folio_documento" value="{{ $newfolio }}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="13" onkeypress="return textnumber(event);" required />
                    </div>
                    <div class="col" id="divrecepcion">
                        <label for="recepcion_documento" class="col-form-label text-md-right">Fecha de Recepcion:</label>
                        <input type="date" id="recepcion_documento" name="recepcion_documento" class="form-control" data-target="#recepcion_documento" value="{{ $documento->dfecha_recepcion }}" maxlength="10" required {{ $noeditar }} autofocus/>
                    </div>
                    <div class="col" id="divnumdoc">
                        <label for="numero_documento" class="col-form-label text-md-right">Número de Documento:</label>
                        <input type="text" id="numero_documento" name="numero_documento" class="form-control" data-target="#numero_documento" value="{{ $documento->cnumero_documento }}" maxlength="100" required {{ $noeditar }} />
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
                        <select class="form-control m-bot15" id="tipo_documento" name="tipo_documento" required {{ $noeditar }}>
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
                        <select class="form-control m-bot15" id="tipo_anexo" name="tipo_anexo" required {{ $noeditar }}>
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
                <div id="divotroanexo" style="display:none;">
                    <div class="row">
                        <div class="col">
                        </div>
                        <div class="col">
                        </div>
                        <div class="col">
                            <label for="otro_tipo_anexo" class="col-form-label text-md-right">Otro Tipo de Anexo:</label>
                            <input type="text" id="otro_tipo_anexo" name="otro_tipo_anexo" class="form-control" value="" maxlength="50" {{ $noeditar }}/>
                        </div>
                    </div>
                </div>
                <br>
                <center><div id="validaDocumento"></div></center>
                <center><div id="validaFolioDup"></div></center>
                <hr>
                <label><b>REMITENTE</b></label>
                <div class="row" id="divremitente">
                    <div class="col-3" id="divbuscarnombre">
                        <label for="nombre_remitente" class="col-form-label text-md-right">Buscar Nombre:</label>
                        <input type="text" onkeypress="return textonly(event);" id="nombre_remitente" name="nombre_remitente" class="form-control" value="" maxlength="50" required {{ $noeditar }}/>
                    </div>
                    <div class="col-3" id="divselectnombre">
                        <label for="listanr" class="col-form-label text-md-right">Seleccionar Nombre:</label>
                        <select class="form-control m-bot15" id="listanr" name="listanr" required {{ $noeditar }}>
                            <option value="0">Escriba un Nombre de Remitente...</option>
                        </select>
                    </div>
                    <div class="col-3" id="divpuesto">
                        <label for="puesto_remitente" class="col-form-label text-md-right">Puesto:</label>
                        <select class="form-control m-bot15" id="puesto_remitente" name="puesto_remitente" required {{ $noeditar }}>
                            <option value="">Escriba un Nombre de Remitente...</option>
                        </select>
                    </div>
                    <div class="col-3" id="divarea">
                        <label for="area_remitente" class="col-form-label text-md-right">Adscripción:</label>
                        <select class="form-control m-bot15" id="area_remitente" name="area_remitente" required {{ $noeditar }}>
                            <option value="">Escriba un Nombre de Remitente...</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row" id="divMarkOtro">
                    <div class="col">
                        <input type="checkbox" id="markOtro" name="markOtro" {{$noeditar}}>
                        <label for="markOtro" class="col-form-label" id="linkOtroNombre">Otro Nombre</label>
                    </div>
                </div>
                <div id="divotronombre" style="display:none;">
                    <div class="row">
                        <div class="col" id="divnewname">
                            <label for="nuevo_nombre" class="col-form-label text-md-right">Nuevo Nombre:</label>
                            <input type="text" id="nuevo_nombre" name="nuevo_nombre" class="form-control" data-target="#nuevo_nombre" value="" maxlength="100" {{ $noeditar }} />
                        </div>
                        <div class="col" id="divpatotrapersona">
                            <label for="otro_paterno" class="col-form-label text-md-right">Paterno:</label>
                            <input type="text" id="otro_paterno" name="otro_paterno" class="form-control" data-target="#otro_paterno" value="" maxlength="100" {{ $noeditar }} />
                        </div>
                        <div class="col" id="divmatotrapersona">
                            <label for="otro_materno" class="col-form-label text-md-right">Materno:</label>
                            <input type="text" id="otro_materno" name="otro_materno" class="form-control" data-target="#otro_materno" value="" maxlength="100" {{ $noeditar }} />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col" id="divnvopuesto">
                            <label for="otro_nvo_puesto" class="col-form-label text-md-right">Puesto:</label>
                            <select class="form-control m-bot15" id="otro_nvo_puesto" name="otro_nvo_puesto" {{ $noeditar }}>
                                <option value="">Elija un Puesto...</option>
                                @foreach($listPuesto as $indice=>$psto)
                                    <option value="{{$psto->iid_puesto}}">{{$psto->cdescripcion_puesto}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col" id="divnvootropuesto">
                            <label for="otra_desc_puesto" class="col-form-label text-md-right">Nuevo Puesto:</label>
                            <input type="text" id="otra_desc_puesto" name="otra_desc_puesto" class="form-control" data-target="#otra_desc_puesto" value="" maxlength="100" />
                        </div>
                        <div class="col" id="divnvaadsc">
                            <label for="otra_nva_adscripcion" class="col-form-label text-md-right">Área/Razón Social:</label>
                            <select class="form-control m-bot15" id="otra_nva_adscripcion" name="otra_nva_adscripcion" {{ $noeditar }}>
                                <option value="">Elija una Adscripcion...</option>
                                @foreach($listAdscripcion as $indice=>$adsc)
                                    <option value="{{$adsc->iid_adscripcion}}">{{$adsc->cdescripcion_adscripcion}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col" id="divnvootraadsc">
                            <label for="otra_desc_adsc" class="col-form-label text-md-right">Nuevo Área/Razón Social:</label>
                            <input type="text" id="otra_desc_adsc" name="otra_desc_adsc" class="form-control" data-target="#otra_desc_adsc" value="" maxlength="100" />
                        </div>
                        <div class="col" id="divnvotipoadsc">
                            <label for="nvo_tipo_adscripcion" class="col-form-label text-md-right">Tipo de Adscripción:</label>
                            <select class="form-control m-bot15" id="nvo_tipo_adscripcion" name="nvo_tipo_adscripcion" {{ $noeditar }}>
                                <option value="">Elija un Tipo de Adscripción...</option>
                                @foreach($listTipoArea as $indice=>$tipo_area)
                                    <option value="{{$tipo_area->iid_tipo_area}}">{{$tipo_area->cdescripcion_tipo_area}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <center><div id="validaPersonal"></div></center>
                <br>
                <hr>
                <div class="row">
                    <div class="col" id="divestatus">
                        <label for="estatus_documento" class="col-form-label text-md-right">Estatus:</label>
                        <select class="form-control m-bot15" id="estatus_documento" name="estatus_documento" required {{ $noeditar }}>
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
                        <select class="form-control m-bot15" id="prioridad_documento" name="prioridad_documento" required {{ $noeditar }}>
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
                    <div class="col" id="divsemaforo">
                        <label for="semaforo" class="col-form-label text-md-right">Semaforo:</label>
                        <select class="form-control m-bot15" id="semaforo" name="semaforo" required {{ $noeditar }}>
                            <option value="">Elija un color de Semaforo...</option>
                            @foreach($listSemaforo as $indice=>$semaforo)
                                @if($semaforo->iid_semaforo==$documento->iid_semaforo)
                                    <option value="{{$semaforo->iid_semaforo}}" selected>{{$semaforo->ccolor_semaforo}}</option>
                                @else
                                    <option value="{{$semaforo->iid_semaforo}}">{{$semaforo->ccolor_semaforo}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col" id="divfoliorel">
                        <label for="folio_relacionado" class="col-form-label text-md-right">Folio Relacionado:</label>
                        <input type="text" id="folio_relacionado" name="folio_relacionado" class="form-control" data-target="#folio_relacionado" value="" {{ $noeditar }}/>
                    </div>
                    <div class="col" id="divnomarchs">
                        <label for="nomenclatura_archivistica" class="col-form-label text-md-right">Nomenclatura Archivistica:</label>
                        <input type="text" onkeypress="return textonly(event);" id="nomenclatura_archivistica" name="nomenclatura_archivistica" class="form-control" data-target="#nomenclatura_archivistica" value="{{ $documento->cnomenclatura_archivistica }}" maxlength="100" {{ $noeditar }} />
                    </div>
                </div>
                <br>
                <center><div id="validaFolioRel"></div></center>
                <hr>
                <div id="divdestinatariocc">
                    <label><b>DESTINATARIO(S) DE COPIA DE CONOCIMIENTO</b></label>
                    <div class="row">
                        <div class="col-3" id="divbuscarnombrecc">
                            <label for="destinatario_cc" class="col-form-label text-md-right">Buscar Nombre:</label>
                            <input type="text" onkeypress="return textonly(event);" id="destinatario_cc" name="destinatario_cc" class="form-control" value="" maxlength="50" {{ $noeditar }}/>
                        </div>
                        <div class="col-3" id="divnombre">
                            <label for="nombre_destinatariocc" class="col-form-label text-md-right">Seleccionar Nombre:</label>
                            <select class="form-control m-bot15" id="nombre_destinatariocc" name="nombre_destinatariocc" required {{ $noeditar }}>
                                <option value="0">Escriba un Nombre de Destinatario...</option>
                            </select>
                        </div>
                        <div class="col-3" id="divpuesto">
                            <label for="puesto_conocimiento" class="col-form-label text-md-right">Puesto:</label>
                            <select class="form-control m-bot15" id="puesto_conocimiento" name="puesto_conocimiento" {{ $noeditar }}>
                                <option value="">Escriba un Nombre de Destinatario...</option>
                            </select>
                        </div>
                        <div class="col-3" id="divarea">
                            <label for="area_conocimiento" class="col-form-label text-md-right">Adscripción:</label>
                            <select class="form-control m-bot15" id="area_conocimiento" name="area_conocimiento" {{ $noeditar }}>
                                <option value="">Escriba un Nombre de Destinatario...</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-4" id="divimportancia">
                            <label for="importancia_contenido" class="col-form-label text-md-right">Importancia del Contenido:</label>
                            <select class="form-control m-bot15" name="importancia_contenido" {{ $noeditar }}>
                                <option value="">Elija una Importancia...</option>
                                @foreach($listImportancia as $indice=>$importancia)
                                    @if($importancia->iid_importancia_contenido==$documento->iid_importancia_contenido)
                                        <option value="{{$importancia->iid_importancia_contenido}}" selected>{{$importancia->cdescripcion_importancia_conten}}</option>
                                    @else
                                        <option value="{{$importancia->iid_importancia_contenido}}">{{$importancia->cdescripcion_importancia_conten}}</option>
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
                            <select class="form-control m-bot15" id="tipo_asunto" name="tipo_asunto" {{ $noeditar }}>
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
                    <div id="divotroasunto" style="display:none;">
                        <div class="row">
                            <div class="col">
                            </div>
                            <div class="col">
                            </div>
                            <div class="col">
                                <label for="otro_tipo_asunto" class="col-form-label text-md-right">Otro Tipo de Asunto:</label>
                                <input type="text" id="otro_tipo_asunto" name="otro_tipo_asunto" class="form-control" value="" maxlength="50" {{ $noeditar }}/>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <center><div id="validaPersonalDest"></div></center>
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
                    <div class="col-2" id="divtermino">
                        <label for="fecha_termino" class="col-form-label text-md-right">Fecha de Término:</label>
                        <input type="date" id="fecha_termino" name="fecha_termino" class="form-control" data-target="#fecha_termino" value="{{ $documento->dfecha_termino }}" maxlength="10" {{ $noeditar }}/>
                    </div>
                    <div class="col" id="divasunto">
                        <label for="asunto" class="col-form-label text-md-right">Asunto:</label>
                        <textarea name="asunto" class="form-control" data-target="#asunto" maxlength="1000" required {{ $noeditar }}>{{ $documento->casunto }}</textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-5" id="divobservaciones">
                        <label for="observaciones" class="col-form-label text-md-right">Observaciones:</label>
                        <textarea name="observaciones" class="form-control" data-target="#observaciones" maxlength="500" {{ $noeditar }}>{{ $documento->cobservaciones }}</textarea>
                    </div>
                    <div class="col-4" id="divarchivo">
                        <label for="archivo" class="col-form-label text-md-right">Archivo Dígital:</label>
                        <input type="file" id="archivo" name="archivo" class="form-control" data-target="#archivo" {{ $noeditar }}/>
                        <a href="{{url('pdf/'.substr($documento->cruta_archivo_documento,strrpos($documento->cruta_archivo_documento,'pdf/')+4))}}" target="_blank">{{substr($documento->cruta_archivo_documento,strrpos($documento->cruta_archivo_documento,'pdf/')+4)}}</a>
                    </div>
                </div>
                <br>
                <hr>
                <div class="row" id="divSegmntDADC">
                    <div class="col-4" id="divdestinatn">
                        <label for="destinatario_atencion" class="col-form-label text-md-right">Destinatarios para Atención:</label>
                    <!--Checkboxes de Destinatarios Atención-->
                        @include('documentos.datos_destinatarios_atencion')
                    </div>
                    <div class="col-4" id="divdestinconoc">
                        <label for="destinatario_conocimiento" class="col-form-label text-md-right">Destinatarios para Conocimiento:</label>
                    <!--Checkboxes de Destinatarios Conocimiento-->
                        @include('documentos.datos_destinatarios_conocimiento')
                    </div>
                    <div class="row" id="otrapers_at_cmto" style="display:none;">
                        @include('documentos.datos_otrapers_at_cmto')
                    </div>
                </div>
                <div id="divRHAtencion">
                    <div class="row">
                        <label><b>DESTINATARIO PARA ATENCIÓN DEL:</b></label>
                    <!--Checkboxes de Atención Presidente u Oficial Mayor para Documentos de RH-->
                        @include('documentos.datos_atencion_presid_ofmayor')
                    </div>
                    <hr>
                    <div class="row">
                        <label><b>A QUIÉN SE DIRIGE:</b></label>
                    <!--Checkboxes de Dirigido a Director Administrativo o DERH para Documentos de RH-->
                        @include('documentos.datos_atencion_da_derh')
                    </div>
                </div>
                <hr>