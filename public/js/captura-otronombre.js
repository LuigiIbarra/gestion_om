'use strict'

window.addEventListener('load', function(){

	function muestraOtro(){
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/buscaOtroNombre',
            data: {
                on: $('#otro_nombre').val(),
            },
            success: function (respuesta) {  
            	console.log(respuesta);
                if(respuesta.exito == 1){
                    document.querySelector('#idOtroPersonal').value = respuesta.idOtroPers;
                    document.querySelector('#otro_nombre').value    = respuesta.nombreOtroP;
                    document.querySelector('#otro_paterno').value   = respuesta.paternoOtroP;
                    document.querySelector('#otro_materno').value   = respuesta.maternoOtroP;
                    document.querySelector('#idOtroPuesto').value   = respuesta.idOtroPuesto;
                    document.querySelector('#otro_puesto').value    = respuesta.descOtroPsto;
                    document.querySelector('#idOtraAdscrip').value  = respuesta.idOtraAdsc;
                    document.querySelector('#otra_adscripcion').value = respuesta.descOtraAdsc;
                    document.querySelector('#tipo_adscripcion').value = respuesta.tipoOtraAdsc;
                    $('#otro_paterno').attr("disabled", true);
                    $('#otro_materno').attr("disabled", true);
                    $('#otro_puesto').attr("disabled", true);
                    $('#otra_adscripcion').attr("disabled", true);
                    $('#tipo_adscripcion').attr("disabled", true);
                	var error=""; 
                    error+="<label><font style='color: red;'>*Este Nombre ya Existe en el catálogo.<font style='color: red;'></label><br/>"
                    document.querySelector('#validaOtroPersonal').innerHTML = error;
                }else{
                	document.querySelector('#idOtroPersonal').value = '';
                    //document.querySelector('#otro_nombre').value    = '';
                    document.querySelector('#otro_paterno').value   = '';
                    document.querySelector('#otro_materno').value   = '';
                    document.querySelector('#idOtroPuesto').value   = '';
                    document.querySelector('#otro_puesto').value    = '';
                    document.querySelector('#idOtraAdscrip').value  = '';
                    document.querySelector('#otra_adscripcion').value = '';
                    document.querySelector('#tipo_adscripcion').value = '';
                	$('#otro_paterno').attr("disabled", false);
                    $('#otro_materno').attr("disabled", false);
                    $('#otro_puesto').attr("disabled", false);
                    $('#otra_adscripcion').attr("disabled", false);
                    $('#tipo_adscripcion').attr("disabled", false);
                    var error=""; 
                    error+="<label><font style='color: red;'>*No se econtraron resultados con este Nombre, capture Apellidos, Puesto, Adscripción y Tipo de Adscripción.<font style='color: red;'></label><br/>"
                    document.querySelector('#validaOtroPersonal').innerHTML = error;
                    return false;
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
               alert('Ocurrio un errror, intente de nuevo.' + jqXHR.responseText );
            }
        });
	}

	var otroNombre = document.querySelector('#otro_nombre');

	otroNombre.addEventListener('change',function(){
		muestraOtro();
	});
});