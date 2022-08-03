<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();

    if ($_SESSION['LOGIN_TRASMEDIC'] == FALSE) {header("Location: index.php");}
    if ($_SESSION['ROL'] != 'vendedor_supervisor' ){header("Location: index.php");}

    $credencial = $_GET['superdato']; 
    
    include 'includes/connection.php';                                           // Conexion a BD
	$sql = "SELECT credencial, numero_contrato, responsable, rol, responsable_2, rol_2, monto, monto_SI, periodicidad, direccion_cobro, 
    fecha_pago, forma_pago, corriente_colones_1, iban_colones_1, corriente_dolares_1, iban_dolares_1, nombre_banco_1, 
    marca_tarjeta, numero_tarjeta, tarjeta_habiente, emisor, vencimiento, vendedor, activo, fecha_activacion, 
    importante_1, importante_2 FROM cobro_credencial WHERE credencial LIKE '$credencial'"; // Consulta del campo necesario
	$resul = $conn->query($sql); 
    
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
            <div class = "table-responsive">

            <table class="table table-sm table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th colspan="27">Datos de cobro asociados a credencial <?php echo $credencial;?>:</th>
                        </tr>
                    </thead>
                    <tr>
                        <!--  <th><small>Codigo Sistema:</small></th> -->
                        <th><small>Credencial:</small></th>
                        <th><small>Contrato:</small></th>
                        <th><small>Responsable:</small></th>
                        <th><small>Rol:</small></th>
                        <th><small>Responsable:</small></th>
                        <th><small>Rol:</small></th>
                        <th><small>Monto (IVA):</small></th>
                        <th><small>Monto (Sin IVA):</small></th>
                        <th><small>Periodicidad:</small></th>
                        <th><small>Direcci&oacute;n cobro:</small></th>
                        <th><small>Fecha de Pago:</small></th>
                        <th><small>Forma de Pago:</small></th>
                        <th><small>Cuenta Colones:</small></th>
                        <th><small>IBAN Colones:</small></th>
                        <th><small>Cuenta Dolares:</small></th>
                        <th><small>IBAN Dolares:</small></th>
                        <th><small>Nombre Banco:</small></th>
                        <th><small>Marca Tarjeta:</small></th>
                        <th><small>N&uacute;mero Tarjeta:</small></th>
                        <th><small>Tarjetahabiente:</small></th>
                        <th><small>Emisor:</small></th>
                        <th><small>vencimiento:</small></th>
                        <th><small>Registro:</small></th>
                        <th><small>Estado:</small></th>
                        <th><small>Fecha Activaci&oacute;n:</small></th>
                        <th><small>Nota Importante 1:</small></th>
                        <th><small>Nota Importante 2:</small></th>
                    </tr>
                        <?php                                                   //saca todos los valores de la base de datos y
                                                                                // los hace filas
                            while ($line =  $resul->fetch_assoc()) 
                                {
                                    echo "<tr>";
                                    foreach ($line as $campo => $col_value)
                                        {
                                            if ($campo == 'credencial'){
                                                echo "<td><a href=consulta_general_2.php?superdato=",$col_value,">$col_value</a></td>";
                                            }
                                            if (($col_value != "No asignar")&&($campo != 'credencial')){
                                                echo "<td><small>$col_value</small></td>";
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