<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();

    if ($_SESSION['LOGIN_TRASMEDIC'] == FALSE) {header("Location: index.php");}
    if ($_SESSION['ROL'] != 'vendedor_supervisor' ){header("Location: index.php");}

    $credencialA = $_POST["credencialA"];
    $credencialB = $_POST["credencialB"];
    
    $credencial = "TM-"."$credencialA"."-"."$credencialB";
    
    $cedulaA = $_POST["cedulaA"];
	$cedulaB = $_POST["cedulaB"];
	$cedulaC = $_POST["cedulaC"];
    $cedula = $cedulaA."-".$cedulaB."-".$cedulaC;
    
    $nombre_razon_social = $_POST["nombre_razon_social"];

    if ($nombre_razon_social != '') {
        $nombre_razon_social = '%' . $nombre_razon_social . '%';
    }
 
    include 'includes/connection.php';                                           // Conexion a BD
    $sql= "SELECT credencial, numero_contrato, tipo_afiliado, cedula, fecha_afiliacion, nombre_razon_social, 
    actividad_comercial, telefono_fijo, telefono_movil, provincia, canton, direccion_exacta, email FROM credencial_general
    WHERE credencial LIKE '$credencial' OR nombre_razon_social LIKE '$nombre_razon_social' OR cedula LIKE '$cedula'";
    //echo $sql;                                         // Consulta del campo necesario
    $resul = $conn->query($sql);                        //  Hacemos consulta a la BD

    include 'includes/connection.php';                                           // Conexion a BD
    $sql2 = "SELECT * FROM beneficiarios_credencial 
    WHERE credencial LIKE '$credencial' OR nombre LIKE '$nombre_razon_social' OR cedula LIKE '$cedula'";
    //echo $sql2;                                         // Consulta del campo necesario
    $resul2 = $conn->query($sql2);  
    
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimun-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/test_borders.css">
        <link rel="stylesheet" href="css/alertas_personalizadas.css">
        <style>
            .td_cedula {
                width: 100px;
            }
        </style>
		<title>SIWO</title>
	</head>
<body>
	<div class = "container mi_cont">

        <?php include_once('includes/header.php');?>
		<?php include_once('includes/main_menu.php');?>


		<div class = "row justify-content-center mi_row">
			<div class = "col-12 mi-col table-responsive">
				<!-- (row_!Centro!) -->
                <table class="table table-sm table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th colspan="19">Datos Credencial Principal:</th>
                        </tr>
                        <tr>
                            <td colspan="19"><small>Haga click en la credencial para ver en detalle.</small></td>
                        </tr>
                    </thead>
                    <tr>
                        <!-- <th><small>Codigo Sistema:</small></th> -->
                        <th><small>Credencial:</small></th>
                        <th><small>Contrato:</small></th>
                        <th><small>Tipo:</small></th>
                        <th class="td_cedula"><small>Cedula:</small></th>
                        <!-- <th><small>Mes:</small></th> -->
                        <!-- <th><small>Ano:</small></th> -->
                        <th><small>Fecha Afiliaci&oacute;n:</small></th>
                        <th><small>Nombre / Raz&oacute;n Social:</small></th>
                        <th><small>Actividad Comercial:</small></th>
                        <th><small>Tel&eacute;fono Fijo:</small></th>
                        <th><small>Tel&eacute;fono M&oacute;vil:</small></th>		
                        <th><small>Provincia:</small></th>
                        <th><small>Cant&oacute;n:</small></th>
                        <!-- <th><small>Distrito:</small></th> -->
                        <th><small>Direcci&oacute;n:</small></th>
                        <th><small>Email:</small></th>
                        <!-- <th><small>Informaci&oacuten m&eacute;dica:</small></th> -->
                        <!-- <th><small>Antecedentes m&eacute;dicos:</small></th> -->
                        <!-- <th><small>Observaciones:</small></th> -->
                    </tr>
                        <?php                                                   //saca todos los valores de la base de datos y
                                                                                // los hace filas
                            while ($line =  $resul->fetch_assoc()) 
                                {
                                    echo "<tr>";
                                    foreach ($line as $campo => $col_value)
                                        {
                                            if ($campo == 'credencial'){
                                                echo "<td><a href=editar_credencial_2.php?superdato=",$col_value,">$col_value</a></td>";
                                            }
                                            if ($campo != 'credencial'){
                                                echo "<td>
                                                        <small>
                                                            $col_value
                                                        </small>
                                                    </td>";
                                            }
                                        }
                                    echo "</tr>";
                                }
                        ?>
                </table>
                <table class="table table-sm table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th colspan="19">Datos de beneficiarios:</th>
                        </tr>
                    </thead>
                    <tr>
                        <th><small>C&oacute;digo Beneficiario:</small></th>
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
                            while ($line2 =  $resul2->fetch_assoc()) 
                                {
                                    echo "<tr>";
                                    foreach ($line2 as $campo2 => $col_value2)
                                        {
                                            if ($campo2 == 'credencial'){
                                                echo "<td><a href=editar_credencial_2.php?superdato=",$col_value2,">$col_value2</a></td>";
                                            }
                                            if ($campo2 != 'credencial'){
                                                echo "<td>
                                                        <small>
                                                            $col_value2
                                                        </small>
                                                    </td>";
                                            }
                                            if ($campo2 == "fecha_nacimiento")
                                            {
                                                $today = date('Y-m-d');
                                                $diff = date_diff(date_create($col_value2), date_create($today));
                                                echo "<td><small>".$diff->format('%y')."</small></td>";
                                            }
                                        }
                                    echo "</tr>";
                                    //echo "</tr></table>";
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