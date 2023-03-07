                <div class="row">
                    <div class="col" id="divfoliorel">
                        <label for="folio_relacionado" class="col-form-label text-md-right">Folio Relacionado:</label>
                        <input type="text" id="folio_relacionado" name="folio_relacionado" class="form-control" data-target="#folio_relacionado" value="{{$folio_relacionado->cfolio_relacionado}}" {{ $noeditar }} required />
                    </div>
                    <div class="col" id="divrecepcion">
                        <label for="fr_recep_docto" class="col-form-label text-md-right">Fecha de Recepcion:</label>
                        <input type="date" id="fr_recep_docto" name="fr_recep_docto" class="form-control" data-target="#fr_recep_docto" value="{{ $docto_relacionado->dfecha_recepcion }}" {{ $noeditar }}/>
                    </div>
                    <div class="col" id="divnumdoc">
                        <label for="fr_num_docto" class="col-form-label text-md-right">Número de Documento:</label>
                        <input type="text" id="fr_num_docto" name="fr_num_docto" class="form-control" data-target="#fr_num_docto" value="{{ $docto_relacionado->cnumero_documento }}" {{ $noeditar }} />
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col" id="divfecdoc">
                        <label for="fr_fec_docto" class="col-form-label text-md-right">Fecha del Documento:</label>
                        <input type="date" id="fr_fec_docto" name="fr_fec_docto" class="form-control" data-target="#fr_fec_docto" value="{{ $docto_relacionado->dfecha_documento }}" {{ $noeditar }}/>
                    </div>
                    <div class="col" id="divtipodoc">
                        <label for="fr_tip_docto" class="col-form-label text-md-right">Tipo de Documento:</label>
                        <input type="text" id="fr_tip_docto" name="fr_tip_docto" class="form-control" data-target="#fr_tip_docto" value="{{ $docto_relacionado->tipodocumento->cdescripcion_tipo_documento }}" {{ $noeditar }} />
                    </div>
                    <div class="col" id="divtipoanexo">
                        <label for="fr_tip_anexo" class="col-form-label text-md-right">Tipo de Anexo:</label>
                        <input type="text" id="fr_tip_anexo" name="fr_tip_anexo" class="form-control" data-target="#fr_tip_anexo" value="{{ $docto_relacionado->tipoanexo->cdescripcion_tipo_anexo }}" {{ $noeditar }} />
                    </div>
                </div>
                <br>
                <center><div id="validaFolioRel"></div></center>
                <hr>
                <label><b>REMITENTE</b></label>
                <div class="row" id="divremitente">
                    <div class="col-4" id="divnombre">
                        <label for="fr_nomb_remitte" class="col-form-label text-md-right">Nombre:</label>
                        <input type="text" id="fr_nomb_remitte" name="fr_nomb_remitte" class="form-control" data-target="#fr_nomb_remitte" value="{{ $docto_relacionado->personalremitente->cnombre_personal.' '.$docto_relacionado->personalremitente->cpaterno_personal.' '.$docto_relacionado->personalremitente->cmaterno_personal }}" {{ $noeditar }}/>
                    </div>
                    <div class="col-4" id="divpuesto">
                        <label for="fr_psto_remitte" class="col-form-label text-md-right">Puesto:</label>
                        <input type="text" id="fr_psto_remitte" name="fr_psto_remitte" class="form-control" data-target="#fr_psto_remitte" value="{{ $docto_relacionado->personalremitente->puesto->cdescripcion_puesto }}" {{ $noeditar }} />
                    </div>
                    <div class="col-4" id="divarea">
                        <label for="fr_area_remitte" class="col-form-label text-md-right">Adscripción:</label>
                        <input type="text" id="fr_area_remitte" name="fr_area_remitte" class="form-control" data-target="#fr_area_remitte" value="{{ $docto_relacionado->personalremitente->adscripcion->cdescripcion_adscripcion }}" {{ $noeditar }} />
                    </div>
                </div>
                <br>