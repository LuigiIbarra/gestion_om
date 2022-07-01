'use strict'

window.addEventListener('load', function(){

	function muestraPersonaConocimiento() {
		var estatusId = document.querySelector('#estatus_documento').value;
		if (estatusId == 3) {
			$('#divdestinatariocc').show();
		} else {
			$('#divdestinatariocc').hide();
		}
	}

	var estatusDoc = document.querySelector("#estatus_documento");
	var estatusId  = document.querySelector('#estatus_documento').value;
	if (estatusId == 3) {
		$('#divdestinatariocc').show();
	} else {
		$('#divdestinatariocc').hide();
	}
		
	estatusDoc.addEventListener('change', function(){        
        muestraPersonaConocimiento();
    });
});