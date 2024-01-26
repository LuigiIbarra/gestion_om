<!--Buscar Nombre en el Catálogo de Personal -->
    <label><b>Buscar en el Catálogo de Personal</b></label>
    <div class="row">
        <div class="col-3" id="divbuscarnombrecc">
            <label for="busca_otro_nombre" class="col-form-label text-md-right"><b>Buscar Nombre:</b></label>
            <input type="text" onkeypress="return textonly(event);" id="busca_otro_nombre" name="busca_otro_nombre" class="form-control" value="" maxlength="100" {{ $noeditar }}/>
        </div>
        <div class="col-3" id="divnombre">
            <label for="otro_nombre" class="col-form-label text-md-right">Seleccionar Nombre:</label>
            <select class="form-control m-bot15" id="otro_nombre" name="otro_nombre" required {{ $noeditar }}>
                <option value="0">Escriba un Nombre en Buscar Nombre...</option>
            </select>
        </div>
        <div class="col-3" id="divpuesto">
            <label for="otro_puesto" class="col-form-label text-md-right">Puesto:</label>
            <select class="form-control m-bot15" id="otro_puesto" name="otro_puesto" {{ $noeditar }}>
                <option value="">Escriba un Nombre en Buscar Nombre...</option>
            </select>
        </div>
        <div class="col-3" id="divarea">
            <label for="otra_adscripcion" class="col-form-label text-md-right">Adscripción:</label>
            <select class="form-control m-bot15" id="otra_adscripcion" name="otra_adscripcion" {{ $noeditar }}>
                <option value="">Escriba un Nombre en Buscar Nombre...</option>
            </select>
        </div>
    </div>
    <br>
<!--Capturar nuevo Nombre (Nombre/Paterno/Materno) con Puesto/Nuevo Puesto y Adscripción/Nueva Adscripción y agregarlos a los catálogos correspondientes -->
    <div class="row">
        <div class="col" id="divnewnameac">
            <label for="nuevo_nombre_ac" class="col-form-label text-md-right"><b>Nuevo Nombre:</b></label>
            <input type="text" id="nuevo_nombre_ac" name="nuevo_nombre_ac" class="form-control" data-target="#nuevo_nombre_ac" value="" maxlength="100" {{ $noeditar }} />
        </div>
        <div class="col" id="divpatotrapersonaac">
            <label for="otro_paterno_ac" class="col-form-label text-md-right">Paterno:</label>
            <input type="text" id="otro_paterno_ac" name="otro_paterno_ac" class="form-control" data-target="#otro_paterno_ac" value="" maxlength="100" {{ $noeditar }} />
        </div>
        <div class="col" id="divmatotrapersonaac">
            <label for="otro_materno_ac" class="col-form-label text-md-right">Materno:</label>
            <input type="text" id="otro_materno_ac" name="otro_materno_ac" class="form-control" data-target="#otro_materno_ac" value="" maxlength="100" {{ $noeditar }} />
        </div>
    </div>
    <div class="row">
        <div class="col" id="divnvopuestoac">
            <label for="otro_nvo_puesto_ac" class="col-form-label text-md-right">Puesto:</label>
            <select class="form-control m-bot15" id="otro_nvo_puesto_ac" name="otro_nvo_puesto_ac" {{ $noeditar }}>
                <option value="">Elija un Puesto...</option>
                @foreach($listPuesto as $indice=>$psto)
                    <option value="{{$psto->iid_puesto}}">{{$psto->cdescripcion_puesto}}</option>
                @endforeach
            </select>
        </div>
        <div class="col" id="divnvootropuestoac">
            <label for="otra_desc_puesto_ac" class="col-form-label text-md-right"><b>Nuevo Puesto:</b></label>
            <input type="text" id="otra_desc_puesto_ac" name="otra_desc_puesto_ac" class="form-control" data-target="#otra_desc_puesto_ac" value="" maxlength="100" />
        </div>
        <div class="col" id="divnvaadscac">
            <label for="otra_nva_adscripcion_ac" class="col-form-label text-md-right">Área/Razón Social:</label>
            <select class="form-control m-bot15" id="otra_nva_adscripcion_ac" name="otra_nva_adscripcion_ac" {{ $noeditar }}>
                <option value="">Elija una Adscripcion...</option>
                @foreach($listAdscripcion as $indice=>$adsc)
                    <option value="{{$adsc->iid_adscripcion}}">{{$adsc->cdescripcion_adscripcion}}</option>
                @endforeach
            </select>
        </div>
        <div class="col" id="divnvootraadscac">
            <label for="otra_desc_adsc_ac" class="col-form-label text-md-right"><b>Nuevo Área/Razón Social:</b></label>
            <input type="text" id="otra_desc_adsc_ac" name="otra_desc_adsc_ac" class="form-control" data-target="#otra_desc_adsc_ac" value="" maxlength="100" />
        </div>
        <div class="col" id="divnvotipoadscac">
            <label for="nvo_tipo_adscripcion_ac" class="col-form-label text-md-right">Tipo de Adscripción:</label>
            <select class="form-control m-bot15" id="nvo_tipo_adscripcion_ac" name="nvo_tipo_adscripcion_ac" {{ $noeditar }}>
                <option value="">Elija un Tipo de Adscripción...</option>
                @foreach($listTipoArea as $indice=>$tipo_area)
                    <option value="{{$tipo_area->iid_tipo_area}}">{{$tipo_area->cdescripcion_tipo_area}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row"><br></div>
    <center><div id="validaOtroPersonalAC"></div></center>