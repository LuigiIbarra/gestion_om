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
    
    numDocto.addEventListener('change', function(){
    	buscaDocDuplicado();
    });

    semaforo.addEventListener('change', function(){
        cambiaColor();
    });
    
});