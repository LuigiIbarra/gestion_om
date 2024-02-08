'use strict'

window.addEventListener('load', function(){

	function muestraSeccionesTipoDoc() {
		var tipoDocId  = document.querySelector('#tipo_documento').value;
		if (tipoDocId == 7) {
		//tipoDocId ==  7 COPIA DE CONOCIMIENTO
			$('#divdestinatariocc').show();
			$('#divSegmntDADC').hide();
            $('#divRHAtencion').hide();
			$('#folio_documento').val(document.querySelector('#folio_cc').value);
		} else if (tipoDocId == 8) {
		//tipoDocId ==  8 RECURSOS HUMANOS
			$('#divdestinatariocc').hide();
			$('#divSegmntDADC').hide();
            $('#divRHAtencion').show();
			$('#folio_documento').val(document.querySelector('#folio_rh').value);
		} else {
			$('#divdestinatariocc').hide();
			$('#divSegmntDADC').show();
            $('#divRHAtencion').hide();
			$('#folio_documento').val(document.querySelector('#folio').value);
		}
	}
	
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
                    error+="<label><font style='color: red;'>*No se econtraron resultados con este Nombre.<font style='color: red;'></label><br/>"
                    document.querySelector('#validaPersonal').innerHTML = error;
                    return false;
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
               alert('Ocurrio un errror, intente de nuevo.' + jqXHR.responseText );
            }
        });
    }
    
	var tipoDoc    = document.querySelector("#tipo_documento");
	var tipoDocId  = document.querySelector('#tipo_documento').value;
	var nombreRem  = document.querySelector('#nombre_remitente');
    
	if (tipoDocId == 7) {
	//tipoDocId ==  7 COPIA DE CONOCIMIENTO
		$('#divdestinatariocc').show();
		$('#divSegmntDADC').hide();
        $('#divRHAtencion').hide();
        $('#folio_documento').val(document.querySelector('#folio_cc').value);
	} else if (tipoDocId == 8) {
	//tipoDocId ==  8 RECURSOS HUMANOS
		$('#divdestinatariocc').hide();
		$('#divSegmntDADC').hide();
        $('#divRHAtencion').show();
        $('#folio_documento').val(document.querySelector('#folio_rh').value);
	} else {
		$('#divdestinatariocc').hide();
		$('#divSegmntDADC').show();
        $('#divRHAtencion').hide();
        $('#folio_documento').val(document.querySelector('#folio').value);
	}	

	tipoDoc.addEventListener('change', function(){        
        muestraSeccionesTipoDoc();
    });
    nombreRem.addEventListener('change', function(){
    	muestraRemitente();
    });
});