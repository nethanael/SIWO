<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();

	if ($_SESSION['LOGIN_TRASMEDIC'] == FALSE){header("Location: index.php");}
	if ($_SESSION['ROL'] != 'unidad' ){header("Location: index.php");}

/* ------------------funcion de revisión de estado de unidades ----------------------------*/

include_once('includes/revisionUnidad.php');

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
					<table class="table">
						<thead class="thead-light">
							<tr>
								<th colspan="4"><p class="text-center h5">Men&uacute; Principal (Unidades):</p></th>
							</tr>
						</thead>
						<tr>
							<td colspan="2"><p class="text-center"><a class="btn btn-success" href="consulta_despachos_abiertos_unidad.php">Despachos Activos (intervenci&oacute;n)</a></p></td>
							<td colspan="2"><p class="text-center"><a class="btn btn-success" href="consulta_despachos_cerrados_unidad.php"> Historial de Despachos Cerrados</a></p></td>
						</tr>
						<tr>
							<td colspan="4"><p class="text-center"><a class="btn btn-success" href="consulta_despachos_abiertos_otra_unidad.php">Despachos Activos (otras Unidades)</a></p></td>
						</tr>
						<tr>
							<td><p class="text-center"><span class="badge badge-<?php revisionUnidad("KAMUK"); ?>">KAMUK</span></p></td>
							<td><p class="text-center"><span class="badge badge-<?php revisionUnidad("TARRAZU"); ?>">TARRAZU</span></p></td>
							<td><p class="text-center"><span class="badge badge-<?php revisionUnidad("YURUSTI"); ?>">YURUSTI</span></p></td>
							<td><p class="text-center"><span class="badge badge-<?php revisionUnidad("UPI"); ?>">UPI</span></p></td>
						
						</tr>
					</table>
			</div>
		</div>

		<div class = "row justify-content-center mi_row">
            <div class = "col-6 mi_col">
                    <?php include_once('shoutbox/shoutbox.inc.php');?>
            </div>
    	</div>

		<div class = "row justify-content-center mi_row">
			<div class="col-6 justify-content-center mi_col bg-secondary text-white">
				<p class="text-center font-weight-light">Este es el men&uacute; principal para el usuario "despachador" del sistema
				Trasmedic Ambulancia SA. Permite el depacho de ambulancias y tambi&eacute;n llevar un control de dichos despachos.
				Toda la informaci&oacute;n 
				contenida en este sistema es totalmente confidencial y solo puede ser accesada por personal autorizado de Trasmedic SA.
				Cualquier difusión o alteraci&oacute;n de esta informaci&oacute;n sin autorizaci&oacute;n puede conllevar a acciones legales.</p>
			
			</div>
		</div>

		<?php include_once('includes/footer.php');?>

	</div>
</body>
</html>