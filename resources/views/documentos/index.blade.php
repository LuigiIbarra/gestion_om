@extends('layouts.app')

@section('titulo')
    <h4 class="text-primary-sin text-center">Listado de Documentos</h4>
@endsection

@section('panel')
    <div class="table-responsive">
        <div class="row">
            <div class="col-10 col-form-label text-right">
            </div>
            <div class="col col-form-label text-right">
                @altaDocumento
                    <a href="{{ url('documentos/nuevo') }}" data-toggle="tooltip" data-html="true" title="Nuevo">
                        + Nuevo Documento
                    </a>
                @endaltaDocumento
            </div>
        </div>
        <table class="table table-striped shadow-lg" id="MyTableDocumentos">
          <thead>
            <tr>
                <th class="text-center" style="display:none;">Consec.</th>
                <th class="text-center">Folio</th>
                <th class="text-center">Fecha de Recepción</th>
                <th class="text-center">Número de Documento</th>
                <th class="text-center">Tipo de Documento</th> 
                <th class="text-center">Remitente</th> 
                <th class="text-center">Estatus</th> 
                <th class="text-center">Prioridad</th> 
                <th class="text-center">Semaforo</th>
                <th class="text-center">Importancia</th> 
                <th class="text-center">Tema</th> 
                <th class="text-center">Fecha de Término</th>
                <th class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($documentos as $indice=>$documento)
                <tr>
                    <td class="text-center" style="display:none;">{{ $documento['iid_documento'] }}</td>
                    <td class="text-center">{{ $documento['cfolio'] }}</td>
                    <td class="text-center">{{ $documento['dfecha_recepcion'] }}</td>
                    <td class="text-center">{{ $documento['cnumero_documento'] }}</td>
                    <td class="text-center">{{ $documento['tipodocumento']['cdescripcion_tipo_documento'] }}</td>
                    <td class="text-center">{{ $documento['personalremitente']['cnombre_personal'].' '.$documento['personalremitente']['cpaterno_personal'].' '.$documento['personalremitente']['cmaterno_personal'] }}</td>
                    <td class="text-center">{{ $documento['estatusdocumento']['cdescripcion_estatus_documento'] }}</td>
                    <td class="text-center">{{ $documento['prioridaddocumento']['cdescripcion_prioridad_documento'] }}</td>
                    @if($documento['semaforodocumento']!=null)
                        @if($documento['semaforodocumento']['iid_semaforo']==1)
                            <td class="text-center" style="background-color: red;">{{ $documento['semaforodocumento']['iid_semaforo'].' '.$documento['semaforodocumento']['ccolor_semaforo'] }}</td>
                        @elseif($documento['semaforodocumento']['iid_semaforo']==2)
                            <td class="text-center" style="background-color: green;">{{ $documento['semaforodocumento']['iid_semaforo'].' '.$documento['semaforodocumento']['ccolor_semaforo'] }}</td>
                        @elseif($documento['semaforodocumento']['iid_semaforo']==3)
                            <td class="text-center" style="background-color: yellow;">{{ $documento['semaforodocumento']['iid_semaforo'].' '.$documento['semaforodocumento']['ccolor_semaforo'] }}</td>
                        @endif
                    @else
                        <td class="text-center"></td>
                    @endif
                    @if($documento['importanciacontenido']!=null)
                        <td class="text-center">{{ $documento['importanciacontenido']['cdescripcion_importancia_conten'] }}</td>
                    @else
                        <td class="text-center"></td>
                    @endif
                    @if($documento['tema']!=null)
                        <td class="text-center">{{ $documento['tema']['cdescripcion_tema'] }}</td>
                    @else
                        <td class="text-center"></td>
                    @endif
                    <td class="text-center">{{ $documento['dfecha_termino'] }}</td>
                    <td class="text-center col-actions">
                    @if ($documento->iestatus == 1)
                        @if ($documento->cruta_archivo_documento!="")
                            <a href="{{url('pdf/'.substr($documento['cruta_archivo_documento'],strrpos($documento['cruta_archivo_documento'],'pdf/')+4))}}" title="Ver PDF" target="_blank">
                                <img src="{{ asset('bootstrap-icons-1.5.0/file-pdf-fill.svg') }}" width="18" height="18">
                            </a>
                        @endif
                        @if ($documento->iid_tipo_documento!=7)
                            <a href="{{ url('documentos/acuse/'.$documento->iid_documento) }}" data-toggle="tooltip" data-html="true" title="Imprimir Acuse">
                                <img src="{{ asset('bootstrap-icons-1.5.0/printer-fill.svg') }}" width="18" height="18">
                            </a>
                        @endif
                        @editaDocumento
                            <a href="{{ url('documentos/editar/'.$documento->iid_documento) }}" data-toggle="tooltip" data-html="true" title="Actualizar">
                                <img src="{{ asset('bootstrap-icons-1.5.0/pencil-fill.svg') }}" width="18" height="18">
                            </a>
                        @endeditaDocumento
                        @borraDocumento
                            <a href="{{ url('documentos/inhabilitar/'.$documento->iid_documento) }}" data-toggle="tooltip" data-html="true" title="Borrar">
                                <img src="{{ asset('bootstrap-icons-1.5.0/trash-fill.svg') }}" width="18" height="18">
                            </a>
                        @endborraDocumento
                    @else
                        @borraDocumento
                            <a href="{{ url('documentos/inhabilitar/'.$documento->iid_documento) }}" data-toggle="tooltip" data-html="true" title="Recuperar">
                                <img src="{{ asset('bootstrap-icons-1.5.0/check-lg.svg') }}" width="18" height="18">
                            </a>
                        @endborraDocumento
                    @endif
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
    </div>
@endsection