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

function confirmar(enlace,pregunta){
	if(confirm(pregunta)){
		location.href=enlace;
	} 
}

function abreSitio(valselect){
	var URL = "http://";
	var web = document.getElementById(valselect).value;
	location.href=web;
}

function nuevoAjax(){
	var xmlhttp=false;
	try{
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
	} 
	catch(e){
		try{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp=false;
		}
	}
	if(!xmlhttp && typeof XMLHttpRequest!='undefined'){
		xmlhttp=new XMLHttpRequest();
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

	function mostrar(id){
		if (!document.getElementById) return false;
		fila = document.getElementById(id);
		fila.style.display = ""; //mostrar fila 	
	}

	function ocultar(id){
		if (!document.getElementById) return false;
		fila = document.getElementById(id);
		fila.style.display = "none";
	}
	
	function tecla(e){
		if(window.event)keyCode=window.event.keyCode;
		else if(e) keyCode=e.which;
		
		return keyCode;
	}	
	
	function sleep(milliseconds) {
	  var start = new Date().getTime();
	  for (var i = 0; i < 1e7; i++) {
	    if ((new Date().getTime() - start) > milliseconds){
	      break;
	    }
	  }
	}

	function chkclock(contenedor){
		var content;
		content=document.getElementById(contenedor);
		ajaxmostrarp=nuevoAjax();
		ajaxmostrarp.open("POST","mods/socket.php",true);
		ajaxmostrarp.onreadystatechange=function() {
			if (ajaxmostrarp.readyState==4) {
				cadena=ajaxmostrarp.responseText;
				cadena=cadena.replace(/\s*[\r\n][\r\n \t]*/g, "");
				content.innerHTML=cadena;
				clearInterval(reloj);
				reloj=setInterval(function(){chkclock("HoraCine")},5000);
		 	}
		}
		ajaxmostrarp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajaxmostrarp.send("mostrarhora=true");
	}

	function chkpeliculas(){
		var arrids;
		var i;
		arrids=new Array();
		ajaxmostrarp=nuevoAjax();
		ajaxmostrarp.open("POST","mods/socket.php",true);
		ajaxmostrarp.onreadystatechange=function() {
			if (ajaxmostrarp.readyState==4) {
				cadena=ajaxmostrarp.responseText;
				cadena=cadena.replace(/\s*[\r\n][\r\n \t]*/g, "");
				arrids=cadena.split(",");
				//alert(arrids);
				for(i=0;i<=(arrids.length-1);i++){
					mostrar(arrids[i]);
				}
		 	}
		}
		ajaxmostrarp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajaxmostrarp.send("chekarpeliculas=true");
	}
	
	function bloq_num(e){
		teclap=tecla(e);
		teclan=chr(teclap);
		if(IsNumeric(teclan)==false){
			alert("Solo está peritido escribir numeros");
		}
	}
	
	function borrar_texto(contendorid){
		var contenedorw=document.getElementById(contendorid);
		
		contenedorw.value='';
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
	
	function removAttr(id,attr){
		document.getElementById(id).removeAttribute(attr);
	}
