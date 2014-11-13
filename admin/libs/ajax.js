var caramo=1;
var idfilas=0;
var idfilasd=0;
var numcontroles=0;
var arrayajax;
var cajasdetexto;
var decoracion;
var formudeco;
var argumentosAjax;
var limitemenor;
var limitemenorse;
var numcontroles;
var numselect;
var cveces;
//Contadores para cada criterio
var numcontrolestjm;
var numcontrolespro;
var numcontrolesmemr;
var numcontrolessiso;
var numcontrolestjrv;
var numcontrolesmoni;
var numcontrolesdisd;
var numcontrolesunio;
var numcontrolesacce;
var numcontrolesimpr;

var cvecestjm;
var cvecespro;
var cvecesmemr;
var cvecessiso;
var cvecestjrv;
var cvecesmoni;
var cvecesdisd;
var cvecesunio;
var cvecesacce;
var cvecesimpr;

cvecestjm=0;
cvecespro=0;
cvecesmemr=0;
cvecessiso=0;
cvecestjrv=0;
cvecesmoni=0;
cvecesdisd=0;
cvecesunio=0;
cvecesacce=0;
cvecesimpr=0;

numcontrolestjm=0;
numcontrolespro=0;
numcontrolesmemr=0;
numcontrolessiso=0;
numcontrolestjrv=0;
numcontrolesmoni=0;
numcontrolesdisd=0;
numcontrolesunio=0;
numcontrolesacce=0;
numcontrolesimpr=0;
////////////////////////////
arrayajax=new Array();
arregloArgs=new Array();
argumentosAjax="";
cajasdetexto="";
decoracion="";
formudeco="";
numcontroles=1;
numselect=1;
limitemenor=0;
limitemenorse=0;
cveces=0;

