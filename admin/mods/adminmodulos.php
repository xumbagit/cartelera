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
	/*
	 * 
	 * 
	 <iframe width="560" height="315" src="//www.youtube.com/embed/n9qU9kVc6jM" frameborder="0" allowfullscreen></iframe>
	 * */
		//error_reporting(E_ERROR);
			$option="modulos";
			$btn=$_POST['btnprocesar2'];
			if(!$btn){
				$sqlsel="SELECT * FROM modulos WHERE ID='".$_GET['idmodulo']."'";
				if($dbn->QuerySQL($sqlsel)==0){
					if($dbn->getFilas()>0){
						$datosconsulta=$dbn->getData();
						$nombre_cons=$datosconsulta['nombre'];
						$raiz_cons=$datosconsulta['raiz'];
						$constantes_cons=$datosconsulta['constante'];
						$tipo_cons=$datosconsulta['tipo'];
						$idusr_cons=$datosconsulta['idusuario'];
						$fechacrea_cons=$datosconsulta['fechacrea'];
						$archivo_cons=$datosconsulta['archivo'];
					}
				}
			}
			if($btn){
				if($option=="modulos"){
					$nombre=$_POST['nombretxt'];
					$raiz=$_POST['raiz_modulo'];
					$constantes=$_POST['cons_modulo'];
					$tipo=$_POST['tipo_modulo'];
					$archivo=$_POST['archivo_modulo'];
					$idusr=$_SESSION['idusuario'];
					$fechacrea=date("Y-m-d");

					if($_GET['subopcion']=="agregar"){
						//echo("HOLA1");
						$sqlog="SELECT * FROM modulos";
						if($dbn->QuerySQL($sqlog)==0){
							//echo("HOLA2");
							$sql2="INSERT INTO modulos(nombre,raiz,constante,tipo,idusuario,fechacrea,archivo) VALUES('$nombre','$raiz','$constantes','$tipo','$idusr','$fechacrea','$archivo')";
							if($dbn->QuerySQL($sql2)==0){
								//echo("HOLA3");
								echo("Se han agregado los datos con exito");
							}
						}
					}
					if($_GET['subopcion']=="modificar"){
						$nombre=$_POST['nombre_modulo'];
						
						$sqlog="SELECT * FROM modulos WHERE ID='".$_GET['idmodulo']."'";
						if($dbn->QuerySQL($sqlog)==0){
							if($dbn->getFilas()>0){
								if($nombre!=''){
									$sql2="UPDATE modulos SET nombre='$nombre' WHERE ID='".$_GET['idmodulo']."'";
									if($dbn->QuerySQL($sql2)==0){
										echo("Se han realizado las modificaciones con exito");
									}	
								}
								if($raiz!=''){
									$sql2="UPDATE modulos SET raiz='$raiz' WHERE ID='".$_GET['idmodulo']."'";
									if($dbn->QuerySQL($sql2)==0){
										echo("Se han realizado las modificaciones con exito");
									}
								}
								if($constantes!=''){
									$sql2="UPDATE modulos SET constante='$constantes' WHERE ID='".$_GET['idmodulo']."'";
									if($dbn->QuerySQL($sql2)==0){
										echo("Se han realizado las modificaciones con exito");
									}
								}
								if($tipo!=''){
									$sql2="UPDATE modulos SET tipo='$tipo' WHERE ID='".$_GET['idmodulo']."'";
									if($dbn->QuerySQL($sql2)==0){
										echo("Se han realizado las modificaciones con exito");
									}
								}
								if($archivo!=''){
									$sql2="UPDATE modulos SET archivo='$archivo' WHERE ID='".$_GET['idmodulo']."'";
									if($dbn->QuerySQL($sql2)==0){
										echo("Se han realizado las modificaciones con exito");
									}
								}
							}
						}
					}
					if($_GET['subopcion']=="eliminar"){
						$sqlog="SELECT * FROM modulos WHERE ID='".$_GET['idmodulo']."'";
						if($dbn->QuerySQL($sqlog)==0){
							if($dbn->getFilas()>0){
								$sqlog2="DELETE FROM modulos WHERE ID='".$_GET['idmodulo']."'";
								if($dbn->QuerySQL($sqlog2)==0){
									echo("Se han eliminido con exito");
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
						if($_GET['opcion']=='modulos'){
							?>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=modulos"); ?>"><h1>MODULOS</h1></a>
							<?php
						}
						else{
							?>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=modulos"); ?>"><h1>MODULOS</h1></a>
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
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&subopcion=agregar"); ?>">Agregar</a>
							</td>
							<td>
								|
							</td>
							<td>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&subopcion=modificar"); ?>">Modificar</a>
							</td>
							<td>
								|
							</td>
							<td>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&subopcion=eliminar"); ?>">Eliminar</a>
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
				<tr>
					<td>
						ID M&oacute;dulo
					</td>
				</tr>
				<tr>
					<td>
						<?php
							if($_GET['subopcion']=="agregar" || $_GET['subopcion']==""){
								?>
									<INPUT name="nombretxt" id="nombretxt" type="text">
								<?php
							}
							else{
								?>
								<SELECT name="nombretxt" id="nombretxt" onchange="abreSitio('nombretxt');">
										<OPTION>[Seleccione]</OPTION>
										<?php
											$sqlsel="SELECT * FROM modulos ORDER BY ID DESC";
											if($dbn->QuerySQL($sqlsel)==0){
												if($dbn->getFilas()>0){
													while($datserv=$dbn->getData()){
														$vowelsconv = array("á", "é", "í", "ó", "ú","ñ");
														$vowels = array("&aacute;", "&eacute;", "&iacute;", "&oacute;", "&uacute;", "&ntilde;");
														$nombretmp=$datserv['nombre'];
														$nombre = str_replace($vowels, $vowelsconv, $nombretmp);
														if($datserv['ID']==$_GET['idmodulo']){
															echo("<OPTION SELECTED value=\"?mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&categoria=".$_GET['categoria']."&idmodulo=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$nombre."</OPTION>");
														}
														else{
															echo("<OPTION value=\"?mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&categoria=".$_GET['categoria']."&idmodulo=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$nombre."</OPTION>");
														}
													}
												}
												else{
													echo("<OPTION>NO HAY MODULOS AGREGADOS</OPTION>");
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
				if($_GET['subopcion']=="modificar"){
				?>
					<tr>
						<td>
							<INPUT name="nombre_modulo" id="nombre_modulo" type="text" value="<?php echo($nombre_cons); ?>">
						</td>
					</tr>
				<?php
				}
				?>
				<tr>
					<td>
						Ra&iacute;z M&oacute;dulo 
					</td>
				</tr>
				<tr>
					<td>
						<INPUT name="raiz_modulo" id="raiz_modulo" type="text" value="<?php echo($raiz_cons); ?>">
					</td>
				</tr>
				<tr>
					<td>
						Archivo M&oacute;dulo 
					</td>
				</tr>
				<tr>
					<td>
						<INPUT name="archivo_modulo" id="archivo_modulo" type="text" value="<?php echo($archivo_cons); ?>">
					</td>
				</tr>
				<tr>
					<td>
						Constante M&oacute;dulo 
					</td>
				</tr>
				<tr>
					<td>
						<INPUT name="cons_modulo" id="cons_modulo" type="text" value="<?php echo($constantes_cons); ?>">
					</td>
				</tr>
				<tr>
					<td>
						Tipo de M&oacute;dulo 
					</td>
				</tr>
				<tr>
					<td>
						<SELECT name="tipo_modulo" id="tipo_modulo">
							<OPTION value="">[Seleccione]</OPTION>
							<OPTION value="DYNAMIC" <?php if($tipo_cons=="DYNAMIC"){ echo("SELECTED"); } ?>>DINAMICO</OPTION>
							<OPTION value="STATIC" <?php if($tipo_cons=="STATIC"){ echo("SELECTED"); } ?>>ESTATICO</OPTION>
						</SELECT>
					</td>
				</tr>
				<tr>
					<td>
						<INPUT name="btnprocesar2" id="btnprocesar2" type="submit" value="Procesar" class="btn btn-info">
					</td>
				</tr>
			</table>
		</form>
</div>
