'use strict'

window.addEventListener('load', function(){

	function muestraPersonaConocimiento() {
		//areaRemId == 15 Dirección Ejecutiva de Recursos Humanos
		//var areaRemId  = document.querySelector('#area_remitente').value;
		//A solicitud del Ing. Victor Zaragoza, cambia de estatus_documento a tipo_documento
		//var estatusId = document.querySelector('#estatus_documento').value;
		//estatusId ==  3 Conocimiento, cambia por
		//tipoDocId ==  7 COPIA DE CONOCIMIENTO
		//tipoDocId ==  8 RECURSOS HUMANOS
		/*
		if (estatusId == 3 && areaRemId == 15) {
			$('#divdestinatariocc').show();
			$('#divSegmntDADC').hide();
		} else if (estatusId == 3 && areaRemId != 15) {
			$('#divdestinatariocc').show();
			$('#divSegmntDADC').hide();
		} else if (estatusId != 3 && areaRemId == 15) {
			$('#divdestinatariocc').hide();
			$('#divSegmntDADC').hide();
		} else if (estatusId != 3 && areaRemId != 15) {
			$('#divdestinatariocc').hide();
			$('#divSegmntDADC').show();
		}
		*/
		var tipoDocId  = document.querySelector('#tipo_documento').value;
		if (tipoDocId == 7) {
		//tipoDocId ==  7 COPIA DE CONOCIMIENTO
			$('#divdestinatariocc').show();
			$('#divSegmntDADC').hide();
		} else if (tipoDocId == 8) {
		//tipoDocId ==  8 RECURSOS HUMANOS
			$('#divdestinatariocc').hide();
			$('#divSegmntDADC').hide();
		} else {
			$('#divdestinatariocc').hide();
			$('#divSegmntDADC').show();
		}
	}
	//A solicitud del Ing. Victor Zaragoza, cambia de estatus_documento a tipo_documento
	//estatusId ==  3 Conocimiento, cambia por
	//tipoDocId ==  7 COPIA DE CONOCIMIENTO
	//tipoDocId ==  8 RECURSOS HUMANOS
	/*
	function muestraRH() {
		var areaRemId  = document.querySelector('#area_remitente').value;
		var estatusId  = document.querySelector('#estatus_documento').value;
		//areaRemId == 15 Dirección Ejecutiva de Recursos Humanos
		if (areaRemId == 15 && estatusId == 3) {
			$('#divdestinatariocc').show();
			$('#divSegmntDADC').hide();
		} else if (areaRemId == 15 && estatusId != 3) {
			$('#divdestinatariocc').hide();
			$('#divSegmntDADC').hide();
		} else if (areaRemId != 15 && estatusId == 3) {
			$('#divdestinatariocc').show();
			$('#divSegmntDADC').hide();
		} else if (areaRemId != 15 && estatusId != 3) {
			$('#divdestinatariocc').hide();
			$('#divSegmntDADC').show();
		}
	}
	*/
	function muestraPuestoAds(){
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
                    document.querySelector('#validaPersonal').innerHTML = "";
                    var selectPuesto = '<option value="'+respuesta.listaPuesto[0].iid_puesto +'">'+respuesta.listaPuesto[0].cdescripcion_puesto+'</option>';
                    var selectAdscrip;
                    for(let i in respuesta.listaAdscrip){
                        selectAdscrip+= '<option value="'+respuesta.listaAdscrip[i].iid_adscripcion +'">'+respuesta.listaAdscrip[i].cdescripcion_adscripcion+'</option>';
                    }
                    document.querySelector('#idRemitente').value = respuesta.idRemitente;
                    document.querySelector('#nombre_remitente').value = respuesta.nombreRemtte;
                    document.querySelector("#puesto_remitente").innerHTML = selectPuesto;
                    document.querySelector("#area_remitente").innerHTML = selectAdscrip;
                	document.querySelector('#validaPersonal').innerHTML = "";
                	//muestraRH();
                }else{
                    $('#puesto_remitente').attr("disabled", true);
                    $('#area_remitente').attr("disabled", true);
                    var selectPuesto  = "<option value='0'>Escriba un Nombre...</option>";
                    var selectAdscrip = "<option value='0'>Escriba un Nombre...</option>";
                    document.querySelector('#idRemitente').value = "";
                    document.querySelector('#nombre_remitente').value = "";
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
    
    //A solicitud del Ing. Victor Zaragoza, cambia de estatus_documento a tipo_documento
	//var areaRemite = document.querySelector('#area_remitente');
	//var areaRemId  = document.querySelector('#area_remitente').value;
	//var estatusDoc = document.querySelector('#estatus_documento');
	//var estatusId  = document.querySelector('#estatus_documento').value;
	var tipoDoc    = document.querySelector("#tipo_documento");
	var tipoDocId  = document.querySelector('#tipo_documento').value;
	var nombreRem  = document.querySelector('#nombre_remitente');

	//estatusId ==  3 Conocimiento, cambia por
	//tipoDocId ==  7 COPIA DE CONOCIMIENTO
	//tipoDocId ==  8 RECURSOS HUMANOS
	//areaRemId == 15 Dirección Ejecutiva de Recursos Humanos
	/*
	if (estatusId == 3 && areaRemId == 15) {
		$('#divdestinatariocc').show();
		$('#divSegmntDADC').hide();
	} else if (estatusId == 3 && areaRemId != 15) {
		$('#divdestinatariocc').show();
		$('#divSegmntDADC').hide();
	} else if (estatusId != 3 && areaRemId == 15) {
		$('#divdestinatariocc').hide();
		$('#divSegmntDADC').hide();
	} else if (estatusId != 3 && areaRemId != 15) {
		$('#divdestinatariocc').hide();
		$('#divSegmntDADC').show();
	}
	*/
	if (tipoDocId == 7) {
	//tipoDocId ==  7 COPIA DE CONOCIMIENTO
		$('#divdestinatariocc').show();
		$('#divSegmntDADC').hide();
	} else if (tipoDocId == 8) {
	//tipoDocId ==  8 RECURSOS HUMANOS
		$('#divdestinatariocc').hide();
		$('#divSegmntDADC').hide();
	} else {
		$('#divdestinatariocc').hide();
		$('#divSegmntDADC').show();
	}	

	tipoDoc.addEventListener('change', function(){        
        muestraPersonaConocimiento();
    });
    /*
    areaRemite.addEventListener('change', function(){        
        muestraRH();
    });
    */
    nombreRem.addEventListener('change', function(){
    	muestraPuestoAds();
    });
});