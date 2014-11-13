// function to calculate local time
// in a different city
// given the city's UTC offset
   var messageSent;
   var messageReturned;
   	var cadena;
	var hora;
	var minutos;
	var horaFinal;
	var minutosFinal;
	var minutosStr;
	var turno;
	var WithZero;
function calcTime(city, offset) {
    // create Date object for current location
    d = new Date();
    // convert to msec
    // add local time zone offset
    // get UTC time in msec
    utc = d.getTime() + (d.getTimezoneOffset() * 60000);
    // create new Date object for different city
    // using supplied offset
    nd = new Date(utc + (3600000*offset));
	hora=nd.getHours();
	minutos=nd.getMinutes();
	minutosStr=minutos;
	if(hora>12){
		horaFinal=hora-12;
		turno="PM";
	}
	else{
		horaFinal=hora;
		turno="AM";
	}
	if(horaFinal<10){
		WithZero="0";
	}
	else{
		WithZero="";
	}
	if(minutos<10){
		minutosFinal="0" + minutosStr;
	}
	else{
		minutosFinal=minutosStr;
	}
    // return time as a string
    cadena=WithZero+horaFinal + ":" + minutosFinal + " " + turno;
    postMessage(cadena);
    return cadena;
}

// function startTime() {
    // var today=new Date();
    // var h=today.getHours();
    // var m=today.getMinutes();
    // var s=today.getSeconds();
    // m = checkTime(m);
    // s = checkTime(s);
    // document.getElementById('txt').innerHTML = h+":"+m+":"+s;
    // var t = setTimeout(function(){startTime()},500);
// }

function messageHandler(event) {
   // Accede a los datos del mensaje enviado por la página principal
   messageSent=event.data;
   // Prepara el mensaje que se va a devolver
   messageReturned=calcTime('','-4.5');
   // Publica el mensaje de vuelta en la página principal
   this.postMessage(messageReturned);
   setInterval("calcTime('','-4.5')",1000);
}

// Declara la function de callback que se ejecutará cuando la página principal nos haga una llamada
this.addEventListener('message', messageHandler, false); 
