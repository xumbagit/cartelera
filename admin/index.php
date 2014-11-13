<?php
	session_start();
	//REVISAR PAGINA COMPLETA MANANA
	include("conf/config.conf.php");
	include("conf/functions.php");
	include("libs/op_mysql.class.php");
	$conexion=mysql_connect(SERVIDOR_BD,USUARIO_BD,CLAVE_BD);
	if($conexion){
		$seleccionar=mysql_select_db(NOMBRE_BD);
		mysql_query("SET NAMES 'utf8'");
	}
	$dbn=new op_mysql();
	$dbn->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	$dbn2=new op_mysql();
	$dbn2->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	$dbn3=new op_mysql();
	$dbn3->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	$dbn4=new op_mysql();
	$dbn4->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	$moduloHASH='adminnoticias';
	if($_GET['mod']!=$moduloHASH){
		$_SESSION['uniq_hash']='';
	}
?>
<!DOCTYPE html>
<html>
	<head>
	    <!-- Bootstrap -->
	    <title>Sistema Administrativo CINETV</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	    <link rel="stylesheet" href="css/bootstrap-responsive.css" />
		<!-- <link rel="shortcut icon" type="image/x-icon" href="img/favicon2.png"> -->
	    <script src="js/jquery-2.1.1.js"></script>
	    <script src="js/bootstrap.js"></script>
		<script src="js/jquery-ui.min.js" type="text/javascript"></script>
		<link href="css/jquery-ui.css" type="text/css" rel="stylesheet"></link>
		<script type="text/javascript" src="libs/ajax.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap styles -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
	    <style type="text/css">
	      body{
	        background-color: #f5f5f5;
	      }
	      .form-signin {
	        max-width: 300px;
	        padding: 19px 29px 29px;
	        margin: 0 auto 20px;
	        background-color: #fff;
	        border: 1px solid #e5e5e5;
	        -webkit-border-radius: 5px;
	           -moz-border-radius: 5px;
	                border-radius: 5px;
	        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
	           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
	                box-shadow: 0 1px 2px rgba(0,0,0,.05);
	      }
	      .form-signin .form-signin-heading,
	      .form-signin .checkbox {
	        margin-bottom: 10px;
	      }
	      .form-signin input[type="text"],
	      .form-signin input[type="password"] {
	        font-size: 16px;
	        height: auto;
	        margin-bottom: 15px;
	        padding: 7px 9px;
	      }
	
	    </style>
		<script>
			$(document).ready(function(){
				$( "#fechapubli" ).datepicker({dateFormat:'yy-mm-dd'});
			});
		</script>
    </head>
    <body>
<?php
	if($_SESSION['usuarioreg']==''){
		?>
			<nav class="navbar navbar-default" role="navigation">
			  <div class="container-fluid">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="navbar-brand" href="#">CINETV</a>
			    </div>
			  </div><!-- /.container-fluid -->
			</nav>
			<div class="container">
			    <form class="form-signin" role="form" method="post" enctype="multipart/form-data">
			        <h2 class="form-signin-heading">Ingrese</h2>
			        <input name="usuariot" id="usuariot" class="form-control" type="text" autofocus="" required="" placeholder="Name User"></input>
			        <input name="clavet" id="clavet" class="form-control" type="password" required="" placeholder="Clave"></input>
			        <label class="checkbox"><input type="checkbox" value="remember-me"></input>Recu&eacute;rda me</label>
			        <input id="btningresar" name="btningresar" class="btn btn-lg btn-primary btn-block" type="submit" value="Entrar"/>
					<?php
						$btnlog=$_POST['btningresar'];
						if($btnlog){
							//echo("HOLA1");
							$usuario=$_POST['usuariot'];
							$clave=md5($_POST['clavet']);
							$sqlog="SELECT * FROM usuarios WHERE usuario='$usuario' AND clave='$clave'";
							$pedidolog=mysql_query($sqlog,$conexion);
							echo(mysql_error());
							//echo("HOLA2");
							if($pedidolog){
								//echo("HOLA3");
								echo(mysql_error());
								$filaslog=mysql_num_rows($pedidolog);
								if($filaslog>0){
									//echo("HOLA4");
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
										location.href="index.php?mod=adminnoticias&opcion=&subopcion=agregar&tipo=peliculas";
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
			    </form>
			</div>
		<?php
	}
	else{
		?>
			<nav class="navbar navbar-default" role="navigation">
			  <div class="container-fluid">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="navbar-brand" href="#">CINETV</a>
			    </div>
			
			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      <ul class="nav navbar-nav">
			        <li class="<?php if($_GET['tipo']=='peliculas'){ echo('active'); }else{ echo(''); } ?>"><a href="index.php?mod=adminnoticias&subopcion=agregar&tipo=peliculas">Cine</a></li>
			        <li class="<?php if($_GET['tipo']=='teatro'){ echo('active'); }else{ echo(''); } ?>"><a href="index.php?mod=adminnoticias&subopcion=agregar&tipo=teatro">Teatro</a></li>
			      </ul>
			      <ul class="nav navbar-nav navbar-right">
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuario<b class="caret"></b></a>
			          <ul class="dropdown-menu">
			            <li><a href="cerrarsession.php">Cerrar Sesi&oacute;n</a></li>
			            <!-- <li class="divider"></li> !-->
			          </ul>
			        </li>
			      </ul>
			    </div>
			    <!-- /.navbar-collapse -->
			  </div>
			  <!-- /.container-fluid -->
			</nav>
		<?php
		$plantilla=$_GET['mod'];
		if($plantilla!=''){
			$modul="mods/".$plantilla.".php";
			if(file_exists($modul)){
				include($modul);
			}
			else{
				?>
					<script type="text/javascript">
						location.href="index.php";
					</script>
				<?php
			}
		}
	}
?>
    
	</body>
</html>
