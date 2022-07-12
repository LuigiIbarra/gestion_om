@extends('layouts.app')

@section('titulo')
    Actualizar Documento
@endsection
@section('panel')
    <form method="POST" action="{{ url('/documentos/actualizar') }}" id="formEditarDocumento" enctype="multipart/form-data">
    	@csrf

        <input type="hidden" id="id_documento" name="id_documento" value="{{ $documento->iid_documento }}">
        <input type="hidden" id="noeditar"     name="noeditar"     value="{{ $noeditar }}">
        <input type="hidden" id="idRemitente"  name="idRemitente"  value="{{ $documento->iid_personal_remitente }}"/>

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
    <br>
    @if($destinAtt_total>0)
        <hr>
        <h5 class="text-primary-sin"><b>SEGUIMIENTO DESTINATARIOS ATENCIÓN</b></h5>
        <br>
        <div class="row" id="divDA_Seguimiento">
        @foreach($destinAtt as $indice=>$destAt)
    <!--OFICIALÍA MAYOR OM, id=2-->
            @if($destAt->iid_adscripcion==2)
                <div class="col-3" id="divDAOMSeg">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#OMSeguimModal">
                        Seguimiento OFMTSJ
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención Oficialía Mayor -->
                    @include('documentos.datos_segOM_dest_aten')
                </div>
            @endif
    <!--PLANEACIÓN PL, id=12-->
            @if($destAt->iid_adscripcion==12)
                <div class="col-3" id="divDAPLSeg">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#PLSeguimModal">
                        Seguimiento D E P
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención Planeación -->
                    @include('documentos.datos_segPL_dest_aten')
                </div>
            @endif
    <!--GESTIÓN TECNOLÓGICA, id=14-->
            @if($destAt->iid_adscripcion==14)
                <div class="col-3" id="divGT_Seguimiento">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#GTSeguimModal">
                        Seguimiento DEGT
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención Gestión Tecnológica -->
                    @include('documentos.datos_segGT_dest_aten')
                </div>
            @endif
    <!--RECURSOS HUMANOS RH, id=15-->
            @if($destAt->iid_adscripcion==15)
                <div class="col-3" id="divRH_Seguimiento">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#RHSeguimModal">
                        Seguimiento DERH
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención DERH -->
                    @include('documentos.datos_segRH_dest_aten')
                </div>
            @endif
            <br>
    <!--OBRAS, MANTENIMIENTO Y SERVICIOS OB, id=16-->
            @if($destAt->iid_adscripcion==16)
                <div class="col-3" id="divOB_Seguimiento">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#OBSeguimModal">
                        Seguimiento DEOMS
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención DEOMS -->
                    @include('documentos.datos_segOB_dest_aten')
                </div>
            @endif
    <!--RECURSOS MAERIALES RM, id=17-->
            @if($destAt->iid_adscripcion==17)
                <div class="col-3" id="divRM_Seguimiento">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#RMSeguimModal">
                        Seguimiento DERM
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención DERM -->
                    @include('documentos.datos_segRM_dest_aten')
                </div>
            @endif
    <!--RECURSOS FINANCIEROS RF, id=18-->
            @if($destAt->iid_adscripcion==18)
                <div class="col-3" id="divRF_Seguimiento">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#RFSeguimModal">
                        Seguimiento DERF
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención DERF -->
                    @include('documentos.datos_segRF_dest_aten')
                </div>
            @endif
    <!--OTRO OT, id=999-->
            @if($destAt->iid_adscripcion==999)
                <div class="col-3" id="divOT_Seguimiento">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#OTSeguimModal">
                        Seguimiento OTRO
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención OTRO -->
                    @include('documentos.datos_segOT_dest_aten')
                </div>
            @endif
        @endforeach
        </div>
    @endif
    <br>
@endsection