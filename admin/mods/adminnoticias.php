<script language="JavaScript" type="text/javascript">
	function abreSitio(valselect){
		var URL = "http://";
		var web = document.getElementById(valselect).value;
		location.href=web;
	}
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
	function cambiarDisplay2(id){
		  if (!document.getElementById) return false;
		  
		  fila = document.getElementById(id);
		  
		  if (fila.style.display != "none") {
		    fila.style.display = "none"; //ocultar fila 
		  } else {
		    fila.style.display = ""; //mostrar fila 
		  }
	}
	function tranSemana(dia){
		if(dia==1){
			return "lunes";
		}
		if(dia==2){
			return "martes";
		}
		if(dia==3){
			return "miercoles";	
		}
		if(dia==4){
			return "jueves";
		}
		if(dia==5){
			return "viernes";
		}
		if(dia==6){
			return "sabado";
		}
		if(dia==0){
			return "domingo";
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
	function mostrarhorarios(idfechacom){
		var splitcadena;
		var nombre;
		var contenido;
		fechacomp=document.getElementById(idfechacom).value;
		nombre=document.getElementById("nombre");
		contenido=document.getElementById("content");
		cont0=document.getElementById("titulodia0");
		cont1=document.getElementById("titulodia1");
		cont2=document.getElementById("titulodia2");
		cont3=document.getElementById("titulodia3");
		cont4=document.getElementById("titulodia4");
		cont5=document.getElementById("titulodia5");
		cont6=document.getElementById("titulodia6");
		cont7=document.getElementById("titulodia7");
		
		contg0=document.getElementById("dia0");
		contg1=document.getElementById("dia1");
		contg2=document.getElementById("dia2");
		contg3=document.getElementById("dia3");
		contg4=document.getElementById("dia4");
		contg5=document.getElementById("dia5");
		contg6=document.getElementById("dia6");
		contg7=document.getElementById("dia7");
		
		ajaxcalendarcalc=nuevoAjax();
		ajaxcalendarcalc.open("POST","mods/socket.php",true);
		ajaxcalendarcalc.onreadystatechange=function() {
			if (ajaxcalendarcalc.readyState==4){
				cadena=ajaxcalendarcalc.responseText;
				splitcadena=cadena.split(",");
				//Cambiar los nombres de los dias y establecer las variables data-*
				/////////////////////////
				dia1=tranSemana(splitcadena[0]);
				cont0.innerHTML=dia1;
				contg0.dataset.fechadiacero=splitcadena[8];
				/////////////////////////
				dia2=tranSemana(splitcadena[1]);
				cont1.innerHTML=dia2;
				contg1.dataset.fechadiauno=splitcadena[9];
				/////////////////////////////
				dia3=tranSemana(splitcadena[2]);
				cont2.innerHTML=dia3;
				contg2.dataset.fechadiados=splitcadena[10];
				/////////////////////////////
				dia4=tranSemana(splitcadena[3]);
				cont3.innerHTML=dia4;
				contg3.dataset.fechadiatres=splitcadena[11];
				/////////////////////////////
				dia5=tranSemana(splitcadena[4]);
				cont4.innerHTML=dia5;
				contg4.dataset.fechadiacuatro=splitcadena[12];
				/////////////////////////////
				dia6=tranSemana(splitcadena[5]);
				cont5.innerHTML=dia6;
				contg5.dataset.fechadiacinco=splitcadena[13];
				/////////////////////////////
				dia7=tranSemana(splitcadena[6]);
				cont6.innerHTML=dia7;
				contg6.dataset.fechadiaseis=splitcadena[14];
				/////////////////////////////
				dia8=tranSemana(splitcadena[7]);
				cont7.innerHTML=dia8;
				contg7.dataset.fechadiasiete=splitcadena[15];
				/////////////////////////////
				//Mostrar las opciones de repeticion de la pelicula en una semana
				if(nombre.value=="" && contenido.value==""){
					alert("Escriba al menos el titulo de la pelicula");
				}
				else{
					if(nombre.value==""){
						alert("Escriba el titulo de la pelicula");
					}
					else{
						mostrar('ModHorarios');
					}
				}
		 	}
		}
		ajaxcalendarcalc.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajaxcalendarcalc.send("calculardiafecha=true&fechainicio="+fechacomp + "&IDpelicula="+gup("IDX"));
	}
</script>
<style type="text/css">
	.diasSemana{
		list-style: none;
	}
	
	.diasSemana li{
		list-style: none;
	}
	/*.diasSemana li #dia0{
		display:none;
	}
	.diasSemana li #dia1{
		display:none;
	}
	.diasSemana li #dia2{
		display:none;
	}
	.diasSemana li #dia3{
		display:none;
	}
	.diasSemana li #dia4{
		display:none;
	}
	.diasSemana li #dia5{
		display:none;
	}
	.diasSemana li #dia6{
		display:none;
	}
	.diasSemana li #dia7{
		display:none;
	}*/
</style>
<div class="titulobar"></div>
<div class="modulobar" style="margin-left: 30px;">
	<form method="POST" enctype="multipart/form-data">
	<?php
	/*
	 * Convertir cadenas a minúsculas en utf8
	 *
	 * @recibe   cadena de caracteres
	 * @devuelve cadena reemplazada
	 *
	 * Uso: $objeto->strtolower_utf8(cadena);
	 *
	 */
	 function strtolower_utf8($cadena) {
	      $convertir_a = array(
	           "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
	           "v", "w", "x", "y", "z", "à", "á", "â", "ã", "ä", "å", "æ", "ç", "è", "é", "ê", "ë","ę", "ì", "í", "î", "ï",
	           "ð", "ñ", "ò", "ó", "ô", "õ", "ö", "ø", "ù", "ú", "û", "ü", "ý", "а", "б", "в", "г", "д", "е", "ё", "ж",
	           "з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "с", "т", "у", "ф", "х", "ц", "ч", "ш", "щ", "ъ", "ы",
	           "ь", "э", "ю", "я"
	      );
	      $convertir_de = array(
	           "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
	           "V", "W", "X", "Y", "Z", "À", "Á", "Â", "Ã", "Ä", "Å", "Æ", "Ç", "È", "É", "Ê", "Ë","Ę", "Ì", "Í", "Î", "Ï",
	           "Ð", "Ñ", "Ò", "Ó", "Ô", "Õ", "Ö", "Ø", "Ù", "Ú", "Û", "Ü", "Ý", "А", "Б", "В", "Г", "Д", "Е", "Ё", "Ж",
	           "З", "И", "Й", "К", "Л", "М", "Н", "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Ъ", "Ъ",
	           "Ь", "Э", "Ю", "Я"
	      );
	      return str_replace($convertir_de, $convertir_a, $cadena);
	 }
	 
	/*
	 * Convertir cadenas a mayúsculas en utf8
	 *
	 * @recibe   cadena de caracters
	 * @devuelve cadena reemplazada
	 *
	 * Uso: $objeto->strtotoupper_utf8(cadena);
	 *
	 */
	 function strtoupper_utf8($cadena) {
	      $convertir_de = array(
	           "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
	           "v", "w", "x", "y", "z", "à", "á", "â", "ã", "ä", "å", "æ", "ç", "è", "é", "ê", "ë","ę", "ì", "í", "î", "ï",
	           "ð", "ñ", "ò", "ó", "ô", "õ", "ö", "ø", "ù", "ú", "û", "ü", "ý", "а", "б", "в", "г", "д", "е", "ё", "ж",
	           "з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "с", "т", "у", "ф", "х", "ц", "ч", "ш", "щ", "ъ", "ы",
	           "ь", "э", "ю", "я"
	      );
	      $convertir_a = array(
	           "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
	           "V", "W", "X", "Y", "Z", "À", "Á", "Â", "Ã", "Ä", "Å", "Æ", "Ç", "È", "É", "Ê", "Ë","Ę", "Ì", "Í", "Î", "Ï",
	           "Ð", "Ñ", "Ò", "Ó", "Ô", "Õ", "Ö", "Ø", "Ù", "Ú", "Û", "Ü", "Ý", "А", "Б", "В", "Г", "Д", "Е", "Ё", "Ж",
	           "З", "И", "Й", "К", "Л", "М", "Н", "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Ъ", "Ъ",
	           "Ь", "Э", "Ю", "Я"
	      );
	      return str_replace($convertir_de, $convertir_a, $cadena);
	 }
	//echo("IDHASH ".$_SESSION['uniq_hash']);
	if($_GET['IDX']!=''){
		$sqle="SELECT * FROM peliculas WHERE ID='".$_GET['IDX']."'";
		$msqlq=mysql_query($sqle,$conexion);
		if($msqlq){
			$mfilas=mysql_num_rows($msqlq);
			if($mfilas>0){
				$datos=mysql_fetch_array($msqlq);
				$idpeli_cons=$datos['ID'];
				$titulnoticia_cons=$datos['titulo'];
				$descrip_cons=$datos['descrip'];
				$sala_cons=$datos['sala'];
				$censura_cons=$datos['censura'];
				$precio_cons=$datos['precio'];
				$categoria_cons=$datos['categoria'];
				$fecha_cons=$datos['fecha'];
				$idtemp_cons=$datos['idtemp'];
				$dis_cons=$datos['disponibilidad'];
				$fechai=$fecha_cons;
				/////////////////////
				$fecha1=$fechai;
				$NuevaFecha1=$fecha1;
				//$NuevaFecha1=date('Y-m-d',$NuevaFecha1);
				//echo($NuevaFecha1);
				/////////////////////
				$fecha2=date($fechai,strtotime("1 day"));
				$NuevaFecha2=strtotime("1 day",strtotime($fecha2));
				$NuevaFecha2=date('Y-m-d',$NuevaFecha2);
				/////////////////////
				$fecha3=date($fechai,strtotime("2 day"));
				$NuevaFecha3=strtotime("2 day",strtotime($fecha3));
				$NuevaFecha3=date('Y-m-d',$NuevaFecha3);
				/////////////////////
				$fecha4=date($fechai,strtotime("3 day"));
				$NuevaFecha4=strtotime("3 day",strtotime($fecha4));
				$NuevaFecha4=date('Y-m-d',$NuevaFecha4);
				/////////////////////
				$fecha5=date($fechai,strtotime("4 day"));
				$NuevaFecha5=strtotime("4 day",strtotime($fecha5));
				$NuevaFecha5=date('Y-m-d',$NuevaFecha5);
				/////////////////////
				$fecha6=date($fechai,strtotime("5 day"));
				$NuevaFecha6=strtotime("5 day",strtotime($fecha6));
				$NuevaFecha6=date('Y-m-d',$NuevaFecha6);
				/////////////////////
				$fecha7=date($fechai,strtotime("6 day"));
				$NuevaFecha7=strtotime("6 day",strtotime($fecha7));
				$NuevaFecha7=date('Y-m-d',$NuevaFecha7);
				/////////////////////
				$fecha8=date($fechai,strtotime("7 day"));
				$NuevaFecha8=strtotime("7 day",strtotime($fecha8));
				$NuevaFecha8=date('Y-m-d',$NuevaFecha8);
				/////////////////////
				$fechaArr1=explode("-",$NuevaFecha1);
				$fechaArr2=explode("-",$NuevaFecha2);
				$fechaArr3=explode("-",$NuevaFecha3);
				$fechaArr4=explode("-",$NuevaFecha4);
				$fechaArr5=explode("-",$NuevaFecha5);
				$fechaArr6=explode("-",$NuevaFecha6);
				$fechaArr7=explode("-",$NuevaFecha7);
				$fechaArr8=explode("-",$NuevaFecha8);
				///////////////////////////////////////////
				//comprobar si hay peliculas ese dia y horario para mostrarlo
				$sql2="SELECT * FROM horarios WHERE fecha='$NuevaFecha1' AND idpelicula='$idpeli_cons'";
				$pedidos=mysql_query($sql2,$conexion);
				echo(mysql_error());
				if($pedidos){
					$filas=mysql_num_rows($pedidos);
					if($filas>0){
						$peliculasNuevaFecha1="display:block;";
						$visto1="checked=\"checked\"";
						//echo("SDFSDF".$peliculasNuevaFecha1);
					}
					else{
						$peliculasNuevaFecha1="display:none;";
						$visto1="";
					}
				}
				$sql2="SELECT * FROM horarios WHERE fecha='$NuevaFecha2' AND idpelicula='$idpeli_cons'";
				$pedidos=mysql_query($sql2,$conexion);
				echo(mysql_error());
				if($pedidos){
					$filas=mysql_num_rows($pedidos);
					if($filas>0){
						$peliculasNuevaFecha2="display:block;";
						$visto2="checked=\"checked\"";
					}
					else{
						$peliculasNuevaFecha2="display:none;";
						$visto2="";
					}
				}
				$sql2="SELECT * FROM horarios WHERE fecha='$NuevaFecha3' AND idpelicula='$idpeli_cons'";
				$pedidos=mysql_query($sql2,$conexion);
				echo(mysql_error());
				if($pedidos){
					$filas=mysql_num_rows($pedidos);
					if($filas>0){
						$peliculasNuevaFecha3="display:block;";
						$visto3="checked=\"checked\"";
					}
					else{
						$peliculasNuevaFecha3="display:none;";
						$visto3="";
					}
				}
				$sql2="SELECT * FROM horarios WHERE fecha='$NuevaFecha4' AND idpelicula='$idpeli_cons'";
				$pedidos=mysql_query($sql2,$conexion);
				echo(mysql_error());
				if($pedidos){
					$filas=mysql_num_rows($pedidos);
					if($filas>0){
						$peliculasNuevaFecha4="display:block;";
						$visto4="checked=\"checked\"";
					}
					else{
						$peliculasNuevaFecha4="display:none;";
						$visto4="";
					}
				}
				$sql2="SELECT * FROM horarios WHERE fecha='$NuevaFecha5' AND idpelicula='$idpeli_cons'";
				$pedidos=mysql_query($sql2,$conexion);
				echo(mysql_error());
				if($pedidos){
					$filas=mysql_num_rows($pedidos);
					if($filas>0){
						$peliculasNuevaFecha5="display:block;";
						$visto5="checked=\"checked\"";
					}
					else{
						$peliculasNuevaFecha5="display:none;";
						$visto5="";
					}
				}
				$sql2="SELECT * FROM horarios WHERE fecha='$NuevaFecha6' AND idpelicula='$idpeli_cons'";
				$pedidos=mysql_query($sql2,$conexion);
				echo(mysql_error());
				if($pedidos){
					$filas=mysql_num_rows($pedidos);
					if($filas>0){
						$peliculasNuevaFecha6="display:block;";
						$visto6="checked=\"checked\"";
					}
					else{
						$peliculasNuevaFecha6="display:none;";
						$visto6="";
					}
				}
				$sql2="SELECT * FROM horarios WHERE fecha='$NuevaFecha7' AND idpelicula='$idpeli_cons'";
				$pedidos=mysql_query($sql2,$conexion);
				echo(mysql_error());
				if($pedidos){
					$filas=mysql_num_rows($pedidos);
					if($filas>0){
						$peliculasNuevaFecha7="display:block;";
						$visto7="checked=\"checked\"";
					}
					else{
						$peliculasNuevaFecha7="display:none;";
						$visto7="";
					}
				}
				$sql2="SELECT * FROM horarios WHERE fecha='$NuevaFecha8' AND idpelicula='$idpeli_cons'";
				$pedidos=mysql_query($sql2,$conexion);
				echo(mysql_error());
				if($pedidos){
					$filas=mysql_num_rows($pedidos);
					if($filas>0){
						$peliculasNuevaFecha8="display:block;";
						$visto8="checked=\"checked\"";
					}
					else{
						$peliculasNuevaFecha8="display:none;";
						$visto8="";
					}
				}
				///////////////////////////////////////////
				$dia1=date("w",mktime(0,0,0,$fechaArr1[1], $fechaArr1[2],$fechaArr1[0]));
				$dia2=date("w",mktime(0,0,0,$fechaArr2[1], $fechaArr2[2],$fechaArr2[0]));
				$dia3=date("w",mktime(0,0,0,$fechaArr3[1], $fechaArr3[2],$fechaArr3[0]));
				$dia4=date("w",mktime(0,0,0,$fechaArr4[1], $fechaArr4[2],$fechaArr4[0]));
				$dia5=date("w",mktime(0,0,0,$fechaArr5[1], $fechaArr5[2],$fechaArr5[0]));
				$dia6=date("w",mktime(0,0,0,$fechaArr6[1], $fechaArr6[2],$fechaArr6[0]));
				$dia7=date("w",mktime(0,0,0,$fechaArr7[1], $fechaArr7[2],$fechaArr7[0]));
				$dia8=date("w",mktime(0,0,0,$fechaArr8[1], $fechaArr8[2],$fechaArr8[0]));
				////////////////////////////
				if($dia1==1){
					$diaStr1="lunes";
				}
				if($dia1==2){
					$diaStr1="martes";
				}
				if($dia1==3){
					$diaStr1="miercoles";	
				}
				if($dia1==4){
					$diaStr1="jueves";
				}
				if($dia1==5){
					$diaStr1="viernes";
				}
				if($dia1==6){
					$diaStr1="sabado";
				}
				if($dia1==0){
					$diaStr1="domingo";
				}
				/////////////////////////
				if($dia2==1){
					$diaStr2="lunes";
				}
				if($dia2==2){
					$diaStr2="martes";
				}
				if($dia2==3){
					$diaStr2="miercoles";	
				}
				if($dia2==4){
					$diaStr2="jueves";
				}
				if($dia2==5){
					$diaStr2="viernes";
				}
				if($dia2==6){
					$diaStr2="sabado";
				}
				if($dia2==0){
					$diaStr2="domingo";
				}
				//////////////////////////
				if($dia3==1){
					$diaStr3="lunes";
				}
				if($dia3==2){
					$diaStr3="martes";
				}
				if($dia3==3){
					$diaStr3="miercoles";	
				}
				if($dia3==4){
					$diaStr3="jueves";
				}
				if($dia3==5){
					$diaStr3="viernes";
				}
				if($dia3==6){
					$diaStr3="sabado";
				}
				if($dia3==0){
					$diaStr3="domingo";
				}
				////////////////////////////
				//echo("DIA4: ".$dia4);
				if($dia4==1){
					$diaStr4="lunes";
				}
				if($dia4==2){
					$diaStr4="martes";
				}
				if($dia4==3){
					$diaStr4="miercoles";	
				}
				if($dia4==4){
					$diaStr4="jueves";
				}
				if($dia4==5){
					$diaStr4="viernes";
				}
				if($dia4==6){
					$diaStr4="sabado";
				}
				if($dia4==0){
					$diaStr4="domingo";
				}
				/////////////////////////////
				if($dia5==1){
					$diaStr5="lunes";
				}
				if($dia5==2){
					$diaStr5="martes";
				}
				if($dia5==3){
					$diaStr5="miercoles";	
				}
				if($dia5==4){
					$diaStr5="jueves";
				}
				if($dia5==5){
					$diaStr5="viernes";
				}
				if($dia5==6){
					$diaStr5="sabado";
				}
				if($dia5==0){
					$diaStr5="domingo";
				}
				/////////////////////////////
				if($dia6==1){
					$diaStr6="lunes";
				}
				if($dia6==2){
					$diaStr6="martes";
				}
				if($dia6==3){
					$diaStr6="miercoles";	
				}
				if($dia6==4){
					$diaStr6="jueves";
				}
				if($dia6==5){
					$diaStr6="viernes";
				}
				if($dia6==6){
					$diaStr6="sabado";
				}
				if($dia6==0){
					$diaStr6="domingo";
				}
				///////////////////////////////
				if($dia7==1){
					$diaStr7="lunes";
				}
				if($dia7==2){
					$diaStr7="martes";
				}
				if($dia7==3){
					$diaStr7="miercoles";	
				}
				if($dia7==4){
					$diaStr7="jueves";
				}
				if($dia7==5){
					$diaStr7="viernes";
				}
				if($dia7==6){
					$diaStr7="sabado";
				}
				if($dia7==0){
					$diaStr7="domingo";
				}
				////////////////////
				if($dia8==1){
					$diaStr8="lunes";
				}
				if($dia8==2){
					$diaStr8="martes";
				}
				if($dia8==3){
					$diaStr8="miercoles";	
				}
				if($dia8==4){
					$diaStr8="jueves";
				}
				if($dia8==5){
					$diaStr8="viernes";
				}
				if($dia8==6){
					$diaStr8="sabado";
				}
				if($dia8==0){
					$diaStr8="domingo";
				}
				////////////////////
			}
			else{
				$fecha_cons=date("Y-m-d");
			}
		}
	}
	else{
		if($categoria_cons==''){
			if($_GET['tipo']=="teatro"){
				$categoria_cons="TEATRO";
			}
			else{
				$categoria_cons="CINE";
			}
		}
		$fecha_cons=date("Y-m-d");
		$peliculasNuevaFecha1="display:none;";
		$visto1="";
		$peliculasNuevaFecha2="display:none;";
		$visto2="";
		$peliculasNuevaFecha3="display:none;";
		$visto3="";
		$peliculasNuevaFecha4="display:none;";
		$visto4="";
		$peliculasNuevaFecha5="display:none;";
		$visto5="";
		$peliculasNuevaFecha6="display:none;";
		$visto6="";
		$peliculasNuevaFecha7="display:none;";
		$visto7="";
		$peliculasNuevaFecha8="display:none;";
		$visto8="";
	}
	$btn=$_POST['btnprocesar'];
	$option=$_GET['opcion'];
	$suboption=$_GET['subopcion'];
	if($btn){
		$option="peliculas";
		$nombre=strtoupper_utf8($_POST['nombre']);
		$descripcion=$_POST['content'];
		$fechapub=$_POST['fechapubli'];
		$categoria=$categoria_cons;
		$sala=$_POST['salacmb'];
		$censura=$_POST['censuracmb'];
		//$disp=$_POST['discmb'];
		$precio=$_POST['precio'];
		if($_GET['subopcion']=="agregar"){
			//$sql2="INSERT INTO peliculas(titulo,descrip,sala,censura,precio,categoria,fecha,idtemp,disponibilidad) VALUES('$nombre','$descripcion','$sala','$censura','$precio','$categoria','".date('Y-m-d',strtotime($fechapub))."','".$_SESSION['uniq_hash']."','$disp')";
			$sql2="INSERT INTO peliculas(titulo,descrip,sala,censura,precio,categoria,fecha,idtemp) VALUES('$nombre','$descripcion','$sala','$censura','$precio','$categoria','".date('Y-m-d',strtotime($fechapub))."','".$_SESSION['uniq_hash']."')";
			$pedidos=mysql_query($sql2,$conexion);
			echo(mysql_error());
			if($pedidos){
				$idrecien=mysql_insert_id();
				if($_SESSION['uniq_hash']!=''){
					if($idrecien!=''){
						$sql3="UPDATE horarios SET idpelicula='$idrecien' WHERE idtemp='".$_SESSION['uniq_hash']."'";
						$pedidhor=mysql_query($sql3,$conexion);
						if($pedidhor){
							$_SESSION['uniq_hash']='';
						}
						?>
							<div class="alert alert-success">Se han agregado los datos con exito</div>
						<?php
					}
				}
			}
			else{
				echo(mysql_error());
			}
		}
		if($_GET['subopcion']=="modificar"){
			$sqlog="SELECT * FROM peliculas WHERE ID='".$_GET['IDX']."'";
			$pedidolog=mysql_query($sqlog,$conexion);
			if($pedidolog){
				$filaslog=mysql_num_rows($pedidolog);
				if($filaslog>0){
					$data=mysql_fetch_array($pedidolog);
						//MODIFICACION
						if($titulnoticia_cons!=''){
							//MODIFICACION
							$sql2="UPDATE peliculas SET titulo='".$nombre."' WHERE ID='".$_GET['IDX']."'";
							$pedidos=mysql_query($sql2,$conexion);
							if($pedidos){
								?>
								<div class="alert alert-success">Se han actualizado los datos con exito</div>
							<?php
							}
							else{
?>
								<div class="alert alert-success"><?php echo(mysql_error()); ?></div>
								<?php
							}
						}
						if($descripcion!=''){
							$sql2="UPDATE peliculas SET descrip='".$descripcion."' WHERE ID='".$_GET['IDX']."'";
							$pedidos=mysql_query($sql2,$conexion);
							if($pedidos){
								?>
								<div class="alert alert-success">Se han actualizado los datos con exito</div>
								<?php
							}
							else{
?>
								<div class="alert alert-success"><?php echo(mysql_error()); ?></div>
								<?php
							}
						}
						if($fechapub!=''){
							$sql2="UPDATE peliculas SET fecha='".date('Y-m-d', strtotime($fechapub))."' WHERE ID='".$_GET['IDX']."'";
							$pedidos=mysql_query($sql2,$conexion);
							if($pedidos){
								?>
								<div class="alert alert-success">Se han actualizado los datos con exito</div>
								<?php
							}
							else{
?>
								<div class="alert alert-success"><?php echo(mysql_error()); ?></div>
								<?php
							}	
						}
						if($categoria!=''){
							$sql2="UPDATE peliculas SET categoria='$categoria' WHERE ID='".$_GET['IDX']."'";
							$pedidos=mysql_query($sql2,$conexion);
							if($pedidos){
								?>
								<div class="alert alert-success">Se han actualizado los datos con exito</div>
								<?php
							}
							else{
?>
								<div class="alert alert-success"><?php echo(mysql_error()); ?></div>
								<?php
							}	
						}
						if($sala!=''){
							$sql2="UPDATE peliculas SET sala='$sala' WHERE ID='".$_GET['IDX']."'";
							$pedidos=mysql_query($sql2,$conexion);
							if($pedidos){
								?>
								<div class="alert alert-success">Se han actualizado los datos con exito</div>
								<?php
							}
							else{
?>
								<div class="alert alert-success"><?php echo(mysql_error()); ?></div>
								<?php
							}	
						}
						if($censura!=''){
							$sql2="UPDATE peliculas SET censura='$censura' WHERE ID='".$_GET['IDX']."'";
							$pedidos=mysql_query($sql2,$conexion);
							if($pedidos){
								?>
								<div class="alert alert-success">Se han actualizado los datos con exito</div>
								<?php
							}
							else{
?>
								<div class="alert alert-success"><?php echo(mysql_error()); ?></div>
								<?php
							}	
						}
						if($precio!=''){
							$sql2="UPDATE peliculas SET precio='$precio' WHERE ID='".$_GET['IDX']."'";
							$pedidos=mysql_query($sql2,$conexion);
							if($pedidos){
								?>
								<div class="alert alert-success">Se han actualizado los datos con exito</div>
								<?php
							}
							else{
								?>
								<div class="alert alert-success"><?php echo(mysql_error()); ?></div>
								<?php
							}	
						}
						//if($disp!=''){
							//$sql2="UPDATE peliculas SET disponibilidad='$disp' WHERE ID='".$_GET['IDX']."'";
							//$pedidos=mysql_query($sql2,$conexion);
							//if($pedidos){
								?>
								<!--<div class="alert alert-success">Se han actualizado los datos con exito</div>!-->
								<?php
							//}
							//else{
								?>
								<!--<div class="alert alert-success"><?php //echo(mysql_error()); ?></div>!-->
								<?php
							//}	
						//}
					}
				}
			}
			if($_GET['subopcion']=="eliminar"){
				$sqlog="SELECT * FROM peliculas WHERE ID='".$_GET['IDX']."'";
				$pedidolog=mysql_query($sqlog,$conexion);
				if($pedidolog){
					$filaslog=mysql_num_rows($pedidolog);
					if($filaslog>0){
						$sqlu="DELETE FROM peliculas WHERE ID='".$_GET['IDX']."'";
						$pedidou=mysql_query($sqlu,$conexion);
						$sqlog="DELETE FROM horarios WHERE idpelicula='".$_GET['IDX']."'";
						$pedidolog=mysql_query($sqlog,$conexion);
						if($pedidolog){
							?>
								<div class="alert alert-success">Se han eliminado los datos con exito</div>
							<?php
						}
						else{
							?>
								<div class="alert alert-success"><?php echo(mysql_error()); ?></div>
							<?php
						}
					}
				}
			}
			//error_reporting(E_ERROR);//
			if(empty($_SESSION['uniq_hash'])){
				$_SESSION['uniq_hash']=substr(md5(uniqid(rand())),0,12);
			}
		}
		//echo($fecha_cons);
		if($_GET['IDX']!=''){
			$sqle="SELECT * FROM peliculas WHERE ID='".$_GET['IDX']."'";
			$msqlq=mysql_query($sqle,$conexion);
			if($msqlq){
				$mfilas=mysql_num_rows($msqlq);
				if($mfilas>0){
					$datos=mysql_fetch_array($msqlq);
					$idpeli_cons=$datos['ID'];
					$titulnoticia_cons=$datos['titulo'];
					$descrip_cons=$datos['descrip'];
					$sala_cons=$datos['sala'];
					$censura_cons=$datos['censura'];
					$precio_cons=$datos['precio'];
					$categoria_cons=$datos['categoria'];
					$fecha_cons=$datos['fecha'];
					$idtemp_cons=$datos['idtemp'];
					$dis_cons=$datos['disponibilidad'];
				}
			}
		}
		?>
		<table>
			<tr>
				<td>
					<?php
					
						if($_GET['tipo']=="teatro"){
							?>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=noticias&entrar=".$_GET['entrar']); ?>"><h1>TEATRO</h1></a>
							<?php
						}
						else{
							?>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=noticias&entrar=".$_GET['entrar']); ?>"><h1>CINE</h1></a>
							<?php							
						}
					
					?>
				</td>
			</tr>
			<tr>
				<td>
				  	<?php
				  		if($_GET['subopcion']!=''){
					  		if($_GET['subopcion']=='agregar'){
					  			$classagregar="active";
					  		}
							elseif($_GET['subopcion']=='modificar'){
					  			$classmodificar="active";
					  		}
							else{
								$classeliminar="active";
							}
				  		}
				  	?>
					<table>
						<tr>
							<td>
								<ul class="nav nav-pills">
								  <li class="<?php echo($classagregar); ?>"><a href="<?php echo("?mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&tipo=".$_GET['tipo']."&subopcion=agregar"); ?>">Agregar</a></li>
								  <li class="<?php echo($classmodificar); ?>"><a href="<?php echo("?mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&tipo=".$_GET['tipo']."&subopcion=modificar"); ?>">Modificar</a></li>
								  <li class="<?php echo($classeliminar); ?>"><a href="<?php echo("?mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&tipo=".$_GET['tipo']."&subopcion=eliminar"); ?>">Eliminar</a></li>
								</ul>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<table>
			<tr><td style="height:20px;"></td></tr>
		</table>
		<table>
		<?php
		if($_GET['subopcion']=='modificar' || $_GET['subopcion']=='eliminar'){
			?>
			<tr>
				<td>
					Seleccionar Item
				</td>
			</tr>
			<tr>
				<td style="height:100px;">
					<?php
					if($_GET['subopcion']=='modificar' || $_GET['subopcion']=='eliminar') {
						?>
						<SELECT name="nombre" id="nombre" onchange="abreSitio('nombre');" multiple="true" style="height:200px;width:350px;">
							<?php
								$opciontabla="peliculas";
								$tabladef="peliculas";
								$campomos="titulo";
								$sqlsel="SELECT * FROM ".$tabladef." WHERE categoria='".$categoria_cons."' ORDER BY ID DESC";
								$pedidosel=mysql_query($sqlsel,$conexion);
								if($pedidosel){
									$filassel=mysql_num_rows($pedidosel);
									if($filassel>0){
										while($datserv=mysql_fetch_array($pedidosel)){
											if($datserv['ID']==$_GET['IDX']){
												echo("<OPTION SELECTED value=\"?&mod=adminnoticias&opcion=".$_GET['opcion']."&tipo=".$_GET['tipo']."&categoria=".$datserv['categoria']."&hash=".$datserv['idtemp']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."\">".$datserv[$campomos]."</OPTION>");
											}
											else{
												echo("<OPTION value=\"?&mod=adminnoticias&opcion=".$_GET['opcion']."&tipo=".$_GET['tipo']."&categoria=".$datserv['categoria']."&hash=".$datserv['idtemp']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."\">".$datserv[$campomos]."</OPTION>");
											}
										}
									}
									else{
										echo("<OPTION value=\"?&mod=adminnoticias&opcion=".$_GET['opcion']."&tipo=".$_GET['tipo']."&categoria=".$datserv['categoria']."&hash=".$datserv['idtemp']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."\">NO HAY FUNCIONES AGREGADAS</OPTION>");
									}
								}
							?>
						</SELECT>
						<?php
					}
					?>
				</td>
			</tr>
		<?php
		}

		if($_GET['subopcion']!="eliminar"){
		?>
			<tr>
				<td>
					<?php
						echo("T&iacute;tulo");
					?>
				</td>
			</tr>
			<tr>
				<td>
					<INPUT name="nombre" id="nombre" type="text" style="border:1px solid black;width:333px;" value="<?php echo($titulnoticia_cons); ?>">
				</td>
			</tr>
				<tr>
					<td>
						Breve Descripci&oacute;n
					</td>
				</tr>
				<tr>
					<td>
						<INPUT name="content" id="content" type="text" style="border:1px solid black;width:333px;" value="<?php echo($descrip_cons); ?>">
					</td>
				</tr>
				<tr>
					<td>
						Sala
					</td>
				</tr>
				<tr>
					<td>
						<?php
						if($categoria_cons=="TEATRO"){
							?>
								<SELECT name="salacmb" id="salacmb">
									<OPTION <?php if($sala_cons=="TRASNOCHO"){ echo("SELECTED"); } ?> value="TRASNOCHO">TRASNOCHO</OPTION>
									<OPTION <?php if($sala_cons=="PLURAL"){ echo("SELECTED"); } ?> value="PLURAL">PLURAL</OPTION>
									<OPTION <?php if($sala_cons=="TAC"){ echo("SELECTED"); } ?> value="TAC">TAC</OPTION>
								</SELECT>
							<?php
						}
						else{
							?>
								<SELECT name="salacmb" id="salacmb">
									<OPTION <?php if($sala_cons=="PASEO 1"){ echo("SELECTED"); } ?> value="PASEO 1">PASEO 1</OPTION>
									<OPTION <?php if($sala_cons=="PASEO 2"){ echo("SELECTED"); } ?> value="PASEO 2">PASEO 2</OPTION>
									<OPTION <?php if($sala_cons=="PLUS 1"){ echo("SELECTED"); } ?> value="PLUS 1">PLUS 1</OPTION>
									<OPTION <?php if($sala_cons=="PLUS 2"){ echo("SELECTED"); } ?> value="PLUS 2">PLUS 2</OPTION>
								</SELECT>
							<?php							
						}
						?>
					</td>
				</tr>
				<tr>
					<td>
						Censura
					</td>
				</tr>
				<tr>
					<td>
						<SELECT name="censuracmb" id="censuracmb">
							<!-- <OPTION <?php if($censura_cons=="AA"){ echo("SELECTED"); } ?> value="AA">AA</OPTION> -->
							<OPTION <?php if($censura_cons=="A"){ echo("SELECTED"); } ?> value="A">A</OPTION>
							<OPTION <?php if($censura_cons=="B"){ echo("SELECTED"); } ?> value="B">B</OPTION>
							<OPTION <?php if($censura_cons=="C"){ echo("SELECTED"); } ?> value="C">C</OPTION>
							<OPTION <?php if($censura_cons=="D"){ echo("SELECTED"); } ?> value="D">D</OPTION>
						</SELECT>
					</td>
				</tr>
				<!-- <tr>
					<td>
						Disponibilidad
					</td>
				</tr>
				<tr>
					<td>
						<SELECT name="discmb" id="discmb">
							<OPTION <?php if($dis_cons=="DISPONIBLE"){ echo("SELECTED"); } ?> value="DISPONIBLE">DISPONIBLE</OPTION>
							<OPTION <?php if($dis_cons=="AGOTADO"){ echo("SELECTED"); } ?> value="AGOTADO">AGOTADO</OPTION>
						</SELECT>
					</td>
				</tr> -->
			<tr>
				<td>
					Precio
				</td>
			</tr>
			<tr>
				<td>
					<INPUT name="precio" id="precio" type="text" style="border:1px solid black;width:333px;" value="<?php echo($precio_cons); ?>">
				</td>
			</tr>
				<tr>
					<td>
						Fecha de Inicio de Exposici&oacute;n (YYYY-MM-DD)
					</td>
				</tr>
				<tr>
					<td>
						<INPUT name="fechapubli" id="fechapubli" type="text" style="border:1px solid black;width:333px;" value="<?php echo($fecha_cons); ?>">
						<?php
							if($_GET['subopcion']!="agregar"){
								$displayButtonContinuar="display:inline-block;";
								$displayCuadroHorarios="display:block;";
								?>
									<input id="btnagregarhorasN" name="btnagregarhorasN" type="button" 
										onclick="mostrarhorarios('fechapubli');" 
										class="btn btn-small btn-info" value="Actualizar Fecha" style="<?php echo($displayButtonContinuar); ?>"></input>
								<?php
							}
							else{
								$displayButtonContinuar="display:inline-block;";
								$displayCuadroHorarios="display:none;";
								?>
									<input id="btnagregarhorasN" name="btnagregarhorasN" type="button" 
										onclick="mostrarhorarios('fechapubli');" 
										class="btn btn-small btn-info" value="Continuar" style="<?php echo($displayButtonContinuar); ?>"></input>
								<?php
							}
						?>
					</td>
				</tr>
		</table>
		<div id="ModHorarios" style="<?php echo($displayCuadroHorarios); ?>">
			<span style="height: 20px;margin-top: 20px;margin-bottom: 10px;">Establecer Horarios</span>
			<ul class="diasSemana">
				<li>
						<input name="checkdia0" id="checkdia0" type="checkbox" onchange="cambiarDisplay2('dia0')" <?php echo($visto1); ?>><span id="titulodia0"><?php echo($diaStr1); ?></span>
						<table id="dia0" data-fechadiacero="<?php echo($NuevaFecha1); ?>" style="<?php echo($peliculasNuevaFecha1); ?>">
							<tr>
								<td>
									<table>
										<tr>
											<td>
												<SELECT name="horacmb0" id="horacmb0">
													<?php
														for($i=1; $i<=12;$i++){
															?>
																<OPTION <?php if($_GET['hora']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
															<?php
														}
													?>
												</SELECT>									
											</td>
											<td>
												<SELECT name="minutocmb0" id="minutocmb0">
													<?php
														for($i=0; $i<=59;$i++){
															?>
																<OPTION <?php if($_GET['minuto']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
															<?php
														}
													?>
												</SELECT>									
											</td>
											<td>
												<SELECT name="turnocmb0" id="turnocmb0">
													<OPTION <?php //if($turno_cons=="PM"){ echo("SELECTED"); } ?>  value="PM">PM</OPTION>
													<OPTION <?php //if($turno_cons=="AM"){ echo("SELECTED"); } ?>  value="AM">AM</OPTION>
												</SELECT>
											</td>
											<td style="width:10px;">
												
											</td>
											<?php
												if(!empty($_GET['hash'])){
													$HASHCons=$_GET['hash'];
												}
												else{
													$HASHCons=$_SESSION['uniq_hash'];
												}
											?>
											<td>
												<SELECT name="discmb0" id="discmb0">
													<OPTION SELECTED>DISPONIBLE</OPTION>
													<OPTION value="AGOTADO">AGOTADO</OPTION>
												</SELECT>
											</td>
											<td>
												<input id="btnagregarhoras0" name="btnagregarhoras0" type="button" 
												onclick="<?php echo("agregarhorario('horacmb0','minutocmb0','turnocmb0','$HASHCons','tabladehorarios0','dia0','discmb0','AGREGAR');"); ?>" 
												class="btn btn-small btn-info" value="Agregar"></input>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr style="height:15px;">
								<td>
								</td>
							</tr>
							<tr>
								<td>
									<div id="tabladehorarios0" name="tabladehorarios0">
									<?php
											if(empty($_SESSION['uniq_hash'])){
												$HASH=$_GET['hash'];
											}
											else{
												if(empty($_GET['hash'])){
													$HASH=$_SESSION['uniq_hash'];	
												}
												else{
													$HASH=$_GET['hash'];
												}
											}
											
											$sqlog="SELECT * FROM horarios WHERE idtemp='$HASH' AND fecha='$NuevaFecha1' ORDER BY ID DESC";
											$pedidolog=mysql_query($sqlog,$conexion);
											echo(mysql_error());
											if($pedidolog){
												$filaslog=mysql_num_rows($pedidolog);
												if($filaslog>0){
													$u=0;
													?>
													<table>
														<tr>
															<td>
																Horarios
															</td>
														</tr>
													</table>
													<table>
													<?php
														while($data=mysql_fetch_array($pedidolog)){
															$btnmodificarhoras="btnmodificarhoras0".$u;
															$modificarhorastxt="modificarhorastxt0".$u;
															$modificarmintxt="modificarmintxt0".$u;
															$modificarturnotxt="modificarturnotxt0".$u;
															$modificardispontxt="diacmbmod0".$u;
															?>
																<tr>
																	<td>
																		<SELECT name="<?php echo($modificarhorastxt); ?>" id="<?php echo($modificarhorastxt); ?>">
																			<?php
																				for($i=1; $i<=12;$i++){
																					?>
																						<OPTION <?php if($data['hora']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
																					<?php
																				}
																			?>
																		</SELECT>									
																	</td>
																	<td>
																		<SELECT name="<?php echo($modificarmintxt); ?>" id="<?php echo($modificarmintxt); ?>">
																			<?php
																				for($i=0; $i<=59;$i++){
																					?>
																						<OPTION <?php if($data['minuto']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
																					<?php
																				}
																			?>
																		</SELECT>									
																	</td>
																	<td>
																		<SELECT name="<?php echo($modificarturnotxt); ?>" id="<?php echo($modificarturnotxt); ?>">
																			<OPTION <?php if($data['turno']=="PM"){ echo("SELECTED"); } ?> value="PM">PM</OPTION>
																			<OPTION <?php if($data['turno']=="AM"){ echo("SELECTED"); } ?> value="AM">AM</OPTION>
																		</SELECT>
																	</td>
																	<td>
																		<SELECT name="<?php echo($modificardispontxt); ?>" id="<?php echo($modificardispontxt); ?>">
																			<OPTION value="DISPONIBLE" <?php if($data['disponible']=="DISPONIBLE"){ echo("SELECTED"); }?>>DISPONIBLE</OPTION>
																			<OPTION value="AGOTADO" <?php if($data['disponible']=="AGOTADO"){ echo("SELECTED"); }?>>AGOTADO</OPTION>
																		</SELECT>
																	</td>
																	<td style="width:10px;">
																		
																	</td>
																	<td>
																		<input id="<?php echo($btnmodificarhoras); ?>" name="<?php echo($btnmodificarhoras); ?>" type="button" class="btn btn-small btn-success" 
																		onclick="<?php echo("agregarhorario('".$modificarhorastxt."','".$modificarmintxt."','".$modificarturnotxt."','".$data['ID']."','tabladehorarios0','".$data['fecha']."','$modificardispontxt','MODIFICAR');"); ?>" 
																		value="Editar"></input>															
																	</td>
																	<td style="width:5px;"></td>
																	<td>
																		<input id="<?php echo($btnmodificarhoras); ?>" name="<?php echo($btnmodificarhoras); ?>" type="button" class="btn btn-small btn-danger" 
																		onclick="<?php echo("agregarhorario('".$modificarhorastxt."','".$modificarmintxt."','".$modificarturnotxt."','".$data['ID']."','tabladehorarios0','".$data['fecha']."','$modificardispontxt','ELIMINAR');"); ?>" 
																		value="Eliminar"></input>															
																	</td>
																</tr>
																<tr>
																	<td style="height:5px;">
																		
																	</td>
																</tr>
																<?php
																$u++;
															}
															?>
														</table>
													<?php
												}
											}
										?>
									</div>
								</td>
							</tr>
						</table>
				</li>
				<li>
							<input name="checkdia1" id="checkdia1" type="checkbox" onchange="cambiarDisplay2('dia1')" <?php echo($visto2); ?>><span id="titulodia1"><?php echo($diaStr2); ?></span>
							<table id="dia1" data-fechadiauno="<?php echo($NuevaFecha2); ?>" style="<?php echo($peliculasNuevaFecha2); ?>">
							<tr>
								<td>
									<table>
										<tr>
											<td>
												<SELECT name="horacmb1" id="horacmb1">
													<?php
														for($i=1; $i<=12;$i++){
															?>
																<OPTION <?php if($_GET['hora']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
															<?php
														}
													?>
												</SELECT>									
											</td>
											<td>
												<SELECT name="minutocmb1" id="minutocmb1">
													<?php
														for($i=0; $i<=59;$i++){
															?>
																<OPTION <?php if($_GET['minuto']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
															<?php
														}
													?>
												</SELECT>									
											</td>
											<td>
												<SELECT name="turnocmb1" id="turnocmb1">
													<OPTION <?php //if($turno_cons=="PM"){ echo("SELECTED"); } ?>  value="PM">PM</OPTION>
													<OPTION <?php //if($turno_cons=="AM"){ echo("SELECTED"); } ?>  value="AM">AM</OPTION>
												</SELECT>
											</td>
											<td style="width:10px;">
												
											</td>
											<td>
												<SELECT name="discmb1" id="discmb1">
													<OPTION SELECTED>DISPONIBLE</OPTION>
													<OPTION value="AGOTADO">AGOTADO</OPTION>
												</SELECT>
											</td>
											<?php
												if(!empty($_GET['hash'])){
													$HASHCons=$_GET['hash'];
												}
												else{
													$HASHCons=$_SESSION['uniq_hash'];
												}
											
											?>
											<td>
												<input id="btnagregarhoras1" name="btnagregarhoras1" type="button" 
												onclick="<?php echo("agregarhorario('horacmb1','minutocmb1','turnocmb1','$HASHCons','tabladehorarios1','dia1','discmb1','AGREGAR');"); ?>" 
												class="btn btn-small btn-info" value="Agregar"></input>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr style="height:15px;">
								<td>
									
								</td>
							</tr>
							<tr>
								<td>
									<div id="tabladehorarios1" name="tabladehorarios1">
									<?php
											if(empty($_SESSION['uniq_hash'])){
												$HASH=$_GET['hash'];
											}
											else{
												if(empty($_GET['hash'])){
													$HASH=$_SESSION['uniq_hash'];	
												}
												else{
													$HASH=$_GET['hash'];
												}
											}
											$sqlog="SELECT * FROM horarios WHERE idtemp='$HASH' AND fecha='$NuevaFecha2' ORDER BY ID DESC";
											$pedidolog=mysql_query($sqlog,$conexion);
											echo(mysql_error());
											if($pedidolog){
												$filaslog=mysql_num_rows($pedidolog);
												if($filaslog>0){
													$u=0;
													?>
													<table>
														<tr>
															<td>
																Horarios
															</td>
														</tr>
													</table>
													<table>
													<?php
														while($data=mysql_fetch_array($pedidolog)){
															$btnmodificarhoras="btnmodificarhoras1".$u;
															$modificarhorastxt="modificarhorastxt1".$u;
															$modificarmintxt="modificarmintxt1".$u;
															$modificarturnotxt="modificarturnotxt1".$u;
															$modificardispontxt="diacmbmod1".$u;
															?>
																<tr>
																	<td>
																		<SELECT name="<?php echo($modificarhorastxt); ?>" id="<?php echo($modificarhorastxt); ?>">
																			<?php
																				for($i=1; $i<=12;$i++){
																					?>
																						<OPTION <?php if($data['hora']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
																					<?php
																				}
																			?>
																		</SELECT>									
																	</td>
																	<td>
																		<SELECT name="<?php echo($modificarmintxt); ?>" id="<?php echo($modificarmintxt); ?>">
																			<?php
																				for($i=0; $i<=59;$i++){
																					?>
																						<OPTION <?php if($data['minuto']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
																					<?php
																				}
																			?>
																		</SELECT>									
																	</td>
																	<td>
																		<SELECT name="<?php echo($modificarturnotxt); ?>" id="<?php echo($modificarturnotxt); ?>">
																			<OPTION <?php if($data['turno']=="PM"){ echo("SELECTED"); } ?> value="PM">PM</OPTION>
																			<OPTION <?php if($data['turno']=="AM"){ echo("SELECTED"); } ?> value="AM">AM</OPTION>
																		</SELECT>
																	</td>
																	<td>
																		<SELECT name="<?php echo($modificardispontxt); ?>" id="<?php echo($modificardispontxt); ?>">
																			<OPTION value="DISPONIBLE" <?php if($data['disponible']=="DISPONIBLE"){ echo("SELECTED"); }?>>DISPONIBLE</OPTION>
																			<OPTION value="AGOTADO" <?php if($data['disponible']=="AGOTADO"){ echo("SELECTED"); }?>>AGOTADO</OPTION>
																		</SELECT>
																	</td>
																	<td style="width:10px;">
																		
																	</td>
																	<td>
																		<input id="<?php echo($btnmodificarhoras); ?>" name="<?php echo($btnmodificarhoras); ?>" type="button" class="btn btn-small btn-success" 
																		onclick="<?php echo("agregarhorario('".$modificarhorastxt."','".$modificarmintxt."','".$modificarturnotxt."','".$data['ID']."','tabladehorarios1','".$data['fecha']."','$modificardispontxt','MODIFICAR');"); ?>" 
																		value="Editar"></input>															
																	</td>
																	<td style="width:5px;">
																		
																	</td>
																	<td>
																		<input id="<?php echo($btnmodificarhoras); ?>" name="<?php echo($btnmodificarhoras); ?>" type="button" class="btn btn-small btn-danger" 
																		onclick="<?php echo("agregarhorario('".$modificarhorastxt."','".$modificarmintxt."','".$modificarturnotxt."','".$data['ID']."','tabladehorarios1','".$data['fecha']."','$modificardispontxt','ELIMINAR');"); ?>" 
																		value="Eliminar"></input>															
																	</td>
																</tr>
																<tr>
																	<td style="height:5px;">
																		
																	</td>
																</tr>
																<?php
																$u++;
															}
															?>
														</table>
													<?php
												}
											}
										?>
									</div>
								</td>
							</tr>
							</table>
				</li>
				<li>
<input name="checkdia2" id="checkdia2" type="checkbox" onchange="cambiarDisplay2('dia2')" <?php echo($visto3); ?>><span id="titulodia2"><?php echo($diaStr3); ?></span>
							<table id="dia2" data-fechadiados="<?php echo($NuevaFecha3); ?>" style="<?php echo($peliculasNuevaFecha3); ?>">
							<tr>
								<td>
									<table>
										<tr>
											<td>
												<SELECT name="horacmb2" id="horacmb2">
													<?php
														for($i=1; $i<=12;$i++){
															?>
																<OPTION <?php if($_GET['hora']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
															<?php
														}
													?>
												</SELECT>									
											</td>
											<td>
												<SELECT name="minutocmb2" id="minutocmb2">
													<?php
														for($i=0; $i<=59;$i++){
															?>
																<OPTION <?php if($_GET['minuto']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
															<?php
														}
													?>
												</SELECT>									
											</td>
											<td>
												<SELECT name="turnocmb2" id="turnocmb2">
													<OPTION <?php //if($turno_cons=="PM"){ echo("SELECTED"); } ?>  value="PM">PM</OPTION>
													<OPTION <?php //if($turno_cons=="AM"){ echo("SELECTED"); } ?>  value="AM">AM</OPTION>
												</SELECT>
											</td>
											<td style="width:10px;">
												
											</td>
											<td>
												<SELECT name="discmb2" id="discmb2">
													<OPTION SELECTED>DISPONIBLE</OPTION>
													<OPTION value="AGOTADO">AGOTADO</OPTION>
												</SELECT>
											</td>
											<?php
												if(!empty($_GET['hash'])){
													$HASHCons=$_GET['hash'];
												}
												else{
													$HASHCons=$_SESSION['uniq_hash'];
												}
											
											?>
											<td>
												<input id="btnagregarhoras2" name="btnagregarhoras2" type="button" 
												onclick="<?php echo("agregarhorario('horacmb2','minutocmb2','turnocmb2','$HASHCons','tabladehorarios2','dia2','discmb2','AGREGAR');"); ?>" 
												class="btn btn-small btn-info" value="Agregar"></input>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr style="height:15px;">
								<td>
									
								</td>
							</tr>
							<tr>
								<td>
									<div id="tabladehorarios2" name="tabladehorarios2">
									<?php
											if(empty($_SESSION['uniq_hash'])){
												$HASH=$_GET['hash'];
											}
											else{
												if(empty($_GET['hash'])){
													$HASH=$_SESSION['uniq_hash'];	
												}
												else{
													$HASH=$_GET['hash'];
												}
											}
											$sqlog="SELECT * FROM horarios WHERE idtemp='$HASH' AND fecha='$NuevaFecha3' ORDER BY ID DESC";
											$pedidolog=mysql_query($sqlog,$conexion);
											echo(mysql_error());
											if($pedidolog){
												$filaslog=mysql_num_rows($pedidolog);
												if($filaslog>0){
													$u=0;
													?>
													<table>
														<tr>
															<td>
																Horarios
															</td>
														</tr>
													</table>
													<table>
													<?php
														while($data=mysql_fetch_array($pedidolog)){
															$btnmodificarhoras="btnmodificarhoras2".$u;
															$modificarhorastxt="modificarhorastxt2".$u;
															$modificarmintxt="modificarmintxt2".$u;
															$modificarturnotxt="modificarturnotxt2".$u;
															$modificardispontxt="diacmbmod2".$u;
															?>
																<tr>
																	<td>
																		<SELECT name="<?php echo($modificarhorastxt); ?>" id="<?php echo($modificarhorastxt); ?>">
																			<?php
																				for($i=1; $i<=12;$i++){
																					?>
																						<OPTION <?php if($data['hora']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
																					<?php
																				}
																			?>
																		</SELECT>									
																	</td>
																	<td>
																		<SELECT name="<?php echo($modificarmintxt); ?>" id="<?php echo($modificarmintxt); ?>">
																			<?php
																				for($i=0; $i<=59;$i++){
																					?>
																						<OPTION <?php if($data['minuto']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
																					<?php
																				}
																			?>
																		</SELECT>									
																	</td>
																	<td>
																		<SELECT name="<?php echo($modificarturnotxt); ?>" id="<?php echo($modificarturnotxt); ?>">
																			<OPTION <?php if($data['turno']=="PM"){ echo("SELECTED"); } ?> value="PM">PM</OPTION>
																			<OPTION <?php if($data['turno']=="AM"){ echo("SELECTED"); } ?> value="AM">AM</OPTION>
																		</SELECT>
																	</td>
																	<td>
																		<SELECT name="<?php echo($modificardispontxt); ?>" id="<?php echo($modificardispontxt); ?>">
																			<OPTION value="DISPONIBLE" <?php if($data['disponible']=="DISPONIBLE"){ echo("SELECTED"); }?>>DISPONIBLE</OPTION>
																			<OPTION value="AGOTADO" <?php if($data['disponible']=="AGOTADO"){ echo("SELECTED"); }?>>AGOTADO</OPTION>
																		</SELECT>
																	</td>
																	<td style="width:10px;">
																		
																	</td>
																	<td>
																		<input id="<?php echo($btnmodificarhoras); ?>" name="<?php echo($btnmodificarhoras); ?>" type="button" class="btn btn-small btn-success" 
																		onclick="<?php echo("agregarhorario('".$modificarhorastxt."','".$modificarmintxt."','".$modificarturnotxt."','".$data['ID']."','tabladehorarios2','".$data['fecha']."','$modificardispontxt','MODIFICAR');"); ?>" 
																		value="Editar"></input>															
																	</td>
																	<td style="width:5px;">
																		
																	</td>
																	<td>
																		<input id="<?php echo($btnmodificarhoras); ?>" name="<?php echo($btnmodificarhoras); ?>" type="button" class="btn btn-small btn-danger" 
																		onclick="<?php echo("agregarhorario('".$modificarhorastxt."','".$modificarmintxt."','".$modificarturnotxt."','".$data['ID']."','tabladehorarios2','".$data['fecha']."','$modificardispontxt','ELIMINAR');"); ?>" 
																		value="Eliminar"></input>															
																	</td>
																</tr>
																<tr>
																	<td style="height:5px;">
																		
																	</td>
																</tr>
																<?php
																$u++;
															}
															?>
														</table>
													<?php
												}
											}
										?>
									</div>
								</td>
							</tr>
							</table>
				</li>
				<li>
					<input name="checkdia3" id="checkdia3" type="checkbox" onchange="cambiarDisplay2('dia3')" <?php echo($visto4); ?>><span id="titulodia3"><?php echo($diaStr4); ?></span>
							<table id="dia3" data-fechadiatres="<?php echo($NuevaFecha4); ?>" style="<?php echo($peliculasNuevaFecha4); ?>">
							<tr>
								<td>
									<table>
										<tr>
											<td>
												<SELECT name="horacmb3" id="horacmb3">
													<?php
														for($i=1; $i<=12;$i++){
															?>
																<OPTION <?php if($_GET['hora']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
															<?php
														}
													?>
												</SELECT>									
											</td>
											<td>
												<SELECT name="minutocmb3" id="minutocmb3">
													<?php
														for($i=0; $i<=59;$i++){
															?>
																<OPTION <?php if($_GET['minuto']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
															<?php
														}
													?>
												</SELECT>									
											</td>
											<td>
												<SELECT name="turnocmb3" id="turnocmb3">
													<OPTION <?php //if($turno_cons=="PM"){ echo("SELECTED"); } ?>  value="PM">PM</OPTION>
													<OPTION <?php //if($turno_cons=="AM"){ echo("SELECTED"); } ?>  value="AM">AM</OPTION>
												</SELECT>
											</td>
											<td style="width:10px;">
												
											</td>
											<td>
												<SELECT name="discmb3" id="discmb3">
													<OPTION SELECTED>DISPONIBLE</OPTION>
													<OPTION value="AGOTADO">AGOTADO</OPTION>
												</SELECT>
											</td>
											<?php
												if(!empty($_GET['hash'])){
													$HASHCons=$_GET['hash'];
												}
												else{
													$HASHCons=$_SESSION['uniq_hash'];
												}
											
											?>
											<td>
												<input id="btnagregarhoras3" name="btnagregarhoras3" type="button" 
												onclick="<?php echo("agregarhorario('horacmb3','minutocmb3','turnocmb3','$HASHCons','tabladehorarios3','dia3','discmb3','AGREGAR');"); ?>" 
												class="btn btn-small btn-info" value="Agregar"></input>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr style="height:15px;">
								<td>
									
								</td>
							</tr>
							<tr>
								<td>
									<div id="tabladehorarios3" name="tabladehorarios3">
									<?php
											if(empty($_SESSION['uniq_hash'])){
												$HASH=$_GET['hash'];
											}
											else{
												if(empty($_GET['hash'])){
													$HASH=$_SESSION['uniq_hash'];	
												}
												else{
													$HASH=$_GET['hash'];
												}
											}
											$sqlog="SELECT * FROM horarios WHERE idtemp='$HASH' AND fecha='$NuevaFecha4' ORDER BY ID DESC";
											$pedidolog=mysql_query($sqlog,$conexion);
											echo(mysql_error());
											if($pedidolog){
												$filaslog=mysql_num_rows($pedidolog);
												if($filaslog>0){
													$u=0;
													?>
													<table>
														<tr>
															<td>
																Horarios
															</td>
														</tr>
													</table>
													<table>
													<?php
														while($data=mysql_fetch_array($pedidolog)){
															$btnmodificarhoras="btnmodificarhoras3".$u;
															$modificarhorastxt="modificarhorastxt3".$u;
															$modificarmintxt="modificarmintxt3".$u;
															$modificarturnotxt="modificarturnotxt3".$u;
															$modificardispontxt="diacmbmod3".$u;
															?>
																<tr>
																	<td>
																		<SELECT name="<?php echo($modificarhorastxt); ?>" id="<?php echo($modificarhorastxt); ?>">
																			<?php
																				for($i=1; $i<=12;$i++){
																					?>
																						<OPTION <?php if($data['hora']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
																					<?php
																				}
																			?>
																		</SELECT>									
																	</td>
																	<td>
																		<SELECT name="<?php echo($modificarmintxt); ?>" id="<?php echo($modificarmintxt); ?>">
																			<?php
																				for($i=0; $i<=59;$i++){
																					?>
																						<OPTION <?php if($data['minuto']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
																					<?php
																				}
																			?>
																		</SELECT>									
																	</td>
																	<td>
																		<SELECT name="<?php echo($modificarturnotxt); ?>" id="<?php echo($modificarturnotxt); ?>">
																			<OPTION <?php if($data['turno']=="PM"){ echo("SELECTED"); } ?> value="PM">PM</OPTION>
																			<OPTION <?php if($data['turno']=="AM"){ echo("SELECTED"); } ?> value="AM">AM</OPTION>
																		</SELECT>
																	</td>
																	<td>
																		<SELECT name="<?php echo($modificardispontxt); ?>" id="<?php echo($modificardispontxt); ?>">
																			<OPTION value="DISPONIBLE" <?php if($data['disponible']=="DISPONIBLE"){ echo("SELECTED"); }?>>DISPONIBLE</OPTION>
																			<OPTION value="AGOTADO" <?php if($data['disponible']=="AGOTADO"){ echo("SELECTED"); }?>>AGOTADO</OPTION>
																		</SELECT>
																	</td>
																	<td style="width:10px;">
																		
																	</td>
																	<td>
																		<input id="<?php echo($btnmodificarhoras); ?>" name="<?php echo($btnmodificarhoras); ?>" type="button" class="btn btn-small btn-success" 
																		onclick="<?php echo("agregarhorario('".$modificarhorastxt."','".$modificarmintxt."','".$modificarturnotxt."','".$data['ID']."','tabladehorarios3','".$data['fecha']."','$modificardispontxt','MODIFICAR');"); ?>" 
																		value="Editar"></input>															
																	</td>
																	<td style="width:5px;">
																		
																	</td>
																	<td>
																		<input id="<?php echo($btnmodificarhoras); ?>" name="<?php echo($btnmodificarhoras); ?>" type="button" class="btn btn-small btn-danger" 
																		onclick="<?php echo("agregarhorario('".$modificarhorastxt."','".$modificarmintxt."','".$modificarturnotxt."','".$data['ID']."','tabladehorarios3','".$data['fecha']."','$modificardispontxt','ELIMINAR');"); ?>" 
																		value="Eliminar"></input>															
																	</td>
																</tr>
																<tr>
																	<td style="height:5px;">
																		
																	</td>
																</tr>
																<?php
																$u++;
															}
															?>
														</table>
													<?php
												}
											}
										?>
									</div>
								</td>
							</tr>
							</table>
				</li>
				<li>
					<input name="checkdia4" id="checkdia4" type="checkbox" onchange="cambiarDisplay2('dia4')" <?php echo($visto5); ?>><span id="titulodia4"><?php echo($diaStr5); ?></span>
							<table id="dia4" data-fechadiacuatro="<?php echo($NuevaFecha5); ?>" style="<?php echo($peliculasNuevaFecha5); ?>">
							<tr>
								<td>
									<table>
										<tr>
											<td>
												<SELECT name="horacmb4" id="horacmb4">
													<?php
														for($i=1; $i<=12;$i++){
															?>
																<OPTION <?php if($_GET['hora']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
															<?php
														}
													?>
												</SELECT>									
											</td>
											<td>
												<SELECT name="minutocmb4" id="minutocmb4">
													<?php
														for($i=0; $i<=59;$i++){
															?>
																<OPTION <?php if($_GET['minuto']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
															<?php
														}
													?>
												</SELECT>									
											</td>
											<td>
												<SELECT name="turnocmb4" id="turnocmb4">
													<OPTION <?php //if($turno_cons=="PM"){ echo("SELECTED"); } ?>  value="PM">PM</OPTION>
													<OPTION <?php //if($turno_cons=="AM"){ echo("SELECTED"); } ?>  value="AM">AM</OPTION>
												</SELECT>
											</td>
											<td style="width:10px;">
												
											</td>
											<td>
												<SELECT name="discmb4" id="discmb4">
													<OPTION SELECTED>DISPONIBLE</OPTION>
													<OPTION value="AGOTADO">AGOTADO</OPTION>
												</SELECT>
											</td>
											<?php
												if(!empty($_GET['hash'])){
													$HASHCons=$_GET['hash'];
												}
												else{
													$HASHCons=$_SESSION['uniq_hash'];
												}
											
											?>
											<td>
												<input id="btnagregarhoras4" name="btnagregarhoras4" type="button" 
												onclick="<?php echo("agregarhorario('horacmb4','minutocmb4','turnocmb4','$HASHCons','tabladehorarios4','dia4','discmb4','AGREGAR');"); ?>" 
												class="btn btn-small btn-info" value="Agregar"></input>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr style="height:15px;">
								<td>
									
								</td>
							</tr>
							<tr>
								<td>
									<div id="tabladehorarios4" name="tabladehorarios4">
									<?php
											if(empty($_SESSION['uniq_hash'])){
												$HASH=$_GET['hash'];
											}
											else{
												if(empty($_GET['hash'])){
													$HASH=$_SESSION['uniq_hash'];	
												}
												else{
													$HASH=$_GET['hash'];
												}
											}
											$sqlog="SELECT * FROM horarios WHERE idtemp='$HASH' AND fecha='$NuevaFecha5' ORDER BY ID DESC";
											$pedidolog=mysql_query($sqlog,$conexion);
											echo(mysql_error());
											if($pedidolog){
												$filaslog=mysql_num_rows($pedidolog);
												if($filaslog>0){
													$u=0;
													?>
													<table>
														<tr>
															<td>
																Horarios
															</td>
														</tr>
													</table>
													<table>
													<?php
														while($data=mysql_fetch_array($pedidolog)){
															$btnmodificarhoras="btnmodificarhoras4".$u;
															$modificarhorastxt="modificarhorastxt4".$u;
															$modificarmintxt="modificarmintxt4".$u;
															$modificarturnotxt="modificarturnotxt4".$u;
															$modificardispontxt="diacmbmod4".$u;
															?>
																<tr>
																	<td>
																		<SELECT name="<?php echo($modificarhorastxt); ?>" id="<?php echo($modificarhorastxt); ?>">
																			<?php
																				for($i=1; $i<=12;$i++){
																					?>
																						<OPTION <?php if($data['hora']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
																					<?php
																				}
																			?>
																		</SELECT>									
																	</td>
																	<td>
																		<SELECT name="<?php echo($modificarmintxt); ?>" id="<?php echo($modificarmintxt); ?>">
																			<?php
																				for($i=0; $i<=59;$i++){
																					?>
																						<OPTION <?php if($data['minuto']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
																					<?php
																				}
																			?>
																		</SELECT>									
																	</td>
																	<td>
																		<SELECT name="<?php echo($modificarturnotxt); ?>" id="<?php echo($modificarturnotxt); ?>">
																			<OPTION <?php if($data['turno']=="PM"){ echo("SELECTED"); } ?> value="PM">PM</OPTION>
																			<OPTION <?php if($data['turno']=="AM"){ echo("SELECTED"); } ?> value="AM">AM</OPTION>
																		</SELECT>
																	</td>
																	<td>
																		<SELECT name="<?php echo($modificardispontxt); ?>" id="<?php echo($modificardispontxt); ?>">
																			<OPTION value="DISPONIBLE" <?php if($data['disponible']=="DISPONIBLE"){ echo("SELECTED"); }?>>DISPONIBLE</OPTION>
																			<OPTION value="AGOTADO" <?php if($data['disponible']=="AGOTADO"){ echo("SELECTED"); }?>>AGOTADO</OPTION>
																		</SELECT>
																	</td>
																	<td style="width:10px;">
																		
																	</td>
																	<td>
																		<input id="<?php echo($btnmodificarhoras); ?>" name="<?php echo($btnmodificarhoras); ?>" type="button" class="btn btn-small btn-success" 
																		onclick="<?php echo("agregarhorario('".$modificarhorastxt."','".$modificarmintxt."','".$modificarturnotxt."','".$data['ID']."','tabladehorarios4','".$data['fecha']."','$modificardispontxt','MODIFICAR');"); ?>" 
																		value="Editar"></input>															
																	</td>
																	<td style="width:5px;">
																		
																	</td>
																	<td>
																		<input id="<?php echo($btnmodificarhoras); ?>" name="<?php echo($btnmodificarhoras); ?>" type="button" class="btn btn-small btn-danger" 
																		onclick="<?php echo("agregarhorario('".$modificarhorastxt."','".$modificarmintxt."','".$modificarturnotxt."','".$data['ID']."','tabladehorarios4','".$data['fecha']."','$modificardispontxt','ELIMINAR');"); ?>" 
																		value="Eliminar"></input>															
																	</td>
																</tr>
																<tr>
																	<td style="height:5px;">
																		
																	</td>
																</tr>
																<?php
																$u++;
															}
															?>
														</table>
													<?php
												}
											}
										?>
									</div>
								</td>
							</tr>
							</table>
				</li>
				<li>
<input name="checkdia5" id="checkdia5" type="checkbox" onchange="cambiarDisplay2('dia5')" <?php echo($visto6); ?>><span id="titulodia5"><?php echo($diaStr6); ?></span>
							<table id="dia5" data-fechadiacinco="<?php echo($NuevaFecha6); ?>" style="<?php echo($peliculasNuevaFecha6); ?>">
							<tr>
								<td>
									<table>
										<tr>
											<td>
												<SELECT name="horacmb5" id="horacmb5">
													<?php
														for($i=1; $i<=12;$i++){
															?>
																<OPTION <?php if($_GET['hora']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
															<?php
														}
													?>
												</SELECT>									
											</td>
											<td>
												<SELECT name="minutocmb5" id="minutocmb5">
													<?php
														for($i=0; $i<=59;$i++){
															?>
																<OPTION <?php if($_GET['minuto']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
															<?php
														}
													?>
												</SELECT>									
											</td>
											<td>
												<SELECT name="turnocmb5" id="turnocmb5">
													<OPTION <?php //if($turno_cons=="PM"){ echo("SELECTED"); } ?>  value="PM">PM</OPTION>
													<OPTION <?php //if($turno_cons=="AM"){ echo("SELECTED"); } ?>  value="AM">AM</OPTION>
												</SELECT>
											</td>
											<td style="width:10px;">
												
											</td>
											<?php
												if(!empty($_GET['hash'])){
													$HASHCons=$_GET['hash'];
												}
												else{
													$HASHCons=$_SESSION['uniq_hash'];
												}
											
											?>
											<td>
												<SELECT name="discmb5" id="discmb5">
													<OPTION SELECTED>DISPONIBLE</OPTION>
													<OPTION value="AGOTADO">AGOTADO</OPTION>
												</SELECT>
											</td>
											<td>
												<input id="btnagregarhoras" name="btnagregarhoras" type="button" 
												onclick="<?php echo("agregarhorario('horacmb5','minutocmb5','turnocmb5','$HASHCons','tabladehorarios5','dia5','discmb5','AGREGAR');"); ?>" 
												class="btn btn-small btn-info" value="Agregar"></input>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr style="height:15px;">
								<td>
									
								</td>
							</tr>
							<tr>
								<td width="250">
									<div id="tabladehorarios5" name="tabladehorarios5">
									<?php
											if(empty($_SESSION['uniq_hash'])){
												$HASH=$_GET['hash'];
											}
											else{
												if(empty($_GET['hash'])){
													$HASH=$_SESSION['uniq_hash'];	
												}
												else{
													$HASH=$_GET['hash'];
												}
											}
											$sqlog="SELECT * FROM horarios WHERE idtemp='$HASH' AND fecha='$NuevaFecha6' ORDER BY ID DESC";
											$pedidolog=mysql_query($sqlog,$conexion);
											echo(mysql_error());
											if($pedidolog){
												$filaslog=mysql_num_rows($pedidolog);
												if($filaslog>0){
													$u=0;
													?>
													<table>
														<tr>
															<td>
																Horarios
															</td>
														</tr>
													</table>
													<table>
													<?php
														while($data=mysql_fetch_array($pedidolog)){
															$btnmodificarhoras="btnmodificarhoras5".$u;
															$modificarhorastxt="modificarhorastxt5".$u;
															$modificarmintxt="modificarmintxt5".$u;
															$modificarturnotxt="modificarturnotxt5".$u;
															$modificardispontxt="diacmbmod5".$u;
															?>
																<tr>
																	<td>
																		<SELECT name="<?php echo($modificarhorastxt); ?>" id="<?php echo($modificarhorastxt); ?>">
																			<?php
																				for($i=1; $i<=12;$i++){
																					?>
																						<OPTION <?php if($data['hora']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
																					<?php
																				}
																			?>
																		</SELECT>									
																	</td>
																	<td>
																		<SELECT name="<?php echo($modificarmintxt); ?>" id="<?php echo($modificarmintxt); ?>">
																			<?php
																				for($i=0; $i<=59;$i++){
																					?>
																						<OPTION <?php if($data['minuto']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
																					<?php
																				}
																			?>
																		</SELECT>									
																	</td>
																	<td>
																		<SELECT name="<?php echo($modificarturnotxt); ?>" id="<?php echo($modificarturnotxt); ?>">
																			<OPTION <?php if($data['turno']=="PM"){ echo("SELECTED"); } ?> value="PM">PM</OPTION>
																			<OPTION <?php if($data['turno']=="AM"){ echo("SELECTED"); } ?> value="AM">AM</OPTION>
																		</SELECT>
																	</td>
																	<td>
																		<SELECT name="<?php echo($modificardispontxt); ?>" id="<?php echo($modificardispontxt); ?>">
																			<OPTION value="DISPONIBLE" <?php if($data['disponible']=="DISPONIBLE"){ echo("SELECTED"); }?>>DISPONIBLE</OPTION>
																			<OPTION value="AGOTADO" <?php if($data['disponible']=="AGOTADO"){ echo("SELECTED"); }?>>AGOTADO</OPTION>
																		</SELECT>
																	</td>
																	<td style="width:10px;">
																		
																	</td>
																	<td>
																		<input id="<?php echo($btnmodificarhoras); ?>" name="<?php echo($btnmodificarhoras); ?>" type="button" class="btn btn-small btn-success" 
																		onclick="<?php echo("agregarhorario('".$modificarhorastxt."','".$modificarmintxt."','".$modificarturnotxt."','".$data['ID']."','tabladehorarios5','".$data['fecha']."','$modificardispontxt','MODIFICAR');"); ?>" 
																		value="Editar"></input>															
																	</td>
																	<td style="width:5px;">
																		
																	</td>
																	<td>
																		<input id="<?php echo($btnmodificarhoras); ?>" name="<?php echo($btnmodificarhoras); ?>" type="button" class="btn btn-small btn-danger" 
																		onclick="<?php echo("agregarhorario('".$modificarhorastxt."','".$modificarmintxt."','".$modificarturnotxt."','".$data['ID']."','tabladehorarios5','".$data['fecha']."','$modificardispontxt','ELIMINAR');"); ?>" 
																		value="Eliminar"></input>															
																	</td>
																</tr>
																<tr>
																	<td style="height:5px;">
																		
																	</td>
																</tr>
																<?php
																$u++;
															}
															?>
														</table>
													<?php
												}
											}
										?>
									</div>
								</td>
							</tr>
							</table>
				</li>
				<li>
							<input name="checkdia6" id="checkdia6" type="checkbox" onchange="cambiarDisplay2('dia6')" <?php echo($visto7); ?>><span id="titulodia6"><?php echo($diaStr7); ?></span>
							<table id="dia6" data-fechadiaseis="<?php echo($NuevaFecha7); ?>" style="<?php echo($peliculasNuevaFecha7); ?>">
							<tr>
								<td>
									<table>
										<tr>
											<td>
												<SELECT name="horacmb6" id="horacmb6">
													<?php
														for($i=1; $i<=12;$i++){
															?>
																<OPTION <?php if($_GET['hora']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
															<?php
														}
													?>
												</SELECT>									
											</td>
											<td>
												<SELECT name="minutocmb6" id="minutocmb6">
													<?php
														for($i=0; $i<=59;$i++){
															?>
																<OPTION <?php if($_GET['minuto']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
															<?php
														}
													?>
												</SELECT>									
											</td>
											<td>
												<SELECT name="turnocmb6" id="turnocmb6">
													<OPTION <?php //if($turno_cons=="PM"){ echo("SELECTED"); } ?>  value="PM">PM</OPTION>
													<OPTION <?php //if($turno_cons=="AM"){ echo("SELECTED"); } ?>  value="AM">AM</OPTION>
												</SELECT>
											</td>
											<td style="width:10px;">
												
											</td>
											<td>
												<SELECT name="discmb6" id="discmb6">
													<OPTION SELECTED>DISPONIBLE</OPTION>
													<OPTION value="AGOTADO">AGOTADO</OPTION>
												</SELECT>
											</td>
											<?php
												if(!empty($_GET['hash'])){
													$HASHCons=$_GET['hash'];
												}
												else{
													$HASHCons=$_SESSION['uniq_hash'];
												}
											
											?>
											<td>
												<input id="btnagregarhoras6" name="btnagregarhoras6" type="button" 
												onclick="<?php echo("agregarhorario('horacmb6','minutocmb6','turnocmb6','$HASHCons','tabladehorarios6','dia6','discmb6','AGREGAR');"); ?>" 
												class="btn btn-small btn-info" value="Agregar"></input>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr style="height:15px;">
								<td>
									
								</td>
							</tr>
							<tr>
								<td>
									<div id="tabladehorarios6" name="tabladehorarios6">
									<?php
											if(empty($_SESSION['uniq_hash'])){
												$HASH=$_GET['hash'];
											}
											else{
												if(empty($_GET['hash'])){
													$HASH=$_SESSION['uniq_hash'];	
												}
												else{
													$HASH=$_GET['hash'];
												}
											}
											$sqlog="SELECT * FROM horarios WHERE idtemp='$HASH' AND fecha='$NuevaFecha7' ORDER BY ID DESC";
											$pedidolog=mysql_query($sqlog,$conexion);
											echo(mysql_error());
											if($pedidolog){
												$filaslog=mysql_num_rows($pedidolog);
												if($filaslog>0){
													$u=0;
													?>
													<table>
														<tr>
															<td>
																Horarios
															</td>
														</tr>
													</table>
													<table>
													<?php
														while($data=mysql_fetch_array($pedidolog)){
															$btnmodificarhoras="btnmodificarhoras6".$u;
															$modificarhorastxt="modificarhorastxt6".$u;
															$modificarmintxt="modificarmintxt6".$u;
															$modificarturnotxt="modificarturnotxt6".$u;
															$modificardispontxt="diacmbmod6".$u;
															?>
																<tr>
																	<td>
																		<SELECT name="<?php echo($modificarhorastxt); ?>" id="<?php echo($modificarhorastxt); ?>">
																			<?php
																				for($i=1; $i<=12;$i++){
																					?>
																						<OPTION <?php if($data['hora']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
																					<?php
																				}
																			?>
																		</SELECT>									
																	</td>
																	<td>
																		<SELECT name="<?php echo($modificarmintxt); ?>" id="<?php echo($modificarmintxt); ?>">
																			<?php
																				for($i=0; $i<=59;$i++){
																					?>
																						<OPTION <?php if($data['minuto']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
																					<?php
																				}
																			?>
																		</SELECT>									
																	</td>
																	<td>
																		<SELECT name="<?php echo($modificarturnotxt); ?>" id="<?php echo($modificarturnotxt); ?>">
																			<OPTION <?php if($data['turno']=="PM"){ echo("SELECTED"); } ?> value="PM">PM</OPTION>
																			<OPTION <?php if($data['turno']=="AM"){ echo("SELECTED"); } ?> value="AM">AM</OPTION>
																		</SELECT>
																	</td>
																	<td>
																		<SELECT name="<?php echo($modificardispontxt); ?>" id="<?php echo($modificardispontxt); ?>">
																			<OPTION value="DISPONIBLE" <?php if($data['disponible']=="DISPONIBLE"){ echo("SELECTED"); }?>>DISPONIBLE</OPTION>
																			<OPTION value="AGOTADO" <?php if($data['disponible']=="AGOTADO"){ echo("SELECTED"); }?>>AGOTADO</OPTION>
																		</SELECT>
																	</td>
																	<td style="width:10px;">
																		
																	</td>
																	<td>
																		<input id="<?php echo($btnmodificarhoras); ?>" name="<?php echo($btnmodificarhoras); ?>" type="button" class="btn btn-small btn-success" 
																		onclick="<?php echo("agregarhorario('".$modificarhorastxt."','".$modificarmintxt."','".$modificarturnotxt."','".$data['ID']."','tabladehorarios6','".$data['fecha']."','$modificardispontxt','MODIFICAR');"); ?>" 
																		value="Editar"></input>															
																	</td>
																	<td style="width:5px;">
																		
																	</td>
																	<td>
																		<input id="<?php echo($btnmodificarhoras); ?>" name="<?php echo($btnmodificarhoras); ?>" type="button" class="btn btn-small btn-danger" 
																		onclick="<?php echo("agregarhorario('".$modificarhorastxt."','".$modificarmintxt."','".$modificarturnotxt."','".$data['ID']."','tabladehorarios6','".$data['fecha']."','$modificardispontxt','ELIMINAR');"); ?>" 
																		value="Eliminar"></input>															
																	</td>
																</tr>
																<tr>
																	<td style="height:5px;">
																		
																	</td>
																</tr>
																<?php
																$u++;
															}
															?>
														</table>
													<?php
												}
											}
										?>
									</div>
								</td>
							</tr>
							</table>
				</li>
				<li>
					<input name="checkdia7" id="checkdia7" type="checkbox" onchange="cambiarDisplay2('dia7')" <?php echo($visto8); ?>><span id="titulodia7"><?php echo($diaStr8); ?></span>
							<table id="dia7" data-fechadiasiete="<?php echo($NuevaFecha8); ?>" style="<?php echo($peliculasNuevaFecha8); ?>">
							<tr>
								<td>
									<table>
										<tr>
											<td>
												<SELECT name="horacmb7" id="horacmb7">
													<?php
														for($i=1; $i<=12;$i++){
															?>
																<OPTION <?php if($_GET['hora']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
															<?php
														}
													?>
												</SELECT>									
											</td>
											<td>
												<SELECT name="minutocmb7" id="minutocmb7">
													<?php
														for($i=0; $i<=59;$i++){
															?>
																<OPTION <?php if($_GET['minuto']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
															<?php
														}
													?>
												</SELECT>									
											</td>
											<td>
												<SELECT name="turnocmb7" id="turnocmb7">
													<OPTION <?php //if($turno_cons=="PM"){ echo("SELECTED"); } ?>  value="PM">PM</OPTION>
													<OPTION <?php //if($turno_cons=="AM"){ echo("SELECTED"); } ?>  value="AM">AM</OPTION>
												</SELECT>
											</td>
											<td style="width:10px;">
												
											</td>
											<td>
												<SELECT name="discmb7" id="discmb7">
													<OPTION SELECTED>DISPONIBLE</OPTION>
													<OPTION value="AGOTADO">AGOTADO</OPTION>
												</SELECT>
											</td>
											<?php
												if(!empty($_GET['hash'])){
													$HASHCons=$_GET['hash'];
												}
												else{
													$HASHCons=$_SESSION['uniq_hash'];
												}
											
											?>
											<td>
												<input id="btnagregarhoras7" name="btnagregarhoras7" type="button" 
												onclick="<?php echo("agregarhorario('horacmb7','minutocmb7','turnocmb7','$HASHCons','tabladehorarios7','dia7','discmb7','AGREGAR');"); ?>" 
												class="btn btn-small btn-info" value="Agregar"></input>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr style="height:15px;">
								<td>
									
								</td>
							</tr>
							<tr>
								<td>
									<div id="tabladehorarios7" name="tabladehorarios7">
									<?php
											if(empty($_SESSION['uniq_hash'])){
												$HASH=$_GET['hash'];
											}
											else{
												if(empty($_GET['hash'])){
													$HASH=$_SESSION['uniq_hash'];	
												}
												else{
													$HASH=$_GET['hash'];
												}
											}
											$sqlog="SELECT * FROM horarios WHERE idtemp='$HASH' AND fecha='$NuevaFecha8' ORDER BY ID DESC";
											$pedidolog=mysql_query($sqlog,$conexion);
											echo(mysql_error());
											if($pedidolog){
												$filaslog=mysql_num_rows($pedidolog);
												if($filaslog>0){
													$u=0;
													?>
													<table>
														<tr>
															<td>
																Horarios
															</td>
														</tr>
													</table>
													<table>
													<?php
														while($data=mysql_fetch_array($pedidolog)){
															$btnmodificarhoras="btnmodificarhoras7".$u;
															$modificarhorastxt="modificarhorastxt7".$u;
															$modificarmintxt="modificarmintxt7".$u;
															$modificarturnotxt="modificarturnotxt7".$u;
															$modificardispontxt="diacmbmod7".$u;
															?>
																<tr>
																	<td>
																		<SELECT name="<?php echo($modificarhorastxt); ?>" id="<?php echo($modificarhorastxt); ?>">
																			<?php
																				for($i=1; $i<=12;$i++){
																					?>
																						<OPTION <?php if($data['hora']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
																					<?php
																				}
																			?>
																		</SELECT>									
																	</td>
																	<td>
																		<SELECT name="<?php echo($modificarmintxt); ?>" id="<?php echo($modificarmintxt); ?>">
																			<?php
																				for($i=0; $i<=59;$i++){
																					?>
																						<OPTION <?php if($data['minuto']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
																					<?php
																				}
																			?>
																		</SELECT>									
																	</td>
																	<td>
																		<SELECT name="<?php echo($modificarturnotxt); ?>" id="<?php echo($modificarturnotxt); ?>">
																			<OPTION <?php if($data['turno']=="PM"){ echo("SELECTED"); } ?> value="PM">PM</OPTION>
																			<OPTION <?php if($data['turno']=="AM"){ echo("SELECTED"); } ?> value="AM">AM</OPTION>
																		</SELECT>
																	</td>
																	<td>
																		<SELECT name="<?php echo($modificardispontxt); ?>" id="<?php echo($modificardispontxt); ?>">
																			<OPTION value="DISPONIBLE" <?php if($data['disponible']=="DISPONIBLE"){ echo("SELECTED"); }?>>DISPONIBLE</OPTION>
																			<OPTION value="AGOTADO" <?php if($data['disponible']=="AGOTADO"){ echo("SELECTED"); }?>>AGOTADO</OPTION>
																		</SELECT>
																	</td>
																	<td style="width:10px;">
																		
																	</td>
																	<td>
																		<input id="<?php echo($btnmodificarhoras); ?>" name="<?php echo($btnmodificarhoras); ?>" type="button" class="btn btn-small btn-success" 
																		onclick="<?php echo("agregarhorario('".$modificarhorastxt."','".$modificarmintxt."','".$modificarturnotxt."','".$data['ID']."','tabladehorarios7','".$data['fecha']."','$modificardispontxt','MODIFICAR');"); ?>" 
																		value="Editar"></input>															
																	</td>
																	<td style="width:5px;">
																		
																	</td>
																	<td>
																		<input id="<?php echo($btnmodificarhoras); ?>" name="<?php echo($btnmodificarhoras); ?>" type="button" class="btn btn-small btn-danger" 
																		onclick="<?php echo("agregarhorario('".$modificarhorastxt."','".$modificarmintxt."','".$modificarturnotxt."','".$data['ID']."','tabladehorarios7','".$data['fecha']."','$modificardispontxt','ELIMINAR');"); ?>" 
																		value="Eliminar"></input>															
																	</td>
																</tr>
																<tr>
																	<td style="height:5px;">
																		
																	</td>
																</tr>
																<?php
																$u++;
															}
															?>
														</table>
													<?php
												}
											}
										?>
									</div>
								</td>
							</tr>
							</table>
				</li>
			</ul>
			<?php
			}
			?>
				<table>
					<tr>
						<td style="height:15px;"></td>
					</tr>
					<tr>
						<td>
							<input id="btnprocesar" name="btnprocesar" type="submit" class="btn btn-large btn-primary" value="Procesar"></input>
						</td>
					</tr>
					<tr>
						<td style="height:65px;"></td>
					</tr>
				</table>
		</div>
	</form>
</div>