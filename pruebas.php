<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();

	if ($_SESSION['LOGIN_TRASMEDIC'] == FALSE) {header("Location: index.php");}
    if ($_SESSION['ROL'] != 'vendedor' ){header("Location: index.php");}
    
    /*$tm = time();

    echo $tm;

    echo '<br>';

    echo date('m/d/y', $tm);*/

    $tm2 = "1983-10-19";
    $today = date('Y-m-d');
    $diff = date_diff(date_create($tm2), date_create($today));

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
                <h1>Modulo de pruebas</h1>
                <?php

                    echo "Age is: ".$diff->format('%y');
                    echo "<br>";

                ?>
                <a href="index.php">Volver</a>
			</div>
		</div>

		<?php include_once('includes/footer.php');?>

	</div>   
</body>
</html>
