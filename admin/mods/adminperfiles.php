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
			if(!$btn){
				$sqlsel="SELECT * FROM perfiles WHERE ID='".$_GET['idperfil']."'";
			    //echo $query;
				if($dbn->QuerySQL($sqlsel)==0){
					if($dbn->getFilas()>0){
						/*getData obtiene informacion de la consulta */
						$datosconsulta=$dbn->getData();
						$nombrecons=$datosconsulta['seccion'];
					}
				}
			}
			print_r($modulosp);
			if($btn){
				$option="perfiles";
				$idmodulos=$_POST['modulper'];
				if($option=="perfiles"){
					$nombre=$_POST['nombretxt'];
					if($_GET['subopcion']=="agregar"){
						$sqlog="SELECT * FROM perfiles";
						if($dbn->QuerySQL($sqlog)==0){
							$sql2="INSERT INTO perfiles(nombre,idusuario,fechacrea) VALUES('$nombre','".$_SESSION['idusuario']."','".date("Y-m-d")."')";
							if($dbn->QuerySQL($sql2)==0){
								$getidins=$dbn->getIDInsert();
								for($i=0;$i<count($idmodulos);$i++){
									$sql011="INSERT INTO modulosperm(idperfil,idmodulos) VALUES('$getidins','".$idmodulos[$i]."')";
									$dbn2->QuerySQL($sql011);
								}
								echo("Se han agregado los datos con exito");
							}
							else{
								echo(mysql_error());
							}
						}
					}
					if($_GET['subopcion']=="modificar"){
						$sqlog="SELECT * FROM perfiles WHERE ID='".$_GET['idperfil']."'";
						if($dbn->QuerySQL($sqlog)==0){
							if($dbn->getFilas()>0){
								//MODIFICACION
								if($seccionpagina!=''){
									//MODIFICACION
									$sql2="UPDATE perfiles SET nombre='$nombre' WHERE ID='".$_GET['idperfil']."'";
									//PEDIDO CONSULTA
									if($dbn->QuerySQL($sql2)==0){
										echo("Se han realizado las modificaciones con exito");
									}
									else{
										echo(mysql_error());
									}	
								}
								$sql01="DELETE FROM modulosperm WHERE idperfil='".$_GET['idperfil']."'";
								$dbn->QuerySQL($sql01);
								for($i=0;$i<=count($idmodulos);$i++){
									$sql2="INSERT INTO modulosperm(idperfil,idmodulos) VALUES('".$_GET['idperfil']."','".$idmodulos[$i]."')";
									$dbn->QuerySQL($sql2);
								}	
							}
						}
					}
					if($_GET['subopcion']=="eliminar"){
						$sqlog="SELECT * FROM perfiles WHERE ID='".$_GET['idperfil']."'";
						if($dbn->QuerySQL($sqlog)==0){
							if($dbn->getFilas()>0){
								$sqlog2="DELETE FROM perfiles WHERE ID='".$_GET['idperfil']."'";
								$dbn->QuerySQL($sqlog2);
								$sqlog01="DELETE FROM modulosperm WHERE idperfil='".$_GET['idperfil']."'";
								if($dbn->QuerySQL($sqlog01)==0){
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
						if($_GET['opcion']=='perfiles'){
							?>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=perfiles"); ?>"><h1>PERFILES</h1></a>
							<?php
						}
						else{
							?>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=perfiles"); ?>"><h1>PERFILES</h1></a>
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
						ID Perfil
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
								<SELECT name="patrocinantetxt" id="patrocinantetxt" onchange="abreSitio('patrocinantetxt');">
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
														if($datserv['ID']==$_GET['idperfil']){
															echo("<OPTION SELECTED value=\"?mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&categoria=".$_GET['categoria']."&idperfil=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$nombre."</OPTION>");
														}
														else{
															echo("<OPTION value=\"?mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&categoria=".$_GET['categoria']."&idperfil=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$nombre."</OPTION>");
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
						M&oacute;dulos Permitidos
					</td>
				</tr>
				<?php
				
					$sqlsel="SELECT * FROM modulos ORDER BY ID DESC";
					if($dbn->QuerySQL($sqlsel)==0){
						if($dbn->getFilas()>0){
							$i=0;
							while($datserv=$dbn->getData()){
								$sqlmod="SELECT * FROM modulosperm WHERE idperfil='".$_GET['idperfil']."' AND idmodulos='".$datserv['ID']."'";
								if($dbn2->QuerySQL($sqlmod)==0){
									if($dbn2->getFilas()>0){
										$checkedchk="checked='true'";
									}
									else{
										$checkedchk="";
									}
								}
							?>
								<tr>
									<td>
										<input name="modulper[]" id="modulper[]" type="checkbox" <?php echo($checkedchk)?> value="<?php echo($datserv['ID']); ?>">
										<?php echo(" ".$datserv['nombre']); ?>									
									</td>
								</tr>
							<?php
							$i++;
							}
						}
					}
				?>
				<tr>
					<td>
						
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
