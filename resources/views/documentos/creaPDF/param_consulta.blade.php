@extends('layouts.app')

@section('titulo')
    Estadística por Área y Estatus
@endsection

@section('panel')
    <form name="formParametros" id="formParametros" method="GET" action="{{ url('reportes/consulta_estadistica') }}" >
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
            <div class="col-5">
            </div>
            <?php $anio = date('Y'); ?>
            <div class="col-2">
                <label for="anio_consulta" class="col-form-label text-md-right">Seleccione Año:</label>
                <select class="form-control m-bot15" name="anio_consulta" id="anio_consulta">
                    <?php 
                    for ($i=2021; $i<=$anio; $i++)
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    ?>
                </select>
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