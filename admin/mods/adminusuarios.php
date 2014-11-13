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
			$option=$_GET['opcion'];
			$btn=$_POST['btnprocesar2'];
			if($_GET['idusr']!=''){
				$sqlsel="SELECT * FROM usuarios WHERE ID='".$_GET['idusr']."'";
			    //echo $query;
				if($dbn->QuerySQL($sqlsel)==0){
					if($dbn->getFilas()>0){
						/*getData obtiene informacion de la consulta */
						$datosconsulta=$dbn->getData();
						$nombre_cons=$datosconsulta['nombre'];
						$idperfil_cons=$datosconsulta['idperfil'];
					}
				}
			}
			if($btn){
				$nombreusuario=$_POST['nombre'];
				$clave=$_POST['clave'];
				$repclave=$_POST['reclave'];
			    $perfil=$_POST['perfiltxt'];
				if($_GET['subopcion']=="agregar"){
					$sqlog="SELECT * FROM usuarios WHERE nombre='$nombreusuario'";
					if($dbn->QuerySQL($sqlog)==0){
						if($repclave==$clave){
							$sql2="INSERT INTO usuarios(email,clave,idperfil) VALUES('$nombreusuario','".md5($clave)."','$perfil')";
							if($dbn2->QuerySQL($sql2)==0){
								echo("Se han agregado los datos con exito");
							}
						}
						else{
							echo("La clave no coincide");
						}
					}
				}
				if($_GET['subopcion']=="modificar"){
					$sqlog="SELECT * FROM usuarios WHERE ID='".$_GET['idusr']."'";
					if($dbn->QuerySQL($sqlog)==0){
						if($dbn->getFilas()>0){
							if($perfil!=''){
								//MODIFICACION
								$sql2="UPDATE usuarios SET idperfil='$perfil' WHERE ID='".$_GET['idusr']."'";
								if($dbn2->QuerySQL($sql2)==0){
									echo("Se han realizado las modificaciones con exito");
								}
								else{
									echo(mysql_error());
								}	
							}
							
							if($repclave!=''){
								if($repclave==$clave){
									//MODIFICACION
									$sql2="UPDATE usuarios SET clave='".md5($repclave)."' WHERE ID='".$_GET['idusr']."'";
									if($dbn2->QuerySQL($sql2)==0){
										echo("Se han realizado las modificaciones con exito");
									}
								}
								else{
									echo("La clave no coincide");
								}
							}
						}
					}
				}
				if($_GET['subopcion']=="eliminar"){
					$sqlog="SELECT * FROM usuarios WHERE ID='".$_GET['idusr']."'";
					if($dbn->QuerySQL($sqlog)==0){
						if($dbn->getFilas()>0){
							$sqlog2="DELETE FROM usuarios WHERE ID='".$_GET['idusr']."'";
							if($dbn2->QuerySQL($sqlog2)==0){
								echo("Se han eliminido con exito");
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
						if($_GET['opcion']=='usuarios'){
							?>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=usuarios"); ?>"><h1>USUARIOS</h1></a>
							<?php
						}
						else{
							?>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=usuarios"); ?>"><h1>USUARIOS</h1></a>
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
						Email
					</td>
				</tr>
				<tr>
					<td>
						<?php
							if($_GET['subopcion']=="agregar" || $_GET['subopcion']==""){
								?>
									<INPUT name="nombre" id="nombre" type="text">
								<?php
							}
							else{
								?>
								<SELECT name="nombre" id="nombre" onchange="abreSitio('nombre');">
										<OPTION>FAVOR SELECCIONAR USUARIO</OPTION>
										<?php
											$sqlsel="SELECT * FROM usuarios ORDER BY ID DESC";
											if($dbn->QuerySQL($sqlsel)==0){
												if($dbn->getFilas()>0){
													while($datserv=$dbn->getData()){
														$vowelsconv = array("á", "é", "í", "ó", "ú","ñ");
														$vowels = array("&aacute;", "&eacute;", "&iacute;", "&oacute;", "&uacute;", "&ntilde;");
														$nombretmp=$datserv['email'];
														$nombre = str_replace($vowels, $vowelsconv, $nombretmp);
														if($datserv['ID']==$_GET['idusr']){
															echo("<OPTION SELECTED value=\"?mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&categoria=".$_GET['categoria']."&idusr=".$datserv['ID']."&idperf=".$datserv['idperfil']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$nombre."</OPTION>");
														}
														else{
															echo("<OPTION value=\"?mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&categoria=".$_GET['categoria']."&idusr=".$datserv['ID']."&idperf=".$datserv['idperfil']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$nombre."</OPTION>");
														}
													}
												}
												else{
													echo("<OPTION>NO HAY PERFILES AGREGADOS</OPTION>");
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
						Clave
					</td>
				</tr>
				<tr>
					<td>
						<INPUT name="clave" id="clave" type="password">
					</td>
				</tr>
				<tr>
					<td>
						Repita Clave
					</td>
				</tr>
				<tr>
					<td>
						<INPUT name="reclave" id="reclave" type="password">
					</td>
				</tr>
				<tr>
					<td>
						ID Perfil
					</td>
				</tr>
				<tr>
					<td>
						<SELECT name="perfiltxt" id="perfiltxt">
								<OPTION>FAVOR SELECCIONAR PERFIL</OPTION>
								<?php
									$sqlsel="SELECT * FROM perfiles ORDER BY ID DESC";
									if($dbn->QuerySQL($sqlsel)==0){
										if($dbn->getFilas()>0){
											while($datserv=$dbn->getData()){
												$vowelsconv = array("á", "é", "í", "ó", "ú","ñ");
												$vowels = array("&aacute;", "&eacute;", "&iacute;", "&oacute;", "&uacute;", "&ntilde;");
												$nombretmp=$datserv['nombre'];
												$nombre = str_replace($vowels, $vowelsconv, $nombretmp);
												if($datserv['ID']==$idperfil_cons){
													echo("<OPTION SELECTED value=\"".$datserv['ID']."\">".$nombre."</OPTION>");
												}
												else{
													echo("<OPTION value=\"".$datserv['ID']."\">".$nombre."</OPTION>");
												}
											}
										}
										else{
											echo("<OPTION>NO HAY PERFILES AGREGADOS</OPTION>");
										}
									}
								?>
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
