<div id="divPersConocIndex" class="table-responsive" style="display:block;">
    <div class="table-responsive">
        <div class="row">
            <div class="col col-form-label text-md-right">
                <a href="{{ url('persconoc/nuevo/'.$documento->iid_documento) }}" data-toggle="tooltip" data-html="true" title="Nuevo">
                    + Nuevo Destinatario de Copia de Conocimiento
                </a>
            </div>
        </div>
        <table class="table table-striped shadow-lg" id="MyTablePersConoc">
          <thead>
            <tr>
                <th class="text-center">Nombre</th>
                <th class="text-center">Puesto</th>
                <th class="text-center">Adscripción</th>
                <th class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pers_conoc as $indice=>$pc)
                <tr>
                    <td class="text-center">{{ $pc['personal']['cnombre_personal'].' '.$pc['personal']['cpaterno_personal'].' '.$pc['personal']['cmaterno_personal'] }}</td>
                    <td class="text-center">{{ $pc['personal']['puesto']['cdescripcion_puesto'] }}</td>
                    <td class="text-center">{{ $pc['personal']['adscripcion']['cdescripcion_adscripcion'] }}</td>
                    <td class="text-center col-actions">
                    @if ($pc->iestatus == 1)
                        @if ($pc->cruta_archivo_seguim!="")
                            <a href="{{url('pdf/'.substr($pc['cruta_archivo_seguim'],strrpos($pc['cruta_archivo_seguim'],'pdf/')+4))}}" title="Ver PDF" target="_blank">
                                <img src="{{ asset('bootstrap-icons-1.5.0/file-pdf-fill.svg') }}" width="18" height="18">
                            </a>
                        @endif
                        <a href="{{ url('persconoc/editar/'.$documento->iid_documento.'/'.$pc->iid_personal) }}" data-toggle="tooltip" data-html="true" title="Seguimiento">
                            <img src="{{ asset('bootstrap-icons-1.5.0/pencil-fill.svg') }}" width="18" height="18">
                        </a>
                        <a href="{{ url('persconoc/inhabilitar/'.$pc->iid_documento.'/'.$pc->iid_personal) }}" data-toggle="tooltip" data-html="true" title="Borrar de Lista">
                            <img src="{{ asset('bootstrap-icons-1.5.0/trash-fill.svg') }}" width="18" height="18">
                        </a>
                    @else
                        <a href="{{ url('persconoc/inhabilitar/'.$pc->iid_documento.'/'.$pc->iid_personal) }}" data-toggle="tooltip" data-html="true" title="Recuperar">
                            <img src="{{ asset('bootstrap-icons-1.5.0/check-lg.svg') }}" width="18" height="18">
                        </a>
                    @endif()
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
    </div>
</div>