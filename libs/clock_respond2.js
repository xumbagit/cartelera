// function to calculate local time
// in a different city
// given the city's UTC offset
   var messageSent;
   var messageReturned;
   	var cadena;
function reiniciar(){
	postMessage("SI");
}

function messageHandler(event) {
   // Accede a los datos del mensaje enviado por la página principal
   messageSent=event.data;
   // Prepara el mensaje que se va a devolver
   //messageReturned=calcTime('','-4.5');
   // Publica el mensaje de vuelta en la página principal
   //this.postMessage(messageReturned);
   setInterval("reiniciar()",3600000);
}

// Declara la function de callback que se ejecutará cuando la página principal nos haga una llamada
this.addEventListener('message', messageHandler, false); 
