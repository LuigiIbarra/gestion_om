'use strict'

function textonly(e){
    var code;

    if (!e) var e = window.event;
      if (e.keyCode)
        code = e.keyCode;
    else
        if (e.which)
            code = e.which;
        if(code == 37 || code == 39) return true;
       
            var caracter = String.fromCharCode(code);
            var valores = /^[\ba-zA-ZñÑáéíóúÁÉÍÓÚ\s]$/;
    if (valores.test(caracter)) return true;
            return false;
}

window.addEventListener('load', function(){

	function muestraPersonaConocimiento() {
		var areaRemId  = document.querySelector('#area_remitente').value;
		var estatusId = document.querySelector('#estatus_documento').value;
		//estatusId ==  3 Conocimiento
		//areaRemId == 15 Dirección Ejecutiva de Recursos Humanos
		if (estatusId == 3 && areaRemId == 15) {
			$('#divdestinatariocc').show();
			$('#divdestinatn').hide();
			$('#divdestinconoc').hide();
		} else if (estatusId == 3 && areaRemId != 15) {
			$('#divdestinatariocc').show();
			$('#divdestinatn').hide();
			$('#divdestinconoc').hide();
		} else if (estatusId != 3 && areaRemId == 15) {
			$('#divdestinatariocc').hide();
			$('#divdestinatn').hide();
			$('#divdestinconoc').hide();
		} else if (estatusId != 3 && areaRemId != 15) {
			$('#divdestinatariocc').hide();
			$('#divdestinatn').show();
			$('#divdestinconoc').show();
		}
	}
	function muestraRH() {
		var areaRemId  = document.querySelector('#area_remitente').value;
		var estatusId  = document.querySelector('#estatus_documento').value;
		//estatusId ==  3 Conocimiento
		//areaRemId == 15 Dirección Ejecutiva de Recursos Humanos
		if (areaRemId == 15 && estatusId == 3) {
			$('#divdestinatariocc').show();
			$('#divdestinatn').hide();
			$('#divdestinconoc').hide();
		} else if (areaRemId == 15 && estatusId != 3) {
				$('#divdestinatariocc').hide();
				$('#divdestinatn').hide();
				$('#divdestinconoc').hide();
		} else if (areaRemId != 15 && estatusId == 3) {
				$('#divdestinatariocc').show();
				$('#divdestinatn').hide();
				$('#divdestinconoc').hide();
		} else if (areaRemId != 15 && estatusId != 3) {
				$('#divdestinatariocc').hide();
				$('#divdestinatn').show();
				$('#divdestinconoc').show();
		}
	}
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
    /*
    function buscaDocDuplicado(){
    	$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
        	type: 'POST',
        	url: '/buscaDoctoDuplicado',
        	data: {
        		nd: $('#numero_documento').val(),
        	},
        	success: function (respuesta) {
        		console.log(respuesta);
        		if(respuesta.exito == 1){
        			var fol  = respuesta.folio;
        			var error=""; 
                    error+="<label><font style='color: red;'>*El Número de Documento YA Existe, con el Folio ".fol.", verifique.<font style='color: red;'></label><br/>"
                    document.querySelector('#validaPersonal').innerHTML = error;
                    return false;
        		}else{
        			document.querySelector('#validaDocumento').innerHTML = "";
        		}
        	},
        	error: function (jqXHR, textStatus, errorThrown) {
        		alert('Ocurrio un errror, intente de nuevo.' + jqXHR.responseText );
        	}
        });
    }
    */

	var areaRemite = document.querySelector('#area_remitente');
	var areaRemId  = document.querySelector('#area_remitente').value;
	var estatusDoc = document.querySelector("#estatus_documento");
	var estatusId  = document.querySelector('#estatus_documento').value;
	var nombreRem  = document.querySelector('#nombre_remitente');
	//var numDocto   = document.querySelector('#numero_documento');
	//estatusId ==  3 Conocimiento
	//areaRemId == 15 Dirección Ejecutiva de Recursos Humanos
	if (estatusId == 3 && areaRemId == 15) {
		$('#divdestinatariocc').show();
		$('#divdestinatn').hide();
		$('#divdestinconoc').hide();
	} else if (estatusId == 3 && areaRemId != 15) {
		$('#divdestinatariocc').show();
		$('#divdestinatn').hide();
		$('#divdestinconoc').hide();
	} else if (estatusId != 3 && areaRemId == 15) {
		$('#divdestinatariocc').hide();
		$('#divdestinatn').hide();
		$('#divdestinconoc').hide();
	} else if (estatusId != 3 && areaRemId != 15) {
		$('#divdestinatariocc').hide();
		$('#divdestinatn').show();
		$('#divdestinconoc').show();
	}

	estatusDoc.addEventListener('change', function(){        
        muestraPersonaConocimiento();
    });
    areaRemite.addEventListener('change', function(){        
        muestraRH();
    });
    nombreRem.addEventListener('change', function(){
    	muestraPuestoAds();
    });
    /*
    numDocto.addEventListener('change', function(){
    	buscaDocDuplicado();
    });
    */
});