@extends('layouts.app')

@section('titulo')
    @if($personal_conocimiento->iestatus == 1)
        Borrar Destinatario de Copia de Conocimiento del Documento {{$documento->cnumero_documento}}
    @else
        Recuperar Destinatario de Copia de Conocimiento del Documento {{$documento->cnumero_documento}}
    @endif
@endsection
@section('panel')
    <form method="POST" action="{{ url('/persconoc/inhabilitar') }}" id="formInhabilitarPersConoc" enctype="multipart/form-data">
    	@csrf
        <!--Auxiliar para el Documento-->
        <input type="hidden" id="idDocumento"    name="idDocumento"    value="{{$documento->iid_documento}}"/>
        <input type="hidden" id="idDestinatario" name="idDestinatario" value="{{$personal->iid_personal}}"/>
        <input type="hidden" id="noeditar"       name="noeditar"       value="{{ $noeditar }}">
        
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
        @include('pers_conoc.datos_seg_pers_conoc')
    
        <div class="row text-center">
            <div class="col-6">                        
                <button type="submit" class="btn btn-primary">
                    @if($personal_conocimiento->iestatus == 1)
                        <img src="{{ asset('bootstrap-icons-1.5.0/trash-fill.svg') }}" width="18" height="18">
                        <span>&nbsp;Borrar</span>
                    @else
                        <img src="{{ asset('bootstrap-icons-1.5.0/check-lg.svg') }}" width="18" height="18">
                        <span>&nbsp;Recuperar</span>
                    @endif
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