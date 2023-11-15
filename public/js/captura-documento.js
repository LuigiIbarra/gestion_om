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
            var valores = /^[\ba-zA-ZñÑáéíóúÁÉÍÓÚ-\s]$/;
    if (valores.test(caracter)) return true;
            return false;
}

function textnumber(e){
    var code;

    if (!e) var e = window.event;
      if (e.keyCode)
        code = e.keyCode;
    else
        if (e.which)
            code = e.which;
        if(code == 37 || code == 39) return true;
       
            var caracter = String.fromCharCode(code);
            var valores = /^[\ba-zA-ZñÑáéíóúÁÉÍÓÚ-b0123456789-\s]$/;
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
    //POR PRIORIDAD URGENTE
    function reglaPriorRojo() {
        var priorDoc   = document.querySelector('#prioridad_documento').value;
        if (priorDoc == 4) {
            $("#semaforo option[value='']").attr("selected", false);
            $("#semaforo option[value='2']").attr("selected", false);
            $("#semaforo option[value='3']").attr("selected", false);
            $("#semaforo option[value='1']").attr("selected", true);
            $('#semaforo').attr("style", 'border-width: 5px; border-color:red;');
        } else {
            if (document.querySelector('#semaforoRojo').value==0) {
                $("#semaforo option[value='1']").attr("selected", false);
                $("#semaforo option[value='2']").attr("selected", false);
                $("#semaforo option[value='3']").attr("selected", false);
                $("#semaforo option[value='']").attr("selected", true);
                $('#semaforo').attr("style", 'border-width: 1px; border-color:gray-light;');
            }
        }
    }

    //POR FECHA DE TÉRMINO
    function reglaTermRojo() {
        var fecterDoc  = document.querySelector('#fecha_termino').value;
        if (fecterDoc != '') {
            $("#semaforo option[value='']").attr("selected", false);
            $("#semaforo option[value='2']").attr("selected", false);
            $("#semaforo option[value='3']").attr("selected", false);
            $("#semaforo option[value='1']").attr("selected", true);
            $('#semaforo').attr("style", 'border-width: 5px; border-color:red;');
        } else {
            if (document.querySelector('#semaforoRojo').value==0) {
                $("#semaforo option[value='1']").attr("selected", false);
                $("#semaforo option[value='2']").attr("selected", false);
                $("#semaforo option[value='3']").attr("selected", false);
                $("#semaforo option[value='']").attr("selected", true);
                $('#semaforo').attr("style", 'border-width: 1px; border-color:gray-light;');
            }
        }
    }

//REGLAS DE SEMÁFORO VERDE
    //POR TIPO DE DOCTO: ACUERDO PL / ACUERDO VAR /  ACUERDO FÍSICO
    function reglaTipoDocVerde(){
        var tipoDocId  = document.querySelector('#tipo_documento').value;
        if (tipoDocId == 1 || tipoDocId == 2 || tipoDocId == 9) {
            $("#semaforo option[value='']").attr("selected", false);
            $("#semaforo option[value='1']").attr("selected", false);
            $("#semaforo option[value='3']").attr("selected", false);
            $("#semaforo option[value='2']").attr("selected", true);
            $('#semaforo').attr("style", 'border-width: 5px; border-color:green;');
        } else {
            if (document.querySelector('#semaforoRojo').value==0) {
                $("#semaforo option[value='1']").attr("selected", false);
                $("#semaforo option[value='2']").attr("selected", false);
                $("#semaforo option[value='3']").attr("selected", false);
                $("#semaforo option[value='']").attr("selected", true);
                $('#semaforo').attr("style", 'border-width: 1px; border-color:gray-light;');
            }
        }
    }

//REGLAS DE SEMÁFORO AMARILLO
    //POR ESTATUS CONCLUIDO
    function reglaStatAmarillo(){
        var statusDoc  = document.querySelector('#estatus_documento').value;
        if (statusDoc == 3) {
            $("#semaforo option[value='']").attr("selected", false);
            $("#semaforo option[value='1']").attr("selected", false);
            $("#semaforo option[value='2']").attr("selected", false);
            $("#semaforo option[value='3']").attr("selected", true);
            $('#semaforo').attr("style", 'border-width: 5px; border-color:yellow;');
        } else {
            if (document.querySelector('#semaforoRojo').value==0) {
                $("#semaforo option[value='1']").attr("selected", false);
                $("#semaforo option[value='2']").attr("selected", false);
                $("#semaforo option[value='3']").attr("selected", false);
                $("#semaforo option[value='']").attr("selected", true);
                $('#semaforo').attr("style", 'border-width: 1px; border-color:gray-light;');
            }
        }
    }

//TAMBIÉN SE PERMITE SELECCIONAR DIRECTAMENTE EL COLOR DEL SEMÁFORO
    function cambiaColor(){
        var option = document.querySelector('#semaforo');
        if (option.value == 1){
            $('#semaforo').attr("style", 'border-width: 5px; border-color:red;');
            $('#semaforoRojo').val('1');
        }
        if (option.value == 2){
            $('#semaforo').attr("style", 'border-width: 5px; border-color:green;');
            $('#semaforoRojo').val('0');
        }
        if (option.value == 3){
            $('#semaforo').attr("style", 'border-width: 5px; border-color:yellow;');
            $('#semaforoRojo').val('0');
        }
        if (option.value == null || option.value < 1 || option.value > 3){
            $('#semaforo').attr("style", 'border-width: 1px; border-color:gray-light;');
            $('#semaforoRojo').val('0');
        }
    }

    function muestraOtroNombre(){
        $('#divotronombre').toggle();
    }

    function cambiaRequeridos(){
        if( $('#markOtro').prop('checked') ) {
        //QUITA REQUERIDO DE LOS CAMPOS DE CAPTURA NORMAL    
            $('#nombre_remitente').removeAttr('required');
            $('#listanr').removeAttr('required');
            $('#puesto_remitente').removeAttr('required');
            $('#area_remitente').removeAttr('required');
        //PONE REQUERIDO DE LOS CAMPOS PARA NUEVO PERSONAL
            $('#nuevo_nombre').prop('required',true);
            $('#otro_paterno').prop('required',true);
            $('#otro_materno').prop('required',true);
            $('#otro_nvo_puesto').prop('required',true);
            $('#otra_nva_adscripcion').prop('required',true);
        } else {
        //PONE REQUERIDO DE LOS CAMPOS DE CAPTURA NORMAL
            $('#nombre_remitente').prop('required',true);
            $('#listanr').prop('required',true);
            $('#puesto_remitente').prop('required',true);
            $('#area_remitente').prop('required',true);
        //QUITA REQUERIDO DE LOS CAMPOS PARA NUEVO PERSONAL
            $('#nuevo_nombre').removeAttr('required');
            $('#otro_paterno').removeAttr('required');
            $('#otro_materno').removeAttr('required');
            $('#otro_nvo_puesto').removeAttr('required');
            $('#otra_desc_puesto').removeAttr('required');
            $('#otra_nva_adscripcion').removeAttr('required');
            $('#otra_desc_adsc').removeAttr('required');
            $('#nvo_tipo_adscripcion').removeAttr('required');
        }
    }

    function cambiaPstoReq(){
        if (document.querySelector('#otro_nvo_puesto').value=="") {
            $('#otro_nvo_puesto').removeAttr('required');
            $('#otra_desc_puesto').prop('required',true);
        } else {
            $('#otro_nvo_puesto').prop('required',true);
            $('#otra_desc_puesto').removeAttr('required');
        }
    }

    function cambiaAreaReq(){
         if (document.querySelector('#otra_nva_adscripcion').value=="") {
            $('#otra_nva_adscripcion').removeAttr('required');
            $('#otra_desc_adsc').prop('required',true);
            $('#nvo_tipo_adscripcion').prop('required',true);
         } else {
            $('#otra_nva_adscripcion').prop('required',true);
            $('#otra_desc_adsc').removeAttr('required');
            $('#nvo_tipo_adscripcion').removeAttr('required');
         }
    }

    function cambiaNewPstoReq(){
        if (document.querySelector('#otra_desc_puesto').value!="") {
            $('#otro_nvo_puesto').removeAttr('required');
            $('#otra_desc_puesto').prop('required',true);
        } else {
            $('#otro_nvo_puesto').prop('required',true);
            $('#otra_desc_puesto').removeAttr('required');
        }
    }

    function cambiaNewAreaReq(){
         if (document.querySelector('#otra_desc_adsc').value!="") {
            $('#otra_nva_adscripcion').removeAttr('required');
            $('#otra_desc_adsc').prop('required',true);
            $('#nvo_tipo_adscripcion').prop('required',true);
         } else {
            $('#otra_nva_adscripcion').prop('required',true);
            $('#otra_desc_adsc').removeAttr('required');
            $('#nvo_tipo_adscripcion').removeAttr('required');
         }
    }

	var numDocto   = document.querySelector('#numero_documento');
    var semaforo   = document.querySelector('#semaforo');
    var pstoDoc    = document.querySelector('#puesto_remitente');
    var priorDoc   = document.querySelector('#prioridad_documento');
    var fecterDoc  = document.querySelector('#fecha_termino');
    var tipoDocId  = document.querySelector('#tipo_documento');
    var statusDoc  = document.querySelector('#estatus_documento');
    var markOtro   = document.querySelector('#markOtro');
    var newPsto    = document.querySelector('#otro_nvo_puesto');
    var otroNewPsto= document.querySelector('#otra_desc_puesto');
    var newArea    = document.querySelector('#otra_nva_adscripcion');
    var otraNewArea= document.querySelector('#otra_desc_adsc');
    
    numDocto.addEventListener('change', function(){
    	buscaDocDuplicado();
    });

    semaforo.addEventListener('change', function(){
        cambiaColor();
    });

//REGLAS DE SEMÁFORO ROJO
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
//APARECE Y DESAPARECE SECCIÓN OTRO NOMBRE (divotronombre)
    markOtro.addEventListener('click', function(){
        muestraOtroNombre();
        cambiaRequeridos();
    });
    newPsto.addEventListener('change', function(){
        cambiaPstoReq();
    });
    newArea.addEventListener('change', function(){
        cambiaAreaReq();
    });
    otroNewPsto.addEventListener('change', function(){
        cambiaNewPstoReq();
    });
    otraNewArea.addEventListener('change', function(){
        cambiaNewAreaReq();
    });
});