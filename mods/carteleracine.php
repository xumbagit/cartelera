<?php
	session_start();
	setlocale(LC_ALL,"es_ES");
	date_default_timezone_set('America/Caracas');
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
	<div class="container" id="ContainerTotalCartelera" data-tiempopaglabel="<?php echo($tiempoporpag); ?>" data-tiempocinelabel="<?php echo($tiempo_cine); ?>" data-tiempoteatrolabel="<?php echo($tiempo_teatro); ?>" 
			data-numpeliculascine="<?php echo($numpeliculas_cine); ?>" data-numpeliculasteatro="<?php echo($numpeliculas_teatro); ?>">
			<!-- SLIDE PARA CINE !-->
			<div id="CarteleraSlideCompleta" class="cine slide">
				<div class="header">
					<div class="header1">
						<div class="img_category">
							<img src="img/logotrasnocho_pq.png" />
						</div>
						<div class="title" id="TituloCategoriaCartelera">CARTELERA de CINE</div>
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
					//$sqlsel="SELECT COUNT(*) AS total_peliculas, CEIL((COUNT(*)/4)) AS TAMANO_PAGINA, (COUNT(*)/(ABS(CEIL(COUNT(*)/4)))) AS total_paginas FROM peliculas WHERE fecha='".date("Y-m-d")."' AND categoria='CINE' ORDER BY categoria DESC, fecha ASC";
					//$sqlsel="SELECT * FROM peliculas,horarios WHERE horarios.fecha=CURDATE() AND peliculas.categoria='CINE' GROUP BY peliculas.ID ORDER BY peliculas.categoria DESC, horarios.fecha ASC";
					$sqlsel="SELECT horarios.fecha, horarios.idpelicula, peliculas.titulo FROM horarios,peliculas WHERE horarios.fecha=CURDATE() AND peliculas.ID=horarios.idpelicula AND peliculas.categoria='CINE' GROUP BY peliculas.ID ORDER BY peliculas.sala ASC";
					if($dbn->QuerySQL($sqlsel)==0){
						$filas=$dbn->getFilas();
						if($filas>0){
							$datos=$dbn->getData();
							$total_peliculas=$filas;
							$TAMANO_PAGINA=6;
							$total_paginas=(int)abs(ceil($total_peliculas/$TAMANO_PAGINA));
							$numpeliculas=$total_peliculas;
						}
					}
					//echo("PELICULAS:".$total_peliculas." PAGINAS:".$total_paginas);
						$i=0;
						$pagina=1;
						?>
						<div class="ventana">
							<div class="pagina">
							<?php
								//Nueva consulta que puede listar las funciones por trasnocho plural y tac
								//UNICAMENTE PARA TEATRO
								// SELECT peliculas.ID AS IDpeli, horarios.ID AS IDHora,titulo,descrip,peliculas.sala,censura,precio,(SELECT sala FROM salas WHERE sala = peliculas.sala) AS NombreSala FROM peliculas INNER JOIN horarios ON horarios.fecha = CURDATE() AND peliculas.ID = horarios.idpelicula AND peliculas.categoria = 'TEATRO' INNER JOIN salas sac WHERE sac.tipo = 'TEATRO' GROUP BY peliculas.ID ORDER BY RIGHT(NombreSala,1) DESC LIMIT 0,6
								// LEGACY
								// $condic2="SELECT peliculas.ID as IDpeli, horarios.ID as IDHora,titulo,descrip,sala,censura,precio FROM peliculas,horarios WHERE horarios.fecha=CURDATE() AND peliculas.ID=horarios.idpelicula AND peliculas.categoria='CINE' GROUP BY peliculas.ID ORDER BY peliculas.sala ASC LIMIT 0,6";
								$condic2="SELECT peliculas.ID as IDpeli, horarios.ID as IDHora,titulo,descrip,sala,censura,precio FROM peliculas,horarios WHERE horarios.fecha=CURDATE() AND peliculas.ID=horarios.idpelicula AND peliculas.categoria='CINE' GROUP BY peliculas.ID ORDER BY peliculas.sala ASC"; 
								if($dbn->QuerySQL($condic2)==0){
									if($dbn->getFilas()>0){
										$i=0;
										while($data=$dbn->getData()){
											$nomcontenedor="Slidepel".$i;
											$nomcontpelicula="Slide_ID".$data['IDpeli'];
											$contcensura="Censura_ID".$data['IDpeli'];
											$contsala="Sala_ID".$data['IDpeli'];
											$contprecio="Precio_ID".$data['IDpeli'];
											$contitulo="Titulo_ID".$data['IDpeli'];
											$contsubt="Subt_ID".$data['IDpeli'];
											//$sql="SELECT * FROM horarios WHERE idpelicula='".$data['ID']."' ORDER BY HOUR(horamilitar) ASC";
											//$sql="SELECT * FROM horarios WHERE idpelicula='".$data['IDpeli']."' AND HOUR(TIME(NOW()))<=HOUR(TIME(horamilitar)) AND fecha='".date("Y-m-d")."' ORDER BY HOUR(horamilitar) ASC";
											$sql="SELECT * FROM horarios WHERE idpelicula='".$data['IDpeli']."' AND fecha=CURDATE() ORDER BY HOUR(horamilitar) ASC";
											$dbn2->QuerySQL($sql);
											$filasu=$dbn2->getFilas();
											if($filasu>0){
												$jqnomcontenedor="#".$nomcontenedor;
												$linkDetails="http://xumbadevenezuela.com/entorno_cinetv_app/mods/detalles_id.php?id=".$data['IDpeli'];
												?>
													<script tyle="text/javascript">
														$(document).ready(function(){
															$(<?php echo($jqnomcontenedor); ?>).click(function() {
																$('#wrapper3').load('<?php echo($linkDetails); ?>',function(){
																	$('#wrapper3').trigger('create');
																	$.mobile.changePage($("#DetallesDeLaPelicula"), "none");
																});
															});
														});
													</script>
													<div name="<?php echo($nomcontenedor); ?>" id="<?php echo($nomcontenedor); ?>">
														<div class="slideshow" id="<?php echo($nomcontpelicula); ?>">
															<div class="nombre">
																<div class="principal" id="<?php echo(contitulo); ?>"><?php echo(utf8_encode($data['titulo'])); ?></div>
																<div class="sub" id="<?php echo(contsubt); ?>"><?php echo(strip_tags(utf8_encode($data['descrip']))); ?></div>
															</div>
															<div id="<?php echo($nombreelim1); ?>" class="sep"></div>
															<div id="<?php echo($nombreelim2); ?>" class="horario">
															<?php
															if($filasu>0){
																$horariostodos=$dbn2->getAllData();
																for($u=0;$u<=($filasu-1);$u++){
																	$shrink=explode(":",$horariostodos[$u]['horacompleta']);
																	$nhora=$shrink[0].":".$shrink[1];
																	$nombreblink="blink_".$horariostodos[$u]['ID'];
																	$nombreelim1="elim1_".$horariostodos[$u]['ID'];
																	$nombreelim2="elim2_".$horariostodos[$u]['ID'];
																	$nombreelim3="elim3_".$horariostodos[$u]['ID'];
																	$nombreelim4="elim4_".$horariostodos[$u]['ID'];
																	$nombreelim5="elim5_".$horariostodos[$u]['ID'];
																	$nombreelim6="elim6_".$horariostodos[$u]['ID'];
																	?>
													                	<div id="<?php echo($nombreelim3); ?>" class="hora"><?php echo($nhora); ?></div>
													                	<div id="<?php echo($nombreblink); ?>" class="blink" style="display:none;"></div>
												                		<div id="<?php echo($nombreelim5); ?>" class="agotado" style="display:none;"><?php echo("AGOTADO"); ?></div>
																	<?php
																}
															}
															?>
															</div>
															<div class="sep"></div>
															<div class="sala" id="<?php echo($contsala); ?>">
																<div id="<?php echo($nombreelim6); ?>" class="text">censura <span style="font-weight: bold;"><?php echo($data['censura']); ?></span></div>
																SALA<br/><?php echo($data['sala']); ?>
															</div>
															<!-- <div class="sep"></div> -->
														</div>
													</div>
												<?php
												$i++;
											}
										}
									}
								}
						?>
					</div>
				</div>
			</div>
		</div>