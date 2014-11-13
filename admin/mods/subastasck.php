<?php
	session_start();
	require_once('../conf/config.conf.php');
	require_once('../lib/op_mysql.class.php');
	require_once('../lib/functions.php');
	ini_set("error_reporting","E_ERROR");
	error_reporting("E_ERROR");
	if($_POST['updatesub']=='true'){
		$sumasubasta=0;
		$sumafinal=0;
		$newsub=new op_mysql();
		$newsub->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
		$newsub2=new op_mysql();
		$newsub2->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
		$sqlbid3="SELECT * FROM vfiscales WHERE ID='".$_POST['idsubasta']."'";
		if($newsub->QuerySQL($sqlbid3)==0){
			if($newsub->getFilas()>0){
				$sqlins="UPDATE vfiscales SET vence='".$_POST['fechavenc']."', agenret='".$_POST['agenret']."', status='3', usvalidador='".$_SESSION['idusuario']."', validada='1'  WHERE ID='".$_POST['idsubasta']."'";
				if($newsub2->QuerySQL($sqlins)==0){
					echo("Se ha activado la subasta!");	
				}
			}
		}
	}
	
	if($_POST['updatedatossub']=='true'){
		$sumasubasta=0;
		$sumafinal=0;
		$newsub=new op_mysql();
		$newsub->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
		$newsub2=new op_mysql();
		$newsub2->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
		$sqlbid3="SELECT * FROM vfiscales WHERE ID='".$_POST['idsubasta']."'";
		if($newsub->QuerySQL($sqlbid3)==0){
			if($newsub->getFilas()>0){
				if($_POST['opcion']=='editar'){
					$sqlins="UPDATE vfiscales SET vence='".$_POST['fechavenc']."', agenret='".$_POST['agenret']."', usvalidador='".$_SESSION['idusuario']."', validada='1'  WHERE ID='".$_POST['idsubasta']."'";
					if($newsub2->QuerySQL($sqlins)==0){
						echo("Se han modificado los datos de la subasta!");	
					}
				}
				if($_POST['opcion']=='suspender'){
					$sqlins="UPDATE vfiscales SET status='4' WHERE ID='".$_POST['idsubasta']."'";
					if($newsub2->QuerySQL($sqlins)==0){
						echo("Se han modificado los datos de la subasta!");	
					}
				}
			}
		}
	}
	if($_GET['detallesubasta']=="true"){
		$newsub=new op_mysql();
		$newsub->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
		$newsub2=new op_mysql();
		$newsub2->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
		$sqlbid3="SELECT * FROM usuarios WHERE ID='".$_GET['idusuario']."'";
		if($newsub->QuerySQL($sqlbid3)==0){
			if($newsub->getFilas()>0){
				$datos=$newsub->getData();
			}
		}
		$sqlbid3="SELECT * FROM vfiscales WHERE ID='".$_GET['idsubasta']."'";
		if($newsub->QuerySQL($sqlbid3)==0){
			if($newsub->getFilas()>0){
				$datos2=$newsub->getData();
			}
		}
		?>
			<table>
				<tr>
					<td>
						<b>
							CREDITO FISCAL
						</b>
					</td>
					<td></td>
				</tr>				
				<tr>
					<td>
						Alias de la oferta
					</td>
					<td>
						<?php echo($datos2['aliasoferta']); ?>
					</td>
				</tr>
				<tr>
					<td>
						Descripci&oacute;n
					</td>
					<td>
						<?php echo($datos2['descrip_oferta']); ?>
					</td>
				</tr>
				<tr>
					<td>
						Fecha de vencimiento de la subasta
					</td>
					<td>
						<?php echo($datos2['vence']); ?>
					</td>
				</tr>
				<tr>
					<td>
						(dias)
					</td>
					<td>
						<?php echo(dias_transcurridos(date("Y-m-d"),$datos2['vence'])); ?>
					</td>
				</tr>
				<?php
				if($_GET['detallesextra']=="true"){
					?>
						<tr>
							<td>
								Valor Nominal
							</td>
							<td>
								<?php echo($datos2['valnominal']); ?>
							</td>
						</tr>
						<tr>
							<td>
								MPO (%)
							</td>
							<td>
								<?php echo(calcular_mpo($datos2['ID'])); ?>
							</td>
						</tr>
						<tr>
							<td>
								Origen
							</td>
							<td>
								<?php echo($datos2['origen']); ?>
							</td>
						</tr>
						<tr>
							<td>
								Auditor&iacute;a Externa
							</td>
							<td>
								<?php echo($datos2['auditex']); ?>
							</td>
						</tr>
					<?php
				}
				?>
				<tr>
					<td>
						<b>
							USUARIO
						</b>
					</td>
					<td></td>
				</tr>
				
				<tr>
					<td>
						Nombre
					</td>
					<td>
						<?php echo($datos['nombre']); ?>
					</td>
				</tr>
				<tr>
					<td>
						C&eacute;dula
					</td>
					<td>
						<?php echo($datos['tipoidentificacion']."-".$datos['cedula']); ?>
					</td>
				</tr>
				<tr>
					<td>
						Email
					</td>
					<td>
						<?php echo($datos['email']); ?>
					</td>
				</tr>
				<tr>
					<td>
						Tel&eacute;fono
					</td>
					<td>
						<?php echo($datos['telefonohab']); ?>
					</td>
				</tr>
			</table>
		<?php
	}

	if($_GET['responsechat']=="true"){
		$idchat=$_GET['idchat'];
		$idusuario=$_GET['idusuario'];
		$idservicio_chat=$_GET['idservicio_chat'];
		$mensaje=$_GET['mensaje'];
		$sckchat=new op_mysql();
		$sckchat->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
		$sckchat2=new op_mysql();
		$sckchat2->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
		$sckchat3=new op_mysql();
		$sckchat3->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
		if($_GET['usrconectado']=='1'){
		$sql_qchat="SELECT * FROM peticiones_chat WHERE idservicio='$idservicio_chat' AND idusuario='$idusuario' ORDER BY ID ASC";
			if($sckchat3->QuerySQL($sql_qchat)==0){
				while($dataq=$sckchat3->getData()){
					$historial.=$dataq['qescribe'].": ".base64_decode($dataq['mensaje'])."\n";
				}
			}
			//echo("SI");
			$sqlchat="SELECT * FROM peticiones_chat WHERE ID='".$_GET['idchat']."'";
			if($sckchat->QuerySQL($sqlchat)==0){
				//echo("SI");
				if($sckchat->getFilas()>0){
					//echo("SI");
					$datos_chat=$sckchat->getData();
					$fecha=$datos_chat['fecha'];
					$idusuario_=$datos_chat['idusuario'];
					$sqlchat_="UPDATE peticiones_chat SET visto='1', idatend='".$_SESSION['idusuario']."' WHERE fecha='$fecha' AND idusuario='".$_GET['idusuario']."' AND idservicio='$idservicio_chat'";
					if($sckchat2->QuerySQL($sqlchat_)==0){
						//echo("SI");
						//$sql_qchat="INSERT INTO peticiones_chat(idusuario,idservicio,mensaje,fecha,hora,idatend,visto,qescribe) VALUES('".$_POST['idusuario']."','$idservicio_chat','$mensaje','".date("Y-m-d")."','".date("H:i:s")."','".$_SESSION['idusuario']."','0','".$_SESSION['Correo_Admin']."')";
						//if($sckchat3->QuerySQL($sql_qchat)==0){
							//echo($historial);
						//}
					}
				}
			}
			?>
				<script type="text/javascript">
					setInterval("check_admin_client('<?php echo($idusuario); ?>','tipo_asesoria','comentarios')",3000);
				</script>
				<select name="tipo_asesoria" id="tipo_asesoria" style="display:none;">
					<option value="<?php echo($idservicio_chat); ?>"><?php echo($idservicio_chat); ?></option>
				</select>
				<div>
					<table>
						<tr>
							<td>
								Mensaje
							</td>
						</tr>
						<tr>
							<td>
								<textarea id="comentarios" style="width:600px;height:300px;"><?php echo($historial); ?></textarea>
							</td>
						</tr>
						<tr>
							<td>
								Respuesta al cliente
							</td>
						</tr>
						<tr>
							<td>
								<input id="respuesta" name="respuesta" type="text">
							</td>
						</tr>
						<tr>
							<td>
								<input id="respuesta" name="respuesta" type="button" value="Responder" onclick="<?php echo("enviar_respuesta($idchat,$idusuario,$idservicio_chat,'respuesta','".$_SESSION['Correo_Admin']."');"); ?>">
							</td>
						</tr>
					</table>
				</div>
			<?php
		}
		else{
			
		}
	}

	if($_POST['enviarrespuestachat']=="true"){
		$idchat=$_POST['idchat'];
		$idusuario=$_POST['idusuario'];
		$idservicio_chat=$_POST['idservicio'];
		$mensaje=base64_encode($_POST['mensaje']);
		$sckchat=new op_mysql();
		$sckchat->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
		$sckchat2=new op_mysql();
		$sckchat2->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
		$sckchat3=new op_mysql();
		$sckchat3->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
		echo("SI");
		$_SESSION['idservicio']=$idservicio_chat;
		$sqlchat="SELECT * FROM peticiones_chat WHERE ID='".$_POST['idchat']."'";
		if($sckchat->QuerySQL($sqlchat)==0){
			echo("SI");
			if($sckchat->getFilas()>0){
				echo("SI");
				$datos_chat=$sckchat->getData();
				$fecha=$datos_chat['fecha'];
				$idusuario_=$datos_chat['idusuario'];
				$sql_qchat2="INSERT INTO peticiones_chat(idusuario,idservicio,mensaje,fecha,hora,idatend,visto,qescribe) VALUES('".$_SESSION['idusuario']."','$idservicio_chat','$mensaje','".date("Y-m-d")."','".date("H:i:s")."','".$_SESSION['idusuario']."','0','".$_SESSION['Correo_Admin']."')";
				if($sckchat3->QuerySQL($sql_qchat2)==0){
					echo("Ya se han ingresado los datos");
				}
			}
		}
	}

	if($_POST['actualizarlistachat']=='true'){
		$historial="";
		$servicio=$_POST['servicio'];
		$newsub2=new op_mysql();
		$newsub2->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
		$sql_qchat="SELECT * FROM peticiones_chat WHERE idservicio='$servicio' AND idusuario='".$_POST['idusuario']."' ORDER BY ID ASC";
		if($newsub2->QuerySQL($sql_qchat)==0){
			while($dataq=$newsub2->getData()){
				$historial.=$dataq['qescribe'].": ".base64_decode($dataq['mensaje'])."\n";
			}
			echo($historial);
		}
	}
?>