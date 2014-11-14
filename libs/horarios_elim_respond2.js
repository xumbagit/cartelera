function nuevoAjax_ago(){
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

function agotadohor(){
	var cadena;
   // Publica el mensaje de vuelta en la página principal
	ajaxmostrarpAgo=nuevoAjax_ago();
	ajaxmostrarpAgo.open("POST","../mods/socket.php",true);
	ajaxmostrarpAgo.onreadystatechange=function() {
		if (ajaxmostrarpAgo.readyState==4){
			cadena=ajaxmostrarpAgo.responseText;
			postMessage(cadena);
	 	}
	}
	ajaxmostrarpAgo.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajaxmostrarpAgo.send("horariosagotados=true");
}

function messageHandler(event) {
   // Accede a los datos del mensaje enviado por la página principal
   var messageSent;
   var cadena;
   messageSent=event.data;
   // Prepara el mensaje que se va a devolver
   var messageReturned;
	setInterval("agotadohor()",17000);
}

// Declara la function de callback que se ejecutará cuando la página principal nos haga una llamada
this.addEventListener('message', messageHandler, false);
