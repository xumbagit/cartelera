<!-- /TinyMCE -->
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    theme: "modern",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ]
});

</script>

<!-- /TinyMCE -->
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
			$sqle="SELECT * FROM colec WHERE ID='".$_GET['IDX']."'";
			$msqlq=mysql_query($sqle,$conexion);
			if($msqlq){
				$mfilas=mysql_num_rows($msqlq);
				if($mfilas>0){
					$datos=mysql_fetch_array($msqlq);
					$nombrecolec=$datos['nombrecolec'];
					$temporada=$datos['temporada'];
					$fechacons=$datos['fecha'];
					$aniocons=$datos['anio'];
					$preffix=$datos['preffix'];
					$carpetacons=$datos['carpeta'];
					$descripcion=$datos['descripcion'];
				}
			}
		}
		
		if($carpetacons==''){
			$carpeta="img/collections".$carpetacons;
		}
		else{
			$carpeta=$carpetacons;
		}
		
		//guardar la fecha en la que se escribio el articulo sin mostrarlo en la pantalla date("Y-m-d"); en campo tipo date
		$btn=$_POST['btnprocesar'];
		$option=$_GET['opcion'];
		$suboption=$_GET['subopcion'];
		if($btn){
			$option="colecciones";
			if($option==''){
				echo("DEBE ELEGIR UNA OPCION");
			}
			if($option=="colecciones"){
				$nombrecolec=$_POST['nombrecolec'];
				$temporada=$_POST['temporada'];
				$fechacons=$_POST['fecha'];
				$anio=$_POST['anio'];
				$preffix=strtoupper($_POST['preffix']);
				$carpeta=$_POST['carpeta'];
				$descripcion=$_POST['descripcion'];
				if($_GET['subopcion']=="agregar"){
					//echo("HOLA1");
					$sqlog="SELECT * FROM colec WHERE nombrecolec ='$nombrecolec'";
					$pedidolog=mysql_query($sqlog,$conexion);
					echo(mysql_error());
					if($pedidolog){
						$filaslog=mysql_num_rows($pedidolog);
						if($filaslog==0){
							//echo("HOLA2");
							$sql2="INSERT INTO colec(nombrecolec,temporada,fecha,anio,preffix,carpeta,descripcion) VALUES('$nombrecolec','$temporada','".date("Y-m-d")."','$anio','$preffix','$carpeta','$descripcion')";
							$pedidos=mysql_query($sql2,$conexion);
							echo(mysql_error());
							if($pedidos){
								echo("Se han agregado los datos con exito");
							}
							else{
								echo(mysql_error());
							}
						}
					}
				}
				if($_GET['subopcion']=="modificar"){
					$sqlog="SELECT * FROM colec WHERE ID='".$_GET['IDX']."'";
					$pedidolog=mysql_query($sqlog,$conexion);
					if($pedidolog){
						$filaslog=mysql_num_rows($pedidolog);
						if($filaslog>0){
							//MODIFICACION
							if($nombre!=''){
								//MODIFICACION
								$sql2="UPDATE colec SET nombrecolec='$nombrecolec' WHERE ID='".$_GET['IDX']."'";
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
							if($temporada!=''){
								//MODIFICACION
								$sql2="UPDATE colec SET temporada='$temporada' WHERE ID='".$_GET['IDX']."'";
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
							if($anio!=''){
								//MODIFICACION
								$sql2="UPDATE colec SET anio='$anio' WHERE ID='".$_GET['IDX']."'";
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
							if($preffix!=''){
								//MODIFICACION
								$sql2="UPDATE colec SET preffix='".strtoupper($preffix)."' WHERE ID='".$_GET['IDX']."'";
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
							if($carpeta!=''){
								//MODIFICACION
								$sql2="UPDATE colec SET carpeta='$carpeta' WHERE ID='".$_GET['IDX']."'";
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
							if($descripcion!=''){
								//MODIFICACION
								$sql2="UPDATE colec SET descripcion='$descripcion' WHERE ID='".$_GET['IDX']."'";
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
						}
					}
				}
				if($_GET['subopcion']=="eliminar"){
					$sqlog="SELECT * FROM colec WHERE ID='".$_GET['IDX']."'";
					$pedidolog=mysql_query($sqlog,$conexion);
					if($pedidolog){
						$filaslog=mysql_num_rows($pedidolog);
						if($filaslog>0){
							$sqlog="DELETE FROM colec WHERE ID='".$_GET['IDX']."'";
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
						if($_GET['opcion']=='colecciones'){
							?>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=colecciones&entrar=".$_GET['entrar']); ?>"><h1>COLECCIONES</h1></a>
							<?php
						}
						else{
							?>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=colecciones&entrar=".$_GET['entrar']); ?>"><h1>COLECCIONES</h1></a>
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
						echo("Seleccionar Coleccion");
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
								<OPTION>[seleccione noticia]</OPTION>
						<?php
						if($_GET['opcion']!=''){
							$opciontabla=$_GET['opcion'];
							
						}
						else{
							$opciontabla="colecciones";
						}
						if($opciontabla=="colecciones"){
							$tabladef="colec";
							$campomos="nombrecolec";
						}
							$sqlsel="SELECT * FROM ".$tabladef." ORDER BY ID DESC";
							$pedidosel=mysql_query($sqlsel,$conexion);
							if($pedidosel){
								$filassel=mysql_num_rows($pedidosel);
								if($filassel>0){
									while($datserv=mysql_fetch_array($pedidosel)){
										if($_GET['option']!='niveles'){
											if($datserv['ID']==$_GET['IDX']){
												echo("<OPTION SELECTED value=\"?&mod=admincolecciones&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
											}
											else{
												echo("<OPTION value=\"?&mod=admincolecciones&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
											}	
										}
										else{
											if($datserv['ID']==$_GET['IDX']){
												echo("<OPTION SELECTED value=\"?&mod=admincolecciones&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
											}
											else{
												echo("<OPTION value=\"?&mod=admincolecciones&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
											}
										}
									}
								}
								else{
									echo("<OPTION>NO HAY COLECCIONES AGREGADAS</OPTION>");
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
							$opciontabla="colecciones";
						}
						if($opciontabla=="colecciones"){
							$tabladef="colec";
							$campomos="nombrecolec";
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
													echo("<OPTION SELECTED value=\"?&mod=admincolecciones&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
												}
												else{
													echo("<OPTION value=\"?&mod=admincolecciones&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
												}	
											}
											else{
												if($datserv['ID']==$_GET['IDX']){
													echo("<OPTION SELECTED value=\"?&mod=admincolecciones&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
												}
												else{
													echo("<OPTION value=\"?&mod=admincolecciones&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
												}
											}
										}
									}
									else{
										echo("<OPTION>NO HAY COLECCIONES AGREGADAS</OPTION>");
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
						echo("T&iacute;tulo de la colecci&oacute;n");
					?>
				</td>
			</tr>
			<tr>
				<td>
					<INPUT name="nombrecolec" id="nombrecolec" type="text" style="border:1px solid black;width:333px;" maxlength="40" value="<?php echo($nombrecolec); ?>">
				</td>
			</tr>
				<tr>
					<td>
						Temporada
					</td>
				</tr>
				<tr>
					<td>
<?php
								$sqlsel="SELECT * FROM colec WHERE ID='".$_GET['IDX']."'";
								$pedidosel=mysql_query($sqlsel,$conexion);
								if($pedidosel){
									$filassel=mysql_num_rows($pedidosel);
									if($filassel>0){
										$datserv=mysql_fetch_array($pedidosel);
										$temporada=$datserv['temporada'];
									}
								}
							?>
						<SELECT name="temporada" id="temporada">
							<OPTION <?php if($temporada=="SPRING-SUMMER"){ echo("SELECTED"); } ?> value="SPRING-SUMMER">SPRING-SUMMER</OPTION>
							<OPTION <?php if($temporada=="FALL-WINTER"){ echo("SELECTED"); } ?> value="FALL-WINTER">FALL-WINTER</OPTION>
						</SELECT>
					</td>
				</tr>
				<tr>
					<td>
						A&ntilde;o de la Coleccion
					</td>
				</tr>
				<tr>
					<td>
						<SELECT name="anio" id="anio">
							<?php
							
							for($i=2009;$i<=(date("Y")+1);$i++){
								?>
									<OPTION <?php if($aniocons==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>" ><?php echo($i); ?></OPTION>
								<?php
							}
							
							?>
						</SELECT>
					</td>
				</tr>
			<tr>
				<td>
					<?php
						echo("Preffix");
					?>
				</td>
			</tr>
			<tr>
				<td>
					<INPUT name="preffix" id="preffix" type="text" style="border:1px solid black;width:333px;" maxlength="40" value="<?php echo($preffix); ?>">
				</td>
			</tr>
			<tr>
				<td>
					<?php
						echo("Carpeta");
					?>
				</td>
			</tr>
			<tr>
				<td>
					<INPUT name="carpeta" id="carpeta" type="text" style="border:1px solid black;width:333px;" maxlength="40" value="<?php echo($carpeta); ?>">
				</td>
			</tr>
				<tr>
					<td>
						Descripci&oacute;n de la Coleccion
					</td>
				</tr>
				<tr>
					<td>
						<textarea name="descripcion" id="descripcion" style="width:100%;display:block;"><?php
								echo($descripcion);
							?></textarea>
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