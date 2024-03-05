'use strict'

window.addEventListener('load', function(){

	function cambiaSolicitudA(){
		var option = document.querySelector('#solicitud_a');
		if (option.value > 0) {
			$('#solicitud_de').val('0');
			$('#correspon_a').val('0');
		}
	}

	function cambiaSolicitudDe(){
		var option = document.querySelector('#solicitud_de');
		if (option.value > 0) {
			$('#solicitud_a').val('0');
			$('#correspon_a').val('0');
		}
	}

	function cambiaCorrespondA(){
		var option = document.querySelector('#correspon_a');
		if (option.value > 0) {
			$('#solicitud_a').val('0');
			$('#solicitud_de').val('0');
		}
	}
	
	var sol_a 	= document.querySelector('#solicitud_a');
	var sol_de 	= document.querySelector('#solicitud_de');
	var cor_a 	= document.querySelector('#correspon_a');

	sol_a.addEventListener('change', function(){
		cambiaSolicitudA();
	});
	sol_de.addEventListener('change', function(){
		cambiaSolicitudDe();
	});
	cor_a.addEventListener('change', function(){
		cambiaCorrespondA();
	});
});