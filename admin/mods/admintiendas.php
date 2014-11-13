<!-- CKEditor -->
<script language="JavaScript" type="text/javascript">
	function abreSitio(valselect){
		var URL = "http://";
		var web = document.getElementById(valselect).value;
		location.href=web;
	}
</script>
<div class="titulobar"></div>
<div class="modulobar" style="margin-left: 30px;">
	<form method="POST" enctype="multipart/form-data">
		<?php
		//error_reporting(E_ERROR);
		//nivel,numlocal,nombreloc,descripcion,dirimagen,fecha,disponibilidad,idcategoria,rifclocal,web,telefono,email,twitter,facebook,x,y,r,logo
		$msqlq="";
		if($_GET['IDX']!=''){
			$sqle="SELECT * FROM noticias WHERE ID='".$_GET['IDX']."'";
			$msqlq=mysql_query($sqle,$conexion);
			if($msqlq){
				$mfilas=mysql_num_rows($msqlq);
				if($mfilas>0){
					$datos=mysql_fetch_array($msqlq);
					$titulnoticia=$datos['titulo'];
					$tiponota=$datos['tipo'];
					$idiomatxt=$datos['idioma'];
					$portadart=$datos['autorportada'];
					$articuloaut=$datos['autorarticulo'];
					$cuerponoticia=$datos['cuerpo'];
				}
			}
		}
		
		//guardar la fecha en la que se escribio el articulo sin mostrarlo en la pantalla date("Y-m-d"); en campo tipo date
		$btn=$_POST['btnprocesar'];
		$option=$_GET['opcion'];
		$suboption=$_GET['subopcion'];
		if($btn){
			$option="noticias";
			if($option==''){
				echo("DEBE ELEGIR UNA OPCION");
			}
			if($option=="noticias"){
				$nombre=strtoupper($_POST['nombre']);
				$nombreanot=strtoupper($_POST['nombreautor']);
				$nombreaimg=strtoupper($_POST['nombresutorimg']);
				if($nombreanot==''){
					die("Debe ingresar el nombre del autor de la noticia");
				}
				$descripcion=$_POST['content'];
				$autor=$_POST['nombreautor'];
				$imgautor=$_POST['nombreautorimg'];
				$noticia=$_POST['content'];
				$idioma=$_POST['idiomacmb'];
				//$noticia=str_replace("p>", "",$noticia);
				$tiponot=$_POST['tiponota'];
				$logo=$_FILES["imgicono"]['name'];
				$tamano = $_FILES["imgicono"]['size'];
			    $tipo = $_FILES["imgicono"]['type'];
			    $archivo = $_FILES["imgicono"]['name'];
				$logof=$_FILES["calendariof"]['name'];
				$tamanof = $_FILES["calendariof"]['size'];
			    $tipof = $_FILES["calendariof"]['type'];
			    $archivof = $_FILES["calendariof"]['name'];
				if($_GET['subopcion']=="agregar"){
					$sqlog="SELECT * FROM noticias WHERE titulo='$nombre'";
					$pedidolog=mysql_query($sqlog,$conexion);
					echo(mysql_error());
					if($pedidolog){
						$filaslog=mysql_num_rows($pedidolog);
						if($filaslog==0){
							$datos=mysql_fetch_array($pedidolog);
						    // obtenemos los datos del archivo
					    	$prefijo = substr(md5(uniqid(rand())),0,6);
					        // guardamos el archivo a la carpeta files
					        $destino =  "img/".$prefijo."_".$archivo;
					        move_uploaded_file($_FILES["imgicono"]['tmp_name'],$destino);
							$sql2="INSERT INTO noticias(titulo,cuerpo,fecha,tipo,fotodir,idioma,fechacons,autorportada,autorarticulo,codigonot) VALUES('$nombre','$noticia','".date("M d, Y")."','$tiponot','$destino','$idioma','".date("Y-m-d")."','$imgautor','$autor','$prefijo')";
							//PEDIDO CONSULTA
							$pedidos=mysql_query($sql2,$conexion);
							echo(mysql_error());
							if($pedidos){
					            $status = "Archivo subido: <b>".$archivo."</b>";
								echo("Se han agregado los datos con exito");
							}
							else{
								echo(mysql_error());
							}
						}
					}
				}
				if($_GET['subopcion']=="modificar"){
					$nombre=strtoupper($_POST['nombre']);
					$nombreanot=strtoupper($_POST['nombreautor']);
					$nombreaimg=strtoupper($_POST['nombresutorimg']);
					if($nombreanot==''){
						die("Debe ingresar el nombre del autor de la noticia");
					}
					$descripcion=$_POST['content'];
					$autor=$_POST['nombreautor'];
					$imgautor=$_POST['nombreautorimg'];
					$noticia=$_POST['content'];
					$idioma=$_POST['idiomacmb'];
					//$noticia=str_replace("p>", "",$noticia);
					$tiponot=$_POST['tiponota'];
					$logo=$_FILES["imgicono"]['name'];
					$tamano = $_FILES["imgicono"]['size'];
				    $tipo = $_FILES["imgicono"]['type'];
				    $archivo = $_FILES["imgicono"]['name'];
					$logof=$_FILES["calendariof"]['name'];
					$tamanof = $_FILES["calendariof"]['size'];
				    $tipof = $_FILES["calendariof"]['type'];
				    $archivof = $_FILES["calendariof"]['name'];
					$sqlog="SELECT * FROM noticias WHERE ID='".$_GET['IDX']."'";
					$pedidolog=mysql_query($sqlog,$conexion);
					if($pedidolog){
						$filaslog=mysql_num_rows($pedidolog);
						if($filaslog>0){
							$data=mysql_fetch_array($pedidolog);
							//MODIFICACION
							if($nombre!=''){
								//MODIFICACION
								$sql2="UPDATE noticias SET titulo='$nombre' WHERE ID='".$_GET['IDX']."'";
								//PEDIDO CONSULTA
								$pedidos=mysql_query($sql2,$conexion);
								echo(mysql_error());
								if($pedidos){
							        $status = "Archivo subido: <b>".$archivo."</b>";
									echo("Se han realizado las modificaciones con exito");
								}
								else{
									echo(mysql_error());
								}	
							}
							$logo=$_FILES["imgicono"]['name'];
							$tamano = $_FILES["imgicono"]['size'];
						    $tipo = $_FILES["imgicono"]['type'];
						    $archivo = $_FILES["imgicono"]['name'];
							$logof=$_FILES["calendariof"]['name'];
							$tamanof = $_FILES["calendariof"]['size'];
						    $tipof = $_FILES["calendariof"]['type'];
						    $archivof = $_FILES["calendariof"]['name'];
							if($idioma!=''){
								$sqlog="SELECT * FROM noticias WHERE ID='".$_GET['IDX']."'";
								$pedidonew=mysql_query($sqlog,$conexion);
								if($pedidonew){
									$filasnew=mysql_num_rows($pedidonew);
									if($filasnew>0){
										$datos=mysql_fetch_array($pedidonew);
										$imagendir=$datos['fotodir'];
										if($datos['idioma']!=$idioma){
											$codigonot=$_GET['codigonot'];
											$idiomanew=$_GET['idioma'];
											$sidup=esta_duplicado($codigonot,$conexion);
											$i=0;
											
											while($i!=3){
												if($sidup[$i]==$idioma){
													break;
												}
												else{
													$i++;
												}
											}
											echo($sidup[$i].$idioma);
											if($sidup[$i]!=$idioma){
											    // obtenemos los datos del archivo
										    	$prefijo = substr(md5(uniqid(rand())),0,6);
										        // guardamos el archivo a la carpeta files
										        $destino =  "img/".$prefijo."_".$archivo;
										        move_uploaded_file($_FILES["imgicono"]['tmp_name'],$destino);
												$sql2="INSERT INTO noticias(titulo,cuerpo,fecha,tipo,fotodir,idioma,fechacons,autorportada,autorarticulo,codigonot) VALUES('$nombre','$noticia','".date("M d, Y")."','$tiponot','$imagendir','$idioma','".date("Y-m-d")."','$imgautor','$autor','".$_GET['codigonot']."')";
												//PEDIDO CONSULTA
												$pedidos=mysql_query($sql2,$conexion);
												echo(mysql_error());
												if($pedidos){
										            $status = "Archivo subido: <b>".$archivo."</b>";
													echo("Se han duplicado los datos al idioma seleccionado");
												}
												else{
													echo(mysql_error());
												}
											}
										}
									}
								}
								//MODIFICACION
								/*
								 * 
								 * 								$sql2="UPDATE noticias SET idioma='$idioma' WHERE ID='".$_GET['IDX']."'";
								//PEDIDO CONSULTA
								$pedidos=mysql_query($sql2,$conexion);
								echo(mysql_error());
								if($pedidos){
							        $status = "Archivo subido: <b>".$archivo."</b>";
									echo("Se han realizado las modificaciones con exito");
								}
								else{
									echo(mysql_error());
								}
								 * 
								 * */
							}
							if($descripcion!=''){
								//MODIFICACION
								$sql2="UPDATE noticias SET cuerpo='$descripcion' WHERE ID='".$_GET['IDX']."'";
								//PEDIDO CONSULTA
								$pedidos=mysql_query($sql2,$conexion);
								echo(mysql_error());
								if($pedidos){
							        $status = "Archivo subido: <b>".$archivo."</b>";
									echo("Se han realizado las modificaciones con exito");
								}
								else{
									echo(mysql_error());
								}	
							}
							if($tiponot!=''){
								//MODIFICACION
								$sql2="UPDATE noticias SET tipo='$tiponot' WHERE ID='".$_GET['IDX']."'";
								//PEDIDO CONSULTA
								$pedidos=mysql_query($sql2,$conexion);
								echo(mysql_error());
								if($pedidos){
							        $status = "Archivo subido: <b>".$archivo."</b>";
									echo("Se han realizado las modificaciones con exito");
								}
								else{
									echo(mysql_error());
								}	
							}
							if($autor!=''){
								//MODIFICACION
								$sql2="UPDATE noticias SET autorarticulo='$autor' WHERE ID='".$_GET['IDX']."'";
								//PEDIDO CONSULTA
								$pedidos=mysql_query($sql2,$conexion);
								echo(mysql_error());
								if($pedidos){
									echo("Se han realizado las modificaciones con exito");
								}
								else{
									echo(mysql_error());
								}	
							}
							if($imgautor!=''){
								//MODIFICACION
								$sql2="UPDATE noticias SET autorportada='$imgautor' WHERE ID='".$_GET['IDX']."'";
								//PEDIDO CONSULTA
								$pedidos=mysql_query($sql2,$conexion);
								echo(mysql_error());
								if($pedidos){
									echo("Se han realizado las modificaciones con exito");
								}
								else{
									echo(mysql_error());
								}
							}
							$logo=$_FILES["imgicono"]['name'];
							$tamano = $_FILES["imgicono"]['size'];
						    $tipo = $_FILES["imgicono"]['type'];
						    $archivo = $_FILES["imgicono"]['name'];
							$logof=$_FILES["calendariof"]['name'];
							$tamanof = $_FILES["calendariof"]['size'];
						    $tipof = $_FILES["calendariof"]['type'];
						    $archivof = $_FILES["calendariof"]['name'];
							if($archivo!=''){
								$foto=$logo;
							    // obtenemos los datos del archivo
						    	$prefijo = substr(md5(uniqid(rand())),0,6);
						        // guardamos el archivo a la carpeta files
						        $destino =  "img/".$prefijo."_".$archivo;
						        move_uploaded_file($_FILES["imgicono"]['tmp_name'],$destino);
								//MODIFICACION
								$sql2="UPDATE noticias SET fotodir='$destino' WHERE ID='".$_GET['IDX']."'";
								//PEDIDO CONSULTA
								$pedidos=mysql_query($sql2,$conexion);
								echo(mysql_error());
								if($pedidos){
									echo("Se han realizado las modificaciones con exito");
								}
								else{
									echo(mysql_error());
								}								
							}

							if($data['codigonot']==''){
								//MODIFICACION
							    // obtenemos los datos del archivo
						    	$prefijo = substr(md5(uniqid(rand())),0,6);
								$sql2="UPDATE noticias SET codigonot='$prefijo' WHERE ID='".$_GET['IDX']."'";
								//PEDIDO CONSULTA
								$pedidos=mysql_query($sql2,$conexion);
								echo(mysql_error());
								if($pedidos){
									echo("Se han realizado las modificaciones con exito");
								}
								else{
									echo(mysql_error());
								}								
							}
							
							
						}
					}
				}
				if($_GET['subopcion']=="eliminar"){
					$sqlog="SELECT * FROM noticias WHERE ID='".$_GET['IDX']."'";
					$pedidolog=mysql_query($sqlog,$conexion);
					if($pedidolog){
						$filaslog=mysql_num_rows($pedidolog);
						if($filaslog>0){
							$sqlog="DELETE FROM noticias WHERE ID='".$_GET['IDX']."'";
							$pedidolog=mysql_query($sqlog,$conexion);
							if($pedidolog){
								echo("Se han eliminido con exito");
							}
							else{
								echo(mysql_error());
							}
						}
					}
				}
			}
		}
		?>
		<table>
			<tr>
				<td>
						<?php
						if($_GET['opcion']=='tiendas'){
							?>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=tiendas&entrar=".$_GET['entrar']); ?>"><h1>TIENDAS</h1></a>
							<?php
						}
						else{
							?>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=tiendas&entrar=".$_GET['entrar']); ?>"><h1>TIENDAS</h1></a>
							<?php							
						}
						?>
				</td>
			</tr>
			<tr>
				<td>
					<table>
						<tr>
							<td>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&subopcion=agregar&entrar=".$_GET['entrar']); ?>">Agregar</a>
							</td>
							<td>
								|
							</td>
							<td>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&subopcion=modificar&categoria=9&nivelc=20&IDX=5&entrar=".$_GET['entrar']); ?>">Modificar</a>
							</td>
							<td>
								|
							</td>
							<td>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&subopcion=eliminar&categoria=9&nivelc=20&IDX=5&entrar=".$_GET['entrar']); ?>">Eliminar</a>
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
		if(($_GET['subopcion']=='modificar' || $_GET['subopcion']=='eliminar' || $_GET['subopcion']=='consultar') && $_GET['opcion']=='niveles') {
			?>
			<tr>
				<td>
					<?php
						echo("Seleccionar Tienda");
					?>
				</td>
			</tr>
		<?php
		}
		?>
			<tr>
				<td>
					<?php
					if(($_GET['subopcion']=='modificar' || $_GET['subopcion']=='eliminar' || $_GET['subopcion']=='consultar') && $_GET['opcion']=='niveles') {
						?>
						<SELECT name="nombre" id="nombre" onchange="abreSitio('nombre');">
								<OPTION>[seleccione tienda]</OPTION>
						<?php
						if($_GET['opcion']!=''){
							$opciontabla=$_GET['opcion'];
							
						}
						else{
							$opciontabla="noticias";
						}
						if($opciontabla=="noticias"){
							$tabladef="tiendas";
							$campomos="titulo";
						}
							$sqlsel="SELECT * FROM ".$tabladef." ORDER BY ID DESC";
							$pedidosel=mysql_query($sqlsel,$conexion);
							if($pedidosel){
								$filassel=mysql_num_rows($pedidosel);
								if($filassel>0){
									while($datserv=mysql_fetch_array($pedidosel)){
										if($_GET['option']!='niveles'){
											if($datserv['ID']==$_GET['IDX']){
												echo("<OPTION SELECTED value=\"?&mod=adminnoticias&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&codigonot=".$datserv['codigonot']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
											}
											else{
												echo("<OPTION value=\"?&mod=adminnoticias&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&codigonot=".$datserv['codigonot']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
											}	
										}
										else{
											if($datserv['ID']==$_GET['IDX']){
												echo("<OPTION SELECTED value=\"?&mod=adminnoticias&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&codigonot=".$datserv['codigonot']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
											}
											else{
												echo("<OPTION value=\"?&mod=adminnoticias&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&codigonot=".$datserv['codigonot']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
											}
										}
									}
								}
								else{
									echo("<OPTION>NO HAY NOTICIAS AGREGADAS</OPTION>");
								}
							}
						?>
						</SELECT>
						<?php
					}
					elseif(($_GET['subopcion']=='modificar' || $_GET['subopcion']=='eliminar' || $_GET['subopcion']=='consultar') && $_GET['opcion']!='niveles') {
						if($_GET['opcion']!=''){
							$opciontabla=$_GET['opcion'];
							
						}
						else{
							$opciontabla="tiendas";
						}
						if($opciontabla=="noticias"){
							$tabladef="tiendas";
							$campomos="titulo";
						}
						?>
						<SELECT name="nombre" id="nombre"  onchange="abreSitio('nombre');">
							<OPTION>[seleccione noticia]</OPTION>
							<?php
								$sqlsel="SELECT * FROM ".$tabladef." ORDER BY ID DESC";
								$pedidosel=mysql_query($sqlsel,$conexion);
								if($pedidosel){
									$filassel=mysql_num_rows($pedidosel);
									if($filassel>0){
										while($datserv=mysql_fetch_array($pedidosel)){
											if($_GET['option']!='niveles'){
												if($datserv['ID']==$_GET['IDX']){
													echo("<OPTION SELECTED value=\"?&mod=adminnoticias&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&codigonot=".$datserv['codigonot']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
												}
												else{
													echo("<OPTION value=\"?&mod=adminnoticias&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&codigonot=".$datserv['codigonot']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
												}	
											}
											else{
												if($datserv['ID']==$_GET['IDX']){
													echo("<OPTION SELECTED value=\"?&mod=adminnoticias&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&codigonot=".$datserv['codigonot']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
												}
												else{
													echo("<OPTION value=\"?&mod=adminnoticias&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&codigonot=".$datserv['codigonot']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
												}
											}
										}
									}
									else{
										echo("<OPTION>NO HAY NOTICIAS AGREGADAS</OPTION>");
									}
								}
							?>
						</SELECT>
						<?php
					}
					?>
				</td>
			</tr>
			<tr>
				<td>
					<?php
						echo("Nombre de la tienda");
					?>
				</td>
			</tr>
			<tr>
				<td>
					<INPUT name="nombre" id="nombre" type="text" style="border:1px solid black;width:333px;" value="<?php echo($titulnoticia); ?>">
				</td>
			</tr>
				<tr>
					<td>
						<?php
							echo("Imagen Portada");
						?>
					</td>
				</tr>
				<tr>
					<td>
						<INPUT name="imgicono" id="imgicono" type="file" style="border:1px solid black;width:333px;">
					</td>
				</tr>
			<tr>
				<td>
					<?php
						echo("Autor de la imagen");
					?>
				</td>
			</tr>
			<tr>
				<td>
					<INPUT name="nombreautorimg" id="nombreautorimg" type="text" style="border:1px solid black;width:333px;" maxlength="40" value="<?php echo($portadart); ?>">
				</td>
			</tr>
				<tr>
					<td>
						Categor&iacute;a
					</td>
				</tr>
				<tr>
					<td>
<?php
								$sqlsel="SELECT * FROM tiendas WHERE ID='".$_GET['IDX']."'";
								$pedidosel=mysql_query($sqlsel,$conexion);
								if($pedidosel){
									$filassel=mysql_num_rows($pedidosel);
									if($filassel>0){
										$datserv=mysql_fetch_array($pedidosel);
										$tiponota=$datserv['tipo'];
									}
								}
							?>
						<SELECT name="tiponota" id="tiponota">
							<OPTION <?php if($tiponota=="PRESS"){ echo("SELECTED"); } ?> value="PRESS">BOUTIQUE</OPTION>
							<OPTION <?php if($tiponota=="RECENT.NEWS"){ echo("SELECTED"); } ?> value="RECENT.NEWS">PUNTO DE VENTA</OPTION>
						</SELECT>
					</td>
				</tr>
				<tr>
					<td>
						Idioma
					</td>
				</tr>
				<tr>
					<td>
						<SELECT name="idiomacmb" id="idiomacmb">
							<OPTION <?php if($idiomatxt=="en"){ echo("SELECTED"); } ?> value="en" >INGL&Eacute;S</OPTION>
							<OPTION <?php if($idiomatxt=="fr"){ echo("SELECTED"); } ?> value="fr" >FRANC&Eacute;S</OPTION>
							<OPTION <?php if($idiomatxt=="es"){ echo("SELECTED"); } ?> value="es" >ESPA&Ntilde;OL</OPTION>
						</SELECT>
					</td>
				</tr>
				<tr>
					<td>
						Ciudad
					</td>
				</tr>
				<tr>
					<td>
						<SELECT name="idiomacmb" id="idiomacmb">
							<OPTION <?php if($idiomatxt=="en"){ echo("SELECTED"); } ?> value="en" >CARACAS</OPTION>
							<OPTION <?php if($idiomatxt=="fr"){ echo("SELECTED"); } ?> value="fr" >MIAMI</OPTION>
						</SELECT>
					</td>
				</tr>
				<tr>
					<td>
						Direcci&oacute;n
					</td>
				</tr>
				<tr>
					<td>
						<textarea name="content" id="content" style="width:100%;display:block;"><?php
								echo($cuerponoticia);
							?></textarea>
						<!-- CKEditor -->
						<script type="text/javascript">
							CKEDITOR.replace( 'content' );	
						</script>
					</td>
				</tr>
		</table>
		<table>
			<tr>
				<td>
					<input id="btnprocesar" name="btnprocesar" type="submit" class="btn btn-large btn-primary" value="Procesar"></input>
				</td>
			</tr>
		</table>
	</form>
</div>