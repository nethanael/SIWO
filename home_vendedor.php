<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();

	if ($_SESSION['LOGIN_TRASMEDIC'] == FALSE) {header("Location: index.php");}
	if ($_SESSION['ROL'] != 'vendedor' ){header("Location: index.php");}
		
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
			<div class = "col-6 mi_col">
				<!-- (row_!Centro!) -->
				<p class="text-center h5">Men&uacute; Principal (Vendedor Limitado):</p>
				<p class="text-center">Gesti&oacute;n de Credenciales</p>
                <p class="text-center font-weight-light">
                    <a class="btn btn-info" href="nuevo_afiliado_A_VL.php">Nueva Afiliaci&oacute;n</a>
                    <a class="btn btn-info" href="consulta_general_VL.php">Consulta Credenciales</a>
                </p>
			</div>
		</div>

		<div class = "row justify-content-center mi_row">
			<div class="col-6 justify-content-center mi_col bg-secondary text-white">
				<p class="text-center font-weight-light">Este es el men&uacute; principal para el usuario "vendedor limitado" del sistema
				Trasmedic Ambulancia SA. Permite la afiliaci&oacute;n y consulta de clientes. Toda la informaci&oacute;n 
				contenida en este sistema es totalmente confidencial y solo puede ser accesada por personal autorizado de Trasmedic SA.
				Cualquier difusión o alteraci&oacute;n de esta informaci&oacute;n sin autorizaci&oacute;n puede conllevar a acciones legales.</p>
			
			</div>
		</div>

		<?php include_once('includes/footer.php');?>

	</div>
</body>
</html>