<?php
    session_start();

    if ($_SESSION['LOGIN_TRASMEDIC'] == FALSE) {header("Location: ../index.php");}
	if ($_SESSION['ROL'] != 'vendedor' ){header("Location: ../index.php");}

    $credencial = $_POST['credencial'];
    $numero_contrato = $_POST['numero_contrato'];
	$responsable = $_POST["responsable"];
	$rol = $_POST["rol"];
	$responsable_2 = $_POST["responsable_2"];
	$rol_2 = $_POST["rol_2"];
	$monto = $_POST["monto"];
    //$monto_SI = $_POST["monto_SI"];
	$periodicidad = $_POST["periodicidad"];
	$fecha_pago = $_POST["fecha_pago"];
    $forma_pago = $_POST["forma_pago"];

    $nombre_banco_1 = $_POST["nombre_banco_1"];
    $corriente_colones_1 = $_POST["corriente_colones_1"];
    $iban_colones_1 = $_POST["iban_colones_1"];
    $corriente_dolares_1 = $_POST["corriente_dolares_1"];
    $iban_dolares_1 = $_POST["iban_dolares_1"];

    $marca_tarjeta = $_POST["marca_tarjeta"];
    $numero_tarjeta_1 = $_POST["numero_tarjeta_1"];
    $numero_tarjeta_2 = $_POST["numero_tarjeta_2"];
    $numero_tarjeta_3 = $_POST["numero_tarjeta_3"];
    $numero_tarjeta_4 = $_POST["numero_tarjeta_4"];
    $numero_tarjeta = $numero_tarjeta_1."-".$numero_tarjeta_2."-".$numero_tarjeta_3."-".$numero_tarjeta_4;
    $tarjeta_habiente = $_POST["tarjeta_habiente"];
    $emisor = $_POST["emisor"];
    $vencimiento_1 = $_POST["vencimiento_1"];
    $vencimiento_2 = $_POST["vencimiento_2"];
    $vencimiento = $vencimiento_1 ."/".$vencimiento_2;

    $direccion_cobro = $_POST["direccion_cobro"];
    $importante_1 = $_POST["importante_1"];
    $importante_2 = $_POST["importante_2"];

    $fecha = date("d/m/y");
    
    if ($credencial == '' || $numero_contrato == '' || $responsable == '' || $rol =='' || $monto == '' || $fecha_pago == '' || $forma_pago == '' || $direccion_cobro == '') 
	{
		$_SESSION['COBRO_ERROR'] = "¡Todos los campos marcados con * son obligatorios!";

		$_SESSION['COBRO_TEMP_1'] = $responsable;
		$_SESSION['COBRO_TEMP_11'] = $rol;
		$_SESSION['COBRO_TEMP_A'] = $responsable_2;
		$_SESSION['COBRO_TEMP_AA'] = $rol_2;
		$_SESSION['COBRO_TEMP_2'] = $monto;
        $_SESSION['COBRO_TEMP_21'] = $monto_SI;
		$_SESSION['COBRO_TEMP_3'] = $fecha_pago;

		$_SESSION['COBRO_TEMP_NOMBRE_BANCO_1'] = $nombre_banco_1;
        $_SESSION['COBRO_TEMP_40'] = $corriente_colones_1;
        $_SESSION['COBRO_TEMP_41'] = $iban_colones_1;
        $_SESSION['COBRO_TEMP_42'] = $corriente_dolares_1;
        $_SESSION['COBRO_TEMP_43'] = $iban_dolares_1;

        $_SESSION['COBRO_TEMP_44A'] = $numero_tarjeta_1;
        $_SESSION['COBRO_TEMP_44B'] = $numero_tarjeta_2;
        $_SESSION['COBRO_TEMP_44C'] = $numero_tarjeta_3;
        $_SESSION['COBRO_TEMP_44D'] = $numero_tarjeta_4;
        $_SESSION['COBRO_TEMP_45'] = $tarjeta_habiente;
        $_SESSION['COBRO_TEMP_46'] = $emisor;
        $_SESSION['COBRO_TEMP_47A'] = $vencimiento_1;
        $_SESSION['COBRO_TEMP_47B'] = $vencimiento_2;

		$_SESSION['COBRO_TEMP_5'] = $direccion_cobro;
		$_SESSION['COBRO_TEMP_6'] = $importante_1;
        $_SESSION['COBRO_TEMP_7'] = $importante_2;

		header("Location: ../nuevo_cobro_info_VL.php");
	} 
	else
	{		

        include '../includes/connection.php';
        $credencial = "TM-"."$credencial"; 
        $usuario = $_SESSION['USUARIO'];

        $monto_SI = $monto - ($monto * 0.04);
        
        $query = "INSERT INTO cobro_credencial (credencial, numero_contrato, responsable, rol, responsable_2, rol_2, 
        monto, monto_SI, periodicidad, direccion_cobro, fecha_pago, forma_pago, corriente_colones_1, iban_colones_1, corriente_dolares_1, 
        iban_dolares_1, nombre_banco_1, marca_tarjeta, numero_tarjeta, tarjeta_habiente, emisor, vencimiento, 
        vendedor, activo, fecha_activacion, importante_1, importante_2) VALUES ('$credencial', '$numero_contrato', '$responsable', 
        '$rol', '$responsable_2', '$rol_2', '$monto', '$monto_SI', '$periodicidad', '$direccion_cobro', '$fecha_pago', '$forma_pago', 
        '$corriente_colones_1', '$iban_colones_1','$corriente_dolares_1','$iban_dolares_1','$nombre_banco_1', '$marca_tarjeta', 
        '$numero_tarjeta','$tarjeta_habiente','$emisor','$vencimiento','$usuario', 'ACTIVO', '$fecha', '$importante_1', 
        '$importante_2')";
        //echo $query;
		$resul = mysqli_query($conn, $query);
		
    
		include 'includes/connection.php';                                           // Conexion a BD
		$query2 = "SELECT * FROM credencial_general WHERE credencial LIKE '$credencial'"; // Consulta del campo necesario
		$resul = mysqli_query($conn, $query2, MYSQLI_USE_RESULT);                     //  Hacemos consulta a la BD
		$datos = mysqli_fetch_assoc($resul);
		
		$tipo_afiliado = $datos["tipo_afiliado"];
		$numero_contrato = $datos["numero_contrato"];
		$cedula = $datos["cedula"];
		$nombre_razon_social = $datos["nombre_razon_social"];
        $actividad_comercial = $datos["actividad_comercial"];
        $tipo_negocio = $datos["tipo_negocio"];
		$telefono_fijo = $datos["telefono_fijo"];
		$telefono_movil = $datos["telefono_movil"];
		$provincia = $datos["provincia"];
		$canton = $datos["canton"];
		$distrito = $datos["distrito"];
		$email = $datos["email"];
		$direccion_exacta = $datos["direccion_exacta"];
		$informacion_medica = $datos["informacion_medica"];
		$antecedentes_medicos = $datos["antecedentes_medicos"];
		$observaciones = $datos["observaciones"];
		$vehiculo = $datos["vehiculo"];
		$flotilla = $datos["flotilla"];
		$placas = $datos["placas"];
        $area_protegida = $datos["area_protegida"];
        $hogar_protegido = $datos["hogar_protegido"];
	
		mysqli_free_result($resul);  

        // armar tabla de beneficiarios resumen

        include 'includes/connection.php';                                           // Conexion a BD
	    $sql_bene = "SELECT cedula, nombre, 
        antecedentes_medicos, fecha_nacimiento, genero, observaciones FROM beneficiarios_credencial 
        WHERE credencial LIKE '$credencial'"; // Consulta del campo necesario
	    $resul_bene = $conn->query($sql_bene); 

        //mysqli_free_result($resul_bene);  

        //armar tabla de datos cobro resumen 

        include 'includes/connection.php';                                           // Conexion a BD
        $sql_cobro = "SELECT responsable, monto, monto_SI, periodicidad, direccion_cobro, 
        fecha_pago, forma_pago, importante_1 FROM cobro_credencial 
        WHERE credencial LIKE '$credencial'"; // Consulta del campo necesario
        $resul_cobro = $conn->query($sql_cobro); 

        //mysqli_free_result($resul_cobro); 
    
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
			<div class = "col-8 mi_col table-responsive">
				<!-- (row_!Centro!) -->
				<span class="text-center"><h3>Nueva afiliaci&oacute;n completamente registrada</h3></span>
				<span class="text-center"><h3>Afiliaci&oacute;n realizada con &eacute;xito por <?php echo $_SESSION['NOMBRE'];?></h3></span>
				<table class="table table-sm table-bordered">	
					<thead class="thead-light">
                            <tr>
                                <th colspan="6">Detalles de la credencial principal:</th>
                            </tr>
                    </thead>
					<tr>
                            <td class="table-primary">Credencial:</td>  
                            <td><?php echo $credencial;?></td>
                            <td class="table-primary">Contrato:</td>  
                            <td><?php echo $numero_contrato;?></td>
                            <td class="table-primary">Tipo de C&eacute;dula:</td>  
                            <td><?php echo $tipo_afiliado;?></td>
                        </tr>
                        <tr>
                            <td class="table-primary">C&eacute;dula:</td>  
                            <td><?php echo $cedula;?></td>
                            <td class="table-primary">Nombre:</td>  
                            <td><?php echo $nombre_razon_social;?></td>
                            <td class="table-primary">Actividad Comercial:</td>  
                            <td><?php echo $actividad_comercial;?></td>
                        </tr>
                        <tr>
                            <td class="table-primary">Tel&eacute;fono M&oacute;vil:</td>  
                            <td><?php echo $telefono_movil;?></td>
                            <td class="table-primary">Tel&eacute;fono Fijo:</td>  
                            <td><?php echo $telefono_fijo;?></td>
                            <td class="table-primary">Tipo de Negocio:</td>  
                            <td><?php echo $tipo_negocio;?></td>
                        </tr>
                        <tr>
                            <td class="table-primary">Email:</td>  
                            <td colspan="5"><?php echo $email;?></td>
                        </tr>
                        <tr>
                            <td class="table-secondary" colspan="6"></td> 
                        </tr>
                        <tr>
                            <td class="table-success">Provincia:</td>  
                            <td><?php echo $provincia;?></td>
                            <td class="table-success">Cant&oacute;n:</td>  
                            <td><?php echo $canton;?></td>
                            <td class="table-success">Distrito:</td>  
                            <td><?php echo $distrito;?></td>
                        </tr>
                        <tr>
                            <td class="table-success">Direcci&oacute;n:</td>  
                            <td colspan="5"><?php echo $direccion_exacta;?></td>
                        </tr>
                        <tr>
                            <td class="table-secondary" colspan="6"></td> 
                        </tr>
                        <tr>
                            <td class="table-info">Info. Medica:</td>  
                            <td colspan="2"><?php echo $informacion_medica;?></td>
                            <td class="table-info">Antec. Medicos:</td>  
                            <td colspan="2"><?php echo $antecedentes_medicos;?></td>
                        </tr>
                        <tr>
                            <td class="table-info">Observaciones:</td>  
                            <td colspan="5"><?php echo $observaciones;?></td>
                        </tr>
                        <tr>
                            <td class="table-secondary" colspan="6"></td> 
                        </tr>
                        <tr>
                            <td class="table-warning">Veh&iacute;culo:</td>  
                            <td><?php echo $vehiculo;?></td>
                            <td class="table-warning">Flotilla:</td>  
                            <td><?php echo $flotilla;?></td>
                            <td class="table-warning">placas:</td>  
                            <td><?php echo $placas;?></td>
                        </tr>
                        <tr>
                            <td class="table-warning">&Aacute;rea Protegida:</td>  
                            <td colspan=""><?php echo $area_protegida;?></td>
                            <td class="table-warning">Hogar Protegido:</td>  
                            <td colspan=""><?php echo $hogar_protegido;?></td>
                        </tr>
                        <tr>
                            <table class="table table-sm table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th colspan=7">Beneficiarios asociados a esta credencial:</th>
                                    </tr>
                                </thead>
                                <tr>
                                    <th class="td_cedula"><small>Cedula:</small></th>
                                    <th><small>Nombre / Raz&oacute;n Social:</small></th>
                                    <th><small>Antecedentes M&eacute;dicos:</small></th>
                                    <th><small>Fecha Nacimiento:</small></th>
                                    <th><small>Edad:</small></th>
                                    <th><small>G&eacute;nero:</small></th>
                                    <th><small>Observaciones:</small></th>
                                </tr>
                                <?php                                                   //saca todos los valores de la base de datos y
                                                                                    // los hace filas
                                while ($line =  $resul_bene->fetch_assoc()) 
                                    {
                                        echo "<tr>";
                                        foreach ($line as $campo => $col_value)
                                            {
                                                
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
                                <tr>
                                    <td colspan="7">
                                        <small>Si desea ver más información vaya a <a href="../consulta_general_VL.php">consulta credenciales</a></small>
                                    </td>
                                </tr>
                            </table>
                            <table class="table table-sm table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th colspan="8">Datos de cobro resumidos asociados a esta credencial:</th>
                                    </tr>
                                </thead>
                                <tr>
                                    <!--  <th><small>Codigo Sistema:</small></th> -->
                                    <th><small>Responsable:</small></th>
                                    <th><small>Monto (IVA):</small></th>
                                    <th><small>Monto (Sin IVA):</small></th>
                                    <th><small>Periodicidad:</small></th>
                                    <th><small>Direcci&oacute;n cobro:</small></th>
                                    <th><small>Fecha de Pago:</small></th>
                                    <th><small>Forma de Pago:</small></th>
                                    <th><small>Nota Importante 1:</small></th>
                                </tr>
                                <?php                                                   //saca todos los valores de la base de datos y
                                                                                            // los hace filas
                                        while ($line =  $resul_cobro->fetch_assoc()) 
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
                                <tr>
                                    <td colspan="7">
                                        <small>Si desea ver más información vaya a <a href="../consulta_general_VL.php">consulta credenciales</a></small>
                                    </td>
                                </tr> 
                            </table>
                        </tr>
                        <tr>
                            <td colspan="6"><a href="../index.php">Volver</a></td>
                        </tr>
                            
				</table>
			

            </div>
    	</div>

        <?php include_once('../includes/footer.php');?>

	</div>

	<?php 
	
		$_SESSION['COBRO_ERROR'] = '';
		$_SESSION['COBRO_TEMP_1'] = '';
		$_SESSION['COBRO_TEMP_11'] = '';
		$_SESSION['COBRO_TEMP_A'] = '';
		$_SESSION['COBRO_TEMP_AA'] = '';
		$_SESSION['COBRO_TEMP_2'] = '';
        $_SESSION['COBRO_TEMP_21'] = '';
		$_SESSION['COBRO_TEMP_3'] = '';

        $_SESSION['COBRO_TEMP_NOMBRE_BANCO_1'] = '';
        $_SESSION['COBRO_TEMP_40'] = '';
        $_SESSION['COBRO_TEMP_41'] = '';
        $_SESSION['COBRO_TEMP_42'] = '';
        $_SESSION['COBRO_TEMP_43'] = '';

        $_SESSION['COBRO_TEMP_44A'] = '';
        $_SESSION['COBRO_TEMP_44B'] = '';
        $_SESSION['COBRO_TEMP_44C'] = '';
        $_SESSION['COBRO_TEMP_44D'] = '';
        $_SESSION['COBRO_TEMP_45'] = '';
        $_SESSION['COBRO_TEMP_46'] = '';
        $_SESSION['COBRO_TEMP_47A'] = '';
        $_SESSION['COBRO_TEMP_47B'] = '';

		$_SESSION['COBRO_TEMP_5'] = '';
		$_SESSION['COBRO_TEMP_6'] = '';
        $_SESSION['COBRO_TEMP_7'] = '';
        $_SESSION['MIDIRECCION'] = '';
	
	    }  ?>
</body>
</html>