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
        <input type="hidden" id="newFolioRel"    name="newFolioRel"    value="0"/>
        <input type="hidden" id="editaDocto"     name="editaDocto"     value="1"/>
        <input type="hidden" id="semaforoRojo"   name="semaforoRojo"   value="0"/>
        @if ($otro_pers_at!=null && $destinAtt_total>0 && $otro_pers_at->iid_adscripcion==1355)
            <input type="hidden" name="idOtroPersonal" id="idOtroPersonal" value="{{ $otro_pers_at->iid_otro_personal }}">
            <input type="hidden" name="idOtroPuesto"   id="idOtroPuesto"   value="{{ $otro_pers_at->iid_otro_puesto }}">
            <input type="hidden" name="idOtraAdscrip"  id="idOtraAdscrip"  value="{{ $otro_pers_at->iid_otra_adscripcion }}">
        @elseif ($otro_pers_cn!=null && $destinCon_total>0 && $otro_pers_cn->iid_adscripcion==1355)
            <input type="hidden" name="idOtroPersonal" id="idOtroPersonal" value="{{ $otro_pers_cn->iid_otro_personal }}">
            <input type="hidden" name="idOtroPuesto"   id="idOtroPuesto"   value="{{ $otro_pers_cn->iid_otro_puesto }}">
            <input type="hidden" name="idOtraAdscrip"  id="idOtraAdscrip"  value="{{ $otro_pers_cn->iid_otra_adscripcion }}">
        @else
            <input type="hidden" name="idOtroPersonal" id="idOtroPersonal" value="">
            <input type="hidden" name="idOtroPuesto"   id="idOtroPuesto"   value="">
            <input type="hidden" name="idOtraAdscrip"  id="idOtraAdscrip"  value="">
        @endif

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
            <div class="col-5">                        
                <button type="submit" class="btn btn-primary">
                    <img src="{{ asset('bootstrap-icons-1.5.0/save.svg') }}" width="18" height="18">
                    <span>&nbsp;Actualizar</span>
                </button>
            </div>
            @if ($documento->iid_tipo_documento!=7)
                <div class="col-2">
                    <button type="button" class="btn btn-primary">
                        <a href="{{ url('documentos/acuse/'.$documento->iid_documento) }}" data-toggle="tooltip" data-html="true" title="Imprimir Acuse">
                                    <img src="{{ asset('bootstrap-icons-1.5.0/printer-fill.svg') }}" width="18" height="18">
                        </a>
                    </button>
                </div>
            @else
                <div class="col-2">
                </div>
            @endif
            <div class="col-5">
                <a href="{{ url('/documentos/index') }}">
                <!--<button type="button" class="btn btn-primary" onClick="history.go(-2)">-->
                    <button type="button" class="btn btn-primary">
                        <img src="{{ asset('bootstrap-icons-1.5.0/x-lg.svg') }}" width="18" height="18">
                        <span>&nbsp;Cerrar</span>
                    </button>
                </a>
            </div>
        </div>
    </form>
    <br>
    @if($destinAtt_total>0 && ($documento->iid_tipo_documento<=6 || $documento->iid_tipo_documento>=9))
        <hr>
        <h5 class="text-primary-sin"><b>SEGUIMIENTO DESTINATARIOS ATENCIÓN</b></h5>
        <br>
        <div class="row" id="divDA_Seguimiento">
            <div id="divVistaPrevia_Seguimiento" class="table-responsive" style="display:block;">
                <div class="table-responsive">
                    <table class="table table-striped shadow-lg" id="MyTableVPSeg">
                      <thead>
                        <tr>
                            <th class="text-center">Número de Documento</th>
                            <th class="text-center">Tipo de Documento</th>
                            <th class="text-center">Estatus</th>
                            <th class="text-center">Fecha de Seguimiento</th>
                            <th class="text-center">Seguimiento</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($destinAtt as $indice=>$destAt)
                    <!--RECURSOS FINANCIEROS RF, id=230/RECURSOS HUMANOS RH, id=231-->
                            @if($destAt->iid_adscripcion==227 || $destAt->iid_adscripcion==228 || $destAt->iid_adscripcion==229 || $destAt->iid_adscripcion==230 || $destAt->iid_adscripcion==231 || $destAt->iid_adscripcion==232 || $destAt->iid_adscripcion==1208 || $destAt->iid_adscripcion==1215 || $destAt->iid_adscripcion==1354 || $destAt->iid_adscripcion==1355)
                                <tr>
                                    <td class="text-center">{{ $destAt['cnum_docto_resp'] }}</td>
                                    @if($destAt['tipodocumento']!=null)
                                        <td class="text-center">{{ $destAt['tipodocumento']['cdescripcion_tipo_documento'] }}</td>
                                    @else
                                        <td class="text-center"></td>
                                    @endif
                                    @if($destAt['estatusdocumento']!=null)
                                        <td class="text-center">{{ $destAt['estatusdocumento']['cdescripcion_estatus_documento'] }}</td>
                                    @else
                                        <td class="text-center"></td>
                                    @endif
                                    <td class="text-center">{{ $destAt['dfecha_concluido'] }}</td>
                                    <td class="text-center">{{ $destAt['crespuesta'] }}</td>
                                    <td class="text-center col-actions">
                                    @if ($destAt->iestatus == 1)
                                        @if ($destAt->cruta_archivo_respuesta!="")
                                            <a href="{{url('pdf/'.substr($destAt['cruta_archivo_respuesta'],strrpos($destAt['cruta_archivo_respuesta'],'pdf/')+4))}}" title="Ver PDF" target="_blank">
                                                <img src="{{ asset('bootstrap-icons-1.5.0/file-pdf-fill.svg') }}" width="18" height="18">
                                            </a>
                                        @endif
                                    @endif()
                                <!--GESTIÓN TECNOLÓGICA DG, id=227-->
                                    @if($destAt->iid_adscripcion==227)
                                        <div class="col-3" id="divDAGTSeg">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AGTSeguimModal">
                                                Seguimiento DEGT
                                            </button>
                                        <!-- Inputs de Modal para Seguimiento Destinatarios Atención Gestión Tecnológica -->
                                            @include('documentos.modales.datos_segGT_dest_aten')
                                        </div>
                                    @endif
                                <!--OBRAS, MANTENIMIENTO Y SERVICIOS OB, id=228-->
                                    @if($destAt->iid_adscripcion==228)
                                        <div class="col-3" id="divDAOBSeg">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AOBSeguimModal">
                                                Seguimiento DEOMS
                                            </button>
                                        <!-- Inputs de Modal para Seguimiento Destinatarios Atención DEOMS -->
                                            @include('documentos.modales.datos_segOB_dest_aten')
                                        </div>
                                    @endif
                                <!--PLANEACIÓN PL, id=229-->
                                    @if($destAt->iid_adscripcion==229)
                                        <div class="col-3" id="divDAPLSeg">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#APLSeguimModal">
                                                Seguimiento D E P
                                            </button>
                                        <!-- Inputs de Modal para Seguimiento Destinatarios Atención Planeación -->
                                            @include('documentos.modales.datos_segPL_dest_aten')
                                        </div>
                                    @endif
                                <!--RECURSOS FINANCIEROS RF, id=230-->
                                    @if($destAt->iid_adscripcion==230)
                                        <div class="col-3" id="divDARFSeg">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ARFSeguimModal">
                                                Seguimiento DERF
                                            </button>
                                        <!-- Inputs de Modal para Seguimiento Destinatarios Atención DERF -->
                                            @include('documentos.modales.datos_segRF_dest_aten')
                                        </div>
                                    @endif
                                <!--RECURSOS HUMANOS RH, id=231-->
                                    @if($destAt->iid_adscripcion==231)
                                        <div class="col-3" id="divDARHSeg">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ARHSeguimModal">
                                                Seguimiento DERH
                                            </button>
                                        <!-- Inputs de Modal para Seguimiento Destinatarios Atención DERH -->
                                            @include('documentos.modales.datos_segRH_dest_aten')
                                        </div>
                                    @endif
                                <!--RECURSOS MAERIALES RM, id=232-->
                                    @if($destAt->iid_adscripcion==232)
                                        <div class="col-3" id="divDARMSeg">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ARMSeguimModal">
                                                Seguimiento DERM
                                            </button>
                                        <!-- Inputs de Modal para Seguimiento Destinatarios Atención DERM -->
                                            @include('documentos.modales.datos_segRM_dest_aten')
                                        </div>
                                    @endif
                                <!--DIRECCIÓN GENERAL JURÍDICA DGJ, id=1208-->
                                    @if($destAt->iid_adscripcion==1208)
                                        <div class="col-3" id="divDADGJSeg">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ADGJSeguimModal">
                                                Seguimiento DGJ
                                            </button>
                                        <!-- Inputs de Modal para Seguimiento Destinatarios Atención DGJ -->
                                            @include('documentos.modales.datos_segDGJ_dest_aten')
                                        </div>
                                    @endif
                                <!--DIRECCIÓN DE SEGURIDAD DS, id=1215-->
                                    @if($destAt->iid_adscripcion==1215)
                                        <div class="col-3" id="divDADSSeg">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ADSSeguimModal">
                                                Seguimiento DS
                                            </button>
                                        <!-- Inputs de Modal para Seguimiento Destinatarios Atención DS -->
                                            @include('documentos.modales.datos_segDS_dest_aten')
                                        </div>
                                    @endif
                                <!--DIRECCIÓN ADMINISTRATIVA DA, id=1354-->
                                    @if($destAt->iid_adscripcion==1354)
                                        <div class="col-3" id="divDADASeg">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ADASeguimModal">
                                                Seguimiento DA
                                            </button>
                                        <!-- Inputs de Modal para Seguimiento Destinatarios Atención DA -->
                                            @include('documentos.modales.datos_segDA_dest_aten')
                                        </div>
                                    @endif
                                <!--OTRO OT, id=1355-->
                                    @if($destAt->iid_adscripcion==1355)
                                        <div class="col-3" id="divDAOTSeg">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AOTSeguimModal">
                                                Seguimiento OTRO
                                            </button>
                                        <!-- Inputs de Modal para Seguimiento Destinatarios Atención OTRO -->
                                            @include('documentos.modales.datos_segOT_dest_aten')
                                        </div>
                                    @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
    @endif
    {{--
    @if($destinCon_total>0)
        <hr>
        <h5 class="text-primary-sin"><b>SEGUIMIENTO DESTINATARIOS CONOCIMIENTO</b></h5>
        <br>
        <div class="row" id="divDC_Seguimiento">
        @foreach($destinCon as $indice=>$destCn)
    <!--OFICIALÍA MAYOR OM, id=1027-->
            @if($destCn->iid_adscripcion==1027)
                <div class="col-3" id="divDCOMSeg">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#COMSeguimModal">
                        Seguimiento OFMTSJ
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención Oficialía Mayor -->
                    @include('documentos.modales.datos_segOM_dest_con')
                </div>
            @endif
    <!--PLANEACIÓN PL, id=229-->
            @if($destCn->iid_adscripcion==229)
                <div class="col-3" id="divDCPLSeg">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CPLSeguimModal">
                        Seguimiento D E P
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención Planeación -->
                    @include('documentos.modales.datos_segPL_dest_con')
                </div>
            @endif
    <!--GESTIÓN TECNOLÓGICA, id=227-->
            @if($destCn->iid_adscripcion==227)
                <div class="col-3" id="divDCGTSeg">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CGTSeguimModal">
                        Seguimiento DEGT
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención Gestión Tecnológica -->
                    @include('documentos.modales.datos_segGT_dest_con')
                </div>
            @endif
    <!--RECURSOS HUMANOS RH, id=231-->
            @if($destCn->iid_adscripcion==231)
                <div class="col-3" id="divDCRHSeg">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CRHSeguimModal">
                        Seguimiento DERH
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención DERH -->
                    @include('documentos.modales.datos_segRH_dest_con')
                </div>
            @endif
            <br>
    <!--OBRAS, MANTENIMIENTO Y SERVICIOS OB, id=228-->
            @if($destCn->iid_adscripcion==228)
                <div class="col-3" id="divDCOBSeg">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#COBSeguimModal">
                        Seguimiento DEOMS
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención DEOMS -->
                    @include('documentos.modales.datos_segOB_dest_con')
                </div>
            @endif
    <!--RECURSOS MAERIALES RM, id=232-->
            @if($destCn->iid_adscripcion==232)
                <div class="col-3" id="divDCRM_Seg">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CRMSeguimModal">
                        Seguimiento DERM
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención DERM -->
                    @include('documentos.modales.datos_segRM_dest_con')
                </div>
            @endif
    <!--RECURSOS FINANCIEROS RF, id=230-->
            @if($destCn->iid_adscripcion==230)
                <div class="col-3" id="divDCRFSeg">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CRFSeguimModal">
                        Seguimiento DERF
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención DERF -->
                    @include('documentos.modales.datos_segRF_dest_con')
                </div>
            @endif
    <!--DIRECCIÓN DE SEGURIDAD DS, id=1215-->
            @if($destCn->iid_adscripcion==1215)
                <div class="col-3" id="divDCDSSeg">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CDSSeguimModal">
                        Seguimiento DS
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención DS -->
                    @include('documentos.modales.datos_segDS_dest_con')
                </div>
            @endif
    <!--DIRECCIÓN ADMINISTRATIVA DA, id=1354-->
            @if($destCn->iid_adscripcion==1354)
                <div class="col-3" id="divDCDASeg">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CDASeguimModal">
                        Seguimiento DA
                    </button>
                <!-- Inputs de Modal para Seguimiento Destinatarios Atención DERF -->
                    @include('documentos.modales.datos_segDA_dest_con')
                </div>
            @endif
    <!--OTRO OT, id=1355-->
            @if($destCn->iid_adscripcion==1355)
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
    --}}
@endsection