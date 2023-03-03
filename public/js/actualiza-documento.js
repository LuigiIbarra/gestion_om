'use strict'

window.addEventListener('load', function(){

	var tipoDocId  = document.querySelector('#tipo_documento').value;
	var editaDoc   = document.querySelector('#editaDocto').value;

	if(tipoDocId == 7 && editaDoc == 1){
		tipo_documento[1].style.display="none";
		tipo_documento[2].style.display="none";
		tipo_documento[3].style.display="none";
		tipo_documento[4].style.display="none";
		tipo_documento[5].style.display="none";
		tipo_documento[6].style.display="none";
		tipo_documento[7].style.display="block";
		tipo_documento[8].style.display="none";
	}else if(tipoDocId == 8 && editaDoc == 1){
		tipo_documento[1].style.display="none";
		tipo_documento[2].style.display="none";
		tipo_documento[3].style.display="none";
		tipo_documento[4].style.display="none";
		tipo_documento[5].style.display="none";
		tipo_documento[6].style.display="none";
		tipo_documento[7].style.display="none";
		tipo_documento[8].style.display="block";
	}else if(tipoDocId <= 6 && editaDoc == 1) {
		tipo_documento[1].style.display="block";
		tipo_documento[2].style.display="block";
		tipo_documento[3].style.display="block";
		tipo_documento[4].style.display="block";
		tipo_documento[5].style.display="block";
		tipo_documento[6].style.display="block";
		tipo_documento[7].style.display="none";
		tipo_documento[8].style.display="none";
	}

});