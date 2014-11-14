<?php
	session_start();
	setlocale(LC_ALL,"es_ES");
	date_default_timezone_set('America/Caracas');
	require_once('conf/config.conf.php');
	require_once('libs/op_mysql.class.php');
	$dbn=new op_mysql();
	$dbn->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	$dbn2=new op_mysql();
	$dbn2->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	$dbn3=new op_mysql();
	$dbn3->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	$dbn4=new op_mysql();
	$dbn4->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	$dbn5=new op_mysql();
	$dbn5->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	$dbn6=new op_mysql();
	$dbn6->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	$dbn7=new op_mysql();
	$dbn7->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	$dbn8=new op_mysql();
	$dbn8->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	$dbn9=new op_mysql();
	$dbn9->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	$sqltimezone="SET time_zone = '-04:30'";
	$dbn->QuerySQL($sqltimezone);
	$tiempoporpag=5*pow(10,3);
	//$sqlsel="SELECT horarios.fecha FROM horarios,peliculas WHERE horarios.fecha=CURDATE() AND peliculas.ID=horarios.ID AND peliculas.categoria='CINE' GROUP BY peliculas.ID ORDER BY peliculas.ID";
	$sqlsel="SELECT horarios.fecha, horarios.idpelicula, peliculas.titulo FROM horarios,peliculas WHERE horarios.fecha=CURDATE() AND peliculas.ID=horarios.idpelicula AND peliculas.categoria='CINE' GROUP BY peliculas.ID ORDER BY peliculas.ID";
	if($dbn->QuerySQL($sqlsel)==0){
		$numpeliculas_cine=$dbn->getFilas();
		if($numpeliculas_cine>0){
			$datos=$dbn->getData();
			$total_paginas_cine=(int)ceil(($numpeliculas_cine/6));
			//echo($numpeliculas_cine);
			//numero de M.Seg. * TotalDePaginas
			$tiempo_cine=$tiempoporpag * $total_paginas_cine;
		}
		else{
			$tiempo_cine=2000;
		}
	}
	//$sqlsel="SELECT * FROM peliculas,horarios WHERE horarios.fecha=CURDATE() AND peliculas.categoria='TEATRO' GROUP BY peliculas.ID ORDER BY peliculas.ID";
	$sqlsel="SELECT horarios.fecha, horarios.idpelicula, peliculas.titulo FROM horarios,peliculas WHERE horarios.fecha=CURDATE() AND peliculas.ID=horarios.idpelicula AND peliculas.categoria='TEATRO' GROUP BY peliculas.ID ORDER BY peliculas.ID";
	if($dbn->QuerySQL($sqlsel)==0){
		$numpeliculas_teatro=$dbn->getFilas();
		if($numpeliculas_teatro>0){
			$datos=$dbn->getData();
			$total_paginas_teatro=(int)ceil(($numpeliculas_teatro/6));
			//numero de M.Seg. * TotalDePaginas
			$tiempo_teatro=$tiempoporpag * $total_paginas_teatro;
		}
		else{
			$tiempo_teatro=2000;
		}
	}
	$dias = array("Domingo","Lunes","Martes","Mi&eacute;rcoles","Jueves","Viernes","S&aacute;bado");
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	//echo($numpeliculas_teatro." ".$numpeliculas_cine);
?>
<!DOCTYPE html>
<html class="ui-mobile">
	<head>
		<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
		<link href="libs/jquery.mobile-1.4.4/jquery.mobile-1.4.4.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet" type="text/css">
		<script src="libs/jquery-2.1.1.js"></script>
		<script src="libs/jquery.mobile-1.4.4/jquery.mobile-1.4.4.js"></script>
		<title>Cartelera Virtual</title>
		<script tyle="text/javascript">
			$(document).ready(function(){
				$('#wrapper1').load('http://xumbadevenezuela.com/entorno_cinetv_app/mods/carteleracine.php',function(){
					$('#wrapper1').trigger('create');
				});
				$('#wrapper2').load('http://xumbadevenezuela.com/entorno_cinetv_app/mods/cartelerateatro.php',function(){
					$('#wrapper2').trigger('create');
				});
			});
		</script>
	</head>
	<body>
		<div id="CarteleraDelCine" data-role="page" style="background: #000;"> 
			<div data-role="header" data-position="fixed" data-theme="b">
				<h1>CARTELERA VIRTUAL</h1>
			</div> 
			<div data-role="content" id="wrapper1"></div> 
			<div data-role="footer" data-theme="b" data-position="fixed">
				<h1>
					Dise&ntilde;o y programaci&oacute;n Xumba de Venezuela 2014
				</h1>
			</div> 
		</div>
		<div id="CarteleraDelTeatro" data-role="page" style="background: #000;"> 
			<div data-role="header" data-position="fixed" data-theme="b">
				<h1>CARTELERA VIRTUAL</h1>
			</div> 
			<div data-role="content" id="wrapper2"></div> 
			<div data-role="footer" data-theme="b" data-position="fixed">
				<h1>
					Dise&ntilde;o y programaci&oacute;n Xumba de Venezuela 2014
				</h1>
			</div> 
		</div>
	</body>
</html>