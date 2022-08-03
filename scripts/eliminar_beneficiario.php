<?php
    session_start();

	if ($_SESSION['LOGIN_TRASMEDIC'] == FALSE) {header("Location: ../index.php");}
	if ($_SESSION['ROL'] != 'vendedor_supervisor' ){header("Location: ../index.php");}

    $codigo_sistema = $_GET['superdato'];

	include '../includes/connection.php';

	$query2 = "SELECT * FROM beneficiarios_credencial WHERE codigo_sistema LIKE '$codigo_sistema'";
	$resul2 = mysqli_query($conn, $query2);
	$datos = mysqli_fetch_assoc($resul2);
	$credencial = $datos['credencial'];
	$contrato = $datos['numero_contrato'];
	mysqli_free_result($resul2); 


	include '../includes/connection.php';

	$query = "DELETE FROM beneficiarios_credencial WHERE codigo_sistema LIKE '$codigo_sistema'";
	//echo $query;
	$resul = mysqli_query($conn, $query);
	mysqli_free_result($resul);
		
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimun-scale=1.0">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/test_borders.css">
		<title>SIWO</title>
	</head>
<body>
	<div class = "container mi_cont">

        <?php include_once('../includes/header.php');?>
	    <?php //include_once('../includes/main_menu.php');?>

    	<div class = "row justify-content-center mi_row">
			<div class = "col-8 mi_col">
				<!-- (row_!Centro!) -->
				<span class="text-center"><h3>Eliminaci&oacute;n completa</h3></span>
				<span class="text-center"><h5>Acci&oacute;n realizada con &eacute;xito por <?php echo $_SESSION['NOMBRE'];?></h5></span>
                <span class="text-center"><a href="../editar_beneficiarios_1.php?superdato=<?php echo $credencial;?>&superdato2=<?php echo $contrato;?>">Volver</a></span>
            </div>
    	</div>

        <?php include_once('../includes/footer.php');?>

	</div>
</body>
</html>