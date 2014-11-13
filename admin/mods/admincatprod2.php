﻿<?php
	ini_set('upload_max_filesize', '100M');
	ini_set('post_max_size', '100M');
	ini_set('max_execution_time', 100000);
	if($_GET['IDX']!=''){
		$sqle="SELECT * FROM accesorios WHERE ID='".$_GET['IDX']."'";
		if($dbn->QuerySQL($sqle)==0){
			if($dbn->getFilas()>0){
				$datos=$dbn->getData();
				$nombreacce_cons=$datos['nombre'];
				$idhash_cons=$datos['hash'];
				$destacadocons=$datos['destacado'];
				$codigo_cons=$datos['codigo'];
				$precio_cons=$datos['precio'];
				$disponibilidad_cons=$datos['disponibilidad'];
				$descripcion_cons=$datos['descripcion'];
				$destacado_cons=$datos['destacado'];
				$categoria_cons=$datos['categoria'];
				
				$inspiracion_en=$datos['inspiracion_en'];
				$inspiracion_fr=$datos['inspiracion_fr'];
				$inspiracion_sp=$datos['inspiracion_sp'];
				$materiales_en=$datos['materiales_en'];
				$materiales_fr=$datos['materiales_fr'];
				$materiales_sp=$datos['materiales_sp'];
			}
		}
	}
