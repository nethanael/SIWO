<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();

    if ($_SESSION['LOGIN_TRASMEDIC'] == FALSE) {header("Location: index.php");}
    if ($_SESSION['ROL'] != 'despachador' ){header("Location: index.php");}

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
                <form name="" method="post" action="scripts/despachar_unidad.php"> 
                    <table class="table table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th colspan="2">Realizar despacho de unidad:</th>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <span class="lead text-info">
                                    Definir el tipo de Despacho: Emergencia M&eacute;dica &oacute; tr&aacute;mite administrativo.
                                    </span>
                                </td>
                            </tr>
                        </thead>
                        <tr>
                            <td></td>
                            <td>
                                <img src="imgs/crear_act.png"><br>
                                <span class="text-danger">
                                    <?php echo $_SESSION[''];?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Tipo de Despacho:</td>
                            <td>    
                                <select id="tipo_despacho" name="tipo_despacho">
                                    <option value="emergencia">Emergencia</option>
                                    <option value="administrativo">Administrativo</option>
                                </select> 
                            </td>
                        </tr>
                    
                        <tr>
                                <td colspan="2"><p class="text-center"><input type="submit" name="Submit" value="Continuar"></p></td>
                        </tr>
                        <tr>
                            <td colspan="2"><a href="index.php">Volver</a></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <?php include_once('includes/footer.php');?>

	</div>
</body>
</html>