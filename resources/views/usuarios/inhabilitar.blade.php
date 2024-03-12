@extends('layouts.app')

@section('titulo')
    @if($usuario->iestatus == 1)
        Borrar Usuario
    @else
        Recuperar Usuario
    @endif
@endsection
@section('panel')
    <form method="POST" action="{{ url('/usuarios/actualizar') }}" id="formInhabilitarUsuario">
    	@csrf

        <input type="hidden" name="id_usuario"  id="id_usuario"  value="{{ $usuario->id }}">
        <input type="hidden" name="noeditar"    id="noeditar"    value="{{ $noeditar }}">

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
        <!--Inputs de Personal-->
        @include('usuarios.datos_usuario')
        <br>
        <div class="row text-center">
            <div class="col-6">                        
                <button type="submit" class="btn btn-primary">
                    @if($usuario->iestatus == 1)
                        <img src="{{ asset('bootstrap-icons-1.5.0/trash-fill.svg') }}" width="18" height="18">
                        <span>&nbsp;Borrar</span>
                    @else
                        <img src="{{ asset('bootstrap-icons-1.5.0/check-lg.svg') }}" width="18" height="18">
                        <span>&nbsp;Recuperar</span>
                    @endif
                </button>
            </div>
            <div class="col-6">
                <a href="{{ url('/usuarios/index') }}">
                    <!--<button type="button" class="btn btn-primary" onClick="history.back()">-->
                    <button type="button" class="btn btn-primary">
                        <img src="{{ asset('bootstrap-icons-1.5.0/x-lg.svg') }}" width="18" height="18">
                        <span>&nbsp;Cerrar</span>
                    </button>
                </a>
            </div>
        </div>
    </form>   
@endsection