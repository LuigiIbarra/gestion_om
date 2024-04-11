'use strict'

window.addEventListener('load', function(){

    function buscaFolioRelacionado(){
    	$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
        	type: 'POST',
        	url: '/buscaFolioRelacionado',
        	data: {
        		fr: $('#folio_relacionado').val(),
        	},
        	success: function (respuesta) {
        		console.log(respuesta);
        		if(respuesta.exito == 1){
                    if($('#newFolioRel').val()==1){
                        document.querySelector('#fr_recep_docto').value = respuesta.fec_recep;
                        document.querySelector('#fr_num_docto').value = respuesta.num_docto;
                        document.querySelector('#fr_fec_docto').value = respuesta.fec_docto;
                        document.querySelector('#fr_tip_docto').value = respuesta.tip_docto;
                        document.querySelector('#fr_tip_anexo').value = respuesta.tip_anexo;
                        document.querySelector('#fr_nomb_remitte').value = respuesta.nom_remtte;
                        document.querySelector('#fr_psto_remitte').value = respuesta.psto_remtte;
                        document.querySelector('#fr_area_remitte').value = respuesta.adsc_remtte;
                    }
        			var error=""; 
                    document.querySelector('#validaFolioRel').innerHTML = "";
        		}else{
                    if($('#newFolioRel').val()==1){
                        document.querySelector('#fr_recep_docto').value = "";
                        document.querySelector('#fr_num_docto').value = "";
                        document.querySelector('#fr_fec_docto').value = "";
                        document.querySelector('#fr_tip_docto').value = "";
                        document.querySelector('#fr_tip_anexo').value = "";
                        document.querySelector('#fr_nomb_remitte').value = "";
                        document.querySelector('#fr_psto_remitte').value = "";
                        document.querySelector('#fr_area_remitte').value = "";
                    }
                    var error=""; 
                    error+="<label><font style='color: red;'>*No se encontraron resultados con este Folio.<font style='color: red;'></label><br/>"
        			document.querySelector('#validaFolioRel').innerHTML = error;
                    return false;
        		}
        	},
        	error: function (jqXHR, textStatus, errorThrown) {
        		alert('Ocurrio un errror, intente de nuevo.' + jqXHR.responseText );
        	}
        });
    }

	var foliorel = document.querySelector('#folio_relacionado');
    
    foliorel.addEventListener('change', function(){
    	buscaFolioRelacionado();
    });
    
});