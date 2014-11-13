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

function elimhor(){
	var cadena;
   // Publica el mensaje de vuelta en la página principal
	ajaxmostrarp=nuevoAjax();
	ajaxmostrarp.open("POST","../mods/socket.php",true);
	ajaxmostrarp.onreadystatechange=function() {
		if (ajaxmostrarp.readyState==4){
			cadena=ajaxmostrarp.responseText;
			postMessage(cadena);
	 	}
	}
	ajaxmostrarp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajaxmostrarp.send("eliminarhorarios=true");
}

function messageHandler(event) {
   // Accede a los datos del mensaje enviado por la página principal
   var messageSent;
   var cadena;
   messageSent=event.data;
   // Prepara el mensaje que se va a devolver
   var messageReturned;
	setInterval("elimhor()",6500);
}

// Declara la function de callback que se ejecutará cuando la página principal nos haga una llamada
this.addEventListener('message', messageHandler, false);