?>
<!-- The main CSS file -->
<!-- Our CSS stylesheet file -->
<link rel="stylesheet" href="libs/html5fileupload/assets/css/styles.css" />
<!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
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
								$option=$_GET['opcion'];
								$btn=$_POST['btnprocesar'];
								if(!empty($_POST)){
								    // obtenemos los datos del archivo
							    	$prefijo = substr(md5(uniqid(rand())),0,6);
							        // guardamos el archivo a la carpeta files
							        $destino =  "uploads/".$prefijo."_".$archivo;
								}
								if($btn){
									$idhash=$_SESSION['uniq_hash'];
									$logo=$_FILES["imagenportada"]['name'];
									$tamano = $_FILES["imagenportada"]['size'];
								    $tipo = $_FILES["imagenportada"]['type'];
								    $archivo = $_FILES["imagenportada"]['name'];
									$enlaceimagen=$_POST['nombreenlace'];
									$disponibilidad=$_POST['disp'];
									$precio=$_POST['precio'];
									$codigo=$_POST['codigo'];
									$destacado=$_POST['destacado'];
									$descrip=$_POST['content'];
									$categoria=$_POST['nombrecategoria'];
									$inspiracion_en=$_POST['content'];
									$inspiracion_fr=$_POST['content1'];
									$inspiracion_sp=$_POST['content2'];
									$materiales_en=$_POST['content3'];
									$materiales_fr=$_POST['content4'];
									$materiales_sp=$_POST['content5'];
									$sqlog="SELECT * FROM accesorios WHERE ID='".$_GET['IDX']."'";
									if($dbn->QuerySQL($sqlog)==0){
										if($dbn->getFilas()>0){
											$datael=$dbn->getData();
											if($_GET['subopcion']=='eliminar'){
												$sqlog="DELETE FROM accesorios WHERE ID='".$_GET['IDX']."'";
												$dbn2->QuerySQL($sqlog);
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
											        if(move_uploaded_file($_FILES["imagenportada"]['tmp_name'],$destino)){
														$sqlog="UPDATE accesorios SET imagenport='$destino' WHERE ID='".$_GET['IDX']."'";
														if($dbn->QuerySQL($sqlog)==0){
															//echo("Se han modificado la imagen con exito");
														}
													}
												}
												if($enlaceimagen!=''){
													$sqlog="UPDATE accesorios SET nombre='$enlaceimagen' WHERE ID='".$_GET['IDX']."'";
													if($dbn->QuerySQL($sqlog)==0){
														//echo("Se han modificado la imagen con exito");
													}
												}
												if($categoria!=''){
													$sqlog="UPDATE accesorios SET categoria='$categoria' WHERE ID='".$_GET['IDX']."'";
													if($dbn->QuerySQL($sqlog)==0){
														//echo("Se han modificado la imagen con exito");
													}
												}
												if($descrip!=''){
													$sqlog="UPDATE accesorios SET descripcion='$descrip' WHERE ID='".$_GET['IDX']."'";
													if($dbn->QuerySQL($sqlog)==0){
														//echo("Se han modificado la imagen con exito");
													}
												}
												if($destacado!=''){
													$sqlog="UPDATE accesorios SET destacado='$destacado' WHERE ID='".$_GET['IDX']."'";
													if($dbn->QuerySQL($sqlog)==0){
														//echo("Se han modificado la imagen con exito");
													}
												}
												if($disponibilidad!=''){
													$sqlog="UPDATE accesorios SET disponibilidad='$disponibilidad' WHERE ID='".$_GET['IDX']."'";
													if($dbn->QuerySQL($sqlog)==0){
														//echo("Se han modificado la imagen con exito");
													}
												}
												if($precio!=''){
													$sqlog="UPDATE accesorios SET precio='$precio' WHERE ID='".$_GET['IDX']."'";
													if($dbn->QuerySQL($sqlog)==0){
														//echo("Se han modificado la imagen con exito");
													}
												}
												if($codigo!=''){
													$sqlog="UPDATE accesorios SET codigo='$codigo' WHERE ID='".$_GET['IDX']."'";
													if($dbn->QuerySQL($sqlog)==0){
														//echo("Se han modificado la imagen con exito");
													}
												}
												
												///Varios Idiomas
												if($inspiracion_en!=''){
													$sqlog="UPDATE accesorios SET inspiracion_en='$inspiracion_en' WHERE ID='".$_GET['IDX']."'";
													if($dbn->QuerySQL($sqlog)==0){
														//echo("Se han modificado la imagen con exito");
													}
												}
												if($inspiracion_sp!=''){
													$sqlog="UPDATE accesorios SET inspiracion_sp='$inspiracion_sp' WHERE ID='".$_GET['IDX']."'";
													if($dbn->QuerySQL($sqlog)==0){
														//echo("Se han modificado la imagen con exito");
													}
												}
												if($inspiracion_fr!=''){
													$sqlog="UPDATE accesorios SET inspiracion_fr='$inspiracion_fr' WHERE ID='".$_GET['IDX']."'";
													if($dbn->QuerySQL($sqlog)==0){
														//echo("Se han modificado la imagen con exito");
													}
												}
												if($materiales_en!=''){
													$sqlog="UPDATE accesorios SET materiales_en='$materiales_en' WHERE ID='".$_GET['IDX']."'";
													if($dbn->QuerySQL($sqlog)==0){
														//echo("Se han modificado la imagen con exito");
													}
												}
												if($materiales_fr!=''){
													$sqlog="UPDATE accesorios SET materiales_fr='$materiales_fr' WHERE ID='".$_GET['IDX']."'";
													if($dbn->QuerySQL($sqlog)==0){
														//echo("Se han modificado la imagen con exito");
													}
												}
												if($materiales_sp!=''){
													$sqlog="UPDATE accesorios SET materiales_sp='$materiales_sp' WHERE ID='".$_GET['IDX']."'";
													if($dbn->QuerySQL($sqlog)==0){
														//echo("Se han modificado la imagen con exito");
													}
												}
												?>
													<div class="alert alert-success">
														Se han modificado los datos con exito!
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
										        if(move_uploaded_file($_FILES["imagenportada"]['tmp_name'],$destino)){
													$sqlog="INSERT INTO accesorios(imagenport,nombre,categoria,descripcion,destacado,disponibilidad,precio,hash,codigo,fecha,inspiracion_en,inspiracion_sp,inspiracion_fr,materiales_en,materiales_sp,materiales_fr) VALUES('$destino','$enlaceimagen','$nomcateg','$descrip','$destacado','$disponibilidad','$precio','$idhash','$codigo','".date("Y-m-d")."','$inspiracion_en','$inspiracion_sp','$inspiracion_fr','$materiales_en','$materiales_sp','$materiales_fr')";
													if($dbn->QuerySQL($sqlog)==0){
														$recien=$dbn->getIDInsert();
														$_SESSION['uniq_hash']='';
														?>
															<div class="alert alert-success">
																Se han agregado los datos con exito!
															</div>
														<?php
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
										if($_GET['subopcion']=='modificar' || $_GET['subopcion']=='eliminar') {
											if($_GET['opcion']!=''){
												$opciontabla=$_GET['opcion'];
												
											}
											else{
												$opciontabla="accesorios";
											}
											if($opciontabla=="accesorios"){
												$tabladef="accesorios";
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
																	if($datserv['ID']==$_GET['IDX']){
																		echo("<OPTION SELECTED value=\"?&mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&categoria=".$datserv['categoria']."&IDX=".$datserv['ID']."&codigonot=".$datserv['codigonot']."&subopcion=".$_GET['subopcion']."&hash=".$datserv['hash']."\">".$datserv[$campomos]."</OPTION>");
																	}
																	else{
																		echo("<OPTION value=\"?&mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&categoria=".$datserv['categoria']."&IDX=".$datserv['ID']."&codigonot=".$datserv['codigonot']."&subopcion=".$_GET['subopcion']."&hash=".$datserv['hash']."\">".$datserv[$campomos]."</OPTION>");
																	}
																}
															}
															else{
																echo("<OPTION>NO HAY REGISTROS</OPTION>");
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
									if($_GET['subopcion']=='modificar' || $_GET['subopcion']=='eliminar'){
										?>
											<tr>
												<td>
													Nombre a Modificar
												</td>
											</tr>
											<tr>
												<td>
													<INPUT name="nombreenlace" id="nombreenlace" type="text" value="<?php echo($nombreacce_cons); ?>">
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
											$tabladef="categorias";
											$campomos="nombre";
										?>
										<SELECT name="nombrecategoria" id="nombrecategoria">
											<OPTION>[seleccione categoria]</OPTION>
											<?php
												$sqlsel="SELECT * FROM ".$tabladef." ORDER BY ID DESC";
												if($dbn->QuerySQL($sqlsel)==0){
													if($dbn->getFilas()>0){
														while($datserv=$dbn->getData()){
															if($datserv['ID']==$_GET['categoria']){
																echo("<OPTION SELECTED value=\"".$datserv['ID']."\">".$datserv[$campomos]."</OPTION>");
															}
															else{
																echo("<OPTION value=\"".$datserv['ID']."\">".$datserv[$campomos]."</OPTION>");
															}
														}
													}
												}
												if($categoria_cons==0){
													echo("<option SELECTED value='0'>NINGUNO</option>");
												}
												else{
													echo("<option value='NINGUNO'>NINGUNO</option>");
												}
											?>
										</SELECT>
									</td>
								</tr>
								<tr>
									<td>C&oacute;digo</td>
								</tr>
								<tr>
									<td>
										<INPUT name="codigo" id="codigo" type="text" value="<?php echo($codigo_cons); ?>">
									</td>
								</tr>
								<tr>
									<td>Imagen Portada</td>
								</tr>
								<tr>
									<td>
										<INPUT name="imagenportada" id="imagenportada" type="file">
									</td>
								</tr>
								<tr>
									<td>Im&aacute;genes Adicionales</td>
								</tr>
								<tr>
									<td>
										<div id="dropbox">
										<?php
											if($_GET['IDX']!=""){
												//echo($_SESSION['uniq_hash']);
												$sqlsel="SELECT * FROM imagenes WHERE uniq_llave='".$idhash_cons."'";
												if($dbn->QuerySQL($sqlsel)==0){
													//echo("HOLA");
													if($dbn->getFilas()>0){
														//echo("HOLA");
														$i=0;
														while($datserv=$dbn->getData()){
															?>
																<div id="<?php echo($datserv['ID']); ?>" class="preview done">
																	<span class="imageHolder">
																		<img src="<?php echo($datserv['archivo']); ?>" />
																		<span class="uploaded"></span>
																	</span>
																	<div class="progressHolder">
																		<div class="progress"></div>
																	</div>
																</div>
															<?php
															$i++;
														}
													}
												}
												$sqlsel="SELECT * FROM imagenes WHERE uniq_llave='".$idhash_cons."'";
												if($dbn->QuerySQL($sqlsel)==0){
													//echo("HOLA");
													if($dbn->getFilas()>0){
														//echo("HOLA");
														$i=0;
														while($datserv=$dbn->getData()){
															?>
																<script type="text/javascript">
																	var oID;
																	$(function(){
																		$(".preview").click(function() {
																			oID=$(this).attr("id");
																			alert(oID);
																			eliminarfoto_(oID);
																		 });
																	});
																</script>
															<?php
															$i++;
														}
													}
												}
											}
											else{
												?>
													<span class="message">Drop images here to upload. <br /><i>(they will only be visible to you)</i></span>
												<?php
											}
										?>
										</div>
									</td>
								</tr>
								<tr>
									<td>Precio</td>
								</tr>
								<tr>
									<td>
										<input name="precio" id="precio" type="text" value="<?php echo($precio_cons); ?>">
									</td>
								</tr>
								<tr>
									<td>Disponibilidad</td>
								</tr>
								<tr>
									<td>
										<input name="disp" id="disp" type="text" value="<?php echo($disponibilidad_cons); ?>">
									</td>
								</tr>
								<tr>
									<td>Destacado</td>
								</tr>
								<tr>
									<td>
										<select name="destacado" id="destacado">
											<option value="si" <?php if($destacado_cons=="si"){ echo("SELECTED"); } ?>>SI</option>
											<option value="no" <?php if($destacado_cons=="no"){ echo("SELECTED"); } ?>>NO</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>Inspiraci&oacute;n (Ingl&eacute;s)</td>
								</tr>
								<tr>
									<td>
										<textarea name="content" id="content" style="width:100%;display:block;"><?php
												echo($inspiracion_en);
										?></textarea>
										<!-- CKEditor -->
										<script type="text/javascript">
											CKEDITOR.replace( 'content' );	
										</script>
									</td>
								</tr>
								<tr>
									<td>Inspiraci&oacute;n (Franc&eacute;s)</td>
								</tr>
								<tr>
									<td>
										<textarea name="content1" id="content1" style="width:100%;display:block;"><?php
												echo($inspiracion_fr);
										?></textarea>
										<!-- CKEditor -->
										<script type="text/javascript">
											CKEDITOR.replace( 'content1' );	
										</script>
									</td>
								</tr>
								<tr>
									<td>Inspiraci&oacute;n (Espa&ntilde;ol)</td>
								</tr>
								<tr>
									<td>
										<textarea name="content2" id="content2" style="width:100%;display:block;"><?php
												echo($inspiracion_sp);
										?></textarea>
										<!-- CKEditor -->
										<script type="text/javascript">
											CKEDITOR.replace( 'content2' );	
										</script>
									</td>
								</tr>
								<tr>
									<td>Materiales (Ingl&eacute;s)</td>
								</tr>
								<tr>
									<td>
										<textarea name="content3" id="content3" style="width:100%;display:block;"><?php
												echo($materiales_en);
										?></textarea>
										<!-- CKEditor -->
										<script type="text/javascript">
											CKEDITOR.replace( 'content3' );	
										</script>
									</td>
								</tr>
								<tr>
									<td>Materiales (Franc&eacute;s)</td>
								</tr>
								<tr>
									<td>
										<textarea name="content4" id="content4" style="width:100%;display:block;"><?php
												echo($materiales_fr);
										?></textarea>
										<!-- CKEditor -->
										<script type="text/javascript">
											CKEDITOR.replace( 'content4' );	
										</script>
									</td>
								</tr>
								<tr>
									<td>Materiales (Espa&ntilde;ol)</td>
								</tr>
								<tr>
									<td>
										<textarea name="content5" id="content5" style="width:100%;display:block;"><?php
												echo($materiales_sp);
										?></textarea>
										<!-- CKEditor -->
										<script type="text/javascript">
											CKEDITOR.replace( 'content5' );	
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
						error_reporting(E_ERROR);
						$msqlq="";
						if($_GET['IDX']!=''){
							$sqle="SELECT * FROM categorias WHERE ID='".$_GET['IDX']."'";
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
									$sqlog="SELECT * FROM categorias WHERE ID='".$_GET['IDX']."'";
									if($dbn->QuerySQL($sqlog)==0){
										if($dbn->getFilas()>0){
											$datael=$dbn->getData();
											if($enlaceimagen_cat!=''){
												//echo("SI HAY ENLACE");
												$pertenece_cons=$_POST['nombrecategoria1'];
												$sqlog="UPDATE categorias SET nombre='$enlaceimagen_cat', pertenece='$pertenece_cons' WHERE ID='".$_GET['IDX']."'";
												if($dbn->QuerySQL($sqlog)==0){
												?>
													<div class="alert alert-success">
														Se han modificado los datos con exito!
													</div>
												<?php
												}
											}
											
											if($_GET['subopcion']=='eliminar'){
												$sqlog="DELETE FROM categorias WHERE ID='".$_GET['IDX']."'";
												$dbn->QuerySQL($sqlog);
												?>
													<div class="alert alert-success">
														Se han eliminado los datos con exito!
													</div>
												<?php
											}
										}
										else{
											$sqlog="INSERT INTO categorias(nombre,pertenece) VALUES('$enlaceimagen_cat','$nombrecateg_cat')";
											if($dbn->QuerySQL($sqlog)==0){
												$recien=$dbn->getIDInsert();
												?>
													<div class="alert alert-success">
														Se han agregado los datos con exito!
													</div>
												<?php
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
									if($_GET['subopcion']=='modificar' || $_GET['subopcion']=='eliminar') {
										if($_GET['opcion']!=''){
											$opciontabla=$_GET['opcion'];
										}
										else{
											$opciontabla="categorias";
										}
										if($opciontabla=="categorias"){
											$tabladef="categorias";
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
															if($datserv['ID']==$_GET['IDX']){
																echo("<option SELECTED value=\"?&mod=".$_GET['mod']."&opcion=categorias&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&codigonot=".$datserv['codigonot']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</option>");
															}
															else{
																echo("<option value=\"?&mod=".$_GET['mod']."&opcion=categorias&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&codigonot=".$datserv['codigonot']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</option>");
															}
														}
													}
													else{
														echo("<option>NO HAY CATEGORIAS AGREGADAS</option>");
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
													Nombre a Modificar
												</td>
											</tr>
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
										$tabladef="categorias";
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
															echo("<option SELECTED value=\"".$datserv['ID']."\">".$datserv[$campomos]."</option>");
														}
														else{
															echo("<option value=\"".$datserv['ID']."\">".$datserv[$campomos]."</option>");
														}
													}
												}
											}
										?>
									</SELECT>
								</td>
							</tr>
						</table>
						<table>
							<tr>
								<td style="height:15px;">
									
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
				</div>
			</td>
		</tr>
	</table>
	<!-- Including the HTML5 Uploader plugin -->
	<script src="libs/html5fileupload/assets/js/jquery.filedrop.js"></script>
	<!-- The main script file -->
    <script src="libs/html5fileupload/assets/js/script.js"></script>
</div>