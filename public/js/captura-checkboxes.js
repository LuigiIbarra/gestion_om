'use strict'

window.addEventListener('load', function(){

	function cambiaConoc2(){

		var atencion2 	= document.querySelector('#atencion2');
		var conoc2 		= document.querySelector('#conoc2');

		if (conoc2.checked == true){
			conoc2.checked = false;
		}
	}
	function cambiaAten2(){

		var atencion2  	= document.querySelector('#atencion2');
		var conoc2 		= document.querySelector('#conoc2');

		if (atencion2.checked == true){
			atencion2.checked = false;
		}
	}
	function cambiaConoc12(){

		var atencion12	= document.querySelector('#atencion12');
		var conoc12     = document.querySelector('#conoc12');

		if (conoc12.checked == true){
			conoc12.checked = false;
		}
	}
	function cambiaAten12(){

		var atencion12  = document.querySelector('#atencion12');
		var conoc12     = document.querySelector('#conoc12');

		if (atencion12.checked == true){
			atencion12.checked = false;
		}
	}
	function cambiaConoc14(){

		var atencion14	= document.querySelector('#atencion14');
		var conoc14     = document.querySelector('#conoc14');

		if (conoc14.checked == true){
			conoc14.checked = false;
		}
	}
	function cambiaAten14(){

		var atencion14  = document.querySelector('#atencion14');
		var conoc14     = document.querySelector('#conoc14');

		if (atencion14.checked == true){
			atencion14.checked = false;
		}
	}
	function cambiaConoc15(){

		var atencion15	= document.querySelector('#atencion15');
		var conoc15     = document.querySelector('#conoc15');

		if (conoc15.checked == true){
			conoc15.checked = false;
		}
	}
	function cambiaAten15(){

		var atencion15  = document.querySelector('#atencion15');
		var conoc15     = document.querySelector('#conoc15');

		if (atencion15.checked == true){
			atencion15.checked = false;
		}
	}
	function cambiaConoc16(){

		var atencion16	= document.querySelector('#atencion16');
		var conoc16     = document.querySelector('#conoc16');

		if (conoc16.checked == true){
			conoc16.checked = false;
		}
	}
	function cambiaAten16(){

		var atencion16  = document.querySelector('#atencion16');
		var conoc16     = document.querySelector('#conoc16');

		if (atencion16.checked == true){
			atencion16.checked = false;
		}
	}
	function cambiaConoc17(){

		var atencion17	= document.querySelector('#atencion17');
		var conoc17     = document.querySelector('#conoc17');

		if (conoc17.checked == true){
			conoc17.checked = false;
		}
	}
	function cambiaAten17(){

		var atencion17  = document.querySelector('#atencion17');
		var conoc17     = document.querySelector('#conoc17');

		if (atencion17.checked == true){
			atencion17.checked = false;
		}
	}
	function cambiaConoc18(){

		var atencion18	= document.querySelector('#atencion18');
		var conoc18     = document.querySelector('#conoc18');

		if (conoc18.checked == true){
			conoc18.checked = false;
		}
	}
	function cambiaAten18(){

		var atencion18  = document.querySelector('#atencion18');
		var conoc18     = document.querySelector('#conoc18');

		if (atencion18.checked == true){
			atencion18.checked = false;
		}
	}
	function cambiaConoc19(){

		var atencion19	= document.querySelector('#atencion19');
		var conoc19     = document.querySelector('#conoc19');

		if (conoc19.checked == true){
			conoc19.checked = false;
		}
	}
	function cambiaAten19(){

		var atencion19  = document.querySelector('#atencion19');
		var conoc19     = document.querySelector('#conoc19');

		if (atencion19.checked == true){
			atencion19.checked = false;
		}
	}
	function cambiaConoc20(){

		var atencion20	= document.querySelector('#atencion20');
		var conoc20     = document.querySelector('#conoc20');

		if (conoc20.checked == true){
			conoc20.checked = false;
		}
	}
	function cambiaAten20(){

		var atencion20  = document.querySelector('#atencion20');
		var conoc20     = document.querySelector('#conoc20');

		if (atencion20.checked == true){
			atencion20.checked = false;
		}
	}
	function cambiaConoc999(){

		var atencion999	= document.querySelector('#atencion999');
		var conoc999     = document.querySelector('#conoc999');

		if (conoc999.checked == true){
			conoc999.checked = false;
		}
	}
	function cambiaAten999(){

		var atencion999  = document.querySelector('#atencion999');
		var conoc1999    = document.querySelector('#conoc999');

		if (atencion999.checked == true){
			atencion999.checked = false;
		}
	}
	function cambiaAtenPresid(){
		var atenpresid   = document.querySelector('#atencion_presidente');
		var atenofmayor  = document.querySelector('#atencion_oficialmayor');

		if (atenofmayor.checked == true)
			atenofmayor.checked = false;
	}
	function cambiaAtenOfMayor(){
		var atenpresid   = document.querySelector('#atencion_presidente');
		var atenofmayor  = document.querySelector('#atencion_oficialmayor');

		if (atenpresid.checked == true)
			atenpresid.checked = false;
	}

	var atencion2   = document.querySelector('#atencion2');
	var conoc2      = document.querySelector('#conoc2');
	var atencion12  = document.querySelector('#atencion12');
	var conoc12     = document.querySelector('#conoc12');
	var atencion14 	= document.querySelector('#atencion14');
	var conoc14		= document.querySelector('#conoc14');
	var atencion15 	= document.querySelector('#atencion15');
	var conoc15		= document.querySelector('#conoc15');
	var atencion16 	= document.querySelector('#atencion16');
	var conoc16		= document.querySelector('#conoc16');
	var atencion17 	= document.querySelector('#atencion17');
	var conoc17		= document.querySelector('#conoc17');
	var atencion18 	= document.querySelector('#atencion18');
	var conoc18		= document.querySelector('#conoc18');
	var atencion19 	= document.querySelector('#atencion19');
	var conoc19		= document.querySelector('#conoc19');
	var atencion20 	= document.querySelector('#atencion20');
	var conoc20		= document.querySelector('#conoc20');
	var atencion999	= document.querySelector('#atencion999');
	var conoc1999	= document.querySelector('#conoc999');
	var atenpresid  = document.querySelector('#atencion_presidente');
	var atenofmayor = document.querySelector('#atencion_oficialmayor');
    
    atencion2.addEventListener('change', function(){
    	cambiaConoc2();
    });
    conoc2.addEventListener('change', function(){
    	cambiaAten2();
    });
    atencion12.addEventListener('change', function(){
    	cambiaConoc12();
    });
    conoc12.addEventListener('change', function(){
    	cambiaAten12();
    });
    atencion14.addEventListener('change', function(){
    	cambiaConoc14();
    });
    conoc14.addEventListener('change', function(){
    	cambiaAten14();
    });
    atencion15.addEventListener('change', function(){
    	cambiaConoc15();
    });
    conoc15.addEventListener('change', function(){
    	cambiaAten15();
    });
    atencion16.addEventListener('change', function(){
    	cambiaConoc16();
    });
    conoc16.addEventListener('change', function(){
    	cambiaAten16();
    });
    atencion17.addEventListener('change', function(){
    	cambiaConoc17();
    });
    conoc17.addEventListener('change', function(){
    	cambiaAten17();
    });
    atencion18.addEventListener('change', function(){
    	cambiaConoc18();
    });
    conoc18.addEventListener('change', function(){
    	cambiaAten18();
    });
    atencion19.addEventListener('change', function(){
    	cambiaConoc19();
    });
    conoc19.addEventListener('change', function(){
    	cambiaAten19();
    });
    atencion20.addEventListener('change', function(){
    	cambiaConoc20();
    });
    conoc20.addEventListener('change', function(){
    	cambiaAten20();
    });
    atencion999.addEventListener('change', function(){
    	cambiaConoc999();
    });
    conoc999.addEventListener('change', function(){
    	cambiaAten999();
    });
    atenpresid.addEventListener('change', function(){
    	cambiaAtenPresid();
    });
    atenofmayor.addEventListener('change', function(){
    	cambiaAtenOfMayor();
    });
});