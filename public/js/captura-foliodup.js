'use strict'

function numberonly(e){
    var code;

    if (!e) var e = window.event;
      if (e.keyCode)
        code = e.keyCode;
    else
        if (e.which)
            code = e.which;
        if(code == 37 || code == 39) return true;
            var caracter = String.fromCharCode(code);
            var valores = /^[\b0123456789\s]$/
    if (valores.test(caracter)) return true;
            return false;
}

window.addEventListener('load', function(){

	function buscaFolioDuplicado(){
    	$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
        	type: 'POST',
        	url: '/buscaFolioDuplicado',
        	data: {
        		fd: $('#folio_documento').val(),
        	},
        	success: function (respuesta) {
        		console.log(respuesta);
        		if(respuesta.exito == 1){
        			var fd   = respuesta.fd;
        			var error=""; 
                    error+="<label><font style='color: red;'>*El Número de Folio "+fd+" YA fue capturado, verifique.<font style='color: red;'></label><br/>"
                    $('#newFolioDup').val('1');
                    document.querySelector('#validaFolioDup').innerHTML = error;
                    return false;
        		}else{
        			$('#newFolioDup').val('0');
        			document.querySelector('#validaFolioDup').innerHTML = "";
        		}
        	},
        	error: function (jqXHR, textStatus, errorThrown) {
        		alert('Ocurrio un errror, intente de nuevo.' + jqXHR.responseText );
        	}
        });
    }

//REGRESAR FOCO AL CAMPO NÚMERO DE FOLIO
    function registraFolioValido(){
		var fd  = document.querySelector('#newFolioDup').value;
	    var fol = document.querySelector('#folio_documento');
	    var fec = document.querySelector('#recepcion_documento');
	//Si el Folio está duplicado, regresar el foco al campo Número de Folio
	    if(fd == 1){
	        $(fol).focus();
	        $(fol).select();
	    }else if(fd == 0){
	//De lo contrario, avanzar al campo Fecha de Recepción
	        $(fec).focus();
	        $(fec).select();
	    }
    }
    

	var numFolio = document.querySelector('#folio_documento');
    
    numFolio.addEventListener('change', function(){
    	buscaFolioDuplicado();
    });
    numFolio.addEventListener('blur', function(){
    	registraFolioValido();
    });
});