function nuevoAjax(){
	var xmlhttp=false;
	 try {
	  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	 } catch (e) {
	  try {
	   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	  } catch (E) {
	   xmlhttp = false;
	  }
	 }

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
	  xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
	}

	function getVarURL(name){
		var regexS = "[\\?&]"+name+"=([^&#]*)";
		var regex = new RegExp ( regexS );
		var tmpURL = window.location.href;
		var results = regex.exec( tmpURL );
		
		if( results == null ){
			return"";	
		}
		else{
			return results[1];
		}
	}
	
	function cambiarDisplay(id) {
		  if (!document.getElementById) return false;
		  
		  fila = document.getElementById(id);
		  
		  if (fila.style.display != "none") {
		    fila.style.display = "none"; //ocultar fila 
		  } else {
		    fila.style.display = ""; //mostrar fila 
		  }
	}

	function gup(name){
		var regexS = "[\\?&]"+name+"=([^&#]*)";
		var regex = new RegExp ( regexS );
		var tmpURL = window.location.href;
		var results = regex.exec( tmpURL );
		
		if( results == null ){
			return"";	
		}
		else{
			return results[1];
		}
	}
	
	function calcular_fecha(mesid,anioid,contenedorid,textid){
		var ani;
		var mesa;
		var contenedor;
		var cadena;
		
		anio=document.getElementById(anioid);
		mesas=document.getElementById(mesid);
		ani=anio.value;
		mesa=mesas.value;		
		contenedor=document.getElementById(contenedorid);
		ajaxcalendarcalc=nuevoAjax();
		ajaxcalendarcalc.open("POST","mods/calendarioajax.php",true);
		ajaxcalendarcalc.onreadystatechange=function() {
			if (ajaxcalendarcalc.readyState==4){
				cadena=ajaxcalendarcalc.responseText;
				contenedor.innerHTML=cadena;
		 	}
		}
		ajaxcalendarcalc.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajaxcalendarcalc.send("calcularfecha=true&mescalc=" + mesa + "&aniocalc=" + ani + "&txtbox=" + textid);
	}
	
	function mostrar_evento(fecha){
		var contenedor=document.getElementById("contenedorfecha");
		var cadena;
		ajaxcalendareve=nuevoAjax();
		ajaxcalendareve.open("POST","mods/calendarioajax.php",true);
		ajaxcalendareve.onreadystatechange=function() {
			if (ajaxcalendareve.readyState==4){
				cadena=ajaxcalendareve.responseText;
				contenedor.innerHTML=cadena;
		 	}
		}
		ajaxcalendareve.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajaxcalendareve.send("calcularevento=true&fecha=" + fecha);
	}

	function mostrar_evento2(fecha){
		var contenedor=document.getElementById("contenedorfecha");
		var cadena;
		ajaxcalendareve2=nuevoAjax();
		ajaxcalendareve2.open("POST","mods/calendarioajax.php",true);
		ajaxcalendareve2.onreadystatechange=function() {
			if (ajaxcalendareve2.readyState==4){
				cadena=ajaxcalendareve2.responseText;
				contenedor.innerHTML=cadena;
		 	}
		}
		ajaxcalendareve2.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajaxcalendareve2.send("calcularevento=true&fecha=" + fecha);
	}
	
	function escribir_fecha(idtext,iddia,idmes,idanio){
		var contenedor=document.getElementById(idtext);
		var cadenafecha;
		
		cadenafecha=idanio + "-" + idmes + "-" + iddia;
		contenedor.value=cadenafecha;
	}
	
	function escribir_fecha_txt(desde,hasta){
		var desdetxt=document.getElementById(desde).value;
		var hastatxt=document.getElementById(hasta);
		
		hastatxt.value=desdetxt;		
	}
	
	function tecla(e){
		if(window.event)keyCode=window.event.keyCode;
		else if(e) keyCode=e.which;
		
		return keyCode;
	}	
	
	function ingresarprod(e,codigo,factura,cantidad){
		var txtbox=document.getElementById(codigo);
		var codigo=document.getElementById(codigo).value;
		var facturan=document.getElementById(factura).value;
		var txtcantidad=document.getElementById(cantidad).value;
		
		ajaxingreso=nuevoAjax();
		teclap=tecla(e);
		if(teclap==13){
			ajaxingreso.open("POST","mods/opciones.php",true);
			ajaxingreso.onreadystatechange=function() {
				if (ajaxingreso.readyState==4) {
					cadena=ajaxingreso.responseText;
					txtbox.value='';
					if(cadena!=''){
						alert(cadena);
					}
			 	}
			}
			
			ajaxingreso.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajaxingreso.send("ingresarprod=true&codigo="+codigo+"&factura="+facturan + "&cantidad="+txtcantidad);	
		}
	}
	
	function validarnombre(e,nombre){
		var txtbox=document.getElementById(nombre);
		var txtnombre=document.getElementById(nombre).value;
		
		ajaxrnombre=nuevoAjax();
		teclap=tecla(e);
		if(teclap==13){
			ajaxrnombre.open("POST","mods/opciones.php",true);
			ajaxrnombre.onreadystatechange=function() {
				if (ajaxrnombre.readyState==4) {
					cadena=ajaxrnombre.responseText;
					txtbox.value='';
					if(cadena!=''){
						alert(cadena);
					}
			 	}
			}
			
			ajaxrnombre.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajaxrnombre.send("revisarnombre=true&nombre="+txtnombre);	
		}
	}
	
	function actualizarlista(e,factura,contenedorid){
		var txtfactura=document.getElementById(factura).value;
		var contenedor=document.getElementById(contenedorid);
		var contenedortxt=document.getElementById('montocomp');
		
		ajaxrlista=nuevoAjax();
		teclap=tecla(e);
		if(teclap==13){
			ajaxrlista.open("POST","mods/opciones.php",true);
			ajaxrlista.onreadystatechange=function() {
				if (ajaxrlista.readyState==4) {
					cadena=ajaxrlista.responseText;
					contenedor.innerHTML=cadena;
			 	}
			}
			
			ajaxrlista.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajaxrlista.send("updatelist=true&idfactura="+txtfactura);
			
			ajaxrmonto.open("POST","modulos/opciones.php",true);
			ajaxrmonto.onreadystatechange=function() {
				if (ajaxrmonto.readyState==4) {
					cadena=ajaxrmonto.responseText;
					contenedortxt.value=cadena;
			 	}
			}
			
			ajaxrmonto.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajaxrmonto.send("updatemonto=true&idfactura="+txtfactura);
		}		
	}

	function bloq_num(e){
		teclap=tecla(e);
		teclan=chr(teclap);
		if(IsNumeric(teclan)==false){
			alert("Solo está peritido escribir numeros");
		}
	}

	function guardar_var(nomvar,content,idcontenedor){
		var txtcedula=document.getElementById(idcontenedor).value + " ";
		var contenedor=document.getElementById(idcontenedor);		
		ajaxguardar=nuevoAjax();
		ajaxguardar.open("POST","mods/opciones.php",true);
		ajaxguardar.onreadystatechange=function() {
			if(ajaxguardar.readyState==4){
				cadena=ajaxguardar.responseText;
				contenedor.innerHTML=cadena;
		 	}
		}
		
		ajaxguardar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajaxguardar.send("guardarvariable=true&contenido=" + txtcedula  + "&variable=" + nomvar);
	}
	function getval(id){
		var e;
		var strUser;
		e = document.getElementById(id);
		strUser = e.options[e.selectedIndex].value;
		return strUser; 
	}
	
	function agregarhorario(hora,minuto,turno,idtemp,idcontent,fecha,disponib,flag){
		var contenedor;
		var horatxt;
		var mintxt;
		var turnotxt;
		var sumarhoras;
		var fechafinal;
		var disponibdiv;
		//alert(disponib);
		disponibdiv=getval(disponib);
		
		if(flag=="AGREGAR"){
			if(fecha=="dia0"){
				fechafinal=document.getElementById(fecha).dataset.fechadiacero;
			}
			if(fecha=="dia1"){
				fechafinal=document.getElementById(fecha).dataset.fechadiauno;
			}
			if(fecha=="dia2"){
				fechafinal=document.getElementById(fecha).dataset.fechadiados;
			}
			if(fecha=="dia3"){
				fechafinal=document.getElementById(fecha).dataset.fechadiatres;
			}
			if(fecha=="dia4"){
				fechafinal=document.getElementById(fecha).dataset.fechadiacuatro;
			}
			if(fecha=="dia5"){
				fechafinal=document.getElementById(fecha).dataset.fechadiacinco;
			}
			if(fecha=="dia6"){
				fechafinal=document.getElementById(fecha).dataset.fechadiaseis;
			}
			if(fecha=="dia7"){
				fechafinal=document.getElementById(fecha).dataset.fechadiasiete;
			}
		}
		else if(flag=="MODIFICAR"){
			fechafinal=fecha;
			if(fecha=="dia0"){
				fechafinal=document.getElementById(fecha).dataset.fechadiacero;
			}
			if(fecha=="dia1"){
				fechafinal=document.getElementById(fecha).dataset.fechadiauno;
			}
			if(fecha=="dia2"){
				fechafinal=document.getElementById(fecha).dataset.fechadiados;
			}
			if(fecha=="dia3"){
				fechafinal=document.getElementById(fecha).dataset.fechadiatres;
			}
			if(fecha=="dia4"){
				fechafinal=document.getElementById(fecha).dataset.fechadiacuatro;
			}
			if(fecha=="dia5"){
				fechafinal=document.getElementById(fecha).dataset.fechadiacinco;
			}
			if(fecha=="dia6"){
				fechafinal=document.getElementById(fecha).dataset.fechadiaseis;
			}
			if(fecha=="dia7"){
				fechafinal=document.getElementById(fecha).dataset.fechadiasiete;
			}
		}
		else if(flag=="ELIMINAR"){
			fechafinal=fecha;
			if(fecha=="dia0"){
				fechafinal=document.getElementById(fecha).dataset.fechadiacero;
			}
			if(fecha=="dia1"){
				fechafinal=document.getElementById(fecha).dataset.fechadiauno;
			}
			if(fecha=="dia2"){
				fechafinal=document.getElementById(fecha).dataset.fechadiados;
			}
			if(fecha=="dia3"){
				fechafinal=document.getElementById(fecha).dataset.fechadiatres;
			}
			if(fecha=="dia4"){
				fechafinal=document.getElementById(fecha).dataset.fechadiacuatro;
			}
			if(fecha=="dia5"){
				fechafinal=document.getElementById(fecha).dataset.fechadiacinco;
			}
			if(fecha=="dia6"){
				fechafinal=document.getElementById(fecha).dataset.fechadiaseis;
			}
			if(fecha=="dia7"){
				fechafinal=document.getElementById(fecha).dataset.fechadiasiete;
			}
		}
		//alert(fechafinal+" "+fecha);
		contenedor=document.getElementById(idcontent);
		horatxt=getval(hora);
		mintxt=getval(minuto);
		turnotxt=getval(turno);
		ajaxrSocket=nuevoAjax();
		ajaxrSocket.open("POST","mods/socket.php",true);
		ajaxrSocket.onreadystatechange=function() {
		if (ajaxrSocket.readyState==4) {
				cadena=ajaxrSocket.responseText;
				contenedor.innerHTML=cadena;
		 	}
			else{
				contenedor.innerHTML="ESPERE...";
			}
		}
		ajaxrSocket.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajaxrSocket.send("agregarhorario=true&hora="+horatxt+"&minutos="+mintxt+"&turno="+turnotxt+"&idtemp="+idtemp+"&fecha="+fechafinal+"&flag="+flag+"&idcontent="+idcontent + "&disponibilidad="+disponibdiv);
	}
	