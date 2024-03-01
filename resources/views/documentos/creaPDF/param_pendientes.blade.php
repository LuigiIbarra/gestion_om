@extends('layouts.app')

@section('titulo')
    Informe de Asuntos Pendientes
@endsection

@section('panel')
    <form name="formParametros" id="formParametros" method="GET" action="{{ url('reportes/consulta_pendientes') }}" >
        @csrf
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <p>Corrige los errores para continuar</p>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row text-center">
            <div class="col-3">
            </div>
            <div class="col-2">
                <label for="solicitud_a" class="col-form-label text-md-right">Solicitudes a:</label>
                <select class="form-control m-bot15" name="solicitud_a" id="solicitud_a">
                    <option value="231">Recursos Humanos</option>
                    <option value="230">Recursos Financieros</option>
                    <option value="232">Recursos Materiales</option>
                    <option value="228">Obras, Mant. y Servicios</option>
                    <option value="227">Gestión Tecnológica</option>
                    <option value="229">Planeación</option>
                    <option value="1215">Seguridad</option>
                    <option value="1354">Dir. Administrativa</option>
                </select>
            </div>
            <div class="col-2">
                <label for="solicitud_de" class="col-form-label text-md-right">Solicitudes de:</label>
                <select class="form-control m-bot15" name="solicitud_de" id="solicitud_de">
                    <option value="1">Magistrados</option>
                    <option value="2">Jueces</option>
                    <option value="3">Consejeros</option>
                    <option value="4">Directores</option>
                    <option value="5">Coordinadores</option>
                </select>
            </div>
            <div class="col-2">
                <label for="correspon_a" class="col-form-label text-md-right">Correspondencia a:</label>
                <select class="form-control m-bot15" name="correspon_a" id="correspon_a">
                    <option value="1">Información Pública y Estadística</option>
                    <option value="2">Centro de Justicia Alternativa</option>
                    <option value="3">INCIFO</option>
                    <option value="4">Instituto de Estudios Judiciales</option>
                    <option value="5">Anales de Jurisprudencia y Boletín Judicial</option>
                    <option value="6">Archivo Judicial</option>
                    <option value="7">Apoyo Judicial</option>
                    <option value="8">Orientación y Derechos Humanos</option>
                    <option value="8">Dir. G. Jurídica</option>
                </select>
            </div>
        </div>
        <br>
        <div class="row text-center">
            <div class="col-4">
            </div>
            <div class="col-2">
                <label for="fecha_inicial" class="col-form-label text-md-right">Fecha Inicial:</label>
                <input type="date" id="fecha_inicial" name="fecha_inicial" class="form-control" data-target="#fecha_inicial" value="" maxlength="10" required />
            </div>
            <div class="col-2">
                <label for="fecha_final" class="col-form-label text-md-right">Fecha Final:</label>
                <input type="date" id="fecha_final" name="fecha_final" class="form-control" data-target="#fecha_final" value="" maxlength="10" required />
            </div>
        </div>
        <br>
        <div class="row text-center">
            <div class="col-6">                        
                <button type="submit" class="btn btn-primary" id="btnDescargarCons">
                    <img src="{{ asset('bootstrap-icons-1.5.0/save.svg') }}" width="18" height="18">
                    <span>&nbsp;Descargar Reporte</span>
                </button>
            </div>
            <div class="col-6">
                <button type="button" class="btn btn-primary" onClick="history.back()">
                    <img src="{{ asset('bootstrap-icons-1.5.0/x-lg.svg') }}" width="18" height="18">
                    <span>&nbsp;Cerrar</span>
                </button>
            </div>
        </div>
    </form>
@endsection