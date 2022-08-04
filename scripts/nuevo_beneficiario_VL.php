<?php
    session_start();

	if ($_SESSION['LOGIN_TRASMEDIC'] == FALSE) {header("Location: ../index.php");}
	if ($_SESSION['ROL'] != 'vendedor' ){header("Location: ../index.php");}

    $usuario = $_SESSION['USUARIO'];
    $credencial = $_SESSION['CREDENCIAL'];
    $numero_contrato = $_SESSION['NUMERO_CONTRATO'];

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

    $nombre = $_POST["nombre"];
	$cedulaA = $_POST["cedulaA"];
	$cedulaB = $_POST["cedulaB"];
	$cedulaC = $_POST["cedulaC"];
	$cedulaN = $cedulaA."-".$cedulaB."-".$cedulaC;
	$cedulaR = $_POST["cedulaR"];
	$fecha_nacimiento = $_POST["fecha_nacimiento"];
    $genero = $_POST["genero"];
    $telefono_movil = $_POST["telefono_movil"];
    $telefono_fijo = $_POST["telefono_fijo"];
    $direccion_exacta = $_POST["direccion_exacta"];
	$observaciones = $_POST["observaciones"];
	
	$respiratorio_1 = $_POST["respiratorio_1"];
	$respiratorio_2 = $_POST["respiratorio_2"];
	$respiratorio_3 = $_POST["respiratorio_3"];

	$respiratorio = $respiratorio_1 . " " . $respiratorio_2 . " " . $respiratorio_3 . " ";

	$cardipatias_1 = $_POST["cardipatias_1"];
	$cardipatias_2 = $_POST["cardipatias_2"];
	$cardipatias_3 = $_POST["cardipatias_3"];
	$cardipatias_4 = $_POST["cardipatias_4"];

	$cardipatias = $cardipatias_1 . " " . $cardipatias_2 . " " . $cardipatias_3 . " " . $cardipatias_4 . " ";

	$neuronales_1 = $_POST["neuronales_1"];
	$neuronales_2 = $_POST["neuronales_2"];
	$neuronales_3 = $_POST["neuronales_3"];
	$neuronales_4 = $_POST["neuronales_4"];
	$neuronales_5 = $_POST["neuronales_5"];

	$neuronales = $neuronales_1 . " " . $neuronales_2 . " " . $neuronales_3 . " " . $neuronales_4 . " " . $neuronales_5 . " ";

	$hepaticas_1 = $_POST["hepaticas_1"];
	$hepaticas_2 = $_POST["hepaticas_2"];
	$hepaticas_3 = $_POST["hepaticas_3"];
	$hepaticas_4 = $_POST["hepaticas_4"];
	$hepaticas_5 = $_POST["hepaticas_5"];
	$hepaticas_6 = $_POST["hepaticas_6"];

	$hepaticas = $hepaticas_1 . " " . $hepaticas_2 . " " . $hepaticas_3 . " " . $hepaticas_4 . " " . $hepaticas_5 . " " . $hepaticas_6 . " ";

	$renales_1 = $_POST["renales_1"];
	$renales_2 = $_POST["renales_2"];

	$renales = $renales_1 . " " . $renales_2 . " "; 

	$endocrinas_1 = $_POST["endocrinas_1"];
	$endocrinas_2 = $_POST["endocrinas_2"];

	$endocrinas = $endocrinas_1 . " " . $endocrinas_2 . " ";

	$gastro_intestinales_1 = $_POST["gastro_intestinales_1"];	
	$gastro_intestinales_2 = $_POST["gastro_intestinales_2"];
	$gastro_intestinales_3 = $_POST["gastro_intestinales_3"];
	$gastro_intestinales_4 = $_POST["gastro_intestinales_4"];
	$gastro_intestinales_5 = $_POST["gastro_intestinales_5"];
	$gastro_intestinales_6 = $_POST["gastro_intestinales_6"];

	$gastro_intestinales = $gastro_intestinales_1 . " " . $gastro_intestinales_2 . " " . $gastro_intestinales_3 . " " . $gastro_intestinales_4 . " " . $gastro_intestinales_5 . " " . $gastro_intestinales_6 . " ";

	$psiquiatricas_1 = $_POST["psiquiatricas_1"];
	$psiquiatricas_2 = $_POST["psiquiatricas_2"];
	$psiquiatricas_3 = $_POST["psiquiatricas_3"];
	$psiquiatricas_4 = $_POST["psiquiatricas_4"];

	$psiquiatricas = $psiquiatricas_1 . " " . $psiquiatricas_2 . " " . $psiquiatricas_3 . " " . $psiquiatricas_4 . " ";
	

	$antecedentes_medicos = trim($respiratorio) . " " .trim($cardipatias) . " " .
	trim($neuronales). " " . trim($hepaticas) . " " . trim($renales) . " " . trim($endocrinas) . " " . 
	trim($gastro_intestinales) . " " . trim($psiquiatricas);

	$antecedentes_medicos = trim($antecedentes_medicos);

    //$antecedentes_medicos = null . "abuela" . null . "corky" . "perrazo" . null . null . "Gol de messi";
	

    if ($credencial == '' || $numero_contrato == '' || $nombre == '' || $fecha_nacimiento == '' || $genero == '' || $telefono_fijo == '' || $telefono_movil == '' || $provincia == '' || $canton == '' || $distrito == '' || $direccion_exacta == '') 
	{
		$_SESSION['BENEFICIARIO_ERROR'] = "¡Todos los campos marcados con * son obligatorios!";

		$_SESSION['BENEFICIARIO_TEMP_3'] = $nombre;
		$_SESSION['BENEFICIARIO_TEMP_4A'] = $cedulaA;
		$_SESSION['BENEFICIARIO_TEMP_4B'] = $cedulaB;
		$_SESSION['BENEFICIARIO_TEMP_4C'] = $cedulaC;
		$_SESSION['BENEFICIARIO_TEMP_4D'] = $cedulaR;
		$_SESSION['BENEFICIARIO_TEMP_5'] = $telefono_movil;
		$_SESSION['BENEFICIARIO_TEMP_6'] = $telefono_fijo;
		$_SESSION['BENEFICIARIO_TEMP_7A'] = $fnA;
		$_SESSION['BENEFICIARIO_TEMP_7B'] = $fnB;
		$_SESSION['BENEFICIARIO_TEMP_7C'] = $fnC;
		$_SESSION['BENEFICIARIO_TEMP_8'] = $distrito;
		$_SESSION['BENEFICIARIO_TEMP_9'] = $direccion_exacta;
		$_SESSION['BENEFICIARIO_TEMP_11'] = $antecedentes_medicos;
		$_SESSION['BENEFICIARIO_TEMP_12'] = $observaciones;

		header("Location: ../nuevo_beneficiario_A.php");
	}
	else
	{		

		if ($cedulaN == "--" && $cedulaR != ""){
			//echo "Nacional en blanco";
			$cedula = $cedulaR;
		}
		if ($cedulaR == "" && $cedulaN != "--"){
			//echo "residente en blanco";
			$cedula = $cedulaN;
		}
		if ($cedulaR != "" && $cedulaN != "--"){
			//echo "residente en blanco";
			$cedula = $cedulaN;
		}
		
		include '../includes/connection.php';
		
		$credencial = "TM-"."$credencial";
        $query = "INSERT INTO beneficiarios_credencial (credencial, numero_contrato, cedula, nombre, fecha_nacimiento, 
		genero, telefono_fijo, telefono_movil, provincia, canton, distrito, direccion_exacta, antecedentes_medicos, observaciones) 
		VALUES ('$credencial', '$numero_contrato', '$cedula', '$nombre', '$fecha_nacimiento', '$genero', '$telefono_fijo', 
		'$telefono_movil', '$provincia', '$canton', '$distrito', '$direccion_exacta', '$antecedentes_medicos', '$observaciones')";
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
			<div class = "col-4 mi_col table-responsive">
				<!-- (row_!Centro!) -->
				<span class="text-center"><h3>Nuevo beneficiario registrado</h3></span>
				<table class="table table-sm table-bordered">
					<tr>
						<td></td>
						<td>Beneficiario registrado con &eacute;xito por <?php echo $_SESSION['NOMBRE'];?></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td><a href="../nuevo_beneficiario_A_VL.php"><h4>Agregar otro Beneficiario</h4></a></td>
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
		$_SESSION['BENEFICIARIO_ERROR'] = '';

		$_SESSION['BENEFICIARIO_TEMP_3'] = '';
		$_SESSION['BENEFICIARIO_TEMP_4A'] = '';
		$_SESSION['BENEFICIARIO_TEMP_4B'] = '';
		$_SESSION['BENEFICIARIO_TEMP_4C'] = '';
		$_SESSION['BENEFICIARIO_TEMP_5'] = '';
		$_SESSION['BENEFICIARIO_TEMP_6'] = '';
		$_SESSION['BENEFICIARIO_TEMP_7A'] = '';
		$_SESSION['BENEFICIARIO_TEMP_7B'] = '';
		$_SESSION['BENEFICIARIO_TEMP_7C'] = '';
		$_SESSION['BENEFICIARIO_TEMP_8'] = '';
		$_SESSION['BENEFICIARIO_TEMP_9'] = '';
		$_SESSION['BENEFICIARIO_TEMP_11'] = '';
		$_SESSION['BENEFICIARIO_TEMP_12'] = '';
	}
	?>
</body>
</html>