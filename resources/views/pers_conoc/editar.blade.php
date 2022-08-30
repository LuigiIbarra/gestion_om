@extends('layouts.app')

@section('titulo')
    Actualizar Destinatario de Copia de Conocimiento del Documento {{$documento->cnumero_documento}}
@endsection
@section('panel')
    <form method="POST" action="{{ url('/persconoc/seguimiento') }}" id="formEditarPersConoc" enctype="multipart/form-data">
    	@csrf
        <!--Auxiliar para el Documento-->
        <input type="hidden" id="idDocumento"    name="idDocumento"    value="{{$documento->iid_documento}}"/>
        <input type="hidden" id="idDestinatario" name="idDestinatario" value="{{$personal->iid_personal}}"/>
        
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