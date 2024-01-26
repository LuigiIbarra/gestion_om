    <div class="row">
        <div class="col" id="divnewnameac">
            <label for="nuevo_nombre_ac" class="col-form-label text-md-right">Nuevo Nombre:</label>
            @if ($otro_pers_at!=null)
                @if ($destinAtt_total>0 && $otro_pers_at->iid_adscripcion==1355)
                    @if ($otro_pers_at->otropersonal!=null)
                        <input type="text" id="nuevo_nombre_ac" name="nuevo_nombre_ac" class="form-control" data-target="#nuevo_nombre_ac" value="{{ $otro_pers_at->otropersonal->cnombre_personal }}" maxlength="100" {{ $noeditar }} />
                    @else
                        <input type="text" id="nuevo_nombre_ac" name="nuevo_nombre_ac" class="form-control" data-target="#nuevo_nombre_ac" value="" maxlength="100" {{ $noeditar }} />
                    @endif
                @endif
            @elseif ($otro_pers_cn!=null) 
                @if ($destinCon_total>0 && $otro_pers_cn->iid_adscripcion==1355)
                    @if ($otro_pers_cn->otropersonal!=null)
                        <input type="text" id="nuevo_nombre_ac" name="nuevo_nombre_ac" class="form-control" data-target="#nuevo_nombre_ac" value="{{ $otro_pers_cn->otropersonal->cnombre_personal }}" maxlength="100" {{ $noeditar }} />
                    @else
                        <input type="text" id="nuevo_nombre_ac" name="nuevo_nombre_ac" class="form-control" data-target="#nuevo_nombre_ac" value="" maxlength="100" {{ $noeditar }} />
                    @endif
                @endif
            @else
                <input type="text" id="nuevo_nombre_ac" name="nuevo_nombre_ac" class="form-control" data-target="#nuevo_nombre_ac" value="" maxlength="100" {{ $noeditar }} />
            @endif
        </div>
        <div class="col" id="divpatotrapersonaac">
            <label for="otro_paterno_ac" class="col-form-label text-md-right">Paterno:</label>
            @if ($otro_pers_at!=null)
                @if ($destinAtt_total>0 && $otro_pers_at->iid_adscripcion==1355)
                    @if ($otro_pers_at->otropersonal!=null)
                        <input type="text" id="otro_paterno_ac" name="otro_paterno_ac" class="form-control" data-target="#otro_paterno_ac" value="{{ $otro_pers_at->otropersonal->cpaterno_personal }}" maxlength="100" {{ $noeditar }} />
                    @else
                        <input type="text" id="otro_paterno_ac" name="otro_paterno_ac" class="form-control" data-target="#otro_paterno_ac" value="" maxlength="100" {{ $noeditar }} />
                    @endif
                @endif
            @elseif ($otro_pers_cn!=null)
                @if ($destinCon_total>0 && $otro_pers_cn->iid_adscripcion==1355)
                    @if ($otro_pers_cn->otropersonal!=null)
                        <input type="text" id="otro_paterno_ac" name="otro_paterno_ac" class="form-control" data-target="#otro_paterno_ac" value="{{ $otro_pers_cn->otropersonal->cpaterno_personal }}" maxlength="100" {{ $noeditar }} />
                    @else
                        <input type="text" id="otro_paterno_ac" name="otro_paterno_ac" class="form-control" data-target="#otro_paterno_ac" value="" maxlength="100" {{ $noeditar }} />
                    @endif
                @endif
            @else
                <input type="text" id="otro_paterno_ac" name="otro_paterno_ac" class="form-control" data-target="#otro_paterno_ac" value="" maxlength="100" {{ $noeditar }} />
            @endif
        </div>
        <div class="col" id="divmatotrapersonaac">
            <label for="otro_materno_ac" class="col-form-label text-md-right">Materno:</label>
            @if ($otro_pers_at!=null)
                @if ($destinAtt_total>0 && $otro_pers_at->iid_adscripcion==1355)
                    @if ($otro_pers_at->otropersonal!=null)
                        <input type="text" id="otro_materno_ac" name="otro_materno_ac" class="form-control" data-target="#otro_materno_ac" value="{{ $otro_pers_at->otropersonal->cmaterno_personal }}" maxlength="100" {{ $noeditar }} />
                    @else
                        <input type="text" id="otro_materno_ac" name="otro_materno_ac" class="form-control" data-target="#otro_materno_ac" value="" maxlength="100" {{ $noeditar }} />
                    @endif
                @endif
            @elseif ($otro_pers_cn!=null) 
                @if ($destinCon_total>0 && $otro_pers_cn->iid_adscripcion==1355)
                    @if ($otro_pers_cn->otropersonal!=null)
                        <input type="text" id="otro_materno_ac" name="otro_materno_ac" class="form-control" data-target="#otro_materno_ac" value="{{ $otro_pers_cn->otropersonal->cmaterno_personal }}" maxlength="100" {{ $noeditar }} />
                    @else
                        <input type="text" id="otro_materno_ac" name="otro_materno_ac" class="form-control" data-target="#otro_materno_ac" value="" maxlength="100" {{ $noeditar }} />
                    @endif
                @endif
            @else
                <input type="text" id="otro_materno_ac" name="otro_materno_ac" class="form-control" data-target="#otro_materno_ac" value="" maxlength="100" {{ $noeditar }} />
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col" id="divnvopuestoac">
            <label for="otro_nvo_puesto_ac" class="col-form-label text-md-right">Puesto:</label>
            <select class="form-control m-bot15" id="otro_nvo_puesto_ac" name="otro_nvo_puesto_ac" {{ $noeditar }}>
            @if ($otro_pers_at!=null)
                @if ($destinAtt_total>0 && $otro_pers_at->iid_adscripcion==1355)
                    @if ($otro_pers_at->otropersonal!=null)
                        <option value="{{$otro_pers_at->iid_otro_puesto}}" selected>{{$otro_pers_at->otropuesto->cdescripcion_puesto}}</option>
                    @else
                        <option value="">Elija un Puesto...</option>
                        @foreach($listPuesto as $indice=>$psto)
                            <option value="{{$psto->iid_puesto}}">{{$psto->cdescripcion_puesto}}</option>
                        @endforeach
                    @endif
                @endif
            @elseif ($otro_pers_cn!=null)
                @if ($destinCon_total>0 && $otro_pers_cn->iid_adscripcion==1355)
                    @if ($otro_pers_cn->otropersonal!=null)
                        <option value="{{$otro_pers_cn->iid_otro_puesto}}" selected>{{$otro_pers_cn->otropuesto->cdescripcion_puesto}}</option>
                    @else
                        <option value="">Elija un Puesto...</option>
                        @foreach($listPuesto as $indice=>$psto)
                            <option value="{{$psto->iid_puesto}}">{{$psto->cdescripcion_puesto}}</option>
                        @endforeach
                    @endif
                @endif
            @else
                <option value="">Elija un Puesto...</option>
                @foreach($listPuesto as $indice=>$psto)
                    <option value="{{$psto->iid_puesto}}">{{$psto->cdescripcion_puesto}}</option>
                @endforeach
            @endif
            </select>
        </div>
        <div class="col" id="divnvootropuestoac">
            <label for="otra_desc_puesto_ac" class="col-form-label text-md-right">Nuevo Puesto:</label>
            <input type="text" id="otra_desc_puesto_ac" name="otra_desc_puesto_ac" class="form-control" data-target="#otra_desc_puesto_ac" value="" maxlength="100" />
        </div>
        <div class="col" id="divnvaadscac">
            <label for="otra_nva_adscripcion_ac" class="col-form-label text-md-right">Área/Razón Social:</label>
            <select class="form-control m-bot15" id="otra_nva_adscripcion_ac" name="otra_nva_adscripcion_ac" {{ $noeditar }}>
            @if ($otro_pers_at!=null)
                @if ($destinAtt_total>0 && $otro_pers_at->iid_adscripcion==1355)
                    @if ($otro_pers_at->otropersonal!=null)
                        <option value="{{$otro_pers_at->iid_otra_adscripcion}}">{{$otro_pers_at->otraadscripcion->cdescripcion_adscripcion}}</option>
                    @else
                        <option value="">Elija una Adscripcion...</option>
                        @foreach($listAdscripcion as $indice=>$adsc)
                            <option value="{{$adsc->iid_adscripcion}}">{{$adsc->cdescripcion_adscripcion}}</option>
                        @endforeach
                    @endif
                @endif
            @elseif ($otro_pers_cn!=null)
                @if ($destinCon_total>0 && $otro_pers_cn->iid_adscripcion==1355)
                    @if ($otro_pers_cn->otropersonal!=null)
                        <option value="{{$otro_pers_cn->iid_otra_adscripcion}}">{{$otro_pers_cn->otraadscripcion->cdescripcion_adscripcion}}</option>
                    @else
                        <option value="">Elija una Adscripcion...</option>
                        @foreach($listAdscripcion as $indice=>$adsc)
                            <option value="{{$adsc->iid_adscripcion}}">{{$adsc->cdescripcion_adscripcion}}</option>
                        @endforeach
                    @endif
                @endif
            @else
                <option value="">Elija una Adscripcion...</option>
                @foreach($listAdscripcion as $indice=>$adsc)
                    <option value="{{$adsc->iid_adscripcion}}">{{$adsc->cdescripcion_adscripcion}}</option>
                @endforeach
            @endif
            </select>
        </div>
        <div class="col" id="divnvootraadscac">
            <label for="otra_desc_adsc_ac" class="col-form-label text-md-right">Nuevo Área/Razón Social:</label>
            <input type="text" id="otra_desc_adsc_ac" name="otra_desc_adsc_ac" class="form-control" data-target="#otra_desc_adsc_ac" value="" maxlength="100" />
        </div>
        <div class="col" id="divnvotipoadscac">
            <label for="nvo_tipo_adscripcion_ac" class="col-form-label text-md-right">Tipo de Adscripción:</label>
            <select class="form-control m-bot15" id="nvo_tipo_adscripcion_ac" name="nvo_tipo_adscripcion_ac" {{ $noeditar }}>
                @if ($otro_pers_at!=null)
                    @if ($destinAtt_total>0 && $otro_pers_at->iid_adscripcion==1355)
                        @if ($otro_pers_at->otropersonal!=null)
                            @foreach($listTipoArea as $indice=>$tipo_area)
                                @if ($tipo_area->iid_tipo_area==$otro_pers_at->otraadscripcion->tipoarea->iid_tipo_area)
                                    <option value="{{$tipo_area->iid_tipo_area}}" selected>{{$tipo_area->cdescripcion_tipo_area}}</option>
                                @else
                                    <option value="{{$tipo_area->iid_tipo_area}}">{{$tipo_area->cdescripcion_tipo_area}}</option>
                                @endif
                            @endforeach
                        @else
                            <option value="">Elija un Tipo de Adscripción...</option>
                            @foreach($listTipoArea as $indice=>$tipo_area)
                                <option value="{{$tipo_area->iid_tipo_area}}">{{$tipo_area->cdescripcion_tipo_area}}</option>
                            @endforeach
                        @endif
                    @endif
                @elseif ($otro_pers_cn!=null)
                    @if ($destinCon_total>0 && $otro_pers_cn->iid_adscripcion==1355)
                        @if ($otro_pers_cn->otropersonal!=null)
                            @foreach($listTipoArea as $indice=>$tipo_area)
                                @if ($tipo_area->iid_tipo_area==$otro_pers_cn->otraadscripcion->tipoarea->iid_tipo_area)
                                    <option value="{{$tipo_area->iid_tipo_area}}" selected>{{$tipo_area->cdescripcion_tipo_area}}</option>
                                @else
                                    <option value="{{$tipo_area->iid_tipo_area}}">{{$tipo_area->cdescripcion_tipo_area}}</option>
                                @endif
                            @endforeach
                        @else
                            <option value="">Elija un Tipo de Adscripción...</option>
                            @foreach($listTipoArea as $indice=>$tipo_area)
                                <option value="{{$tipo_area->iid_tipo_area}}">{{$tipo_area->cdescripcion_tipo_area}}</option>
                            @endforeach
                        @endif
                    @endif
                @else
                    <option value="">Elija un Tipo de Adscripción...</option>
                    @foreach($listTipoArea as $indice=>$tipo_area)
                        <option value="{{$tipo_area->iid_tipo_area}}">{{$tipo_area->cdescripcion_tipo_area}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <center><div id="validaOtroPersonalAC"></div></center>