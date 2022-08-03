<?php
    session_start();

    $mes = date("m");
	$ano = date("y");

	$despachador = $_SESSION['USUARIO'];
    $credencialA = $_POST["credencialA"];
	$credencialB = $_POST["credencialB"];
	$credencial = "$credencialA"."-"."$credencialB";
    $tipo_despacho = "EMERGENCIA";
    $estado = 'ABIERTO';

    $fecha_despacho = $_POST["fecha_despacho"];
    $nombre_interesado = $_POST["nombre_interesado"];
    $nombre_paciente = $_POST["nombre_paciente"];
    $tipo_paciente = $_POST["tipo_paciente"];
    $unidad = $_POST["unidad"];
    $diagnostico = $_POST["diagnostico"];
    $direccion = $_POST["direccion"];
    $destino = $_POST["destino"];
    $monto = $_POST["monto"];
    $factura = $_POST["factura"];
    $km_salida = $_POST["km_salida"];
    $km_entrada = $_POST["km_entrada"];
    $tiempo_llamada = $_POST["tiempo_llamada"];
    $tiempo_despacho = $_POST["tiempo_despacho"];
    $tiempo_salida_unidad = $_POST["tiempo_salida_unidad"];
    $tiempo_llegada_escena = $_POST["tiempo_llegada_escena"];
    $tiempo_salida_escena = $_POST["tiempo_salida_escena"];
    $tiempo_hospital = $_POST["tiempo_hospital"];
    $tiempo_disponible = $_POST["tiempo_disponible"];
    $prioridad = $_POST["prioridad"];
    $observaciones = $_POST["observaciones"];
    
    if ($credencialA == '' || $credencialB == '' || $nombre_interesado == '' || $nombre_paciente == '' || $tipo_paciente == '' 
    || $unidad == '' || $direccion == '' || $destino == '' || $monto == '' || $tiempo_llamada == '' 
    || $prioridad == '' || $tiempo_despacho == '') 
	{
		$_SESSION['DESPACHO_ERROR'] = "¡Todos los campos marcados con * son obligatorios!";

		$_SESSION['DESPACHO_TEMP_A1'] = $credencialA;
        $_SESSION['DESPACHO_TEMP_A2'] = $credencialB;
        $_SESSION['DESPACHO_TEMP_B'] = $nombre_interesado;
        $_SESSION['DESPACHO_TEMP_C'] = $nombre_paciente;
        $_SESSION['DESPACHO_TEMP_D'] = $diagnostico;
        $_SESSION['DESPACHO_TEMP_E'] = $direccion;
        $_SESSION['DESPACHO_TEMP_F'] = $destino;
        $_SESSION['DESPACHO_TEMP_G'] = $monto;
        $_SESSION['DESPACHO_TEMP_H'] = $factura;
        $_SESSION['DESPACHO_TEMP_I'] = $km_salida;
        $_SESSION['DESPACHO_TEMP_J'] = $km_entrada;
        $_SESSION['DESPACHO_TEMP_K'] = $observaciones;
        
		header("Location: ../despachar_unidad_B1.php");
	}
	else
	{		
		
		include '../includes/connection.php';
		
		$credencial = "TM-"."$credencial";
        $query = "INSERT INTO despachos (tipo_despacho, credencial, estado, fecha_despacho, mes, ano, despachador, interesado, 
        paciente, tipo_paciente, diagnostico, direccion, destino, monto, numero_factura, observaciones, unidad, km_entrada, km_salida, 
        tiempo_llamada, tiempo_despacho, tiempo_salida_unidad, tiempo_llegada_escena, tiempo_salida_escena, tiempo_hospital, 
        prioridad) VALUES ('$tipo_despacho', '$credencial', '$estado', '$fecha_despacho', '$mes', '$ano', '$despachador', 
        '$nombre_interesado', '$nombre_paciente', '$tipo_paciente', '$diagnostico', '$direccion', '$destino', '$monto', '$factura', '$observaciones', 
        '$unidad', '$km_entrada', '$km_salida', '$tiempo_llamada', '$tiempo_despacho', '$tiempo_salida_unidad', 
        '$tiempo_llegada_escena', '$tiempo_salida_escena', '$tiempo_hospital', '$prioridad')";
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
			<div class = "col-4 mi_col">
				<!-- (row_!Centro!) -->
				<span class="text-center"><h3>Nuevo despacho registrado</h3></span>
				<table class="table table-bordered">
					<tr>
						<td></td>
						<td><img src="../imgs/crear_act.png"></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td>Despacho realizado con &eacute;xito por <?php echo $_SESSION['NOMBRE'];?></td>
						<td></td>
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
	
		$_SESSION['DESPACHO_ERROR'] = '';
		$_SESSION['DESPACHO_TEMP_A1'] = '';
		$_SESSION['DESPACHO_TEMP_A2'] = '';
        $_SESSION['DESPACHO_TEMP_B'] = '';
        $_SESSION['DESPACHO_TEMP_C'] = '';
        $_SESSION['DESPACHO_TEMP_D'] = '';
        $_SESSION['DESPACHO_TEMP_E'] = '';
        $_SESSION['DESPACHO_TEMP_F'] = '';
        $_SESSION['DESPACHO_TEMP_G'] = '';
        $_SESSION['DESPACHO_TEMP_H'] = '';
        $_SESSION['DESPACHO_TEMP_I'] = '';
        $_SESSION['DESPACHO_TEMP_J'] = '';
        $_SESSION['DESPACHO_TEMP_K'] = '';
	
	}?>
</body>
</html>