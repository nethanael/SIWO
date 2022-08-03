<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();

    if ($_SESSION['LOGIN_TRASMEDIC'] == FALSE) {header("Location: index.php");}
    if ($_SESSION['ROL'] != 'vendedor' ){header("Location: index.php");}

    $credencial = $_GET['superdato']; 
    
    include 'includes/connection.php';                                           // Conexion a BD
	$sql = "SELECT credencial, numero_contrato, cedula, nombre, provincia, canton, distrito, direccion_exacta, telefono_fijo, 
    telefono_movil, antecedentes_medicos, fecha_nacimiento, genero, observaciones FROM beneficiarios_credencial 
    WHERE credencial LIKE '$credencial'"; // Consulta del campo necesario
	$resul = $conn->query($sql); 
    
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimun-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/test_borders.css">
        <link rel="stylesheet" href="css/alertas_personalizadas.css">
		<title>SIWO</title>
        <style>
            .td_cedula {
                width: 100px;
            }
        </style>
	</head>
<body>
	<div class = "container mi_cont">

    <?php include_once('includes/header.php');?>
		<?php include_once('includes/main_menu.php');?>
          
        <div class = "row justify-content-center mi_row">
            <div class = "table-responsive">

            <table class="table table-sm table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th colspan="19">Beneficiario asociados a credencial <?php echo $credencial;?>:</th>
                        </tr>
                    </thead>
                    <tr>
                        <!-- <th><small>Codigo Sistema:</small></th> -->
                        <th><small>Credencial:</small></th>
                        <th><small>Contrato:</small></th>
                        <th class="td_cedula"><small>Cedula:</small></th>
                        <th><small>Nombre / Raz&oacute;n Social:</small></th>
                        <th><small>Provincia:</small></th>
                        <th><small>Cant&oacute;n:</small></th>
                        <th><small>Distrito:</small></th>
                        <th><small>Direcci&oacute;n:</small></th>
                        <th><small>Tel&eacute;fono Fijo:</small></th>
                        <th><small>Tel&eacute;fono M&oacute;vil:</small></th>
                        <th><small>Antecedentes M&eacute;dicos:</small></th>
                        <th><small>Fecha Nacimiento:</small></th>
                        <th><small>Edad:</small></th>
                        <th><small>G&eacute;nero:</small></th>
                        <th><small>Observaciones:</small></th>
                    </tr>
                        <?php                                                   //saca todos los valores de la base de datos y
                                                                                // los hace filas
                            while ($line =  $resul->fetch_assoc()) 
                                {
                                    echo "<tr>";
                                    foreach ($line as $campo => $col_value)
                                        {
                                            if ($campo == 'credencial'){
                                                echo "<td><a href=consulta_general_2_VL.php?superdato=",$col_value,">$col_value</a></td>";
                                            }
                                            if (($campo != 'credencial')){
                                                echo "<td><small>$col_value</small></td>";
                                            }
                                            if (($campo == "fecha_nacimiento"))
                                            {
                                                $today = date('Y-m-d');
                                                $diff = date_diff(date_create($col_value), date_create($today));            
                                                echo '<td><small>'.$diff->format('%y').'</small></td>';
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