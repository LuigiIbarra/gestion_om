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
                //Regla de Semáforo color Rojo
                    reglaPstoRojo();
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

//REGLAS DE SEMÁFORO ROJO
    //POR PUESTO
    function reglaPstoRojo(){
        var pstoDoc    = document.querySelector('#puesto_remitente').value;
        console.log(pstoDoc);
        if ((pstoDoc >=   69  &&  pstoDoc  <=  76) ||    //COORDINADOR(A)
            (pstoDoc >=   84  &&  pstoDoc  <= 151) ||    //DIRECTOR(A) (EJECUTIVO/DE ÁREA)
            (pstoDoc >=  366  &&  pstoDoc  <= 377) ||    //JUEZ(A)
            (pstoDoc >=  384  &&  pstoDoc  <= 387) ||    //MAGISTRADO(A)
            (pstoDoc >=  614  &&  pstoDoc  <= 621) ||    //DIRECTOR(A) (EJECUTIVO/DE ÁREA)
            (pstoDoc >=  623  &&  pstoDoc  <= 635) ||    //DIRECTOR(A) (EJECUTIVO/DE ÁREA)
            (pstoDoc >=  817  &&  pstoDoc  <= 823) ||    //MAGISTRADO(A) / JUEZ(A)
            (pstoDoc ==  687  ||  pstoDoc  == 694  ||    //COORDINADOR(A)
             pstoDoc ==  746  ||                         //COORDINADOR(A)
             pstoDoc ==  830  ||  pstoDoc  == 832  ||    //JUEZ(A)
             pstoDoc ==  844  ||  pstoDoc  == 847)) {    //DIRECTOR(A) (EJECUTIVO/DE ÁREA)
            $("#semaforo option[value='']").attr("selected", false);
            $("#semaforo option[value='2']").attr("selected", false);
            $("#semaforo option[value='3']").attr("selected", false);
            $("#semaforo option[value='1']").attr("selected", true);
            $('#semaforo').attr("style", 'border-width: 5px; border-color:red;');
            $('#semaforoRojo').val('1');
        } else {
            $("#semaforo option[value='1']").attr("selected", false);
            $("#semaforo option[value='2']").attr("selected", false);
            $("#semaforo option[value='3']").attr("selected", false);
            $("#semaforo option[value='']").attr("selected", true);
            $('#semaforo').attr("style", 'border-width: 1px; border-color:gray-light;');
            $('#semaforoRojo').val('0');
        }
    }

    var nr         = document.querySelector('#nombre_remitente');
	var listanr    = document.querySelector('#listanr');

	listanr.addEventListener('change', function(){
    	cambiaPuestoAds();
    });
//Regla de Semáforo color Rojo
    nr.addEventListener('focus', function(){
        reglaPstoRojo();
    });
    nr.addEventListener('blur', function(){
        reglaPstoRojo();
    });
    listanr.addEventListener('focus', function(){
        reglaPstoRojo();
    });
    listanr.addEventListener('blur', function(){
        reglaPstoRojo();
    });
});