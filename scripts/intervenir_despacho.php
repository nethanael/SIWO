<?php
    session_start();

    $fecha = date("Y-m-d");

    $codigo_despacho = $_POST['codigo_despacho'];
    $credencial = $_POST['credencial'];
    $unidad = $_POST['unidad'];
    $tipo_paciente = $_POST['tipo_paciente'];
    $nombre_interesado = $_POST['nombre_interesado'];
    $nombre_paciente = $_POST['nombre_paciente'];
    $despachador = $_POST['despachador'];
    $prioridad = $_POST['prioridad'];
    $direccion = $_POST['direccion'];
    $diagnostico = $_POST['diagnostico'];
    $observaciones = $_POST['observaciones'];
    $tiempo_salida_unidad = $fecha."T".$_POST['tiempo_salida_unidad'];
    $tiempo_llegada_escena = $fecha."T".$_POST['tiempo_llegada_escena'];
    $tiempo_salida_escena = $fecha."T".$_POST['tiempo_salida_escena'];
    $tiempo_llegada_hospital = $fecha."T".$_POST['tiempo_llegada_hospital'];
    $estado = $_POST['estado'];
    $km_salida = $_POST['km_salida'];
    $km_entrada = $_POST['km_entrada'];

    $cambiar_salida_unidad = $_POST['cambiar_salida_unidad'];
    $cambiar_llegada_escena = $_POST['cambiar_llegada_escena'];
    $cambiar_salida_escena = $_POST['cambiar_salida_escena'];
    $cambiar_llegada_hospital = $_POST['cambiar_llegada_hospital'];

    $ahora = date("Y-m-d H:i");

    if ($credencial == '' || $codigo_despacho == '') 
	{
        $myheader = "Location: ../intervenir_despacho.php?superdato=" . $codigo_despacho;
        //echo $myheader;
		header($myheader);
	}
	else
	{		

        include '../includes/connection.php';

        $query = "UPDATE despachos set direccion = '$direccion', diagnostico = '$diagnostico', 
        observaciones = '$observaciones', km_entrada = '$km_entrada', km_salida = '$km_salida',
        estado = '$estado', tiempo_cierre = '$ahora' WHERE codigo_despacho LIKE '$codigo_despacho'";

        //echo $query;
        $resul = mysqli_query($conn, $query);

        if ($cambiar_salida_unidad) {
            //echo "si quiere cambiar 1";
            $query2 = "UPDATE despachos set tiempo_salida_unidad = '$tiempo_salida_unidad'
            WHERE codigo_despacho LIKE '$codigo_despacho'";
            //echo $query2;
            $resul2 = mysqli_query($conn, $query2);
        }

        if ($cambiar_llegada_escena) {
            //echo "si quiere cambiar 2";
            $query3 = "UPDATE despachos set tiempo_llegada_escena = '$tiempo_llegada_escena'
            WHERE codigo_despacho LIKE '$codigo_despacho'";
            //echo $query3;
            $resul3 = mysqli_query($conn, $query3);
        }

        if ($cambiar_salida_escena) {
            //echo "si quiere cambiar 3";
            $query4 = "UPDATE despachos set tiempo_salida_escena = '$tiempo_salida_escena'
            WHERE codigo_despacho LIKE '$codigo_despacho'";
            //echo $query4;
            $resul4 = mysqli_query($conn, $query4);
        }

        if ($cambiar_llegada_hospital) {
            //echo "si quiere cambiar 4";
            $query5 = "UPDATE despachos set tiempo_hospital = '$tiempo_llegada_hospital'
            WHERE codigo_despacho LIKE '$codigo_despacho'";
            //echo $query5;
            $resul5 = mysqli_query($conn, $query5);
        }
		
		include '../includes/connection.php';                                                // Conexion a BD
		$query2 = "SELECT * FROM despachos WHERE codigo_despacho LIKE '$codigo_despacho'";  // Consulta del campo necesario
		$resul = mysqli_query($conn, $query2, MYSQLI_USE_RESULT);                            //  Hacemos consulta a la BD
		$datos = mysqli_fetch_assoc($resul);
		
        $codigo_despacho = $datos['codigo_despacho'];
        $credencial = $datos['credencial'];
        $estado = $datos['estado'];
        $fecha_despacho = $datos['fecha_despacho'];
        $mes = $datos['mes'];
        $ano = $datos['ano'];
        $despachador = $datos['despachador'];
        $nombre_interesado = $datos['interesado'];
        $nombre_paciente = $datos['paciente'];
        $tipo_paciente = $datos['tipo_paciente'];
        $diagnostico = $datos['diagnostico'];
        $direccion = $datos['direccion'];
        $destino = $datos['destino'];
        $monto = $datos['monto'];
        $numero_factura = $datos['numero_factura'];
        $observaciones = $datos['observaciones'];
        $unidad = $datos['unidad'];
        $km_salida = $datos['km_salida'];
        $km_entrada = $datos['km_entrada'];
        $tiempo_llamada = $datos['tiempo_llamada'];
        $tiempo_despacho = $datos['tiempo_despacho'];
        $tiempo_salida_unidad = $datos['tiempo_salida_unidad'];
        $tiempo_llegada_escena = $datos['tiempo_llegada_escena'];
        $tiempo_salida_escena = $datos['tiempo_salida_escena'];
        $tiempo_llegada_hospital = $datos['tiempo_hospital'];
        $prioridad = $datos['prioridad'];

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
			<div class = "col-8 mi_col table-responsive">
				<!-- (row_!Centro!) -->
				<span class="text-center"><h3>Intervenci&oacute;n completa</h3></span>
				<span class="text-center"><h5>Intervenci&oacute;n realizada con &eacute;xito por <?php echo $_SESSION['NOMBRE'];?></h5></span>
				<table class="table table-sm table-bordered">	
					<thead class="thead-light">
                            <tr>
                                <th colspan="6">Detalles del despacho:</th>
                            </tr>
                    </thead>
					    <tr>
                            <td class="table-primary">Credencial:</td>  
                            <td><?php echo $credencial;?></td>
                            <td class="table-primary">Codigo Despacho:</td>  
                            <td><?php echo $codigo_despacho;?></td>
                            <td class="table-primary">Unidad:</td>  
                            <td><?php echo $unidad;?></td>
                        </tr>
                        <tr>
                            <td class="table-primary">Interesado:</td>  
                            <td><?php echo $nombre_interesado;?></td>
                            <td class="table-primary">Paciente:</td>  
                            <td><?php echo $nombre_paciente;?></td>
                            <td class="table-primary">Tipo de Paciente:</td>  
                            <td><?php echo $tipo_paciente;?></td>
                        </tr>
                        <tr>
                            <td class="table-secondary" colspan="6"></td> 
                        </tr>
                        <tr>
                            <td class="table-success">Tiempo Llamada:</td>  
                            <td><?php echo $tiempo_llamada;?></td>
                            <td class="table-success">Tiempo Despacho:</td>  
                            <td><?php echo $tiempo_despacho;?></td>
                            <td class="table-success">Tiempo Salida Unidad:</td>  
                            <td><?php echo $tiempo_salida_unidad;?></td>
                        </tr>
                        <tr>
                            <td class="table-success">Tiempo Llegada Escena:</td>  
                            <td><?php echo $tiempo_llegada_escena;?></td>
                            <td class="table-success">Tiempo Salida Escena:</td>  
                            <td><?php echo $tiempo_salida_escena;?></td>
                            <td class="table-success">Tiempo Llegada Hospital:</td>  
                            <td><?php echo $tiempo_llegada_hospital;?></td>
                        </tr>
                        <tr>
                            <td class="table-secondary" colspan="6"></td> 
                        </tr>
                        <tr>
                            <td class="table-info">Direcci&oacute;n:</td>  
                            <td colspan="5"><?php echo $direccion;?></td>
                        </tr>
                        <tr>
                            <td class="table-info">Destino:</td>  
                            <td colspan="5"><?php echo $destino;?></td>
                        </tr>
                        <tr>
                            <td class="table-info">Diagn&oacute;stico:</td>  
                            <td colspan="5"><?php echo $diagnostico;?></td>
                        </tr>
                        <tr>
                            <td class="table-info">Observaciones:</td>  
                            <td colspan="5"><?php echo $observaciones;?></td>
                        </tr>
                        <tr>
                            <td class="table-secondary" colspan="6"></td> 
                        </tr>
                        <tr>
                            <td class="table-warning">Fecha del Despacho:</td>  
                            <td><?php echo $fecha_despacho;?></td>
                            <td class="table-warning">KM Salida:</td>  
                            <td><?php echo $km_salida;?></td>
                            <td class="table-warning">KM Entrada:</td>  
                            <td><?php echo $km_entrada;?></td>
                        </tr>
                        <tr>
                            <td class="table-warning">Estado:</td>  
                            <td colspan=""><?php echo $estado;?></td>
                            <td class="table-warning">Prioridad:</td>  
                            <td colspan=""><?php echo $prioridad;?></td>
                            <td class="table-warning">Despachador:</td>  
                            <td colspan=""><?php echo $despachador;?></td>
                        </tr>
                        <tr>
                            <td colspan="3"><a href="../consulta_despachos_abiertos.php">Despachos abiertos</a></td>
                            <td colspan="3"><a href="../index.php">Volver a Principal</a></td>
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