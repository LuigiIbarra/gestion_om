'use strict'

window.addEventListener('load', function(){

	var tipoDocId  = document.querySelector('#tipo_documento').value;
	var editaDoc   = document.querySelector('#editaDocto').value;

	if((tipoDocId == 7 || tipoDocId == 8) && editaDoc == 1)
		$('#tipo_documento').attr("disabled", true);
	else if(tipoDocId <= 6 && editaDoc == 1) {
		$('#tipo_documento').attr("disabled", false);
		tipo_documento[7].style.display="none";
		tipo_documento[8].style.display="none";
	}

});