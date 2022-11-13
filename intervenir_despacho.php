<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();

    if ($_SESSION['LOGIN_TRASMEDIC'] == FALSE) {header("Location: index.php");}

    $codigo_despacho = $_GET['superdato'];
    
    include 'includes/connection.php';                                           // Conexion a BD
	$query = "SELECT * FROM despachos WHERE codigo_despacho LIKE '$codigo_despacho'"; // Consulta del campo necesario
	$resul = mysqli_query($conn, $query, MYSQLI_USE_RESULT);                     //  Hacemos consulta a la BD
    $datos = mysqli_fetch_assoc($resul);
    
    $tipo_despacho = $datos["tipo_despacho"];
    $credencial = $datos["credencial"];
    $estado = $datos["estado"];
    $fecha_despacho = $datos["fecha_despacho"];
    $mes = $datos["mes"];
    $ano = $datos["ano"];
    $despachador = $datos["despachador"];
    $interesado = $datos["interesado"];
    $paciente = $datos["paciente"];
    $tipo_paciente = $datos["tipo_paciente"];
    $diagnostico = $datos["diagnostico"];
    $direccion = $datos["direccion"];
    $destino = $datos["destino"];
    $monto = $datos["monto"];
    $numero_factura = $datos["numero_factura"];
    $observaciones = $datos["observaciones"];
    $unidad = $datos["unidad"];
    $km_salida = $datos["km_salida"];
    $km_entrada = $datos["km_entrada"];
    $tiempo_llamada = $datos["tiempo_llamada"];
    $tiempo_despacho = $datos["tiempo_despacho"];
    $tiempo_salida_unidad = $datos["tiempo_salida_unidad"];
    $tiempo_llegada_escena = $datos["tiempo_llegada_escena"];
    $tiempo_salida_escena = $datos["tiempo_salida_escena"];
    $tiempo_llegada_hospital = $datos["tiempo_hospital"];
    $prioridad = $datos["prioridad"];

    mysqli_free_result($resul);    
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimun-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/test_borders.css">
		<title>SIWO</title>
        <style>
            .claseEspecial {
                color:green;
                background-color: yellow;
                font-size: large;
            }
        </style>
	</head>
