<?php
	require_once('../conf/config.conf.php');
	require_once('../libs/op_mysql.class.php');
	$dias = array("Domingo","Lunes","Martes","Mi&eacute;rcoles","Jueves","Viernes","S&aacute;bado");
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	$conexion=mysql_connect(SERVIDOR_BD,USUARIO_BD,CLAVE_BD);
	if($conexion){
		$seleccionar=mysql_select_db(NOMBRE_BD);
		mysql_query("SET NAMES 'utf8'");
	}
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
	$idp=$_GET['id'];
	$dbn=new op_mysql();
	$dbn->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	$dbn2=new op_mysql();
	$dbn2->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	$dbn3=new op_mysql();
	$dbn3->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	$dbn4=new op_mysql();
	$dbn4->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	$sqlsel="SELECT * FROM peliculas WHERE ID='$idp'";
	if($dbn->QuerySQL($sqlsel)==0){
		$filas=$dbn->getFilas();
		if($filas>0){
			$datos=$dbn->getData();
			$nombre=$datos['titulo'];
			$descripcion=$datos['descrip'];
			$censura=$datos['censura'];
			$sala=$datos['sala'];
			$director=$datos['director'];
			$prota=$datos['prota'];
			$sinopsis=$datos['sinopsis'];
			$catego=$datos['categoria'];
			$trailer="location.href='".$datos['urltrailer']."';";
			$fecha=$datos['fecha'];
			$fecha_cons=$datos['fecha'];
			$fechai=$fecha_cons;
			$idpeli_cons=$idp;
			/////////////////////
	?>
		<div class="header">
			<div class="header1">
				<div class="img_category">
					<img src="img/logotrasnocho_pq.png" />
				</div>
				<div class="title" id="TituloCategoriaCartelera">DETALLES <?php echo($nombre); ?></div>
				<div class="fecha" id="FechaCine"><?php echo(utf8_encode(ucwords(strtolower(strftime($dias[date('w')]." %d "))))."de ".utf8_encode(ucwords(strtolower(strftime($meses[date('n')-1]))))); ?>/</div>
				<div class="hora" id="HoraCine" style="margin-left:5px;"><?php echo(date("h:i A")); ?></div>
			</div>
			<div class="header2">
				<a href="#PrincipalWrapper">
					<img src="http://xumbadevenezuela.com/entorno_cinetv_app/img/btn_regresar.png" />
				</a>
			</div>
		</div>
	<?php
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
				
				if($catego=="CINE"){
					$claseDetalle="divdetalle divdetalleCine";
				}
				else{
					$claseDetalle="divdetalle divdetalleTeatro";
				}
			?>
				<div class="<?php echo($claseDetalle); ?>">
					<div class="head_talle">
						<div class="nombres">
							<span class="titulobra"><?php echo($nombre); ?></span><br>
							<span class="subtitulobra"><?php echo($descripcion); ?></span>
						</div>
						<div class="censura_sala">
							<?php echo("censura ".$censura); ?><br>
							<?php echo("SALA<br>".$sala); ?>
						</div>
					</div>
					<div class="sepElimFloat"></div>
					<div class="horarios_talle">
						<div class="sep_horario2"></div>
						<div class="dia_horario">
							<div class="nombre">
								<?php
									echo($diaStr1);
								?>
							</div>
							<div class="horas">
								<?php
									$sql2="SELECT * FROM horarios WHERE fecha='$NuevaFecha1' AND idpelicula='$idpeli_cons'";
									$pedidos=mysql_query($sql2,$conexion);
									echo(mysql_error());
									if($pedidos){
										$filas=mysql_num_rows($pedidos);
										if($filas>0){
											while($filas=mysql_fetch_array($pedidos)){
												$minuto=$filas['minuto'];
												$hora=$filas['hora'];
												$horStr=$hora;
												$minStr=$minuto;
												if($hora<10){
													$horStr='0'.$hora;
												}
												if($minuto>=0 && $minuto<10){
													$minStr='0'.$minuto;
												}
												?>
													<div class="hpel"><?php echo($horStr.":".$minStr); ?></div>
												<?php
											}
										}
									}
								?>
							</div>
						</div>
						<div class="sep_horario2"></div>
						<div class="dia_horario">
							<div class="nombre">
								<?php
									echo($diaStr2);
								?>
							</div>
							<div class="horas">
								<?php
									$sql2="SELECT * FROM horarios WHERE fecha='$NuevaFecha2' AND idpelicula='$idpeli_cons'";
									$pedidos=mysql_query($sql2,$conexion);
									echo(mysql_error());
									if($pedidos){
										$filas=mysql_num_rows($pedidos);
										if($filas>0){
											while($filas=mysql_fetch_array($pedidos)){
												$minuto=$filas['minuto'];
												$hora=$filas['hora'];
												$horStr=$hora;
												$minStr=$minuto;
												if($hora<10){
													$horStr='0'.$hora;
												}
												if($minuto>=0 && $minuto<10){
													$minStr='0'.$minuto;
												}
												?>
													<div class="hpel"><?php echo($horStr.":".$minStr); ?></div>
												<?php
											}
										}
									}
								?>
							</div>
						</div>
						<div class="sep_horario2"></div>
						<div class="dia_horario">
							<div class="nombre">
								<?php
									echo($diaStr3);
								?>
							</div>
							<div class="horas">
								<?php
									$sql2="SELECT * FROM horarios WHERE fecha='$NuevaFecha3' AND idpelicula='$idpeli_cons'";
									$pedidos=mysql_query($sql2,$conexion);
									echo(mysql_error());
									if($pedidos){
										$filas=mysql_num_rows($pedidos);
										if($filas>0){
											while($filas=mysql_fetch_array($pedidos)){
												$minuto=$filas['minuto'];
												$hora=$filas['hora'];
												$horStr=$hora;
												$minStr=$minuto;
												if($hora<10){
													$horStr='0'.$hora;
												}
												if($minuto>=0 && $minuto<10){
													$minStr='0'.$minuto;
												}
												?>
													<div class="hpel"><?php echo($horStr.":".$minStr); ?></div>
												<?php
											}
										}
									}
								?>
							</div>
						</div>
						<div class="sep_horario2"></div>
						<div class="dia_horario">
							<div class="nombre">
								<?php
									echo($diaStr4);
								?>
							</div>
							<div class="horas">
								<?php
									$sql2="SELECT * FROM horarios WHERE fecha='$NuevaFecha4' AND idpelicula='$idpeli_cons'";
									$pedidos=mysql_query($sql2,$conexion);
									echo(mysql_error());
									if($pedidos){
										$filas=mysql_num_rows($pedidos);
										if($filas>0){
											while($filas=mysql_fetch_array($pedidos)){
												$minuto=$filas['minuto'];
												$hora=$filas['hora'];
												$horStr=$hora;
												$minStr=$minuto;
												if($hora<10){
													$horStr='0'.$hora;
												}
												if($minuto>=0 && $minuto<10){
													$minStr='0'.$minuto;
												}
												?>
													<div class="hpel"><?php echo($horStr.":".$minStr); ?></div>
												<?php
											}
										}
									}
								?>
							</div>
						</div>
						<div class="sep_horario2"></div>
						<div class="dia_horario">
							<div class="nombre">
								<?php
									echo($diaStr5);
								?>
							</div>
							<div class="horas">
								<?php
									$sql2="SELECT * FROM horarios WHERE fecha='$NuevaFecha5' AND idpelicula='$idpeli_cons'";
									$pedidos=mysql_query($sql2,$conexion);
									echo(mysql_error());
									if($pedidos){
										$filas=mysql_num_rows($pedidos);
										if($filas>0){
											while($filas=mysql_fetch_array($pedidos)){
												$minuto=$filas['minuto'];
												$hora=$filas['hora'];
												$horStr=$hora;
												$minStr=$minuto;
												if($hora<10){
													$horStr='0'.$hora;
												}
												if($minuto>=0 && $minuto<10){
													$minStr='0'.$minuto;
												}
												?>
													<div class="hpel"><?php echo($horStr.":".$minStr); ?></div>
												<?php
											}
										}
									}
								?>
							</div>
						</div>
						<div class="sep_horario2"></div>
					</div>
					<div class="sep_horario3"></div>
					<div class="horarios_talle">
						<div class="sep_horario2"></div>
						<div class="dia_horario">
							<div class="nombre">
								<?php
									echo($diaStr6);
								?>
							</div>
							<div class="horas">
								<?php
									$sql2="SELECT * FROM horarios WHERE fecha='$NuevaFecha6' AND idpelicula='$idpeli_cons'";
									$pedidos=mysql_query($sql2,$conexion);
									echo(mysql_error());
									if($pedidos){
										$filas=mysql_num_rows($pedidos);
										if($filas>0){
											while($filas=mysql_fetch_array($pedidos)){
												$minuto=$filas['minuto'];
												$hora=$filas['hora'];
												$horStr=$hora;
												$minStr=$minuto;
												if($hora<10){
													$horStr='0'.$hora;
												}
												if($minuto>=0 && $minuto<10){
													$minStr='0'.$minuto;
												}
												?>
													<div class="hpel"><?php echo($horStr.":".$minStr); ?></div>
												<?php
											}
										}
									}
								?>
							</div>
						</div>
						<div class="sep_horario2"></div>
						<div class="dia_horario">
							<div class="nombre">
								<?php
									echo($diaStr7);
								?>
							</div>
							<div class="horas">
								<?php
									$sql2="SELECT * FROM horarios WHERE fecha='$NuevaFecha7' AND idpelicula='$idpeli_cons'";
									$pedidos=mysql_query($sql2,$conexion);
									echo(mysql_error());
									if($pedidos){
										$filas=mysql_num_rows($pedidos);
										if($filas>0){
											while($filas=mysql_fetch_array($pedidos)){
												$minuto=$filas['minuto'];
												$hora=$filas['hora'];
												$horStr=$hora;
												$minStr=$minuto;
												if($hora<10){
													$horStr='0'.$hora;
												}
												if($minuto>=0 && $minuto<10){
													$minStr='0'.$minuto;
												}
												?>
													<div class="hpel"><?php echo($horStr.":".$minStr); ?></div>
												<?php
											}
										}
									}
								?>
							</div>
						</div>
						<div class="sep_horario2"></div>
					</div>
					<div class="sepElimFloat"></div>
					<div class="director">
						<span>Director</span>
						<div>
							<?php echo($director); ?>
						</div>
					</div>
					<div class="prota">
						<span>Protagonistas</span>
						<div>
							<?php echo($prota); ?>
						</div>
					</div>
					<div class="sinopsis">
						<span>Sinopsis</span>
						<?php echo($sinopsis); ?>
					</div>
					<?php
					
						if($catego=="CINE"){
							?>
								<div class="btn_trailer" onclick="<?php echo($trailer); ?>">
									VER TRAILER
								</div>
							<?php
						}
					
					?>
				</div>
			<?php
		}
	}
?>