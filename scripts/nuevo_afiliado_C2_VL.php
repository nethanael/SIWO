<?php
    session_start();

	if ($_SESSION['LOGIN_TRASMEDIC'] == FALSE) {header("Location: ../index.php");}
	if ($_SESSION['ROL'] != 'vendedor' ){header("Location: ../index.php");}

    $usuario = $_SESSION['USUARIO'];
	$credencialA = $_POST["credencialA"];
	$credencialB = $_POST["credencialB"];
	$_SESSION['CREDENCIAL'] = "$credencialA"."-"."$credencialB";
	$_SESSION['NUMERO_CONTRATO'] = $_POST["numero_contrato"];
	$_SESSION['AFILIADO'] = $_POST["nombre_razon_social"];
	$_SESSION['MIDIRECCION'] = $_POST["direccion_exacta"];

	$provincia = $_POST["provincia"];

	switch ($provincia){
		case "0":
			$provincia = '';
			break;
		case "1":
			$provincia = "San Jose";
			break;
		case "2":
			$provincia = "Alajuela";
			break;
		case "3":
			$provincia = "Cartago";
		break;
		case "4":
			$provincia = "Heredia";
		break;
		case "5":
			$provincia = "Guanacaste";
		break;
		case "6":
			$provincia = "Puntarenas";
		break;
		case "7":
			$provincia = "Limón";
		break;
	}

	$canton = $_POST["canton"];
    $distrito = $_POST["distrito"];

    $credencial = $_SESSION['CREDENCIAL'];
    $numero_contrato = $_SESSION['NUMERO_CONTRATO'];
    $nombre_razon_social = $_SESSION['AFILIADO'];
	$cedulaA = $_POST["cedulaA"];
	$cedulaB = $_POST["cedulaB"];
	$cedulaC = $_POST["cedulaC"];
	$cedula = $cedulaA."-".$cedulaB."-".$cedulaC;
    $telefono_movil = $_POST["telefono_movil"];
    $telefono_fijo = $_POST["telefono_fijo"];
    $email = $_POST["email"];
	$direccion_exacta = $_POST["direccion_exacta"];
	
	$actividad_comercial = $_POST["actividad_comercial"];
	$tipo_negocio = $_POST["tipo_negocio"];
    $vehiculo = $_POST["vehiculo"];
	$flotilla = $_POST["flotilla"];
	$placas = $_POST["placas"];
	$area_protegida = $_POST["area_protegida"];
	$hogar_protegido = $_POST["hogar_protegido"];

	$observaciones = $_POST["observaciones"];

    $mes = date("m");
	$ano = date("y");
    $fecha = date("d/m/y");
    	
    if ($credencialA == '' || $credencialB == '' || $numero_contrato == '' || $nombre_razon_social == '' || $actividad_comercial == '' || $cedulaA == '' || $cedulaB == '' || $cedulaC == '' || $telefono_fijo == '' || $telefono_movil == '' || $email == '' || $provincia == '' || $canton == '' || $distrito == '' || $direccion_exacta == '') 
	{
		$_SESSION['AFILIACION_ERROR'] = "¡Todos los campos marcados con * son obligatorios!, recuerde actualizar Provincia y Distrito";

		$_SESSION['AFILIACION_TEMP_1A'] = $credencialA;
		$_SESSION['AFILIACION_TEMP_1B'] = $credencialB;
		$_SESSION['AFILIACION_TEMP_2'] = $numero_contrato;
		$_SESSION['AFILIACION_TEMP_3'] = $nombre_razon_social;
		$_SESSION['AFILIACION_TEMP_4A'] = $cedulaA;
		$_SESSION['AFILIACION_TEMP_4B'] = $cedulaB;
		$_SESSION['AFILIACION_TEMP_4C'] = $cedulaC;
		$_SESSION['AFILIACION_TEMP_5'] = $actividad_comercial;
		$_SESSION['AFILIACION_TEMP_6'] = $telefono_movil;
		$_SESSION['AFILIACION_TEMP_7'] = $telefono_fijo;
		$_SESSION['AFILIACION_TEMP_8'] = $email;
		$_SESSION['AFILIACION_TEMP_9'] = $distrito;
		$_SESSION['AFILIACION_TEMP_10'] = $direccion_exacta;
		$_SESSION['AFILIACION_TEMP_11'] = $placas;
		$_SESSION['AFILIACION_TEMP_13'] = $observaciones;

		header("Location: ../nuevo_afiliado_B2_VL.php");
	}
	else
	{		

        include '../includes/connection.php';
		
		$credencial = "TM-"."$credencial";
		$query = "INSERT INTO credencial_general (credencial, numero_contrato, tipo_afiliado, cedula, mes_afiliacion, ano_afiliacion, 
		fecha_afiliacion, nombre_razon_social, actividad_comercial, telefono_fijo, telefono_movil, provincia, canton, distrito, 
		direccion_exacta, email, observaciones, vehiculo, flotilla, placas, area_protegida, hogar_protegido, tipo_negocio) 
		VALUES ('$credencial', '$numero_contrato', 'Juridico', '$cedula', '$mes', '$ano', '$fecha', '$nombre_razon_social', 
		'$actividad_comercial', '$telefono_fijo', '$telefono_movil', '$provincia', '$canton', '$distrito', '$direccion_exacta', 
		'$email', '$observaciones', '$vehiculo', '$flotilla', '$placas', '$area_protegida', '$hogar_protegido', '$tipo_negocio')";
		//echo $query;
        $resul = mysqli_query($conn, $query);
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
					<span class="text-center"><h3>Nueva afiliaci&oacute;n registrada</h3></span>
					<span class="text-center"><h6>Afiliaci&oacute;n realizada con &eacute;xito por <?php echo $_SESSION['NOMBRE'];?></h3></span>
           		</div>
			<div class = "col-8 mi_col table-responsive">
				<!-- (row_!Centro!) -->
				<table class="table table-sm table-bordered">
					<tr>
						<td></td>
						<td><a href="../nuevo_beneficiario_A_VL.php"><h4>Agregar Beneficiarios</h4></a></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td><a href="../nuevo_cobro_info_VL.php"><h4>Agregar Información de cobro</h4></a></td>
						<td></td>
					</tr>
				</table>
			</div>
    	</div>

        <?php include_once('../includes/footer.php');?>

	</div>

	<?php 
	
		$_SESSION['AFILIACION_ERROR'] = '';
		$_SESSION['AFILIACION_TEMP_1A'] = '';
		$_SESSION['AFILIACION_TEMP_1B'] = '';
		$_SESSION['AFILIACION_TEMP_2'] = '';
		$_SESSION['AFILIACION_TEMP_3'] = '';
		$_SESSION['AFILIACION_TEMP_4A'] = '';
		$_SESSION['AFILIACION_TEMP_4B'] = '';
		$_SESSION['AFILIACION_TEMP_4C'] = '';
		$_SESSION['AFILIACION_TEMP_5'] = '';
		$_SESSION['AFILIACION_TEMP_6'] = '';
		$_SESSION['AFILIACION_TEMP_7'] = '';
		$_SESSION['AFILIACION_TEMP_8'] = '';
		$_SESSION['AFILIACION_TEMP_9'] = '';
		$_SESSION['AFILIACION_TEMP_10'] = '';
		$_SESSION['AFILIACION_TEMP_11'] = '';
		$_SESSION['AFILIACION_TEMP_13'] = '';
	
	}?>
</body>
</html>