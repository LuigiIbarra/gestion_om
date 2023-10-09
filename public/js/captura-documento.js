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
        			var nd   = respuesta.nd;
        			var fol  = respuesta.folio;
        			var error=""; 
                    error+="<label><font style='color: red;'>*El Número de Documento "+nd+" YA fue capturado, con el Folio "+fol+", verifique.<font style='color: red;'></label><br/>"
                    document.querySelector('#validaDocumento').innerHTML = error;
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

//REGLAS DE SEMÁFORO ROJO
    //POR PUESTO
    function reglaPstoRojo(){
        var pstoDoc    = document.querySelector('#puesto_remitente').value;
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
            $("#semaforo option[value='2']").attr("selected", false);
            $("#semaforo option[value='3']").attr("selected", false);
            $("#semaforo option[value='1']").attr("selected", true);
            $('#semaforo').attr("style", 'border-width: 5px; border-color:red;');
        } else {
            $("#semaforo option[value='1']").attr("selected", false);
            $("#semaforo option[value='2']").attr("selected", false);
            $("#semaforo option[value='3']").attr("selected", false);
            $('#semaforo').attr("style", 'border-width: 1px; border-color:gray-light;');
        }
    }

    //POR PRIORIDAD URGENTE
    function reglaPriorRojo() {
        var priorDoc   = document.querySelector('#prioridad_documento').value;
        if (priorDoc == 4) {
            $("#semaforo option[value='1']").attr("selected", true);
            $("#semaforo option[value='2']").attr("selected", false);
            $("#semaforo option[value='3']").attr("selected", false);
            $('#semaforo').attr("style", 'border-width: 5px; border-color:red;');
        } else {
            $("#semaforo option[value='1']").attr("selected", false);
            $("#semaforo option[value='2']").attr("selected", false);
            $("#semaforo option[value='3']").attr("selected", false);
            $('#semaforo').attr("style", 'border-width: 1px; border-color:gray-light;');
        }
    }

    //POR FECHA DE TÉRMINO
    function reglaTermRojo() {
        var fecterDoc  = document.querySelector('#fecha_termino').value;
        if (fecterDoc != '') {
            $("#semaforo option[value='1']").attr("selected", true);
            $("#semaforo option[value='2']").attr("selected", false);
            $("#semaforo option[value='3']").attr("selected", false);
            $('#semaforo').attr("style", 'border-width: 5px; border-color:red;');
        } else {
            $("#semaforo option[value='1']").attr("selected", false);
            $("#semaforo option[value='2']").attr("selected", false);
            $("#semaforo option[value='3']").attr("selected", false);
            $('#semaforo').attr("style", 'border-width: 1px; border-color:gray-light;');
        }
    }

//REGLAS DE SEMÁFORO VERDE
    //POR TIPO DE DOCTO: ACUERDO PL / ACUERDO VAR /  ACUERDO FÍSICO
    function reglaTipoDocVerde(){
        var tipoDocId  = document.querySelector('#tipo_documento').value;
        if (tipoDocId == 1 || tipoDocId == 2 || tipoDocId == 9) {   
            $("#semaforo option[value='2']").attr("selected", true);
            $("#semaforo option[value='1']").attr("selected", false);
            $("#semaforo option[value='3']").attr("selected", false);
            $('#semaforo').attr("style", 'border-width: 5px; border-color:green;');
        } else {
            $("#semaforo option[value='1']").attr("selected", false);
            $("#semaforo option[value='2']").attr("selected", false);
            $("#semaforo option[value='3']").attr("selected", false);
            $('#semaforo').attr("style", 'border-width: 1px; border-color:gray-light;');
        }
    }

//REGLAS DE SEMÁFORO AMARILLO
    //POR ESTATUS CONCLUIDO
    function reglaStatAmarillo(){
        var statusDoc  = document.querySelector('#estatus_documento').value;
        if (statusDoc == 3) {    
            $("#semaforo option[value='3']").attr("selected", true);
            $("#semaforo option[value='1']").attr("selected", false);
            $("#semaforo option[value='2']").attr("selected", false);
            $('#semaforo').attr("style", 'border-width: 5px; border-color:yellow;');
        } else {
            $("#semaforo option[value='1']").attr("selected", false);
            $("#semaforo option[value='2']").attr("selected", false);
            $("#semaforo option[value='3']").attr("selected", false);
            $('#semaforo').attr("style", 'border-width: 1px; border-color:gray-light;');
        }
    }

//TAMBIÉN SE PERMITE SELECCIONAR DIRECTAMENTE EL COLOR DEL SEMÁFORO
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

	var numDocto   = document.querySelector('#numero_documento');
    var semaforo   = document.querySelector('#semaforo');
    var remite     = document.querySelector('#listanr');
    var pstoDoc    = document.querySelector('#puesto_remitente');
    var priorDoc   = document.querySelector('#prioridad_documento');
    var fecterDoc  = document.querySelector('#fecha_termino');
    var tipoDocId  = document.querySelector('#tipo_documento');
    var statusDoc  = document.querySelector('#estatus_documento');
    
    numDocto.addEventListener('change', function(){
    	buscaDocDuplicado();
    });

    semaforo.addEventListener('change', function(){
        cambiaColor();
    });

//REGLAS DE SEMÁFORO ROJO
    //POR PUESTO 
    remite.addEventListener('change', function(){
        reglaPstoRojo();
    });
    /*
    pstoDoc.addEventListener('change', function(){
        reglaPstoRojo();
    });
    */
    //POR PRIORIDAD URGENTE
    priorDoc.addEventListener('change', function(){
        reglaPriorRojo();
    });
    //POR FECHA DE TÉRMINO
    fecterDoc.addEventListener('change', function(){
        reglaTermRojo();
    });
//REGLAS DE SEMÁFORO VERDE
    //POR TIPO DE DOCTO: ACUERDO PL / ACUERDO VAR /  ACUERDO FÍSICO
    tipoDocId.addEventListener('change', function(){
        reglaTipoDocVerde();
    });
//REGLAS DE SEMÁFORO AMARILLO
    //POR ESTATUS CONCLUIDO
    statusDoc.addEventListener('change', function(){
        reglaStatAmarillo()
    });
});