<body>
	<div class = "container mi_cont">

    <?php include_once('includes/header.php');?>
		<?php include_once('includes/main_menu.php');?>
          
        <div class = "row justify-content-center mi_row">
			<div class = "col-8 mi_col table-responsive">
				<!-- (row_!Centro!) -->
                <form name="" method="post" action="scripts/intervenir_despacho.php"> 
                    <table class="table table-sm table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th colspan="6">Detalles de despacho a intervenir</th>
                            </tr>
                        </thead>
                        <tr>
                            <td class="table-primary">
                                *Credencial:
                            </td>  
                            <td>
                                <input name="credencial" id="credencial" size="8" value="<?php echo $credencial;?>"readonly>
                            </td>
                            <td class="table-primary">
                                *Unidad:
                            </td>  
                            <td>
                                <input name="unidad" id="unidad" size="8" value="<?php echo $unidad;?>"readonly>
                            </td>
                            <td class="table-primary">
                                *Tipo de Paciente:
                            </td>  
                            <td>
                            <input name="tipo_paciente" id="tipo_paciente" size="8" value="<?php echo $tipo_paciente;?>"readonly>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-primary">
                                *Interesado:
                            </td>  
                            <td colspan="2">
                                <input name="nombre_interesado" id="nombre_interesado" size="20" value="<?php echo $interesado;?>"readonly>
                            </td>
                            <td class="table-primary">
                                *Paciente:
                            </td>  
                            <td colspan="2">
                                <input name="nombre_paciente" id="nombre_paciente" size="20" value="<?php echo $paciente;?>"readonly>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-primary">
                                *Despachador:
                            </td>  
                            <td>
                                <input name="despachador" id="despachador" size="8" value="<?php echo $despachador;?>"readonly>
                            </td>
                            <td class="table-primary">
                                *Prioridad:
                            </td>  
                            <td>
                                <input name="prioridad" id="prioridad" size="1" value="<?php echo $prioridad;?>"readonly>
                            </td>
                            <td class="table-primary">
                                *C&oacute;digo:
                            </td>  
                            <td>
                                <input name="codigo_despacho" id="codigo_despacho" size="1" value="<?php echo $codigo_despacho;?>"readonly>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-secondary" colspan="6"></td> 
                        </tr>
                        <tr>
                            <td class="table-success">
                                Direcci&oacute;n:
                            </td>  
                            <td colspan="5">
                                <input name="direccion" id="direccion" size="60" value="<?php echo $direccion;?>">
                            </td>
                        </tr>
                        <tr>
                            <td class="table-success">
                                Destino:
                            </td>  
                            <td colspan="5">
                                <input name="destino" id="destino" size="60" value="<?php echo $destino;?>">
                            </td>
                        </tr>
                        <tr>
                            <td class="table-success">
                                Diagn&oacute;stico:
                            </td>  
                            <td colspan="5">
                                <textarea id="diagnostico" name="diagnostico" rows="4" cols="63"><?php echo $diagnostico;?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-success">Observaciones:</td>  
                            <td colspan="5"><input name="observaciones" id="observaciones" size="60" value="<?php echo $observaciones;?>"></td>
                        </tr>
                        <tr>
                            <td class="table-secondary" colspan="6">Tiempos: (debe marcar check si quiere modificar)</td> 
                        </tr>
                        <tr>
                            <td class="table-info">
                                Salida Unidad:
                            </td>  
                            <td colspan="2">
                                <span class="claseEspecial"><?php echo $tiempo_salida_unidad;?></span>
                                <input name="tiempo_salida_unidad" type="time" id="tiempo_salida_unidad" size="8" maxlength="100">
                                <input type="checkbox" id="cambiar_salida_unidad" name="cambiar_salida_unidad" value=true>
                            </td>
                            <td class="table-info">
                                LLegada Escena:
                            </td>  
                            <td colspan="2">
                                <span class="claseEspecial"><?php echo $tiempo_llegada_escena;?></span>
                                <input name="tiempo_llegada_escena" type="time" id="tiempo_llegada_escena" size="8" maxlength="100">
                                <input type="checkbox" id="cambiar_llegada_escena" name="cambiar_llegada_escena" value=true>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-info">
                                Salida Escena:
                            </td>  
                            <td colspan="2">
                                <span class="claseEspecial"><?php echo $tiempo_salida_escena;?></span>
                                <input name="tiempo_salida_escena" type="time" id="tiempo_salida_escena" size="8" maxlength="100">
                                <input type="checkbox" id="cambiar_salida_escena" name="cambiar_salida_escena" value=true>
                            </td>
                            <td class="table-info">
                                LLegada Hospital:
                            </td>  
                            <td colspan="2">
                                <span class="claseEspecial"><?php echo $tiempo_llegada_hospital;?></span>
                                <input name="tiempo_llegada_hospital" type="time" id="tiempo_llegada_hospital" size="8" maxlength="100">
                                <input type="checkbox" id="cambiar_llegada_hospital" name="cambiar_llegada_hospital" value=true>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-secondary" colspan="6"></td> 
                        </tr>
                        <tr>
                            <td class="table-warning">Estado:</td>  
                            <td>                                
                                <select name="estado" id="estado">
                                    <option value="ABIERTO">ABIERTO</option>
                                    <option value="CERRADO">CERRADO</option>
                                </select>
                            </td>
                            <td class="table-warning">
                                KM Salida:
                            </td>  
                            <td>
                                <input name="km_salida" id="km_salida" size="8" value="<?php echo $km_salida;?>">
                            </td>
                            <td class="table-warning">
                                KM Entrada:
                            </td>  
                            <td>
                                <input name="km_entrada" id="km_entrada" size="8" value="<?php echo $km_entrada;?>">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><input type="submit" name="Submit" value="Actualizar"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="6"><a href="index.php">Volver</a></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <?php include_once('includes/footer.php');?>

	</div>
</body>
</html>