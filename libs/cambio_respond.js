var contador;
var i;
contador=0;

// function cambioCineTeatro(tiempo){
	// var cadena;
	// var cambio;
	// var tiempoSend;
// 	
	// if(tiempo!=''){
		// tiempoSend=tiempo;
	// }
	// postMessage(tiempoSend);
// }

function ContCartelera(){
	i = i + 1;
    postMessage(i);
}

function messageHandler(event) {
	var messageSent;
	var intnum;
	messageSent=event.data;
	//this.postMessage(messageSent);
	if(messageSent=="restart"){
		i=0;
	}
	clearInterval(intnum);
	intnum=setInterval("ContCartelera()",2000);
}
// Declara la function de callback que se ejecutará cuando la página principal nos haga una llamada
this.addEventListener('message', messageHandler, false);