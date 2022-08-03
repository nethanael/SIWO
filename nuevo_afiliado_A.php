<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();

    if ($_SESSION['LOGIN_TRASMEDIC'] == FALSE) {header("Location: index.php");}
    if ($_SESSION['ROL'] != 'vendedor_supervisor' ){header("Location: index.php");}

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
                <form name="" method="post" action="scripts/afiliacion.php"> 

                    <p class="text-center h5">Nueva afiliaci&oacute;n:</p>
                    <p class="text-center font-italic text-info">Definir el tipo de Afiliado, c&eacute;dula f&iacute;sica o c&eacute;dula Jur&iacute;dica.</p>
                    <p class="text-center d-none d-lg-block">
                        <img src="imgs/crear_act.png"><br>
                    </p>

                    <div class="form-group">
						<label for="tipo_cedula">Tipo de C&eacute;dula:</label>
                        <select class="form-control" id="tipo_cedula" name="tipo_cedula">
                            <option value="fisica">F&iacute;sica</option>
                            <option value="juridica">Jur&iacute;dica</option>
                        </select>
                        <input type="submit" class="form-control" name="Submit" value="Continuar"> 
					</div>

                </form>
            </div>
        </div>

        <?php include_once('includes/footer.php');?>

	</div>
</body>
</html>