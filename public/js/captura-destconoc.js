'use strict'

window.addEventListener('load', function(){

    function muestraDestinatarioCC(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/buscaPuestoAdscrip',
            data: {
                nr: $('#destinatario_cc').val(),
            },
            success: function (respuesta) {  
            	console.log(respuesta);
                if(respuesta.exito == 1){
                    $('#puesto_conocimiento').attr("disabled", false);
                    $('#area_conocimiento').attr("disabled", false);
                    document.querySelector('#validaPersonalDest').innerHTML = "";
                    var selectNDCC;
                    for(let i in respuesta.listaNR){
                        selectNDCC+= '<option value="'+respuesta.listaNR[i].iid_personal +'">'+respuesta.listaNR[i].cnombre_personal+' '+respuesta.listaNR[i].cpaterno_personal+' '+respuesta.listaNR[i].cmaterno_personal+'</option>';
                    }
                    var selectPuesto = '<option value="'+respuesta.listaPuesto[0].iid_puesto +'">'+respuesta.listaPuesto[0].cdescripcion_puesto+'</option>';
                    var selectAdscrip= '<option value="'+respuesta.listaAdscrip[0].iid_adscripcion +'">'+respuesta.listaAdscrip[0].cdescripcion_adscripcion+'</option>';
                    document.querySelector('#idDestinatario').value = respuesta.idRemitente;
                    document.querySelector('#nombre_destinatariocc').innerHTML = selectNDCC;
                    document.querySelector("#puesto_conocimiento").innerHTML = selectPuesto;
                    document.querySelector("#area_conocimiento").innerHTML = selectAdscrip;
                	document.querySelector('#validaPersonalDest').innerHTML = "";
                }else{
                    $('#puesto_conocimiento').attr("disabled", true);
                    $('#area_conocimiento').attr("disabled", true);
                    var selectNDCC    = "<option value='0'>Escriba un Nombre...</option>";
                    var selectPuesto  = "<option value='0'>Escriba un Nombre...</option>";
                    var selectAdscrip = "<option value='0'>Escriba un Nombre...</option>";
                    document.querySelector('#idDestinatario').value = "";
                    document.querySelector('#destinatario_cc').value = "";
                    document.querySelector('#nombre_destinatariocc').innerHTML = selectNDCC;
                    document.querySelector("#puesto_conocimiento").innerHTML = selectPuesto;
                    document.querySelector("#area_conocimiento").innerHTML = selectAdscrip;                   
                    var error=""; 
                    error+="<label><font style='color: red;'>*No se encontraron resultados con este Nombre.<font style='color: red;'></label><br/>"
                    document.querySelector('#validaPersonalDest').innerHTML = error;
                    return false;
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
               alert('Ocurrio un errror, intente de nuevo.' + jqXHR.responseText );
            }
        });
    }

    var nombreDes  = document.querySelector('#destinatario_cc');
    
    nombreDes.addEventListener('change', function(){
    	muestraDestinatarioCC();
    });
});