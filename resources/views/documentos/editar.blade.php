@extends('layouts.app')

@section('titulo')
    Actualizar Documento
@endsection
@section('panel')
    <form method="POST" action="{{ url('/documentos/actualizar') }}" id="formEditarDocumento" enctype="multipart/form-data">
    	@csrf

        <input type="hidden" id="id_documento" name="id_documento" value="{{ $documento->iid_documento }}">
        <input type="hidden" id="noeditar"     name="noeditar"     value="{{ $noeditar }}">
        <input type="hidden" id="idRemitente"  name="idRemitente"  value=""/>

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
        @include('documentos.datos_documento_editar')
    
        <div class="row text-center">
            <div class="col-6">                        
                <button type="submit" class="btn btn-primary">
                    <img src="{{ asset('bootstrap-icons-1.5.0/save.svg') }}" width="18" height="18">
                    <span>&nbsp;Actualizar</span>
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