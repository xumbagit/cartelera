<?php
	require_once('../conf/config.conf.php');
	require_once('../libs/op_mysql.class.php');
	$dbn=new op_mysql();
	$dbn->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	$dbn2=new op_mysql();
	$dbn2->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	$dbn3=new op_mysql();
	$dbn3->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	$dbn4=new op_mysql();
	$dbn4->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
//Establecer el tiempo actual en MySQL
	$sqltimezone="SET time_zone = '-04:30'";
//Establecer el tiempo actual en PHP
	date_default_timezone_set('America/Caracas');
	$dbn->QuerySQL($sqltimezone);

	if($_POST['checkfecha']=="true"){
		$dias = array("Domingo","Lunes","Martes","Mi&eacute;rcoles","Jueves","Viernes","S&aacute;bado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		echo(utf8_encode(ucwords(strtolower(strftime($dias[date('w')]." %d "))))."de ".utf8_encode(ucwords(strtolower(strftime($meses[date('n')-1]))))." / ");
	}

	if($_POST['chekarpeliculas']=="true"){
		//$sqlsel="SELECT MINUTE(horamilitar - CURTIME()) AS TimeDiff, horamilitar,ID,horacompleta FROM horarios WHERE MINUTE(horamilitar - CURTIME())>0 AND MINUTE(horamilitar - CURTIME())<=20 AND HOUR(NOW())<HOUR(horamilitar)";
		$sqlsel="SELECT TIME(NOW()) AS ahora,HOUR(TIME(NOW())) AS hahora,HOUR(horamilitar) AS hpeli,MINUTE(horamilitar) AS mpeli,MINUTE(TIME(NOW())) AS mahora,MINUTE(TIMEDIFF(TIME(NOW()),TIME(horamilitar))) AS DiffTime, HOUR(horamilitar) AS horapeli, HOUR(NOW()) AS hahora,MINUTE(TIMEDIFF(TIME(NOW()),TIME(ADDTIME(TIME(horamilitar),'0:09:00')))) AS DiffTime_min, MINUTE(TIME(NOW())) AS mahora, MINUTE(TIME(horamilitar)) AS mpeli, horamilitar,ID,horacompleta FROM horarios ORDER BY ID ASC";
		if($dbn->QuerySQL($sqlsel)==0){
			if($dbn->getFilas()>0){
				$u=0;
				//$ids=array();
				$cadenaC="";
				while($data=$dbn->getData()){
					$horapeli=intval($data['hpeli']);
					$hahora=intval($data['hahora']);
					$mpeli=intval($data['mpeli']);
					$mahora=intval($data['mahora']);
					$DiffTime_min=intval($data['DiffTime_min']);
					$DiffTime=intval($data['DiffTime']);
					$IDhorario=intval($data['ID']);
					if($horapeli==$hahora || ($hahora==($horapeli-1) && $mahora>30 && $mpeli<30) || ($hahora==($horapeli-1) && $mahora>30 && $mpeli<30)){
						//if($horapeli==$hahora && $mahora<=$mpeli || $hahora==($horapeli-1) && $mahora<=$mpeli){
							if($DiffTime>=0 && $DiffTime<=10 || $DiffTime_min>=0 && $DiffTime_min<=10){
								$cadenaC.="blink_".$IDhorario.",";
							}
						//}
					}
				}
				if($cadenaC!=''){
					echo($cadenaC);
				}
			}
		}
	}
	
	if($_POST['eliminarhorarios']=="true"){
		$sqlsel="SELECT horamilitar,ID,horacompleta,MINUTE(TIMEDIFF(TIME(NOW()),TIME(horamilitar))) AS DiffTime,MINUTE(TIMEDIFF(TIME(NOW()),TIME(ADDTIME(TIME(horamilitar),'0:10:00')))) AS DiffTime_min, HOUR(TIME(horamilitar)) AS horapeli, HOUR(TIME(NOW())) AS hahora, MINUTE(TIME(NOW())) AS mahora, MINUTE(TIME(horamilitar)) AS mpeli FROM horarios";
		if($dbn->QuerySQL($sqlsel)==0){
			if($dbn->getFilas()>0){
				//echo("SI HAY REGISTROS QUE MOSTRAR");
				while($data2=$dbn->getData()){
					$horapeli=intval($data2['horapeli']);
					$hahora=intval($data2['hahora']);
					$mpeli=intval($data2['mpeli']);
					$mahora=intval($data2['mahora']);
					$strminutos=intval($data2['DiffTime']);
					$elim_horario=intval($data2['DiffTime_min']);
					//$cadenaN.="HAHORA: ".$hahora.","."HORAPELI: ".$horapeli."STRMINUTOS: ".$strminutos."MPELI: ".$mpeli."MAHORA: ".$mahora;
					
					// if($elim_horario==0){
						// $cadenaN.="elim3_".$data2['ID'].",blink_".$data2['ID'].",elim5_".$data2['ID'].",";
					// }
					
					if($hahora>$horapeli){
						$cadenaN.="elim3_".$data2['ID'].",blink_".$data2['ID'].",elim5_".$data2['ID'].",";
					}
					if(($hahora==$horapeli && $mahora>($mpeli+10))){
						$cadenaN.="elim3_".$data2['ID'].",blink_".$data2['ID'].",elim5_".$data2['ID'].",";
					}
				}
				echo($cadenaN);
			}
			else{
				//echo("NO HAY REGISTROS QUE MOSTRAR");
			}
		}
	}
	
	if($_POST['horariosagotados']=="true"){
		$sqlsel="SELECT disponible,horamilitar,ID,horacompleta,MINUTE(TIMEDIFF(TIME(NOW()),TIME(horamilitar))) AS DiffTime, HOUR(TIME(horamilitar)) AS horapeli, HOUR(TIME(NOW())) AS hahora, MINUTE(TIME(NOW())) AS mahora, MINUTE(TIME(horamilitar)) AS mpeli FROM horarios";
		if($dbn->QuerySQL($sqlsel)==0){
			if($dbn->getFilas()>0){
				//echo("SI HAY REGISTROS QUE MOSTRAR");
				while($data2=$dbn->getData()){
					$horapeli=intval($data2['horapeli']);
					$hahora=intval($data2['hahora']);
					$mpeli=intval($data2['mpeli']);
					$mahora=intval($data2['mahora']);
					$strminutos=intval($data2['DiffTime']);
					if($data2['disponible']=="AGOTADO"){
						if($hahora<$horapeli){
							$cadenaN.="elim5_".$data2['ID'].",";
						}
						if(($hahora==$horapeli && $mahora>($mpeli+6))){
							$cadenaN.="elim5_".$data2['ID'].",";
						}
					}
				}
				echo($cadenaN);
			}
			else{
				//echo("NO HAY REGISTROS QUE MOSTRAR");
			}
		}
	}
// if($_POST['actualizarhor']=="true"){
	// $dbn=new op_mysql();
	// $dbn->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	// $dbn2=new op_mysql();
	// $dbn2->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	// $dbn3=new op_mysql();
	// $dbn3->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	// $dbn4=new op_mysql();
	// $dbn4->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	// $peliculas=array();
	// $i=0;
	// //$condic2="SELECT peliculas.ID as IDpeli, horarios.ID as IDHora,titulo,descrip,sala,censura,precio FROM peliculas,horarios WHERE horarios.fecha=CURDATE() AND peliculas.ID=horarios.idpelicula AND peliculas.categoria='CINE' GROUP BY peliculas.ID ORDER BY peliculas.ID DESC LIMIT 0,4";
	// $sqlsel="SELECT peliculas.ID as IDpeli, horarios.ID as IDHora,titulo,descrip,sala,censura,precio FROM peliculas,horarios WHERE horarios.fecha=CURDATE() AND peliculas.ID=horarios.idpelicula AND HOUR(TIME(NOW()))<=HOUR(TIME(horamilitar)) GROUP BY peliculas.ID ORDER BY RAND() LIMIT 1";
	// if($dbn->QuerySQL($sqlsel)==0){
		// $numpeliculas_cine=$dbn->getFilas();
		// if($numpeliculas_cine>0){
			// $strhtml="";
			// $datos=$dbn->getData();
			// $IDpelirandom=$datos["IDpeli"];
			// $nomcontpelicula="Slide_ID".$IDpelirandom;
			// $condic2="SELECT peliculas.ID as IDpeli, horarios.ID as IDHora, horarios.horamilitar as Hmilitarc, horarios.horaM as Hmilitar,MINUTE(TIMEDIFF(TIME(NOW()),TIME(horamilitar))) AS DiffTime,titulo,descrip,sala,censura,categoria,precio FROM peliculas,horarios WHERE horarios.fecha=CURDATE() AND peliculas.ID='$IDpelirandom' GROUP BY peliculas.ID ORDER BY peliculas.ID DESC LIMIT 1";
			// if($dbn2->QuerySQL($condic2)==0){
				// if($dbn2->getFilas()>0){
					// $i=0;
					// while($data=$dbn2->getData()){
						// $nomcontenedor="Slidepel".$i;
						// $nomcontpelicula="Slide_ID".$data['IDpeli'];
						// //$sql="SELECT * FROM horarios WHERE idpelicula='".$data['ID']."' ORDER BY HOUR(horamilitar) ASC";
						// //$sqlq3="SELECT * FROM horarios WHERE idpelicula='".$data['IDpeli']."' AND HOUR(TIME(NOW()))<=HOUR(TIME(horamilitar)) AND fecha=CURDATE() ORDER BY HOUR(horamilitar) ASC";
						// $sqlq3="SELECT * FROM horarios WHERE idpelicula='".$data['IDpeli']."' AND fecha=CURDATE() ORDER BY HOUR(horamilitar) ASC";
						// $dbn3->QuerySQL($sqlq3);
						// $filasu=$dbn3->getFilas();
						// if($filasu>0){
							// $strhtml.="<div class=\"nombre\">";
							// $strhtml.="<div class=\"principal\">".strip_tags($data['titulo'])."</div>";
							// $strhtml.="<div class=\"sub\">".$data['descrip']."</div>";
							// $strhtml.="</div>";
							// $horariostodos=$dbn3->getAllData();
							// for($u=0;$u<=($filasu-1);$u++){
								// $shrink=explode(":",$horariostodos[$u]['horacompleta']);
								// $nhora=$shrink[0].":".$shrink[1];
								// $nombreblink="blink_".$horariostodos[$u]['ID'];
								// $nombreelim1="elim1_".$horariostodos[$u]['ID'];
								// $nombreelim2="elim2_".$horariostodos[$u]['ID'];
								// $nombreelim3="elim3_".$horariostodos[$u]['ID'];
								// $nombreelim4="elim4_".$horariostodos[$u]['ID'];
								// $nombreelim5="elim5_".$horariostodos[$u]['ID'];
								// $horapeli=intval($data['Hmilitar']);
								// $hahora=date("H");
								// $mpeli=$data['mpeli'];
								// $mahora=date("i");
								// $strminutos=intval($data2['DiffTime']);
								// $strhtml.="<div id=\"$nombreelim1\" class=\"sep\"></div>";
				            	// $strhtml.="<div id=\"$nombreelim2\" class=\"horario\">";
								// $strhtml.="<div class=\"hora\" style=\"display:inline-block;\">".$nhora."</div>";
									// //$cadenaN.="HAHORA: ".$hahora.","."HORAPELI: ".$horapeli."STRMINUTOS: ".$strminutos."MPELI: ".$mpeli."MAHORA: ".$mahora;
									// $strhtml.="<div id=\"$nombreblink\" class=\"blink\" style=\"display:none;\"></div>";
			                		// $strhtml.="<div id=\"$nombreelim5\" class=\"agotado\" style=\"display:none;\">AGOTADO</div>";
				            	// $strhtml.="</div>";
							// }
							// if($filasu<3){
								// $restante=abs(3-$filasu);
								// for($u=0;$u<=($restante-2);$u++){
									// $shrink=explode(":",$horariostodos[$u]['horacompleta']);
									// $nhora=$shrink[0].":".$shrink[1];
									// $nombreblink="blink_".$horariostodos[$u]['ID'];
									// $nombreelim1="elim1_".$horariostodos[$u]['ID'];
									// $nombreelim2="elim2_".$horariostodos[$u]['ID'];
									// $nombreelim3="elim3_".$horariostodos[$u]['ID'];
									// $nombreelim4="elim4_".$horariostodos[$u]['ID'];
// 										
									// $strhtml.="<div id=\"$nombreelim1\" class=\"sep\"></div>";
					            	// $strhtml.="<div id=\"$nombreelim2\" class=\"horario\"  style=\"visibility: hidden;\">";
					                	// $strhtml.="<div id=\"$nombreelim3\" class=\"hora\" style=\"visibility: hidden;\">".$nhora."</div>";
					                	// $strhtml.="<div id=\"$nombreblink\" class=\"blink\" style=\"display:none;\"></div>";
					                	// $strhtml.="<div id=\"$nombreelim5\" class=\"agotado\" style=\"display:none;\">AGOTADO</div>";
					            	// $strhtml.="</div>";
// 										
								// }
							// }
							// $strhtml.="<div class=\"sep\"></div>";
							// $strhtml.="<div class=\"sala\">";
								// $strhtml.="SALA<br/>".$data['sala'];
							// $strhtml.="</div>";
							// if($data['categoria']=="TEATRO"){
								// $strhtml.="<div class=\"sep\"></div>";
								// $strhtml.="<div class=\"censura\">";
									// $strhtml.="<div class=\"text\">precio</div>";
									// // 1.000,235 notación francesa
									// $nombre_format_francais = number_format($data['precio'], 2, ',', '.');
									// $strhtml.="<div class=\"letras\" style=\"font-size:40px;\">".$nombre_format_francais."</div>";
								// $strhtml.="</div>";
							// }
							// $strhtml.="<div id=\"$nombreelim1\" class=\"sep\"></div>";
							// $strhtml.="<div id=\"$nombreelim2\" class=\"censura\">";
								// $strhtml.="<div id=\"$nombreelim3\" class=\"text\">censura</div>";
								// $strhtml.="<div id=\"$nombreelim4\" class=\"letras\">".$data['censura']."</div>";
							// $strhtml.="</div>";
							// $i++;
						// }
					// }
				// }
			// }	
	if($_POST['actualizarhor']=="true"){
		$dbn=new op_mysql();
		$dbn->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
		$dbn2=new op_mysql();
		$dbn2->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
		$dbn3=new op_mysql();
		$dbn3->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
		$dbn4=new op_mysql();
		$dbn4->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
		$peliculas=array();
		$i=0;
		//$condic2="SELECT peliculas.ID as IDpeli, horarios.ID as IDHora,titulo,descrip,sala,censura,precio FROM peliculas,horarios WHERE horarios.fecha=CURDATE() AND peliculas.ID=horarios.idpelicula AND peliculas.categoria='CINE' GROUP BY peliculas.ID ORDER BY peliculas.ID DESC LIMIT 0,4";
		$sqlsel="SELECT peliculas.ID as IDpeli, horarios.ID as IDHora,titulo,descrip,sala,censura,precio FROM peliculas,horarios WHERE horarios.fecha=CURDATE() AND peliculas.ID=horarios.idpelicula AND HOUR(TIME(NOW()))<=HOUR(TIME(horamilitar)) GROUP BY peliculas.ID ORDER BY RAND() LIMIT 1";
		if($dbn->QuerySQL($sqlsel)==0){
			$numpeliculas_cine=$dbn->getFilas();
			if($numpeliculas_cine>0){
				$strhtml="";
				$datos=$dbn->getData();
				$IDpelirandom=$datos["IDpeli"];
				$nomcontpelicula="Slide_ID".$IDpelirandom;
				$condic2="SELECT peliculas.ID as IDpeli, horarios.ID as IDHora, horarios.horamilitar as Hmilitarc, horarios.horaM as Hmilitar,MINUTE(TIMEDIFF(TIME(NOW()),TIME(horamilitar))) AS DiffTime_hor,titulo,descrip,sala,censura,categoria,precio FROM peliculas,horarios WHERE horarios.fecha=CURDATE() AND peliculas.ID='$IDpelirandom' GROUP BY peliculas.ID ORDER BY RAND() LIMIT 1";
				if($dbn2->QuerySQL($condic2)==0){
					if($dbn2->getFilas()>0){
						$i=0;
						$data=$dbn2->getData();
						//$sql="SELECT * FROM horarios WHERE idpelicula='".$data['ID']."' ORDER BY HOUR(horamilitar) ASC";
						//$sqlq3="SELECT * FROM horarios WHERE idpelicula='".$data['IDpeli']."' AND HOUR(TIME(NOW()))<=HOUR(TIME(horamilitar)) AND fecha=CURDATE() ORDER BY HOUR(horamilitar) ASC";
						$diff=$data['DiffTime_hor'];
						if($diff>=0){
							$sqlq3="SELECT * FROM horarios WHERE idpelicula='".$data['IDpeli']."' AND TIME(NOW())<=TIME(horamilitar) AND fecha=CURDATE() ORDER BY HOUR(horamilitar) ASC LIMIT 1";
							$dbn3->QuerySQL($sqlq3);
							$filasu=$dbn3->getFilas();
							if($filasu>0){
								$datahora=$dbn3->getData();
								$nombreelim3="elim3_".$datahora['ID'];
								//$i++;
								$hor_final=$datahora['hora'];
								$min_final=$datahora['minuto'];
								
								if($hor_final<10){
									$hor_Str="0".$hor_final;
								}
								else{
									$hor_Str=$hor_final;
								}
								
								if($min_final<10){
									$min_Str="0".$min_final;
								}
								else{
									$min_Str=$min_final;
								}
								
								$cadenahorario=$nombreelim3."+".$hor_Str.":".$min_Str;
								echo($cadenahorario);
							}
						}
					}
				}
			}
		}
	}
	 
	if($_POST['actualizarcuadros']=="true"){
		$dbn=new op_mysql();
		$dbn->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
		$dbn2=new op_mysql();
		$dbn2->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
		$dbn3=new op_mysql();
		$dbn3->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
		$dbn4=new op_mysql();
		$dbn4->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
		$peliculas=array();
		$sqlsel="SELECT peliculas.ID as peliID,censura,precio,sala,titulo,descrip FROM peliculas,horarios  WHERE horarios.fecha=CURDATE() ORDER BY RAND() LIMIT 1";
		if($dbn->QuerySQL($sqlsel)==0){
			if($dbn->getFilas()>0){
				//echo("SI HAY REGISTROS QUE MOSTRAR");
				$data=$dbn->getData();
				$idpelicula=$data['peliID'];
				$strcambio="#Sala_ID".$idpelicula."+"."#Precio_ID".$idpelicula."+"."#Censura_ID".$idpelicula."+"."#Titulo_ID".$idpelicula."+"."#Subt_ID".$idpelicula."+"."SALA<br>".$data['sala']."+".$data['precio']."+".$data['censura']."+".utf8_encode($data['titulo'])."+".strip_tags(utf8_encode($data['descrip']));
				echo($strcambio);
			}
		}
	}
?>