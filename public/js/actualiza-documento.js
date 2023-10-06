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

    function cambiaColor(){
        var option = document.querySelector('#semaforo');
        if (option.value == 1)
            $('#semaforo').attr("style", 'border-width: 5px; border-color:red;');
        if (option.value == 2)
            $('#semaforo').attr("style", 'border-width: 5px; border-color:green;');
        if (option.value == 3)
            $('#semaforo').attr("style", 'border-width: 5px; border-color:yellow;');
        if (option.value == null || option.value < 1 || option.value > 3)
            $('#semaforo').attr("style", 'border-width: 1px; border-color:gray-light;');
    }

	var tipoDocId  = document.querySelector('#tipo_documento').value;
	var editaDoc   = document.querySelector('#editaDocto').value;
	var nombreRem  = document.querySelector('#nombre_remitente');
    var semaforo   = document.querySelector('#semaforo');

	if(tipoDocId == 7 && editaDoc == 1){
		tipo_documento[1].style.display="none";
		tipo_documento[2].style.display="none";
		tipo_documento[3].style.display="none";
		tipo_documento[4].style.display="none";
		tipo_documento[5].style.display="none";
		tipo_documento[6].style.display="none";
		tipo_documento[7].style.display="block";
		tipo_documento[8].style.display="none";
	}else if(tipoDocId == 8 && editaDoc == 1){
		tipo_documento[1].style.display="none";
		tipo_documento[2].style.display="none";
		tipo_documento[3].style.display="none";
		tipo_documento[4].style.display="none";
		tipo_documento[5].style.display="none";
		tipo_documento[6].style.display="none";
		tipo_documento[7].style.display="none";
		tipo_documento[8].style.display="block";
	}else if(tipoDocId <= 6 && editaDoc == 1) {
		tipo_documento[1].style.display="block";
		tipo_documento[2].style.display="block";
		tipo_documento[3].style.display="block";
		tipo_documento[4].style.display="block";
		tipo_documento[5].style.display="block";
		tipo_documento[6].style.display="block";
		tipo_documento[7].style.display="none";
		tipo_documento[8].style.display="none";
	}

    if (semaforo.value == 1)
        $('#semaforo').attr("style", 'border-width: 5px; border-color:red;');
    if (semaforo.value == 2)
        $('#semaforo').attr("style", 'border-width: 5px; border-color:green;');
    if (semaforo.value == 3)
        $('#semaforo').attr("style", 'border-width: 5px; border-color:yellow;');
    if (semaforo.value == null || semaforo.value < 1 || semaforo.value > 3)
        $('#semaforo').attr("style", 'border-width: 1px; border-color:gray-light;');

	nombreRem.addEventListener('change', function(){
    	muestraRemitente();
    });
    semaforo.addEventListener('change', function(){
        cambiaColor();
    });

});