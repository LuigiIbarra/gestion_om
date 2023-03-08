'use strict'

window.addEventListener('load', function(){

	function cambiaPuestoAds() {
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/actualizaPuestoAdscrip',
            data: {
                lnr: $('#listanr').val(),
            },
            success: function (respuesta) {  
            	console.log(respuesta);
                if(respuesta.exito == 1){
                    //idRemitente es el campo auxiliar oculto 
        			document.querySelector('#idRemitente').value = document.querySelector('#listanr').value;
                    $('#puesto_remitente').attr("disabled", false);
                    $('#area_remitente').attr("disabled", false);
                    $('#btnGuardarDoc').attr("disabled",false);
                    var selectPuesto = '<option value="'+respuesta.puesto[0].iid_puesto +'">'+respuesta.puesto[0].cdescripcion_puesto+'</option>';
                    var selectAdscrip= '<option value="'+respuesta.adscripcion[0].iid_adscripcion +'">'+respuesta.adscripcion[0].cdescripcion_adscripcion+'</option>';
                    document.querySelector("#puesto_remitente").innerHTML = selectPuesto;
                    document.querySelector("#area_remitente").innerHTML   = selectAdscrip;
                	document.querySelector('#validaPersonal').innerHTML   = "";
                }else{
                    $('#puesto_remitente').attr("disabled", true);
                    $('#area_remitente').attr("disabled", true);
                    $('#btnGuardarDoc').attr("disabled",true);
                    var selectPuesto  = "<option value='0'>Escriba un Nombre...</option>";
                    var selectAdscrip = "<option value='0'>Escriba un Nombre...</option>";
                    document.querySelector("#puesto_remitente").innerHTML = selectPuesto;
                    document.querySelector("#area_remitente").innerHTML   = selectAdscrip;                   
                    var error=""; 
                    error+="<label><font style='color: red;'>*No se econtraron resultados con este Nombre.<font style='color: red;'></label><br/>"
                    document.querySelector('#validaPersonal').innerHTML   = error;
                    return false;
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
               alert('Ocurrio un errror, intente de nuevo.' + jqXHR.responseText );
            }
        });
		
	}

	var listanr    = document.querySelector('#listanr');

	listanr.addEventListener('change', function(){
    	cambiaPuestoAds();
    });
});