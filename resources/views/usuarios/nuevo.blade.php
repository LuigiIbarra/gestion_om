@extends('layouts.app')

@section('titulo')
    Nuevo Usuario
@endsection
@section('panel')
    <form method="POST" action="{{ url('/usuarios/guardar') }}" id="formNuevoUsuario">
    	@csrf

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
        <div class="row" id="divpassword">
            <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
            <div class="col-md-5">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <br><br>
        <div class="row text-center">
            <div class="col-6">                        
                <button type="submit" class="btn btn-primary">
                    <img src="{{ asset('bootstrap-icons-1.5.0/save.svg') }}" width="18" height="18">
                    <span>&nbsp;Guardar</span>
                </button>
            </div>
            <div class="col-6">
                <a href="{{ url('/usuarios/index') }}">
                    <button type="button" class="btn btn-primary">
                        <img src="{{ asset('bootstrap-icons-1.5.0/x-lg.svg') }}" width="18" height="18">
                        <span>&nbsp;Cerrar</span>
                    </button>
                </button>
            </div>
        </div>
    </form>   
@endsection