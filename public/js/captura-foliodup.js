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
		var fd  = document.querySelector('#newFolioDup').value;         //Check auxiliar: 1=folio duplicado,0=folio nuevo
	    var fol = document.querySelector('#folio_documento');           //Input text Folio
	    var fec = document.querySelector('#recepcion_documento');       //Input text Fecha de Recepción
        var nf  = fol.value.split('-');                                 //Arreglo para separar folio del resto: -23, -23CC, -23RH
        var fc  = str_pad(nf[0],5,'0','STR_PAD_LEFT')+'-'+nf[1];        //Completar a 5 dígitos con ceros a la izquierda
        console.log(fc);
        $('#folio_documento').val(fc);                                  //Volver a desplegar el folio a 5 dígitos con ceros a la izquierda.
        buscaFolioDuplicado();
	//Si el Folio está duplicado, regresar el foco al campo Número de Folio
	    if(fd == 1){
	        $(fol).focus();
	        $(fol).select();
            $(fol).val(fc);
	    }else if(fd == 0){
	//De lo contrario, avanzar al campo Fecha de Recepción
	        $(fec).focus();
	        $(fec).select();
	    }
    }
    
//FUNCIÓN AUXILIAR EQUIVALENTE A LA FUNCIÓN PHP str_pad
    function str_pad (input, padLength, padString, padType) { // eslint-disable-line camelcase
//  discuss at: https://locutus.io/php/str_pad/
// original by: Kevin van Zonneveld (https://kvz.io)
// improved by: Michael White (https://getsprink.com)
//    input by: Marco van Oort
// bugfixed by: Brett Zamir (https://brett-zamir.me)
//   example 1: str_pad('Kevin van Zonneveld', 30, '-=', 'STR_PAD_LEFT')
//   returns 1: '-=-=-=-=-=-Kevin van Zonneveld'
//   example 2: str_pad('Kevin van Zonneveld', 30, '-', 'STR_PAD_BOTH')
//   returns 2: '------Kevin van Zonneveld-----'
        let half = ''
        let padToGo
        const _strPadRepeater = function (s, len) {
            let collect = ''
            while (collect.length < len) {
                collect += s
            }
            collect = collect.substr(0, len)
            return collect
        }
        input += ''
        padString = padString !== undefined ? padString : ' '
        if (padType !== 'STR_PAD_LEFT' && padType !== 'STR_PAD_RIGHT' && padType !== 'STR_PAD_BOTH') {
            padType = 'STR_PAD_RIGHT'
        }
        if ((padToGo = padLength - input.length) > 0) {
            if (padType === 'STR_PAD_LEFT') {
                input = _strPadRepeater(padString, padToGo) + input
            } else if (padType === 'STR_PAD_RIGHT') {
                input = input + _strPadRepeater(padString, padToGo)
            } else if (padType === 'STR_PAD_BOTH') {
                half = _strPadRepeater(padString, Math.ceil(padToGo / 2))
                input = half + input + half
                input = input.substr(0, padLength)
            }
        }
        return input
    }

	var numFolio = document.querySelector('#folio_documento');
    
    numFolio.addEventListener('change', function(){
    	buscaFolioDuplicado();
    });
    numFolio.addEventListener('blur', function(){
    	registraFolioValido();
    });
});