@extends('layouts.app')

@section('titulo')
    <h4 class="text-primary-sin text-center">Listado de Personal</h4>
@endsection

@section('panel')
    <div class="table-responsive">
        <div class="row">
            <div class="col col-form-label text-md-right">
                    <a href="{{ url('personal/nuevo') }}" data-toggle="tooltip" data-html="true" title="Nuevo">
                        + Nuevo Personal
                    </a>
            </div>
        </div>
        <table class="table table-striped shadow-lg" id="MyTablePersonal">
          <thead>
            <tr>
                <th class="text-center">Nombre</th>
                <th class="text-center">Paterno</th>
                <th class="text-center">Materno</th>
                <th class="text-center">Puesto</th>
                <th class="text-center">Adscripción</th> 
                <th class="text-center">Correo Electrónico</th> 
                <th class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($personal as $indice=>$persona)
                <tr>
                    <td class="text-center">{{ $persona['cnombre_personal'] }}</td>
                    <td class="text-center">{{ $persona['cpaterno_personal'] }}</td>
                    <td class="text-center">{{ $persona['cmaterno_personal'] }}</td>
                    <td class="text-center">{{ $persona['puesto']['cdescripcion_puesto'] }}</td>
                    <td class="text-center">{{ $persona['adscripcion']['cdescripcion_adscripcion'] }}</td>
                    <td class="text-center">{{ $persona['ccorreo_electronico'] }}</td>
                    <td class="text-center col-actions">
                    @if ($persona->iestatus == 1)
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