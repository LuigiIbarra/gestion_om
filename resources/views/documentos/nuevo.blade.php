@extends('layouts.app')

@section('titulo')
    Nuevo Documento
@endsection
@section('panel')
    <!--
    <form method="POST" action="{{ url('/documentos/guardar') }}" id="formNuevoDocumento">
    -->
    <form method="POST" action="#" id="formNuevoDocumento">
    	@csrf
        <!--Auxiliar para el año-->
        <input type="hidden" id="anio"  name="anio"  value="{{$parametros->ianio}}"/>
        <input type="hidden" id="folio" name="folio" value="{{$newfolio}}"/>

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
        <!--Inputs de Documento-->
        @include('documentos.datos_documento')
    
        <div class="row text-center">
            <div class="col-6">                        
                <button type="submit" class="btn btn-primary">
                    <img src="{{ asset('bootstrap-icons-1.5.0/save.svg') }}" width="18" height="18">
                    <span>&nbsp;Guardar</span>
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