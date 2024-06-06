<div id="divFoliosIndex" class="table-responsive" style="display:block;">
    <div class="table-responsive">
        <div class="row">
            <div class="col col-form-label text-md-right">
                @if ($noeditar=="")
                    <a href="{{ url('folios/nuevo/'.$documento->iid_documento) }}" data-toggle="tooltip" data-html="true" title="Nuevo">
                        + Nuevo Folio Relacionado
                    </a>
                @endif
            </div>
        </div>
        <table class="table table-striped shadow-lg" id="MyTableFolios">
          <thead>
            <tr>
                <th class="text-center">Folio</th>
                <th class="text-center">Fecha de Recepción</th>
                <th class="text-center">Número de Documento</th>
                <th class="text-center">Fecha de Término</th>
                <th class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($docs_rels as $indice=>$folio_rel)
                <tr>
                    <td class="text-center">{{ $folio_rel['cfolio'] }}</td>
                    <td class="text-center">{{ $folio_rel['dfecha_recepcion'] }}</td>
                    <td class="text-center">{{ $folio_rel['cnumero_documento'] }}</td>
                    <td class="text-center">{{ $folio_rel['dfecha_termino'] }}</td>                    
                    <td class="text-center col-actions">
                    @if ($folio_rel->iestatus == 1)
                        @if ($folio_rel->cruta_archivo_documento!="")
                            <a href="{{url('pdf/'.substr($folio_rel['cruta_archivo_documento'],strrpos($folio_rel['cruta_archivo_documento'],'pdf/')+4))}}" title="Ver PDF" target="_blank">
                                <img src="{{ asset('bootstrap-icons-1.5.0/file-pdf-fill.svg') }}" width="18" height="18">
                            </a>
                        @endif
                        <a href="{{ url('documentos/editar/'.$folio_rel->iid_documento) }}" data-toggle="tooltip" data-html="true" title="Actualizar">
                            <img src="{{ asset('bootstrap-icons-1.5.0/pencil-fill.svg') }}" width="18" height="18">
                        </a>
                        <a href="{{ url('folios/inhabilitar/'.$documento->iid_documento.'/'.$folio_rel->cfolio) }}" data-toggle="tooltip" data-html="true" title="Borrar de la Lista">
                            <img src="{{ asset('bootstrap-icons-1.5.0/trash-fill.svg') }}" width="18" height="18">
                        </a>
                    @else
                        <a href="{{ url('folios/inhabilitar/'.$documento->iid_documento.'/'.$folio_rel->cfolio) }}" data-toggle="tooltip" data-html="true" title="Recuperar en Lista">
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