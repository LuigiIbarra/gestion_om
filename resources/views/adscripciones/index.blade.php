@extends('layouts.app')

@section('titulo')
    <h4 class="text-primary-sin text-center">Listado de Adscripciones</h4>
@endsection

@section('panel')
    <div class="table-responsive">
        <div class="row">
            <div class="col col-form-label text-md-right">
                    <a href="{{ url('adscripciones/nueva') }}" data-toggle="tooltip" data-html="true" title="Nuevo">
                        + Nueva Adscripción
                    </a>
            </div>
        </div>
        <table class="table table-striped shadow-lg" id="MyTableAdscripciones">
          <thead>
            <tr>
                <th class="text-center">Descripción de la Adscripción</th>
                <th class="text-center">Siglas</th>
                <th class="text-center">Tipo de Adscripción</th> 
                <th class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($adscripciones as $indice=>$adscripcion)
                <tr>
                    <td class="text-center">{{ $adscripcion['cdescripcion_adscripcion'] }}</td>
                    <td class="text-center">{{ $adscripcion['csiglas'] }}</td>
                    <td class="text-center">{{ $adscripcion['tipoarea']['cdescripcion_tipo_area'] }}</td>
                    <td class="text-center col-actions">
                    @if ($adscripcion->iestatus == 1)
                            <a href="{{ url('adscripciones/editar/'.$adscripcion->iid_adscripcion) }}" data-toggle="tooltip" data-html="true" title="Actualizar">
                                <img src="{{ asset('bootstrap-icons-1.5.0/pencil-fill.svg') }}" width="18" height="18">
                            </a>
                            <a href="{{ url('adscripciones/inhabilitar/'.$adscripcion->iid_adscripcion) }}" data-toggle="tooltip" data-html="true" title="Borrar">
                                <img src="{{ asset('bootstrap-icons-1.5.0/trash-fill.svg') }}" width="18" height="18">
                            </a>
                    @else
                            <a href="{{ url('adscripciones/inhabilitar/'.$adscripcion->iid_adscripcion) }}" data-toggle="tooltip" data-html="true" title="Recuperar">
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