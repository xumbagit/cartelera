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
		<table>
			<tr>
				<td>
						<?php
						if($_GET['opcion']=='descargas'){
							?>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=gethistorial"); ?>"><h1>HISTORIAL DE ACTIVIDADES</h1></a>
							<?php
						}
						else{
							?>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=gethistorial"); ?>"><h1>HISTORIAL DE ACTIVIDADES</h1></a>
							<?php							
						}
						?>
				</td>
			</tr>
		</table>
		<table>
			<tr><td style="height:50px;"></td></tr>
		</table>
		<table>
			<thead>
				<th>Usuario</th>
				<th>Tipo</th>
				<th>Actividad</th>
				<th>Fecha</th>
				<th>Hora</th>
			</thead>
			<tbody>
				<?php
				
					$sqlsel="SELECT * FROM historial ORDER BY ID DESC";
					if($dbn->QuerySQL($sqlsel)==0){
						if($dbn->getFilas()>0){
							$i=0;
							while($datserv=$dbn->getData()){
								$sqlmod="SELECT * FROM usuarios WHERE ID='".$datserv['idusuario']."'";
								if($dbn2->QuerySQL($sqlmod)==0){
									if($dbn2->getFilas()>0){
										$datusr=$dbn2->getData();
										$nombreusuario=$datusr['nombre'];
										$idusuario=$datusr['ID'];
									}
								}
								?>
									<tr>
										<td><?php echo($nombreusuario); ?></td>
										<td><?php echo($datserv['tipocambio']); ?></td>
										<td><?php echo($datserv['descripcion']); ?></td>
										<td><?php echo($datserv['fechacambio']); ?></td>
										<td><?php echo($datserv['horacambio']); ?></td>
									</tr>
								<?php
							}
						}
					}
				?>
			</tbody>
		</table>
		</form>
</div>
