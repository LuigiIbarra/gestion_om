'use strict'

window.addEventListener('load', function(){

	function muestraRemitente(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/buscaPuestoAdscrip',
            data: {
                nr: $('#nombre_remitente').val(),
            },
            success: function (respuesta) {  
            	console.log(respuesta);
                if(respuesta.exito == 1){
                    $('#puesto_remitente').attr("disabled", false);
                    $('#area_remitente').attr("disabled", false);
                    $('#btnGuardarDoc').attr("disabled",false);
                    document.querySelector('#validaPersonal').innerHTML = "";
                    var selectNR;
                    for(let i in respuesta.listaNR){
                        selectNR+= '<option value="'+respuesta.listaNR[i].iid_personal +'">'+respuesta.listaNR[i].cnombre_personal+' '+respuesta.listaNR[i].cpaterno_personal+' '+respuesta.listaNR[i].cmaterno_personal+'</option>';
                    }
                    var selectPuesto = '<option value="'+respuesta.listaPuesto[0].iid_puesto +'">'+respuesta.listaPuesto[0].cdescripcion_puesto+'</option>';
                    var selectAdscrip= '<option value="'+respuesta.listaAdscrip[0].iid_adscripcion +'">'+respuesta.listaAdscrip[0].cdescripcion_adscripcion+'</option>';
                    document.querySelector('#idRemitente').value          = respuesta.idRemitente;
                    document.querySelector('#listanr').innerHTML          = selectNR;
                    document.querySelector("#puesto_remitente").innerHTML = selectPuesto;
                    document.querySelector("#area_remitente").innerHTML   = selectAdscrip;
                	document.querySelector('#validaPersonal').innerHTML   = "";
                }else{
                    $('#puesto_remitente').attr("disabled", true);
                    $('#area_remitente').attr("disabled", true);
                    $('#btnGuardarDoc').attr("disabled",true);
                    var selectNR      = "<option value='0'>Escriba un Nombre...</option>";
                    var selectPuesto  = "<option value='0'>Escriba un Nombre...</option>";
                    var selectAdscrip = "<option value='0'>Escriba un Nombre...</option>";
                    document.querySelector('#idRemitente').value = "";
                    document.querySelector('#nombre_remitente').value = "";
                    document.querySelector('#listanr').innerHTML = selectNR;
                    document.querySelector("#puesto_remitente").innerHTML = selectPuesto;
                    document.querySelector("#area_remitente").innerHTML = selectAdscrip;                   
                    var error=""; 
                    error+="<label><font style='color: red;'>*No se encontraron resultados con este Nombre.<font style='color: red;'></label><br/>"
                    document.querySelector('#validaPersonal').innerHTML = error;
                    return false;
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
               alert('Ocurrio un errror, intente de nuevo.' + jqXHR.responseText );
            }
        });
    }

//APARECE Y DESAPARECE SECCIÓN OTRO NOMBRE ATENCIÓN/CONOCIMIENTO (otrapers_at_cmto)
    function muestraOtroAtCn(){
        if ($('#atencion999').prop('checked') || $('#conoc999').prop('checked'))
            $('#otrapers_at_cmto').show();
        else
            $('#otrapers_at_cmto').hide();
    }

    function cambiaRequeridosAC(){
        if( $('#atencion999').prop('checked') || $('#conoc999').prop('checked') ) {
        //PONE REQUERIDO DE LOS CAMPOS PARA NUEVO PERSONAL
            $('#nuevo_nombre_ac').prop('required',true);
            $('#otro_paterno_ac').prop('required',true);
            $('#otro_materno_ac').prop('required',true);
            $('#otro_nvo_puesto_ac').prop('required',true);
            $('#otra_nva_adscripcion_ac').prop('required',true);
        } else {
        //QUITA REQUERIDO DE LOS CAMPOS PARA NUEVO PERSONAL
            $('#nuevo_nombre_ac').removeAttr('required');
            $('#otro_paterno_ac').removeAttr('required');
            $('#otro_materno_ac').removeAttr('required');
            $('#otro_nvo_puesto_ac').removeAttr('required');
            $('#otra_desc_puesto_ac').removeAttr('required');
            $('#otra_nva_adscripcion_ac').removeAttr('required');
            $('#otra_desc_adsc_ac').removeAttr('required');
            $('#nvo_tipo_adscripcion_ac').removeAttr('required');
        }
    }

//CAMBIAR CAMPOS REQUERIDOS PARA SECCIÓN OTRO NOMBRE ATENCIÓN/CONOCIMIENTO (otrapers_at_cmto)
    function cambiaPstoReqAC(){
        if (document.querySelector('#otro_nvo_puesto_ac').value=="") {
            $('#otro_nvo_puesto_ac').removeAttr('required');
            $('#otra_desc_puesto_ac').prop('required',true);
        } else {
            $('#otro_nvo_puesto_ac').prop('required',true);
            $('#otra_desc_puesto_ac').removeAttr('required');
        }
    }

    function cambiaAreaReqAC(){
         if (document.querySelector('#otra_nva_adscripcion_ac').value=="") {
            $('#otra_nva_adscripcion_ac').removeAttr('required');
            $('#otra_desc_adsc_ac').prop('required',true);
            $('#nvo_tipo_adscripcion_ac').prop('required',true);
         } else {
            $('#otra_nva_adscripcion_ac').prop('required',true);
            $('#otra_desc_adsc_ac').removeAttr('required');
            $('#nvo_tipo_adscripcion_ac').removeAttr('required');
         }
    }

    function cambiaNewPstoReqAC(){
        if (document.querySelector('#otra_desc_puesto_ac').value!="") {
            $('#otro_nvo_puesto_ac').removeAttr('required');
            $('#otra_desc_puesto_ac').prop('required',true);
        } else {
            $('#otro_nvo_puesto_ac').prop('required',true);
            $('#otra_desc_puesto_ac').removeAttr('required');
        }
    }

    function cambiaNewAreaReqAC(){
         if (document.querySelector('#otra_desc_adsc_ac').value!="") {
            $('#otra_nva_adscripcion_ac').removeAttr('required');
            $('#otra_desc_adsc_ac').prop('required',true);
            $('#nvo_tipo_adscripcion_ac').prop('required',true);
         } else {
            $('#otra_nva_adscripcion_ac').prop('required',true);
            $('#otra_desc_adsc_ac').removeAttr('required');
            $('#nvo_tipo_adscripcion_ac').removeAttr('required');
         }
    }

//APARECE Y DESAPARECE SECCIÓN OTRO TIPO ANEXO (divotroanexo)
    function toggleOtroAnexo(){
        if (document.querySelector('#tipo_anexo').value==16)
            $('#divotroanexo').show();
        else
            $('#divotroanexo').hide();
    }

//APARECE Y DESAPARECE SECCIÓN OTRO TIPO ASUNTO (divotroasunto)
    function toggleOtroAsunto(){
        if (document.querySelector('#tipo_asunto').value==11)
            $('#divotroasunto').show();
        else
            $('#divotroasunto').hide();
    }

	var tipoDocId  = document.querySelector('#tipo_documento').value;
	var editaDoc   = document.querySelector('#editaDocto').value;
	var nombreRem  = document.querySelector('#nombre_remitente');
    var semaforo   = document.querySelector('#semaforo');
    var tipoAnexo  = document.querySelector('#tipo_anexo');
    var tipoAsunto = document.querySelector('#tipo_asunto');
//OTRO ATENCIÓN/CONOCIMIENTO
    var otroAtencion    = document.querySelector('#atencion999');
    var otroCncmnt      = document.querySelector('#conoc999');
    var newPstoAC       = document.querySelector('#otro_nvo_puesto_ac');
    var otroNewPstoAC   = document.querySelector('#otra_desc_puesto_ac');
    var newAreaAC       = document.querySelector('#otra_nva_adscripcion_ac');
    var otraNewAreaAC   = document.querySelector('#otra_desc_adsc_ac');

	if(tipoDocId == 7 && editaDoc == 1){   //Copia de Conocimiento
		tipo_documento[1].style.display="none";   //12 Acuerdo Administrativo
		tipo_documento[2].style.display="none";   //13 Acuerdo AMP
		tipo_documento[3].style.display="none";   //10 Acuerdo COMT
		tipo_documento[4].style.display="none";   //11 Acuerdo Consolidado
		tipo_documento[5].style.display="none";   // 9 Acuerdo Físico
		tipo_documento[6].style.display="none";   // 1 Acuerdo PL
		tipo_documento[7].style.display="none";   // 2 Acuerdo VAR
		tipo_documento[8].style.display="none";   // 4 Circular
        tipo_documento[9].style.display="block";  // 7 Copia de Conocimiento
        tipo_documento[10].style.display="none";  // 5 Informes
        tipo_documento[11].style.display="none";  // 6 Nota Informativa
        tipo_documento[12].style.display="none";  // 3 Oficio
        tipo_documento[13].style.display="none";  // 8 Recursos Humanos
	}else if(tipoDocId == 8 && editaDoc == 1){ //Recursos Humanos
		tipo_documento[1].style.display="none";   //12 Acuerdo Administrativo
        tipo_documento[2].style.display="none";   //13 Acuerdo AMP
        tipo_documento[3].style.display="none";   //10 Acuerdo COMT
        tipo_documento[4].style.display="none";   //11 Acuerdo Consolidado
        tipo_documento[5].style.display="none";   // 9 Acuerdo Físico
        tipo_documento[6].style.display="none";   // 1 Acuerdo PL
        tipo_documento[7].style.display="none";   // 2 Acuerdo VAR
        tipo_documento[8].style.display="none";   // 4 Circular
        tipo_documento[9].style.display="none";   // 7 Copia de Conocimiento
        tipo_documento[10].style.display="none";  // 5 Informes
        tipo_documento[11].style.display="none";  // 6 Nota Informativa
        tipo_documento[12].style.display="none";  // 3 Oficio
        tipo_documento[13].style.display="block"; // 8 Recursos Humanos
	}else if((tipoDocId <= 6 || tipoDocId >= 9) && editaDoc == 1) {
		tipo_documento[1].style.display="block";   //12 Acuerdo Administrativo
        tipo_documento[2].style.display="block";   //13 Acuerdo AMP
        tipo_documento[3].style.display="block";   //10 Acuerdo COMT
        tipo_documento[4].style.display="block";   //11 Acuerdo Consolidado
        tipo_documento[5].style.display="block";   // 9 Acuerdo Físico
        tipo_documento[6].style.display="block";   // 1 Acuerdo PL
        tipo_documento[7].style.display="block";   // 2 Acuerdo VAR
        tipo_documento[8].style.display="block";   // 4 Circular
        tipo_documento[9].style.display="none";    // 7 Copia de Conocimiento
        tipo_documento[10].style.display="block";  // 5 Informes
        tipo_documento[11].style.display="block";  // 6 Nota Informativa
        tipo_documento[12].style.display="block";  // 3 Oficio
        tipo_documento[13].style.display="none";   // 8 Recursos Humanos
	}

//COLOREAR BORDE SEGÚN EL COLOR DEL SEMÁFORO
    if (semaforo.value == 1)
        $('#semaforo').attr("style", 'border-width: 5px; border-color:red;');
    if (semaforo.value == 2)
        $('#semaforo').attr("style", 'border-width: 5px; border-color:green;');
    if (semaforo.value == 3)
        $('#semaforo').attr("style", 'border-width: 5px; border-color:yellow;');
    if (semaforo.value == null || semaforo.value < 1 || semaforo.value > 3)
        $('#semaforo').attr("style", 'border-width: 1px; border-color:gray-light;');

//APARECE Y DESAPARECE SECCIÓN OTRO TIPO ANEXO (divotroanexo)
    if (tipoAnexo.value==16)
        $('#divotroanexo').show();
    else
        $('#divotroanexo').hide();
//APARECE Y DESAPARECE SECCIÓN OTRO TIPO ASUNTO (divotroasunto)
    if (tipoAsunto.value==11)
        $('#divotroasunto').show();
    else
        $('#divotroasunto').hide();

//APARECE Y DESAPARECE SECCIÓN OTRO NOMBRE ATENCIÓN/CONOCIMIENTO (otrapers_at_cmto)
    if ($('#atencion999').prop('checked') || $('#conoc999').prop('checked'))
        $('#otrapers_at_cmto').show();
    else
        $('#otrapers_at_cmto').hide();

	nombreRem.addEventListener('change', function(){
    	muestraRemitente();
    });
//APARECE Y DESAPARECE SECCIÓN OTRO TIPO ANEXO (divotroanexo)
    tipoAnexo.addEventListener('change', function(){
        toggleOtroAnexo();
    });
//APARECE Y DESAPARECE SECCIÓN OTRO TIPO ASUNTO (divotroasunto)
    tipoAsunto.addEventListener('change', function(){
        toggleOtroAsunto();
    });
//APARECE Y DESAPARECE SECCIÓN OTRO NOMBRE ATENCIÓN/CONOCIMIENTO (otrapers_at_cmto)
    otroAtencion.addEventListener('click', function(){
        muestraOtroAtCn();
    });
    otroCncmnt.addEventListener('click', function(){
        muestraOtroAtCn();
    });
    newPstoAC.addEventListener('change', function(){
        cambiaPstoReqAC();
    });
    newAreaAC.addEventListener('change', function(){
        cambiaAreaReqAC();
    });
    otroNewPstoAC.addEventListener('change', function(){
        cambiaNewPstoReqAC();
    });
    otraNewAreaAC.addEventListener('change', function(){
        cambiaNewAreaReqAC();
    });
});