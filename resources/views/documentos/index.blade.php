@extends('layouts.app')

@section('titulo')
    <h4 class="text-primary-sin text-center">Listado de Documentos</h4>
@endsection

@section('panel')
    <div class="table-responsive">
        <div class="row">
            <div class="col col-form-label text-md-right">
                    <a href="{{ url('documentos/nuevo') }}" data-toggle="tooltip" data-html="true" title="Nuevo">
                        + Nuevo Documento
                    </a>
            </div>
        </div>
        <table class="table table-striped shadow-lg" id="MyTableDocumentos">
          <thead>
            <tr>
                <th class="text-center">Folio</th>
                <th class="text-center">Fecha de Recepción</th>
                <th class="text-center">Número de Documento</th>
                <th class="text-center">Fecha del Documento</th>
                <th class="text-center">Tipo de Documento</th> 
                <th class="text-center">Tipo de Anexo</th> 
                <th class="text-center">Remitente</th> 
                <th class="text-center">Estatus</th> 
                <th class="text-center">Prioridad</th> 
                <th class="text-center">Folio Relacionado</th> 
                <th class="text-center">Importancia</th> 
                <th class="text-center">Tema</th> 
                <th class="text-center">Asunto</th> 
                <th class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($documentos as $indice=>$documento)
                <tr>
                    <td class="text-center">{{ $documento['ifolio'].'-'.$documento['ianio'] }}</td>
                    <td class="text-center">{{ $documento['dfecha_recepcion'] }}</td>
                    <td class="text-center">{{ $documento['cnumero_documento'] }}</td>
                    <td class="text-center">{{ $documento['dfecha_documento'] }}</td>
                    <td class="text-center">{{ $documento['tipodocumento']['cdescripcion_tipo_documento'] }}</td>
                    <td class="text-center">{{ $documento['tipoanexo']['cdescripcion_tipo_anexo'] }}</td>
                    <td class="text-center">{{ $documento['personalremitente']['cnombre_personal'].' '.$documento['personalremitente']['cpaterno_personal'].' '.$documento['personalremitente']['cmaterno_personal'] }}</td>
                    <td class="text-center">{{ $documento['estatusdocumento']['cdescripcion_estatus_documento'] }}</td>
                    <td class="text-center">{{ $documento['prioridaddocumento']['cdescripcion_prioridad_documento'] }}</td>
                    <td class="text-center">{{ $documento['ifolio_relacionado'].'-'.$documento['ianio_relacionado'] }}</td>
                    <td class="text-center">{{ $documento['importanciacontenido']['cdescripcion_importancia_contenido'] }}</td>
                    <td class="text-center">{{ $documento['tema']['cdescripcion_tema'] }}</td>
                    <td class="text-center">{{ $documento['tipoasunto']['cdescripcion_tipo_asunto'] }}</td>
                    <td class="text-center col-actions">
                    @if ($documento->iestatus == 1)
                            <a href="#" data-toggle="tooltip" data-html="true" title="Actualizar">
                                <img src="{{ asset('bootstrap-icons-1.5.0/pencil-fill.svg') }}" width="18" height="18">
                            </a>
                            <a href="#" data-toggle="tooltip" data-html="true" title="Borrar">
                                <img src="{{ asset('bootstrap-icons-1.5.0/trash-fill.svg') }}" width="18" height="18">
                            </a>
                    @else
                            <a href="#" data-toggle="tooltip" data-html="true" title="Recuperar">
                                <img src="{{ asset('bootstrap-icons-1.5.0/check-lg.svg') }}" width="18" height="18">
                            </a>
                    @endif
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
    </div>
@endsection