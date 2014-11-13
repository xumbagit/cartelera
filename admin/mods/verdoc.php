<?php
	session_start();
	require_once('../conf/config.conf.php');
	require_once('../lib/op_mysql.class.php');
	$dbn=new op_mysql();
	$dbn->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	$dbn2=new op_mysql();
	$dbn2->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	//echo($dbn->getIDConn());
	$sqlsel="SELECT * FROM documentos WHERE ID='".$_GET['iddoc']."'";
	if($dbn->QuerySQL($sqlsel)==0){
		if($dbn->getFilas()>0){
			$datserv=$dbn->getData();
			$archivoaler=$datserv['soporte'];
			$dirdownload="http://".$_SERVER['SERVER_NAME']."/".$archivoaler;
			?>
				<iframe src="http://docs.google.com/viewer?url=<?php echo($dirdownload); ?>&embedded=true" width="600" height="780" style="border: none;"></iframe>
			<?php
		}
	}
?>
