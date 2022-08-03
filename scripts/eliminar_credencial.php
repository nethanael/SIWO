<?php
    session_start();

	if ($_SESSION['LOGIN_TRASMEDIC'] == FALSE) {header("Location: ../index.php");}
	if ($_SESSION['ROL'] != 'vendedor_supervisor' ){header("Location: ../index.php");}

    $fecha = date("d/m/y");	

    include '../includes/connection.php';
    $credencial = $_GET['superdato']; 
        
    $query1 = "DELETE FROM credencial_general WHERE credencial = '$credencial'";
    $query2 = "DELETE FROM beneficiarios_credencial WHERE credencial = '$credencial'";
    $query3 = "DELETE FROM cobro_credencial WHERE credencial = '$credencial'";

    $resul1 = mysqli_query($conn, $query1);
    $resul2 = mysqli_query($conn, $query2);
    $resul3 = mysqli_query($conn, $query3);
    
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
				<span class="text-center">
					<h3>Eliminaci&oacute;n realizada con &eacute;xito por <?php echo $_SESSION['NOMBRE'];?></h3>
					<h3><a href="../editar_credencial_1.php">Volver</a></h3>
				</span>
			</div>
    	</div>

        <?php include_once('../includes/footer.php');?>

	</div>
</body>
</html>