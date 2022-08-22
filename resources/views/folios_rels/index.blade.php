<div id="divFoliosIndex" class="table-responsive" style="display:block;">
    <div class="table-responsive">
        <div class="row">
            <div class="col col-form-label text-md-right">
                <a href="{{ url('folios/nuevo/'.$documento->iid_documento) }}" data-toggle="tooltip" data-html="true" title="Nuevo">
                    + Nuevo Folio
                </a>
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
            @foreach($docs_rels as $indice=>$folio)
                <tr>
                    <td class="text-center">{{ $folio['cfolio'] }}</td>
                    <td class="text-center">{{ $folio['dfecha_recepcion'] }}</td>
                    <td class="text-center">{{ $folio['cnumero_documento'] }}</td>
                    <td class="text-center">{{ $folio['dfecha_termino'] }}</td>                    
                    <td class="text-center col-actions">
                    @if ($folio->iestatus == 1)
                        @if ($folio->cruta_archivo_documento!="")
                            <a href="{{url('pdf/'.substr($folio['cruta_archivo_documento'],strrpos($folio['cruta_archivo_documento'],'pdf/')+4))}}" title="Ver PDF" target="_blank">
                                <img src="{{ asset('bootstrap-icons-1.5.0/file-pdf-fill.svg') }}" width="18" height="18">
                            </a>
                        @endif
                        <a href="{{ url('documentos/editar/'.$folio->iid_documento) }}" data-toggle="tooltip" data-html="true" title="Actualizar">
                            <img src="{{ asset('bootstrap-icons-1.5.0/pencil-fill.svg') }}" width="18" height="18">
                        </a>
                        <a href="{{ url('documentos/inhabilitar/'.$folio->iid_documento) }}" data-toggle="tooltip" data-html="true" title="Borrar de Lista">
                            <img src="{{ asset('bootstrap-icons-1.5.0/trash-fill.svg') }}" width="18" height="18">
                        </a>
                    @else
                        <a href="{{ url('documentos/inhabilitar/'.$folio->iid_documento) }}" data-toggle="tooltip" data-html="true" title="Recuperar">
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