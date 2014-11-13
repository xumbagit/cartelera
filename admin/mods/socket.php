<?php
	session_start();
	require_once('../conf/config.conf.php');
	require_once('../libs/op_mysql.class.php');
	$dbn=new op_mysql();
	$dbn->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	$dbn2=new op_mysql();
	$dbn2->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	//echo($dbn->getIDConn());
	function operacion_fecha($fecha,$dias){ 
		list($dia,$mes,$ano)=explode("-",$fecha); 
		if (!checkdate($mes,$dia,$ano)){return false;} 
		$dia=$dia+$dias; 
		$fecha=date( "d-m-Y", mktime(0,0,0,$mes,$dia,$ano) ); 
		return $fecha;
	}  
	if($_POST['agregarhorario']=="true"){
		$hora=$_POST['hora'];
		$minutos=$_POST['minutos'];
		$turno=$_POST['turno'];
		$fechaFinal=$_POST['fecha'];
		$flag=$_POST['flag'];
		$contentdiv=$_POST['idcontent'];
		if($_SESSION['uniq_hash']==''){
			$prefijo = substr(md5(uniqid(rand())),0,16);
			$_SESSION['uniq_hash']=$prefijo;
			$idhash=$_SESSION['uniq_hash'];
		}
		else{
			$idhash=$_SESSION['uniq_hash'];
		}
		if($flag=="AGREGAR"){
			$HASH=$_POST['idtemp'];
			$sqlsel="SELECT * FROM peliculas WHERE idtemp='$HASH'";
			if($dbn->QuerySQL($sqlsel)==0){
				if($dbn->getFilas()>0){
					$datas=$dbn->getData();
					$idpeli=$datas['ID'];
				}
			}
			$horacompleta=$hora.":".$minutos.":"."00";
			if($hora<12 && $turno=="PM"){
				$horaFinal=$hora+12;
			}
			elseif($hora<12 && $turno=="AM"){
				$horaFinal=$hora;
			}
			else{
				$horaFinal=$hora;
			}
			$horacompletaMilitar=$horaFinal.":".$minutos.":"."00";
			$sqlsel="INSERT INTO horarios(hora,horaM,minuto,turno,idtemp,horacompleta,horamilitar,idpelicula,fecha,disponible) VALUES('$hora','$horaFinal','$minutos','$turno','$HASH','$horacompleta','$horacompletaMilitar','$idpeli','$fechaFinal','".$_POST['disponibilidad']."')";
			if($dbn->QuerySQL($sqlsel)==0){
				$HASH=$HASH;
			}
		}
		if($flag=="MODIFICAR"){
			$HASH=$_POST['idtemp'];
			$sqlsel="SELECT * FROM horarios WHERE ID='$HASH'";
			if($dbn->QuerySQL($sqlsel)==0){
				if($dbn->getFilas()>0){
					$datas=$dbn->getData();
					$idpeli=$datas['idpelicula'];
					$idhash=$datas['idtemp'];
				}
				else{
					$idhash=$_SESSION['uniq_hash'];
				}
			}
			$horacompleta=$hora.":".$minutos.":"."00";
			if($hora<12 && $turno=="PM"){
				$horaFinal=$hora+12;
			}
			elseif($hora<12 && $turno=="AM"){
				$horaFinal=$hora;
			}
			else{
				$horaFinal=$hora;
			}
			$horacompletaMilitar=$horaFinal.":".$minutos.":"."00";
			$sqlsel="UPDATE horarios SET hora='$hora', horaM='$horaFinal', minuto='$minutos', turno='$turno', horacompleta='$horacompleta', idpelicula='$idpeli', horamilitar='$horacompletaMilitar', disponible='".$_POST['disponibilidad']."'  WHERE ID='$HASH'";
			if($dbn->QuerySQL($sqlsel)==0){
				$HASH=$idhash;
			}
			//echo($dbn->getIDInsert());			
		}
		if($flag=="ELIMINAR"){
			$HASH=$_POST['idtemp'];
			$sqlsel="SELECT * FROM horarios WHERE ID='$HASH'";
			if($dbn->QuerySQL($sqlsel)==0){
				if($dbn->getFilas()>0){
					$datas=$dbn->getData();
					$idpeli=$datas['idpelicula'];
					$idhash=$datas['idtemp'];
				}
				else{
					$idhash=$_SESSION['uniq_hash'];
				}
			}
			$sqlsel="DELETE FROM horarios WHERE ID='$HASH'";
			if($dbn->QuerySQL($sqlsel)==0){
				$HASH=$idhash;
			}
		}
		$sqlsel="SELECT * FROM horarios WHERE idtemp='$HASH' AND fecha='$fechaFinal' ORDER BY ID DESC";
		if($dbn->QuerySQL($sqlsel)==0){
			if($dbn->getFilas()>0){
				$u=0;
				?>
					<table>
						<tr>
							<td>
								Horarios
							</td>
						</tr>
					</table>
					<table>
				<?php
				while($data=$dbn->getData()){
					$btnmodificarhoras="btnmodificarhoras".$u;
					$modificarhorastxt="modificarhorastxt".$u;
					$modificarmintxt="modificarmintxt".$u;
					$modificarturnotxt="modificarturnotxt".$u;
					$modificardispontxt="diacmbmod0".$u;
					?>
						<tr>
							<td>
								<SELECT name="<?php echo($modificarhorastxt); ?>" id="<?php echo($modificarhorastxt); ?>">
									<?php
										for($i=1; $i<=12;$i++){
											?>
												<OPTION <?php if($data['hora']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
											<?php
										}
									?>
								</SELECT>									
							</td>
							<td>
								<SELECT name="<?php echo($modificarmintxt); ?>" id="<?php echo($modificarmintxt); ?>">
									<?php
										for($i=0; $i<=59;$i++){
											?>
												<OPTION <?php if($data['minuto']==$i){ echo("SELECTED"); } ?> value="<?php echo($i); ?>"><?php echo($i); ?></OPTION>
											<?php
										}
									?>
								</SELECT>									
							</td>
							<td>
								<SELECT name="<?php echo($modificarturnotxt); ?>" id="<?php echo($modificarturnotxt); ?>">
									<OPTION <?php if($data['turno']=="PM"){ echo("SELECTED"); } ?> value="PM">PM</OPTION>
									<OPTION <?php if($data['turno']=="AM"){ echo("SELECTED"); } ?> value="AM">AM</OPTION>
								</SELECT>
							</td>
							<td style="width:10px;">
								
							</td>
							<td>
								<SELECT name="<?php echo($modificardispontxt); ?>" id="<?php echo($modificardispontxt); ?>">
									<OPTION value="DISPONIBLE" <?php if($data['disponible']=="DISPONIBLE"){ echo("SELECTED"); }?>>DISPONIBLE</OPTION>
									<OPTION value="AGOTADO" <?php if($data['disponible']=="AGOTADO"){ echo("SELECTED"); }?>>AGOTADO</OPTION>
								</SELECT>
							</td>
							<td>
								<input id="<?php echo($btnmodificarhoras); ?>" name="<?php echo($btnmodificarhoras); ?>" type="button" class="btn btn-small btn-success" 
								onclick="<?php echo("agregarhorario('".$modificarhorastxt."','".$modificarmintxt."','".$modificarturnotxt."',".$data['ID'].",'".$contentdiv."','".$data['fecha']."','$modificardispontxt','MODIFICAR');"); ?>" 
								value="Editar"></input>															
							</td>
							<td style="width:5px;">
								
							</td>
							<td>
								<input id="<?php echo($btnmodificarhoras); ?>" name="<?php echo($btnmodificarhoras); ?>" type="button" class="btn btn-small btn-danger" 
								onclick="<?php echo("agregarhorario('".$modificarhorastxt."','".$modificarmintxt."','".$modificarturnotxt."',".$data['ID'].",'".$contentdiv."','".$data['fecha']."','$modificardispontxt','ELIMINAR');"); ?>" 
								value="Eliminar"></input>															
							</td>
						</tr>
						<tr>
							<td style="height:5px;">
								
							</td>
						</tr>
					<?php
					$u++;
				}
				?>
					</table>
				<?php
			}
		}
	}
	
	if($_POST['eliminarchivo']=="true"){
		$id=$_POST['idarchivo'];
		$sqlsel="DELETE FROM imagenes WHERE ID='$id'";
		$dbn->QuerySQL($sqlsel);
	}
	
	if($_POST['actualizarlista']=="true"){
		$sqlsel="SELECT * FROM imagenes WHERE uniq_llave='".$_SESSION['uniq_llave']."'";
		if($dbn->QuerySQL($sqlsel)==0){
			if($dbn->getFilas()>0){
				while($datserv=$dbn->getData()){
					?>
						<div id="<?php echo($datserv['ID']); ?>" onclick="eliminarfoto(this.id);" class="preview done">
							<span class="imageHolder">
								<img src="<?php echo($datserv['archivo']); ?>" />
								<span class="uploaded"></span>
							</span>
						</div>
						<div class="progressHolder">
							<div class="progress"></div>
						</div>
					<?php
				}
			}
		}
	}

	if($_POST['calculardiafecha']=="true"){
		$fechai=$_POST['fechainicio'];
		$idpeli=$_POST['IDpelicula'];
		$sqlsel="SELECT * FROM peliculas WHERE ID='$idpeli'";
		if($dbn->QuerySQL($sqlsel)==0){
			if($dbn->getFilas()>0){
				$datas=$dbn->getData();
				$sqlsel2="UPDATE peliculas SET fecha='$fechai' WHERE ID='$idpeli'";
				$dbn2->QuerySQL($sqlsel2);
			}
		}
		$fecha1=$fechai;
		$nuevaFecha1=$fecha1;
		//$nuevaFecha1=date('Y-m-d',$nuevaFecha1);
		/////////////////////
		$fecha2=date($fechai,strtotime("1 day"));
		$nuevaFecha2=strtotime("1 day",strtotime($fecha2));
		$nuevaFecha2=date('Y-m-d',$nuevaFecha2);
		/////////////////////
		$fecha3=date($fechai,strtotime("2 day"));
		$nuevaFecha3=strtotime("2 day",strtotime($fecha3));
		$nuevaFecha3=date('Y-m-d',$nuevaFecha3);
		/////////////////////
		$fecha4=date($fechai,strtotime("3 day"));
		$nuevaFecha4=strtotime("3 day",strtotime($fecha4));
		$nuevaFecha4=date('Y-m-d',$nuevaFecha4);
		/////////////////////
		$fecha5=date($fechai,strtotime("4 day"));
		$nuevaFecha5=strtotime("4 day",strtotime($fecha5));
		$nuevaFecha5=date('Y-m-d',$nuevaFecha5);
		/////////////////////
		$fecha6=date($fechai,strtotime("5 day"));
		$nuevaFecha6=strtotime("5 day",strtotime($fecha6));
		$nuevaFecha6=date('Y-m-d',$nuevaFecha6);
		/////////////////////
		$fecha7=date($fechai,strtotime("6 day"));
		$nuevaFecha7=strtotime("6 day",strtotime($fecha7));
		$nuevaFecha7=date('Y-m-d',$nuevaFecha7);
		/////////////////////
		$fecha8=date($fechai,strtotime("7 day"));
		$nuevaFecha8=strtotime("7 day",strtotime($fecha8));
		$nuevaFecha8=date('Y-m-d',$nuevaFecha8);
		/////////////////////
		$fechaArr1=explode("-",$nuevaFecha1);
		$fechaArr2=explode("-",$nuevaFecha2);
		$fechaArr3=explode("-",$nuevaFecha3);
		$fechaArr4=explode("-",$nuevaFecha4);
		$fechaArr5=explode("-",$nuevaFecha5);
		$fechaArr6=explode("-",$nuevaFecha6);
		$fechaArr7=explode("-",$nuevaFecha7);
		$fechaArr8=explode("-",$nuevaFecha8);
		///////////////////////////////////////////
		$dia1=date("w",mktime(0,0,0,$fechaArr1[1], $fechaArr1[2],$fechaArr1[0]));
		$dia2=date("w",mktime(0,0,0,$fechaArr2[1], $fechaArr2[2],$fechaArr2[0]));
		$dia3=date("w",mktime(0,0,0,$fechaArr3[1], $fechaArr3[2],$fechaArr3[0]));
		$dia4=date("w",mktime(0,0,0,$fechaArr4[1], $fechaArr4[2],$fechaArr4[0]));
		$dia5=date("w",mktime(0,0,0,$fechaArr5[1], $fechaArr5[2],$fechaArr5[0]));
		$dia6=date("w",mktime(0,0,0,$fechaArr6[1], $fechaArr6[2],$fechaArr6[0]));
		$dia7=date("w",mktime(0,0,0,$fechaArr7[1], $fechaArr7[2],$fechaArr7[0]));
		$dia8=date("w",mktime(0,0,0,$fechaArr8[1], $fechaArr8[2],$fechaArr8[0]));
		echo($dia1.",".$dia2.",".$dia3.",".$dia4.",".$dia5.",".$dia6.",".$dia7.",".$dia8.",".$nuevaFecha1.",".$nuevaFecha2.",".$nuevaFecha3.",".$nuevaFecha4.",".$nuevaFecha5.",".$nuevaFecha6.",".$nuevaFecha7.",".$nuevaFecha8);
	}
?>
