﻿<?php
	ini_set('upload_max_filesize', '100M');
	ini_set('post_max_size', '100M');
	ini_set('max_execution_time', 100000);
?>
<script language="JavaScript" type="text/javascript">
	var contador;
	contador=0;
	function abreSitio(valselect){
		var URL = "http://";
		var web = document.getElementById(valselect).value;
		location.href=web;
	}
</script>
<div class="titulobar"></div>
<div class="modulobar" style="margin-left: 30px;">
	<a href="<?php echo("?mod=".$_GET['mod']."&opcion=descargas&entrar=".$_GET['entrar']); ?>"><h1>Accesorios</h1></a>
	<?php
		if($_GET['opcion']=="tiendaonline"){
			$tabproductos_tab="active";
			$tabcategorias_tab="";
		}
		else{
			$tabcategorias_tab="active";
			$tabproductos_tab="";
		}
	?>
	<ul class="nav nav-tabs">
	<?php
		if($_GET['opcion']=="categorias"){
			$tab_categorias="active";
			$mod_categorias="tab-pane active";
			$tab_productos="";
			$mod_productos="tab-pane";
		}
		else{
			$tab_productos="active";
			$mod_productos="tab-pane active";
			$mod_categorias="tab-pane";
			$tab_categorias="";							
		}
	?>
	  <li class="<?php echo($tab_productos); ?>"><a href="#productos" data-toggle="tab">Productos</a></li>
	  <li class="<?php echo($tab_categorias); ?>"><a href="#categorias" data-toggle="tab">Categor&iacute;as</a></li>
	</ul>
		<table>
			<tr>
				<td>
					<!-- Tab panes -->
					<div class="tab-content">
					  <div class="<?php echo($mod_productos); ?>" id="productos">
						  	<?php
						  		if($_GET['subopcion']!=''){
							  		if($_GET['subopcion']=='agregar'){
							  			$classagregar="active";
							  		}
									elseif($_GET['subopcion']=='modificar'){
							  			$classmodificar="active";
							  		}
									else{
										$classeliminar="active";
									}
						  		}
						  	?>
							<table>
								<tr>
									<td>
										<ul class="nav nav-pills">
										  <li class="<?php echo($classagregar); ?>"><a href="<?php echo("?mod=".$_GET['mod']."&opcion=&subopcion=agregar&entrar=".$_GET['entrar']); ?>">Agregar</a></li>
										  <li class="<?php echo($classmodificar); ?>"><a href="<?php echo("?mod=".$_GET['mod']."&opcion=&subopcion=modificar&entrar=".$_GET['entrar']); ?>">Modificar</a></li>
										  <li class="<?php echo($classeliminar); ?>"><a href="<?php echo("?mod=".$_GET['mod']."&opcion=&subopcion=eliminar&entrar=".$_GET['entrar']); ?>">Eliminar</a></li>
										</ul>
									</td>
								</tr>
							</table>
							<form method="POST" enctype="multipart/form-data">
							<?php
								// <div class="alert alert-success">...</div>
								// <div class="alert alert-info">...</div>
								// <div class="alert alert-warning">...</div>
								// <div class="alert alert-danger">...</div>
							$msqlq="";
							if($_GET['IDX']!=''){
								$sqle="SELECT * FROM clave_archivo_bib WHERE idarchivo='".$_GET['IDX']."'";
								if($dbn->QuerySQL($sqle)==0){
									if($dbn->getFilas()>0){
										$cadenaeti="";
										while($datos=$dbn->getData()){
											$cadenaeti.=$datos['clave'].",";
										}
									}
									else{
										$fechaevento='';
									}					
								}
					
								$sqle="SELECT * FROM bib_fiscal WHERE ID='".$_GET['IDX']."'";
								if($dbn->QuerySQL($sqle)==0){
									if($dbn->getFilas()>0){
										$datos=$dbn->getData();
										$nombredenlace_cons=$datos['nombre'];
										$idcateg_cons=$datos['idcategoria'];
										$sumario=$datos['descripcion'];
									}		
								}
							}
							
								$option=$_GET['opcion'];
								$btn=$_POST['btnprocesar'];
								if($btn){
									$logo=$_FILES["imgicono"]['name'];
									$tamano = $_FILES["imgicono"]['size'];
								    $tipo = $_FILES["imgicono"]['type'];
								    $archivo = $_FILES["imgicono"]['name'];
									$enlaceimagen=$_POST['nombreenlace'];
									$nombrecateg_bib=$_POST['nombrecategoria'];
									$descrip=$_POST['content'];
									$etiq=$_POST['etiquetas_1'];
									$sqlog="SELECT * FROM bib_fiscal WHERE ID='".$_GET['IDX']."'";
									if($dbn->QuerySQL($sqlog)==0){
										if($dbn->getFilas()>0){
											$datael=$dbn->getData();
											if($_GET['subopcion']=='eliminar'){
												$sqlog="DELETE FROM clave_archivo_bib WHERE idarchivo='".$_GET['IDX']."'";
												$dbn2->QuerySQL($sqlog);
												$sqlog="DELETE FROM bib_fiscal WHERE ID='".$_GET['IDX']."'";
												if($dbn3->QuerySQL($sqlog)==0){
													$urlarchivo="admin/".$datael['archivo'];
													unlink($urlarchivo);
												}
												?>
													<div class="alert alert-success">
														Se han eliminado los datos con exito!
													</div>
												<?php
											}
											else{
												if($archivo!=''){
													//echo("SI HAY IMAGEN");
												    // obtenemos los datos del archivo
											    	$prefijo = substr(md5(uniqid(rand())),0,6);
											        // guardamos el archivo a la carpeta files
											        $destino =  "uploads/".$prefijo."_".$archivo;
											        if(move_uploaded_file($_FILES["imgicono"]['tmp_name'],$destino)){
														$sqlog="UPDATE bib_fiscal SET archivo='$destino' WHERE ID='".$_GET['IDX']."'";
														if($dbn->QuerySQL($sqlog)==0){
															//echo("Se han modificado la imagen con exito");
														}
													}
												}
												
												if($enlaceimagen!=''){
													//echo("SI HAY ENLACE");
													$sqlog="UPDATE bib_fiscal SET nombre='$enlaceimagen' WHERE ID='".$_GET['IDX']."'";
													if($dbn->QuerySQL($sqlog)==0){
														echo("Se han modificado la imagen con exito");
													}
												}
												
												if($nombrecateg_bib!=''){
													//echo("SI HAY ENLACE");
													$sqlog="UPDATE bib_fiscal SET idcategoria='$nombrecateg_bib' WHERE ID='".$_GET['IDX']."'";
													if($dbn->QuerySQL($sqlog)==0){
														//echo("Se han modificado la imagen con exito");
													}
												}
												
												if($descrip!=''){
													//echo("SI HAY ENLACE");
													$sqlog="UPDATE bib_fiscal SET descripcion='$descrip' WHERE ID='".$_GET['IDX']."'";
													if($dbn->QuerySQL($sqlog)==0){
														//echo("Se han modificado la imagen con exito");
													}													
												}
												
												?>
													<div class="alert alert-success">
														Se han modiicado los datos con exito!
													</div>
												<?php
											}
										}
										else{
											if($archivo!=''){
												//echo("SI HAY IMAGEN");
												$nomcateg=$_POST['nombrecategoria'];
											    // obtenemos los datos del archivo
										    	$prefijo = substr(md5(uniqid(rand())),0,6);
										        // guardamos el archivo a la carpeta files
										        $destino =  "uploads/".$prefijo."_".$archivo;
										        if(move_uploaded_file($_FILES["imgicono"]['tmp_name'],$destino)){
													$sqlog="INSERT INTO bib_fiscal(archivo,nombre,idcategoria,fecha,descripcion) VALUES('$destino','$enlaceimagen','$nomcateg','".date("Y-m-d")."','$descrip')";
													if($dbn->QuerySQL($sqlog)==0){
														$recien=$dbn->getIDInsert();
														echo("Se han agregado la imagen con exito");
													}
													$datetiq=explode(",",$etiq);
													for($i=0;$i<=(count($datetiq)-1);$i++){
														$sqletiq="INSERT INTO clave_archivo_bib(clave,idarchivo) VALUES('".$datetiq[$i]."','$recien')";
														$dbn3->QuerySQL($sqletiq);
													}
												}
											}
										}
									}
								}
							?>
							<table>
							<?php
							if($_GET['subopcion']=='modificar' || $_GET['subopcion']=='eliminar') {
								?>
								<tr>
									<td>
										<?php
											echo("Nombre");
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
											<SELECT name="nombreenlace" id="nombreenlace" onchange="abreSitio('nombre');">
													<OPTION>[seleccione nombre]</OPTION>
											<?php
											if($_GET['opcion']!=''){
												$opciontabla=$_GET['opcion'];
											}
											else{
												$opciontabla="bib_fiscal";
											}
											if($opciontabla=="bib_fiscal"){
												$tabladef="bib_fiscal";
												$campomos="nombre";
											}
												$sqlsel="SELECT * FROM ".$tabladef." ORDER BY ID DESC";
												if($dbn->QuerySQL($sqlsel)==0){
													if($dbn->getFilas()>0){
														while($datserv=$dbn->getData()){
															if($datserv['ID']==$_GET['IDX']){
																echo("<OPTION SELECTED value=\"?&mod=adminnoticias&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&codigonot=".$datserv['codigonot']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
															}
															else{
																echo("<OPTION value=\"?&mod=adminnoticias&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&codigonot=".$datserv['codigonot']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
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
												$opciontabla="bib_fiscal";
											}
											if($opciontabla=="bib_fiscal"){
												$tabladef="bib_fiscal";
												$campomos="nombre";
											}
											?>
											<SELECT name="nombreenlace" id="nombreenlace"  onchange="abreSitio('nombreenlace');">
												<OPTION>[seleccione nombre]</OPTION>
												<?php
													$sqlsel="SELECT * FROM ".$tabladef." ORDER BY ID DESC";
													if($dbn->QuerySQL($sqlsel)==0){
														if($dbn->getFilas()>0){
															while($datserv=$dbn->getData()){
																if($_GET['option']!='niveles'){
																	if($datserv['ID']==$_GET['IDX']){
																		echo("<OPTION SELECTED value=\"?&mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&codigonot=".$datserv['codigonot']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
																	}
																	else{
																		echo("<OPTION value=\"?&mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&codigonot=".$datserv['codigonot']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
																	}	
																}
																else{
																	if($datserv['ID']==$_GET['IDX']){
																		echo("<OPTION SELECTED value=\"?&mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&codigonot=".$datserv['codigonot']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
																	}
																	else{
																		echo("<OPTION value=\"?&mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&codigonot=".$datserv['codigonot']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
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
										else{
											?>
												<tr>
													<td>Nombre</td>
												</tr>
												<tr>
													<td>
														<INPUT name="nombreenlace" id="nombreenlace" type="text">
													</td>
												</tr>
											<?php	
										}
										?>
									</td>
								</tr>
								<?php
									if(($_GET['subopcion']=='modificar' || $_GET['subopcion']=='eliminar' || $_GET['subopcion']=='consultar') && $_GET['opcion']!='niveles') {
										?>
											<tr>
												<td>
													<INPUT name="nombreenlace" id="nombreenlace" type="text" value="<?php echo($nombredenlace_cons); ?>">
												</td>
											</tr>
										<?php
									}
								?>
								<tr>
									<td>Categor&iacute;a</td>
								</tr>
								<tr>
									<td>
										<?php
												$tabladef="categorias_bib";
												$campomos="nombre";
											?>
											<SELECT name="nombrecategoria" id="nombrecategoria">
												<OPTION>[seleccione categoria]</OPTION>
												<?php
													$sqlsel="SELECT * FROM ".$tabladef." ORDER BY ID DESC";
													if($dbn->QuerySQL($sqlsel)==0){
														if($dbn->getFilas()>0){
															while($datserv=$dbn->getData()){
																if($datserv['ID']==$idcateg_cons){
																	echo("<OPTION SELECTED value=\"".$datserv['ID']."\">".$datserv[$campomos]."</OPTION>");
																}
																else{
																	echo("<OPTION value=\"".$datserv['ID']."\">".$datserv[$campomos]."</OPTION>");
																}
															}
														}
													}
													echo("<OPTION value='NINGUNO'>NINGUNO</OPTION>");
												?>
											</SELECT>
									</td>
								</tr>
								<tr>
									<td>C&oacute;digo</td>
								</tr>
								<tr>
									<td>
										<INPUT name="codigo" id="codigo" type="text">
									</td>
								</tr>
								<tr>
									<td>Imagenes</td>
								</tr>
								<tr>
									<td>
										<table>
											<tr>
												<td>
													<input name="imgicono[]" id="imgicono[]" type="file">
												</td>
												<td>
													<input name="agregarunomas[]" id="agregarunomas[]" type="button" value="Agregar 1">
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td>Precio</td>
								</tr>
								<tr>
									<td>
										<input name="precio" id="precio" type="text">
									</td>
								</tr>
								<tr>
									<td>Disponibilidad</td>
								</tr>
								<tr>
									<td>
										<input name="disp" id="disp" type="text">
									</td>
								</tr>
								<tr>
									<td>Destacado</td>
								</tr>
								<tr>
									<td>
										<select name="destacado" id="destacado">
											<option value="si">SI</option>
											<option value="no">NO</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>Sumario</td>
								</tr>
								<tr>
									<td>
										<textarea name="content" id="content" style="width:100%;display:block;"><?php
												echo($sumario);
											?></textarea>
										<!-- CKEditor -->
										<script type="text/javascript">
											CKEDITOR.replace( 'content' );	
										</script>
									</td>
								</tr>
								<tr>
									<td>
										<input id="btnprocesar" name="btnprocesar" type="submit" class="btn btn-large btn-primary" value="Procesar"></input>
									</td>
								</tr>
							</table>
						</form>
				  </div>
				  <div class="<?php echo($mod_categorias); ?>" id="categorias">
					<table>
						<tr>
							<td>
								<ul class="nav nav-pills">
								  <li class="<?php echo($classagregar); ?>"><a href="<?php echo("?mod=".$_GET['mod']."&opcion=categorias&subopcion=agregar&entrar=".$_GET['entrar']); ?>">Agregar</a></li>
								  <li class="<?php echo($classmodificar); ?>"><a href="<?php echo("?mod=".$_GET['mod']."&opcion=categorias&subopcion=modificar&entrar=".$_GET['entrar']); ?>">Modificar</a></li>
								</ul>
							</td>
						</tr>
					</table>
					<form method="POST" enctype="multipart/form-data">
						<?php
						//error_reporting(E_ERROR);
						
						$msqlq="";
						if($_GET['IDX']!=''){
							$sqle="SELECT * FROM categorias_bib WHERE ID='".$_GET['IDX']."'";
							if($dbn->QuerySQL($sqle)==0){
								if($dbn->getFilas()>0){
									$datos=$dbn->getData();
									$nombredenlace_cons=$datos['nombre'];
									$pertenece_cons=$datos['pertenece'];
								}		
							}
						}
						
							$option=$_GET['opcion'];
							$btn=$_POST['btnprocesar'];
							if($btn){
								$enlaceimagen_cat=$_POST['nombreenlace1'];
								$nombrecateg_cat=$_POST['nombrecategoria1'];
								if($enlaceimagen_cat!=''){
									$sqlog="SELECT * FROM categorias_bib WHERE ID='".$_GET['IDX']."'";
									if($dbn->QuerySQL($sqlog)==0){
										if($dbn->getFilas()>0){
											$datael=$dbn->getData();
											if($enlaceimagen_cat!=''){
												//echo("SI HAY ENLACE");
												$pertenece_cons=$_POST['nombrecategoria1'];
												$sqlog="UPDATE categorias_bib SET nombre='$enlaceimagen_cat', pertenece='$pertenece_cons' WHERE ID='".$_GET['IDX']."'";
												if($dbn->QuerySQL($sqlog)==0){
													echo("Se han modificado la imagen con exito");
												}
											}
											
											if($_GET['subopcion']=='eliminar'){
												$sqlog="DELETE FROM categorias_bib WHERE ID='".$_GET['IDX']."'";
												$dbn->QuerySQL($sqlog);
											}
										}
										else{
											$sqlog="INSERT INTO categorias_bib(nombre,pertenece) VALUES('$enlaceimagen_cat','$nombrecateg_cat')";
											if($dbn->QuerySQL($sqlog)==0){
												$recien=$dbn->getIDInsert();
												echo("Se han agregado la categoria con exito");
											}
										}
									}
								}
							}
						?>
						<table>
						<?php
						if($_GET['subopcion']=='modificar' || $_GET['subopcion']=='eliminar') {
							?>
							<tr>
								<td>
									<?php
										echo("Seleccionar Archivo");
									?>
								</td>
							</tr>
						<?php
						}
						?>
							<tr>
								<td>
									<?php
									if(($_GET['subopcion']=='modificar' || $_GET['subopcion']=='eliminar' || $_GET['subopcion']=='consultar') && $_GET['opcion']!='niveles') {
										if($_GET['opcion']!=''){
											$opciontabla=$_GET['opcion'];
											
										}
										else{
											$opciontabla="bib_fiscal";
										}
										if($opciontabla=="bib_fiscal"){
											$tabladef="bib_fiscal";
											$campomos="nombre";
										}
										?>
										<SELECT name="nombreenlace1" id="nombreenlace1"  onchange="abreSitio('nombreenlace1');">
											<OPTION>[seleccione categoria]</OPTION>
											<?php
												$sqlsel="SELECT * FROM ".$tabladef." ORDER BY ID DESC";
												if($dbn->QuerySQL($sqlsel)==0){
													if($dbn->getFilas()>0){
														while($datserv=$dbn->getData()){
															if($_GET['option']!='niveles'){
																if($datserv['ID']==$_GET['IDX']){
																	echo("<OPTION SELECTED value=\"?&mod=".$_GET['mod']."&opcion=categorias&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&codigonot=".$datserv['codigonot']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
																}
																else{
																	echo("<OPTION value=\"?&mod=".$_GET['mod']."&opcion=categorias&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&codigonot=".$datserv['codigonot']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
																}	
															}
															else{
																if($datserv['ID']==$_GET['IDX']){
																	echo("<OPTION SELECTED value=\"?&mod=".$_GET['mod']."&opcion=categorias&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&codigonot=".$datserv['codigonot']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
																}
																else{
																	echo("<OPTION value=\"?&mod=".$_GET['mod']."&opcion=categorias&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&codigonot=".$datserv['codigonot']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
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
									else{
										?>
											<tr>
												<td>Nombre</td>
											</tr>
											<tr>
												<td>
													<INPUT name="nombreenlace1" id="nombreenlace1" type="text">
												</td>
											</tr>
										<?php	
									}
									?>
								</td>
							</tr>
							<?php
								if(($_GET['subopcion']=='modificar' || $_GET['subopcion']=='eliminar' || $_GET['subopcion']=='consultar') && $_GET['opcion']!='niveles') {
										?>
											<tr>
												<td>
													<INPUT name="nombreenlace1" id="nombreenlace1" type="text" value="<?php echo($nombredenlace_cons); ?>">
												</td>
											</tr>
										<?php					
								}
							?>
							<tr>
								<td>
									Padre
								</td>
							</tr>
							<tr>
								<td>
									<?php
											$tabladef="categorias_bib";
											$campomos="nombre";
										?>
										<SELECT name="nombrecategoria1" id="nombrecategoria1">
											<OPTION>[seleccione categoria]</OPTION>
											<?php
												$sqlsel="SELECT * FROM ".$tabladef." WHERE ID<>'".$_GET['IDX']."'";
												if($dbn->QuerySQL($sqlsel)==0){
													if($dbn->getFilas()>0){
														while($datserv=$dbn->getData()){
															if($datserv['ID']==$pertenece_cons){
																echo("<OPTION SELECTED value=\"".$datserv['ID']."\">".$datserv[$campomos]."</OPTION>");
															}
															else{
																echo("<OPTION value=\"".$datserv['ID']."\">".$datserv[$campomos]."</OPTION>");
															}
														}
													}
												}
												echo("<OPTION value='0'>NINGUNO</OPTION>");
											?>
										</SELECT>
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
				</div>
			</td>
		</tr>
	</table>
</div>