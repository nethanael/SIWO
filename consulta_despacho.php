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
			<div class = "col-6 mi_col table-responsive">
				<!-- (row_!Centro!) -->
                <form name="" method="post" action="consulta_despacho_2.php"> 
                    <table class="table table-striped ">
                        <thead class="thead-light">
                            <tr>
                                <th colspan="2">Consulta de Despacho:</th>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <span class="lead text-info">
                                    Elija el criterio de b&uacute;squeda y pulse buscar:
                                    </span>
                                </td>
                            </tr>
                        </thead>
                        <tr>
                            <td></td>
                            <td>
                                <span class="text-danger">
                                    <?php echo $_SESSION[''];?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Por # de Credencial:</td>
                            <td>
                                TM-
                                    <input 
                                        name="credencialA" 
                                        id="credencialA" 
                                        value="<?php echo $_SESSION['DESPACHO_1A']; ?>" 
                                        size="1" 
                                        maxlength="20">
                                    </input>
                                -
                                    <input 
                                    name="credencialB" 
                                    id="credencialB" 
                                    value="<?php echo $_SESSION['DESPACHO_1B']; ?>" 
                                    size="1" 
                                    maxlength="20">
                                    </input>
                            </td>
                        </tr>
                        <tr>
                            <td>Por # de C&eacute;dula:</td>
                            <td>
                                <input 
                                    name="cedulaA" 
                                    id="cedulaA" 
                                    value="<?php echo $_SESSION['DESPACHO_2A']; ?>" 
                                    size="1" 
                                    maxlength="1">
                                </input> 
                                 -
                                <input 
                                    name="cedulaB" 
                                    id="cedulaB" 
                                    value="<?php echo $_SESSION['DESPACHO_2B']; ?>" 
                                    size="1" 
                                    maxlength="4">
                                </input>
                                 -
                                <input 
                                    name="cedulaC" 
                                    id="cedulaC" 
                                    value="<?php echo $_SESSION['DESPACHO_3C']; ?>" 
                                    size="1" 
                                    maxlength="4">
                                </input>
                            </td>
                        </tr>
                        <tr>
                            <td>Por Nombre:</td>
                            <td>
                                <input 
                                    name="nombre_razon_social" 
                                    id="nombre_razon_social" 
                                    value="<?php echo $_SESSION['DESPACHO_3']; ?>" 
                                    size="20" 
                                    maxlength="40">
                                </input>
                            </td>
                        </tr>
                        <tr>
                                <td colspan="2">
                                    <p class="text-center">
                                        <input type="submit" name="Submit" value="Buscar">
                                    </p>
                                </td>
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