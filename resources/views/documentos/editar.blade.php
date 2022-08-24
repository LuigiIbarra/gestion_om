@extends('layouts.app')

@section('titulo')
    Actualizar Documento
@endsection
@section('panel')
    <form method="POST" action="{{ url('/documentos/actualizar') }}" id="formEditarDocumento" enctype="multipart/form-data">
    	@csrf

        <input type="hidden" id="id_documento"   name="id_documento"   value="{{ $documento->iid_documento }}"/>
        <input type="hidden" id="noeditar"       name="noeditar"       value="{{ $noeditar }}"/>
        <input type="hidden" id="idRemitente"    name="idRemitente"    value="{{ $documento->iid_personal_remitente }}"/>
        <input type="hidden" id="idDestinatario" name="idDestinatario" value="{{ $pers_conoc->iid_personal }}"/>
        <input type="hidden" id="newFolioRel"    name="newFolioRel"    value="0"/>

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
    @if($folsRels_total>0)
        <hr>
        <h5 class="text-primary-sin"><b>Folios Relacionados</b></h5>
        @include('folios_rels.index')
    @endif
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AOMSeguimModal">
                        Seguimiento OFMTSJ
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención Oficialía Mayor -->
                    @include('documentos.modales.datos_segOM_dest_aten')
                </div>
            @endif
    <!--PLANEACIÓN PL, id=12-->
            @if($destAt->iid_adscripcion==12)
                <div class="col-3" id="divDAPLSeg">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#APLSeguimModal">
                        Seguimiento D E P
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención Planeación -->
                    @include('documentos.modales.datos_segPL_dest_aten')
                </div>
            @endif
    <!--GESTIÓN TECNOLÓGICA, id=14-->
            @if($destAt->iid_adscripcion==14)
                <div class="col-3" id="divDAGTSeg">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AGTSeguimModal">
                        Seguimiento DEGT
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención Gestión Tecnológica -->
                    @include('documentos.modales.datos_segGT_dest_aten')
                </div>
            @endif
    <!--RECURSOS HUMANOS RH, id=15-->
            @if($destAt->iid_adscripcion==15)
                <div class="col-3" id="divDARHSeg">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ARHSeguimModal">
                        Seguimiento DERH
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención DERH -->
                    @include('documentos.modales.datos_segRH_dest_aten')
                </div>
            @endif
            <br>
    <!--OBRAS, MANTENIMIENTO Y SERVICIOS OB, id=16-->
            @if($destAt->iid_adscripcion==16)
                <div class="col-3" id="divDAOBSeg">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AOBSeguimModal">
                        Seguimiento DEOMS
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención DEOMS -->
                    @include('documentos.modales.datos_segOB_dest_aten')
                </div>
            @endif
    <!--RECURSOS MAERIALES RM, id=17-->
            @if($destAt->iid_adscripcion==17)
                <div class="col-3" id="divDARMSeg">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ARMSeguimModal">
                        Seguimiento DERM
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención DERM -->
                    @include('documentos.modales.datos_segRM_dest_aten')
                </div>
            @endif
    <!--RECURSOS FINANCIEROS RF, id=18-->
            @if($destAt->iid_adscripcion==18)
                <div class="col-3" id="divDARFSeg">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ARFSeguimModal">
                        Seguimiento DERF
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención DERF -->
                    @include('documentos.modales.datos_segRF_dest_aten')
                </div>
            @endif
    <!--OTRO OT, id=999-->
            @if($destAt->iid_adscripcion==999)
                <div class="col-3" id="divDAOTSeg">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AOTSeguimModal">
                        Seguimiento OTRO
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención OTRO -->
                    @include('documentos.modales.datos_segOT_dest_aten')
                </div>
            @endif
        @endforeach
        </div>
    @endif
    <br>
    @if($destinCon_total>0)
        <hr>
        <h5 class="text-primary-sin"><b>SEGUIMIENTO DESTINATARIOS CONOCIMIENTO</b></h5>
        <br>
        <div class="row" id="divDC_Seguimiento">
        @foreach($destinCon as $indice=>$destCn)
    <!--OFICIALÍA MAYOR OM, id=2-->
            @if($destCn->iid_adscripcion==2)
                <div class="col-3" id="divDCOMSeg">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#COMSeguimModal">
                        Seguimiento OFMTSJ
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención Oficialía Mayor -->
                    @include('documentos.modales.datos_segOM_dest_con')
                </div>
            @endif
    <!--PLANEACIÓN PL, id=12-->
            @if($destCn->iid_adscripcion==12)
                <div class="col-3" id="divDCPLSeg">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CPLSeguimModal">
                        Seguimiento D E P
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención Planeación -->
                    @include('documentos.modales.datos_segPL_dest_con')
                </div>
            @endif
    <!--GESTIÓN TECNOLÓGICA, id=14-->
            @if($destCn->iid_adscripcion==14)
                <div class="col-3" id="divDCGTSeg">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CGTSeguimModal">
                        Seguimiento DEGT
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención Gestión Tecnológica -->
                    @include('documentos.modales.datos_segGT_dest_con')
                </div>
            @endif
    <!--RECURSOS HUMANOS RH, id=15-->
            @if($destCn->iid_adscripcion==15)
                <div class="col-3" id="divDCRHSeg">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CRHSeguimModal">
                        Seguimiento DERH
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención DERH -->
                    @include('documentos.modales.datos_segRH_dest_con')
                </div>
            @endif
            <br>
    <!--OBRAS, MANTENIMIENTO Y SERVICIOS OB, id=16-->
            @if($destCn->iid_adscripcion==16)
                <div class="col-3" id="divDCOBSeg">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#COBSeguimModal">
                        Seguimiento DEOMS
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención DEOMS -->
                    @include('documentos.modales.datos_segOB_dest_con')
                </div>
            @endif
    <!--RECURSOS MAERIALES RM, id=17-->
            @if($destCn->iid_adscripcion==17)
                <div class="col-3" id="divDCRM_Seg">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CRMSeguimModal">
                        Seguimiento DERM
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención DERM -->
                    @include('documentos.modales.datos_segRM_dest_con')
                </div>
            @endif
    <!--RECURSOS FINANCIEROS RF, id=18-->
            @if($destCn->iid_adscripcion==18)
                <div class="col-3" id="divDCRFSeg">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CRFSeguimModal">
                        Seguimiento DERF
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención DERF -->
                    @include('documentos.modales.datos_segRF_dest_con')
                </div>
            @endif
    <!--OTRO OT, id=999-->
            @if($destCn->iid_adscripcion==999)
                <div class="col-3" id="divDCOTSeg">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#COTSeguimModal">
                        Seguimiento OTRO
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención OTRO -->
                    @include('documentos.modales.datos_segOT_dest_con')
                </div>
            @endif
        @endforeach
        </div>
    @endif
@endsection