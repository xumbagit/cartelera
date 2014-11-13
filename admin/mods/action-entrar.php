<?php
	$btnlog=$_POST['btningresar'];
	if($btnlog){
		echo("HOLA1");
		$usuario=$_POST['usuariot'];
		$clave=md5($_POST['clavet']);
		$sqlog="SELECT * FROM usuarios WHERE usuario='$usuario' AND clave='$clave'";
		$pedidolog=mysql_query($sqlog,$conexion);
		echo(mysql_error());
		echo("HOLA2");
		if($pedidolog){
			echo("HOLA3");
			echo(mysql_error());
			$filaslog=mysql_num_rows($pedidolog);
			if($filaslog>0){
				echo("HOLA4");
				$datoslog=mysql_fetch_array($pedidolog);
				$_SESSION['usuarioreg']=$datoslog['usuario'];
				$_SESSION['idusuario']=$datoslog['ID'];
				$_SESSION['nombrereal']=strtoupper($datoslog['nombre']." ".$datoslog['apellido']);
				$_SESSION['nivel']=$datoslog['nivel'];
				$_SESSION['email']=$datoslog['email'];
				$_SESSION['cedula']=$datoslog['cedula'];
				$_SESSION['telefono']=$datoslog['telefono'];
				$_SESSION['loggedin']="true";
				echo("Usuario Registrado: ".$_SESSION['usuarioreg']);
				?>
				<script type="text/javascript" language="JavaScript">
					location.href=location.href;
				</script>
				<?php
			}
			else{
				?>
				<script type="text/javascript" language="JavaScript">
					alert("Usuario/Contraseña Incorrecto!");
				</script>
				<?php
			}
		}
	}
?>