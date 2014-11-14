function nuevoAjax_act(){
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

function actualizar_cuadros2(){
	// Publica el mensaje de vuelta en la página principal
	ajaxmostrarpact=nuevoAjax_act();
	ajaxmostrarpact.open("POST","../mods/socket.php",true);
	ajaxmostrarpact.onreadystatechange=function() {
		if (ajaxmostrarpact.readyState==4) {
			cadena=ajaxmostrarpact.responseText;
			//cadena=cadena.replace(/\s*[\r\n][\r\n \t]*/g, "");
			postMessage(cadena);
	 	}
	}
	ajaxmostrarpact.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajaxmostrarpact.send("actualizarcuadros=true");
}

function messageHandler(event) {
   // Accede a los datos del mensaje enviado por la página principal
   var messageSent;
   var cadena;
   messageSent=event.data;
   // Prepara el mensaje que se va a devolver
   var messageReturned;
	setInterval("actualizar_cuadros2()",15000);
}

// Declara la function de callback que se ejecutará cuando la página principal nos haga una llamada
this.addEventListener('message', messageHandler, false);