'use strict'

window.addEventListener('load', function(){

	function cambiaPstoAdsDCC() {
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/actualizaPuestoAdscrip',
            data: {
                lnr: $('#nombre_destinatariocc').val(),
            },
            success: function (respuesta) {  
            	console.log(respuesta);
                if(respuesta.exito == 1){
                    //idDestinatario es el campo auxiliar oculto 
        			document.querySelector('#idDestinatario').value = document.querySelector('#nombre_destinatariocc').value;
                    $('#puesto_conocimiento').attr("disabled", false);
                    $('#area_conocimiento').attr("disabled", false);
                    $('#btnGuardarDoc').attr("disabled",false);
                    var selectPuesto = '<option value="'+respuesta.puesto[0].iid_puesto +'">'+respuesta.puesto[0].cdescripcion_puesto+'</option>';
                    var selectAdscrip= '<option value="'+respuesta.adscripcion[0].iid_adscripcion +'">'+respuesta.adscripcion[0].cdescripcion_adscripcion+'</option>';
                    document.querySelector("#puesto_conocimiento").innerHTML = selectPuesto;
                    document.querySelector("#area_conocimiento").innerHTML   = selectAdscrip;
                	document.querySelector('#validaPersonalDest').innerHTML  = "";
                }else{
                    $('#puesto_conocimiento').attr("disabled", true);
                    $('#area_conocimiento').attr("disabled", true);
                    $('#btnGuardarDoc').attr("disabled",true);
                    var selectPuesto  = "<option value='0'>Escriba un Nombre...</option>";
                    var selectAdscrip = "<option value='0'>Escriba un Nombre...</option>";
                    document.querySelector("#puesto_conocimiento").innerHTML = selectPuesto;
                    document.querySelector("#area_conocimiento").innerHTML   = selectAdscrip;                   
                    var error=""; 
                    error+="<label><font style='color: red;'>*No se econtraron resultados con este Nombre.<font style='color: red;'></label><br/>"
                    document.querySelector('#validaPersonalDest').innerHTML  = error;
                    return false;
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
               alert('Ocurrio un errror, intente de nuevo.' + jqXHR.responseText );
            }
        });
		
	}

	var listandcc    = document.querySelector('#nombre_destinatariocc');

	listandcc.addEventListener('change', function(){
    	cambiaPstoAdsDCC();
    });
});