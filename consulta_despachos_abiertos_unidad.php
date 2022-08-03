<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();

    if ($_SESSION['LOGIN_TRASMEDIC'] == FALSE) {header("Location: index.php");}

    $hoy = date("Y-m-d H:i");
    $unidad = $_SESSION['NOMBRE'];

    //'%D dias %H horas %I minutos %S segundos'

    function dateDifference($date_1 , $date_2 , $differenceFormat = '%H horas %I minutos' ) 
	{
		$datetime1 = date_create($date_1);
		$datetime2 = date_create($date_2);

        if ($datetime1 == false || $datetime2 == false){
            return "N/A";
        }
	
		$interval = date_diff($datetime1, $datetime2);
	
		return $interval->format($differenceFormat);
	}
 
    include 'includes/connection.php';                                           // Conexion a BD
    $sql= "SELECT codigo_despacho, /*estado, interesado,*/ paciente, diagnostico, direccion, 
    destino, observaciones, unidad, prioridad, tiempo_llamada, tiempo_salida_unidad, tiempo_salida_escena,
    tiempo_hospital FROM despachos WHERE estado LIKE 'ABIERTO' AND unidad LIKE '$unidad'";                                          // Consulta del campo necesario
	$resul = $conn->query($sql);                                                 //  Hacemos consulta a la BD
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimun-scale=1.0">
        <meta http-equiv="refresh" content="20" />
		<link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/test_borders.css">
		<title>SIWO</title>
        <style>
            .claseEspecial {
            color:green;
            background-color: yellow;
            font-size: large;
        }
        </style>
	</head>
<body>
	<div class = "container mi_cont">

        <?php include_once('includes/header.php');?>
		<?php include_once('includes/main_menu.php');?>

		<div class = "row justify-content-center mi_row">
			<div class = "table-responsive">
				<!-- (row_!Centro!) -->
                <table class="table table-sm table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th colspan="19">Despachos abiertos para esta unidad:</th>
                        </tr>
                        <tr>
                            <td colspan="19"><small>Haga cl&iacute;ck en el c&oacute;digo de despacho para intervenir.</small></td>
                        </tr>
                    </thead>
                    <tr>
                        <th><small>C&oacute;digo Despacho:</small></th>
                        <!-- <th><small>Estado:</small></th> -->
                        <!-- <th><small>Interesado:</small></th> -->
                        <th><small>Paciente:</small></th>
                        <th><small>Diagn&oacute;stico:</small></th>
                        <th><small>Direcci&oacute;n:</small></th>
                        <th><small>Destino:</small></th>
                        <th><small>Observaciones:</small></th>
                        <th><small>Unidad Asignada:</small></th>
                        <th><small>Prioridad:</small></th>
                        <th><small>Tiempo Llamada:</small></th>
                        <th><small>Tiempo desde Llamada:</small></th>
                        <th><small>Tiempo Salida Unidad:</small></th>	
                        <th><small>Tiempo desde Salida Unidad:</small></th>
                        <th><small>Tiempo Salida Escena:</small></th>	
                        <th><small>Tiempo desde Salida Escena:</small></th>
                        <th><small>Tiempo Llegada a Hospital:</small></th>	
                        <th><small>Tiempo desde Llegada Hospital:</small></th>
                    </tr>
                        <?php                                                   //saca todos los valores de la base de datos y
                                                                                // los hace filas
                            while ($line =  $resul->fetch_assoc()) 
                                {
                                    echo "<tr>";
                                    foreach ($line as $campo => $col_value)
                                        {
                                            if ($campo == 'codigo_despacho'){
                                                echo "<td><a href=intervenir_despacho_unidad.php?superdato=",$col_value,">$col_value</a></td>";
                                            }
                                            if ($campo != 'codigo_despacho'){
                                                echo "<td><small>$col_value</small></td>";
                                            }

                                            if ($campo == 'tiempo_llamada'){
                                                $tiempo = dateDifference($hoy,$col_value);
                                                echo "<td class='claseEspecial'>$tiempo</td>";
                                            }
                                            if ($campo == 'tiempo_salida_unidad'){
                                                $tiempo = dateDifference($hoy,$col_value);
                                                echo "<td class='claseEspecial'>$tiempo</td>";
                                            }
                                            if ($campo == 'tiempo_salida_escena'){
                                                $tiempo = dateDifference($hoy,$col_value);
                                                echo "<td class='claseEspecial'>$tiempo</td>";
                                            }
                                            if ($campo == 'tiempo_hospital'){
                                                $tiempo = dateDifference($hoy,$col_value);
                                                echo "<td class='claseEspecial'>$tiempo</td>";
                                            }
                                        }
                                    echo "</tr>";
                                }
                        ?>     
                </table>
            </div>

        <a href="index.php">Volver</a>
		</div>
        <?php include_once('includes/footer.php');?>
	</div>
</body>
</html>