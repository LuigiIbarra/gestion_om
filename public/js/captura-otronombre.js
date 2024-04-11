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
                on: $('#busca_otro_nombre').val(),
            },
            success: function (respuesta) {  
            	console.log(respuesta);
                if(respuesta.exito == 1){
                    var selectON;
                    for(let i in respuesta.otro_personal){
                        selectON+= '<option value="'+respuesta.otro_personal[i].iid_personal +'">'+respuesta.otro_personal[i].cnombre_personal+' '+respuesta.otro_personal[i].cpaterno_personal+' '+respuesta.otro_personal[i].cmaterno_personal+'</option>';
                    }
                    var selectPuesto = '<option value="'+respuesta.otro_personal[0].iid_puesto +'">'+respuesta.otro_personal[0].puesto.cdescripcion_puesto+'</option>';
                    var selectAdscrip= '<option value="'+respuesta.otro_personal[0].iid_adscripcion +'">'+respuesta.otro_personal[0].adscripcion.cdescripcion_adscripcion+'</option>';
                    document.querySelector('#idOtroPersonal').value   = respuesta.otro_personal[0].iid_personal;
                    document.querySelector('#otro_nombre').innerHTML  = selectON;
                    document.querySelector('#idOtroPuesto').value     = respuesta.otro_personal[0].iid_puesto;
                    document.querySelector('#otro_puesto').innerHTML  = selectPuesto;
                    document.querySelector('#idOtraAdscrip').value    = respuesta.otro_personal[0].iid_adscripcion;
                    document.querySelector('#otra_adscripcion').innerHTML = selectAdscrip;
                	var error=""; 
                    error+="<label><font style='color: red;'>*Este Nombre ya Existe en el catálogo.<font style='color: red;'></label><br/>"
                    document.querySelector('#validaOtroPersonalAC').innerHTML = error;
                }else{
                	document.querySelector('#idOtroPersonal').value   = '';
                    document.querySelector('#otro_nombre').innerHTML  = "<option value='0'>Escriba un Nombre...</option>";
                    document.querySelector('#idOtroPuesto').value     = '';
                    document.querySelector('#otro_puesto').innerHTML  = "<option value='0'>Escriba un Nombre...</option>";
                    document.querySelector('#idOtraAdscrip').value    = '';
                    document.querySelector('#otra_adscripcion').innerHTML = "<option value='0'>Escriba un Nombre...</option>";
                	var error=""; 
                    error+="<label><font style='color: red;'>*No se encontraron resultados con este Nombre, capture Apellidos, Puesto, Adscripción y Tipo de Adscripción.<font style='color: red;'></label><br/>"
                    document.querySelector('#validaOtroPersonalAC').innerHTML = error;
                    return false;
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
               alert('Ocurrio un errror, intente de nuevo.' + jqXHR.responseText );
            }
        });
	}

	var otroNombre = document.querySelector('#busca_otro_nombre');

	otroNombre.addEventListener('change',function(){
		muestraOtro();
	});
});