'use strict'

window.addEventListener('load', function(){

	function muestraPersonaConocimiento() {
		var areaRemId  = document.querySelector('#area_remitente').value;
		var estatusId = document.querySelector('#estatus_documento').value;
		//estatusId ==  3 Conocimiento
		//areaRemId == 15 Dirección Ejecutiva de Recursos Humanos
		if (estatusId == 3 && areaRemId == 15) {
			$('#divdestinatariocc').show();
			$('#divdestinatn').hide();
			$('#divdestinconoc').hide();
		} else if (estatusId == 3 && areaRemId != 15) {
			$('#divdestinatariocc').show();
			$('#divdestinatn').hide();
			$('#divdestinconoc').hide();
		} else if (estatusId != 3 && areaRemId == 15) {
			$('#divdestinatariocc').hide();
			$('#divdestinatn').hide();
			$('#divdestinconoc').hide();
		} else if (estatusId != 3 && areaRemId != 15) {
			$('#divdestinatariocc').hide();
			$('#divdestinatn').show();
			$('#divdestinconoc').show();
		}
	}
	function muestraRH() {
		var areaRemId  = document.querySelector('#area_remitente').value;
		var estatusId  = document.querySelector('#estatus_documento').value;
		//estatusId ==  3 Conocimiento
		//areaRemId == 15 Dirección Ejecutiva de Recursos Humanos
		if (areaRemId == 15 && estatusId == 3) {
			$('#divdestinatariocc').show();
			$('#divdestinatn').hide();
			$('#divdestinconoc').hide();
		} else if (areaRemId == 15 && estatusId != 3) {
				$('#divdestinatariocc').hide();
				$('#divdestinatn').hide();
				$('#divdestinconoc').hide();
		} else if (areaRemId != 15 && estatusId == 3) {
				$('#divdestinatariocc').show();
				$('#divdestinatn').hide();
				$('#divdestinconoc').hide();
		} else if (areaRemId != 15 && estatusId != 3) {
				$('#divdestinatariocc').hide();
				$('#divdestinatn').show();
				$('#divdestinconoc').show();
		}
	}

	var areaRemite = document.querySelector('#area_remitente');
	var areaRemId  = document.querySelector('#area_remitente').value;
	var estatusDoc = document.querySelector("#estatus_documento");
	var estatusId  = document.querySelector('#estatus_documento').value;
	//estatusId ==  3 Conocimiento
	//areaRemId == 15 Dirección Ejecutiva de Recursos Humanos
	if (estatusId == 3 && areaRemId == 15) {
		$('#divdestinatariocc').show();
		$('#divdestinatn').hide();
		$('#divdestinconoc').hide();
	} else if (estatusId == 3 && areaRemId != 15) {
		$('#divdestinatariocc').show();
		$('#divdestinatn').hide();
		$('#divdestinconoc').hide();
	} else if (estatusId != 3 && areaRemId == 15) {
		$('#divdestinatariocc').hide();
		$('#divdestinatn').hide();
		$('#divdestinconoc').hide();
	} else if (estatusId != 3 && areaRemId != 15) {
		$('#divdestinatariocc').hide();
		$('#divdestinatn').show();
		$('#divdestinconoc').show();
	}

	estatusDoc.addEventListener('change', function(){        
        muestraPersonaConocimiento();
    });
    areaRemite.addEventListener('change', function(){        
        muestraRH();
    });
});