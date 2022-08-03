<?php
    session_start();

    if ($_SESSION['LOGIN_TRASMEDIC'] == FALSE) {header("Location: ../index.php");}
    if ($_SESSION['ROL'] != 'vendedor_supervisor' ){header("Location: ../index.php");}

    $credencial = $_POST['credencial'];
    $numero_contrato = $_POST['numero_contrato'];

    $cedula = $_POST["cedula"];
    $nombre_razon_social = $_POST['nombre_razon_social'];
    $actividad_comercial = $_POST["actividad_comercial"];
    $tipo_negocio = $_POST["tipo_negocio"];
	
    $telefono_movil = $_POST["telefono_movil"];
    $telefono_fijo = $_POST["telefono_fijo"];
    $hogar_protegido = $_POST["hogar_protegido"];
    $email = $_POST["email"];

    $provincia = $_POST["provincia"];
    $canton = $_POST["canton"];
    $distrito = $_POST["distrito"];
	$direccion_exacta = $_POST["direccion_exacta"];
    
    $informacion_medica = $_POST["informacion_medica"];
    $antecedentes_medicos = $_POST["antecedentes_medicos"];
    $observaciones = $_POST["observaciones"];
    
    $vehiculo = $_POST["vehiculo"];
    $flotilla = $_POST["flotilla"];
    $placas = $_POST["placas"];
    $area_protegida = $_POST["area_protegida"];    

    $fecha_afiliacion = $_POST["fecha_afiliacion"];

    if ($credencial == '' || $numero_contrato == '' || $nombre_razon_social == '' || $cedula == '' 
    || $telefono_fijo == '' || $telefono_movil == '' || $email == '' || $provincia == '' || $canton == '' 
    || $distrito == '' || $direccion_exacta == '' || $fecha_afiliacion == '') 
	{
        $myheader = "Location: ../editar_credencial_2.php?superdato=" . $credencial;
        //echo $myheader;
		header($myheader);
	}
	else
	{		

        include '../includes/connection.php';

        $query = "UPDATE credencial_general set nombre_razon_social = '$nombre_razon_social', telefono_fijo = '$telefono_fijo', 
        telefono_movil = '$telefono_movil', cedula = '$cedula', email = '$email', provincia = '$provincia', canton = '$canton', 
        distrito = '$distrito', direccion_exacta = '$direccion_exacta', hogar_protegido = '$hogar_protegido', 
        antecedentes_medicos = '$antecedentes_medicos', informacion_medica = '$informacion_medica', observaciones = '$observaciones',
        area_protegida = '$area_protegida', vehiculo = '$vehiculo', flotilla = '$flotilla', placas = '$placas',
        actividad_comercial = '$actividad_comercial', tipo_negocio = '$tipo_negocio', fecha_afiliacion = '$fecha_afiliacion'
        WHERE credencial LIKE '$credencial'";

        //echo $query;
        $resul = mysqli_query($conn, $query);
		
		include '../includes/connection.php';                                           // Conexion a BD
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
        $fecha_afiliacion = $datos["fecha_afiliacion"];
	
		mysqli_free_result($resul);  
    
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
			<div class = "col-8 mi_col">
				<!-- (row_!Centro!) -->
				<span class="text-center"><h3>Edici&oacute;n completa</h3></span>
				<span class="text-center"><h5>Edici&oacute;n realizada con &eacute;xito por <?php echo $_SESSION['NOMBRE'];?></h5></span>
				<table class="table table-sm table-bordered">	
					<thead class="thead-light">
                            <tr>
                                <th colspan="6">Detalles de la credencial:</th>
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
                            <td class="table-warning">Fecha Afiliaci&oacute;n:</td>  
                            <td colspan=""><?php echo $fecha_afiliacion;?></td>
                        </tr>
                        <tr>
                            <td colspan="6"><a href="../editar_credencial_2.php?superdato=<?php echo $credencial;?>">Volver</a></td>
                        </tr>
				</table>
			</div>
    	</div>

        <?php include_once('../includes/footer.php');?>

	</div>

	<?php 
        }  
        ?>
</body>
</html>