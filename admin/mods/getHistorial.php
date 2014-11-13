<?php	 	
	require_once 'lib/function_gen.php';
	if($_SERVER['REQUEST_METHOD'] == "GET")
	{
		$fecha = $_GET['fecha'];
		$nroiden_user = $_GET['nroiden_user'];
		$nroiden_adm = $_GET['nroiden_adm'];

		$query = "SELECT conversacion FROM mp_historial_his WHERE fecha_conversacion = '$fecha' AND nro_iden_usuario = '$nroiden_user' AND nro_iden_asesor = '$nroiden_adm';";
		$rows = fnc_ejecutaQuery($query);
		
		foreach ($rows as $value) {
			echo $value['conversacion'];
		}
	}
?>