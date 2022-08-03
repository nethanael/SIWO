<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();
	
	if ($_SESSION['LOGIN_TRASMEDIC'] == FALSE) {header("Location: index.php");}
	
	$user = $_SESSION['USUARIO'];	
	$nombre = $_SESSION['NOMBRE'];
	
	include 'includes/connection.php';

	$query = "SELECT * FROM usuarios WHERE usuario like '$user'"; 
	$resul = mysqli_query($conn, $query, MYSQLI_USE_RESULT);
	
	$datos = mysqli_fetch_array($resul);
	$user_bd = $datos["usuario"];
	$pass_bd = $datos["contrasena"];
	mysqli_free_result($resul); 
	
	$_SESSION['CAMBIO_PASS_TEMP1'] = $pass_bd;
	
?>
<!DOCTYPE HTML>
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

		<?php include_once('includes/header.php');?>
	    <?php include_once('includes/main_menu.php');?>
        
		<div class = "row justify-content-center mi_row">
			<div class = "col-6 justify-content-center mi_col">
				<!-- (row_!Centro!) -->
				<form name="form1" method="post" action="scripts/cambio_pass.php">
					<table class="table">
						<thead class="thead-light">
							<tr>
								<th colspan="2">Cambio de Contrase&ntilde;a</th>
							</tr>
						</thead>
						
						<tr>	
							<td></td>
							<td colspan="2">
							<img src="imgs/cambio_pass.png"><br>
								<span class="text-danger">
									<?php echo $_SESSION['CAMBIO_PASS_ERROR'] ?>
								</span>
							</td>
						</tr>
						<tr>
							<td colspan="2"><h3>Datos del usuario:<h3></td>
						</tr>
						<tr>
							<td><?php echo $_SESSION['NOMBRE'];?></td>
							<td><?php echo $_SESSION['APELLIDOS'];?></td>
						</tr>

						<tr>
							<td><?php echo $_SESSION['CEDULA'];?></td>
							<td><?php echo $_SESSION['ROL'];?></td>
						</tr>
						<tr>
							<td><?php echo $_SESSION['EMAIL'];?></td>
							<td><?php echo $_SESSION['TELEFONO'];?></td>
						</tr>
						<tr>
							<td colspan="2"><h3>Login:<h3></td>
						</tr>
						<tr>
							<td>Usuario:</td>
							<td><?php echo $_SESSION['USUARIO'];?></td>
						</tr>
						<tr>
							<td>Contrase&ntilde;a actual encryptada:</td>
							<td><?php echo $_SESSION['CAMBIO_PASS_TEMP1'];?></td>
						</tr>
						
						<tr>
							<td>Nueva Contrase&ntilde;a:</td>
							<td><input name="pass1" type="password" id="pass1"></td>
						</tr>
						
						<tr>
							<td>Nueva Contrase&ntilde;a:</td>
							<td><input name="pass2" type="password" id="pass2"></td>
						</tr>
						
						<tr>
							<td colspan="2"><input type="submit" name="Submit" value="Cambiar"></td>
						</tr>
				
						<tr>
							<td colspan="2"><a href="index.php">No quiero cambiar mi contrase&ntilde;a.</a></td>
						</tr>
				
					</table>
				</form>
			</div>
		</div>

		<?php include_once('includes/footer.php');?>

	</div>
</body>
</html>