@extends('layouts.app')

@section('titulo')
    <h4 class="text-primary-sin text-center">Listado de Personal</h4>
@endsection

@section('panel')
    <div class="table-responsive">
        <div class="row">
            <div class="col col-form-label text-md-right">
                @altaPersonal
                    <a href="{{ url('personal/nuevo') }}" data-toggle="tooltip" data-html="true" title="Nuevo">
                        + Nuevo Personal
                    </a>
                @endaltaPersonal
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
                        @editaPersonal
                            <a href="{{ url('personal/editar/'.$persona->iid_personal) }}" data-toggle="tooltip" data-html="true" title="Actualizar">
                                <img src="{{ asset('bootstrap-icons-1.5.0/pencil-fill.svg') }}" width="18" height="18">
                            </a>
                            <a href="{{ url('personal/actualizar/'.$persona->iid_personal) }}" data-toggle="tooltip" data-html="true" title="Actualizar Puesto y Adscripción">
                                <img src="{{ asset('bootstrap-icons-1.5.0/pencil.svg') }}" width="18" height="18">
                            </a>
                        @endeditaPersonal
                        @borraPersonal
                            <a href="{{ url('personal/inhabilitar/'.$persona->iid_personal) }}" data-toggle="tooltip" data-html="true" title="Borrar">
                                <img src="{{ asset('bootstrap-icons-1.5.0/trash-fill.svg') }}" width="18" height="18">
                            </a>
                        @endborraPersonal
                    @else
                        @borraPersonal
                            <a href="{{ url('personal/inhabilitar/'.$persona->iid_personal) }}" data-toggle="tooltip" data-html="true" title="Recuperar">
                                <img src="{{ asset('bootstrap-icons-1.5.0/check-lg.svg') }}" width="18" height="18">
                            </a>
                        @endborraPersonal
                    @endif
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
    </div>
@endsection