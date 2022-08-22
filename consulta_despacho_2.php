<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();

    if ($_SESSION['LOGIN_TRASMEDIC'] == FALSE) {header("Location: index.php");}
    if ($_SESSION['ROL'] != 'despachador' ){header("Location: index.php");}

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
    
    include 'includes/connection.php';                                           // Conexion a BD
    $query3 = "SELECT * FROM cobro_credencial 
    WHERE credencial LIKE '$credencial' OR responsable LIKE '$nombre_razon_social'"; // Consulta del campo necesario
    $resul3 = mysqli_query($conn, $query3, MYSQLI_USE_RESULT);                     //  Hacemos consulta a la BD
    $datos3 = mysqli_fetch_assoc($resul3);
    
    $activo = $datos3["activo"];
    $importante_1 = $datos3["importante_1"];
    $importante_2 = $datos3["importante_2"];
    //$credencial = $datos3["credencial"];

    mysqli_free_result($resul3);  
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
			<div class = "mi_col table-responsive">
				<!-- (row_!Centro!) -->
                <table id="tablilla" class="table table-sm table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th colspan="19">Datos importantes:</th>
                        </tr>
                        <tr>
                            <td colspan="19">
                                <small>
                                    Revisar y tomar en consideración antes de hacer un despacho de unidad
                                </small>
                            </td>
                        </tr>
                    </thead>
                    <tr>
                        <td>Estado de la credencial:</td>
                        <?php 
                        
                        if ($activo == "ACTIVO" || $activo == "activo" || $activo == "Activo") {
                            echo '<td class="alerta_activo">';
                            echo $activo;
                            echo "</td>";
                            $miclase= "alert alert-success";
                        }
                    
                        if ($activo == "PENDIENTE" || $activo == "pendiente" || $activo == "Pendiente") {
                            echo '<td class="alerta_pendiente">';
                            echo $activo;
                            echo "</td>";
                            $miclase= "alert alert-warning";
                        }

                        if ($activo == "INACTIVO" || $activo == "inactivo" || $activo == "Inactivo") {
                            echo '<td class="alerta_inactivo">';
                            echo $activo;
                            echo "</td>";
                            $miclase= "alert alert-danger";
                        }
                    ?>
                    </tr>
                    <tr>
                        <td><small>Nota Importante 1:</small></td>
                        <td class="<?php echo $miclase;?>"><small><?php echo $importante_1;?></small></td>
                    </tr>
                    <tr>
                        <td><small>Nota Importante 2:</small></td>
                        <td class="<?php echo $miclase;?>"><small><?php echo $importante_2;?></small></td>
                    </tr>
                    <tr>
                        <td>Despachar unidad para esta credencial:</td>
                        <td><a 
                                id="botoncillo" 
                                href="despachar_unidad_directo.php?superdato=<?php echo $credencial;?>" 
                                class="btn btn-primary" role="button">
                                    Despachar
                            </a>
                        </td>
                    </tr>
                </table>
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
                                                echo "<td>
                                                        <a href=despachar_unidad_directo.php?superdato=",$col_value,">
                                                            $col_value
                                                        </a>
                                                    </td>";
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
                                                echo "<td>
                                                        <a href=despachar_unidad_directo.php?superdato=",$col_value2,">
                                                            $col_value2
                                                        </a>
                                                    </td>";
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
    <script>
        
        var credencial = '<?=$credencial?>'; //esto pasa variables de php a javascript
        console.log(credencial); 

        var activo = '<?=$activo?>';
        console.log(activo);

        if (credencial == "TM--" || activo == ''){
            document.getElementById("botoncillo").style.display = "none";
            document.getElementById("tablilla").style.display = "none";
        } else {
            document.getElementById("botoncillo").style.display = "block";
            document.getElementById("tablilla").style.display = "inline-table   ";
        }
    </script>
</html>