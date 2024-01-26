'use strict'

window.addEventListener('load', function(){

	function cambiaOtroPstoAds() {
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/actualizaPuestoAdscrip',
            data: {
                lnr: $('#otro_nombre').val(),
            },
            success: function (respuesta) {  
            	console.log(respuesta);
                if(respuesta.exito == 1){
                    //idOtroPersonal es el campo auxiliar oculto 
        			document.querySelector('#idOtroPersonal').value = document.querySelector('#otro_nombre').value;
                    document.querySelector('#idOtroPuesto').value   = respuesta.puesto[0].iid_puesto;
                    document.querySelector('#idOtraAdscrip').value  = respuesta.adscripcion[0].iid_adscripcion;
                    var selectPuesto = '<option value="'+respuesta.puesto[0].iid_puesto+'">'+respuesta.puesto[0].cdescripcion_puesto+'</option>';
                    var selectAdscrip= '<option value="'+respuesta.adscripcion[0].iid_adscripcion+'">'+respuesta.adscripcion[0].cdescripcion_adscripcion+'</option>';
                    document.querySelector("#otro_puesto").innerHTML        = selectPuesto;
                    document.querySelector("#otra_adscripcion").innerHTML   = selectAdscrip;
                	document.querySelector('#validaOtroPersonalAC').innerHTML = "";
                }else{
                    document.querySelector('#idOtroPersonal').value = "";
                    document.querySelector('#idOtroPuesto').value   = "";
                    document.querySelector('#idOtraAdscrip').value  = "";
                    var selectPuesto  = "<option value='0'>Escriba un Nombre...</option>";
                    var selectAdscrip = "<option value='0'>Escriba un Nombre...</option>";
                    document.querySelector("#otro_puesto").innerHTML        = selectPuesto;
                    document.querySelector("#otra_adscripcion").innerHTML   = selectAdscrip;
                    var error=""; 
                    error+="<label><font style='color: red;'>*No se econtraron resultados con este Nombre.<font style='color: red;'></label><br/>"
                    document.querySelector('#validaOtroPersonalAC').innerHTML = error;
                    return false;
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
               alert('Ocurrio un errror, intente de nuevo.' + jqXHR.responseText );
            }
        });
		
	}

    var slctNombre = document.querySelector('#otro_nombre');

    slctNombre.addEventListener('change',function(){
        cambiaOtroPstoAds();
    });
});