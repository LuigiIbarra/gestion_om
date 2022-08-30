'use strict'

window.addEventListener('load', function(){

    function muestraDest(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/buscaPuestoAdscrip',
            data: {
                nr: $('#nombre_destinatariocc').val(),
            },
            success: function (respuesta) {  
            	console.log(respuesta);
                if(respuesta.exito == 1){
                    $('#puesto_conocimiento').attr("disabled", false);
                    $('#area_conocimiento').attr("disabled", false);
                    document.querySelector('#validaPersonalDest').innerHTML = "";
                    var selectPuesto = '<option value="'+respuesta.listaPuesto[0].iid_puesto +'">'+respuesta.listaPuesto[0].cdescripcion_puesto+'</option>';
                    var selectAdscrip;
                    for(let i in respuesta.listaAdscrip){
                        selectAdscrip+= '<option value="'+respuesta.listaAdscrip[i].iid_adscripcion +'">'+respuesta.listaAdscrip[i].cdescripcion_adscripcion+'</option>';
                    }
                    document.querySelector('#idDestinatario').value = respuesta.idRemitente;
                    document.querySelector('#nombre_destinatariocc').value = respuesta.nombreRemtte;
                    document.querySelector("#puesto_conocimiento").innerHTML = selectPuesto;
                    document.querySelector("#area_conocimiento").innerHTML = selectAdscrip;
                	document.querySelector('#validaPersonalDest').innerHTML = "";
                }else{
                    $('#puesto_conocimiento').attr("disabled", true);
                    $('#area_conocimiento').attr("disabled", true);
                    var selectPuesto  = "<option value='0'>Escriba un Nombre...</option>";
                    var selectAdscrip = "<option value='0'>Escriba un Nombre...</option>";
                    document.querySelector('#idDestinatario').value = "";
                    document.querySelector('#nombre_destinatariocc').value = "";
                    document.querySelector("#puesto_conocimiento").innerHTML = selectPuesto;
                    document.querySelector("#area_conocimiento").innerHTML = selectAdscrip;                   
                    var error=""; 
                    error+="<label><font style='color: red;'>*No se econtraron resultados con este Nombre.<font style='color: red;'></label><br/>"
                    document.querySelector('#validaPersonalDest').innerHTML = error;
                    return false;
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
               alert('Ocurrio un errror, intente de nuevo.' + jqXHR.responseText );
            }
        });
    }

    var nombreDes  = document.querySelector('#nombre_destinatariocc');
    
    nombreDes.addEventListener('change', function(){
    	muestraDest();
    });
});