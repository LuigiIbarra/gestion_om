@extends('layouts.app')

@section('titulo')
    <h4 class="text-primary-sin text-center">Listado de Puestos</h4>
@endsection

@section('panel')
    <div class="table-responsive">
        <div class="row">
            <div class="col col-form-label text-md-right">
                @altaPuesto
                    <a href="{{ url('puestos/nuevo') }}" data-toggle="tooltip" data-html="true" title="Nuevo">
                        + Nuevo Puesto
                    </a>
                @endaltaPuesto
            </div>
        </div>
        <table class="table table-striped shadow-lg" id="MyTablePuestos">
          <thead>
            <tr>
                <th class="text-center">Descripción de Puesto</th> 
                <th class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($puestos as $indice=>$puesto)
                <tr>
                    <td class="text-center">{{ $puesto['cdescripcion_puesto'] }}</td>
                    <td class="text-center col-actions">
                    @if ($puesto->iestatus == 1)
                        @editaPuesto
                            <a href="{{ url('puestos/editar/'.$puesto->iid_puesto) }}" data-toggle="tooltip" data-html="true" title="Actualizar">
                                <img src="{{ asset('bootstrap-icons-1.5.0/pencil-fill.svg') }}" width="18" height="18">
                            </a>
                        @endeditaPuesto
                        @borraPuesto
                            <a href="{{ url('puestos/inhabilitar/'.$puesto->iid_puesto) }}" data-toggle="tooltip" data-html="true" title="Borrar">
                                <img src="{{ asset('bootstrap-icons-1.5.0/trash-fill.svg') }}" width="18" height="18">
                            </a>
                        @endborraPuesto
                    @else
                        @borraPuesto
                            <a href="{{ url('puestos/inhabilitar/'.$puesto->iid_puesto) }}" data-toggle="tooltip" data-html="true" title="Recuperar">
                                <img src="{{ asset('bootstrap-icons-1.5.0/check-lg.svg') }}" width="18" height="18">
                            </a>
                        @endborraPuesto
                    @endif
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
    </div>
@endsection