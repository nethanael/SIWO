<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();
	

	if ($_SESSION['LOGIN_TRASMEDIC'] == TRUE)
		{
			if ($_SESSION['ROL'] == 'vendedor_supervisor') header("Location: home_vendedor_supervisor.php");
			if ($_SESSION['ROL'] == 'vendedor') header("Location: home_vendedor.php");
			if ($_SESSION['ROL'] == 'despachador') header("Location: home_despachador.php");
			if ($_SESSION['ROL'] == 'unidad') header("Location: home_unidad.php");
		}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimun-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/test_borders.css">
		<title>SIWO</title>
	</head>
<body>
	<div class = "container mi_cont">

		<div class = "row justify-content-center mi_row">
			<div class = "col-6 mi_col d-none d-lg-block">
					<!--(row_!Titulo!)-->
					<p class="text-center"><img src="imgs/logo_1.png"></p>
			</div>
		</div>

		<div class = "row justify-content-center mi_row">
			<div class = "col-6 mi_col">
				<!--(row_!nav!)-->
			</div>
		</div>
		
		<div class = "row justify-content-center mi_row">
			<div class = "col-6 justify-content-center mi_col">
				<!--(row_!Centro!)-->
					<form name="form1" method="post" action="scripts/ingreso.php">
					<p class="text-center h5">Ingrese sus datos:</p>
					<div class="form-group">
						<label for="user">Usuario</label>
						<input name="user" type="text" class="form-control" name="user" id="user" value="<?php echo $_SESSION['USUARIO_TEMP']; ?>" size="10" maxlength="10">
						<label for="pass">Contrase&ntilde;a:</label>
						<input type="password" class="form-control" name="pass" id="pass" size="10" maxlength="10">
						<input type="submit" class="form-control" name="Submit" value="Ingresar"><p class="text-center font-italic text-danger"><?php echo $_SESSION['LOGIN_ERROR']; ?></p>
					</div>
					</form>
			</div>
		</div>
		<div class = "row justify-content-center mi_row">
			<div class="col-6 justify-content-center mi_col bg-secondary text-white">
			<div class = "d-none d-lg-block">
				<p class="text-center font-weight-light">Este es un sistema automatizado para la afiliaci&oacute;n y control
				de clientes de la empresa Trasmedic Ambulancia SA. El nombre y apellidos de cada 
				usuario a sido registrado adecuadamente, por lo tanto, utilizar el sistema responsablemente. No se permite 
				el pr&eacute;stamo de usuarios y contrase&ntilde;as. Consultas y sugerencias a: pabloh@kamalacr.com </p>
			</div>
			</div>
		</div>

		<?php include_once('includes/footer.php');?>

	</div>
</body>
</html>