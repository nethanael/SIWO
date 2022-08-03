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
	$query = "SELECT * FROM credencial_general WHERE credencial LIKE '$credencial'"; // Consulta del campo necesario
	$resul = mysqli_query($conn, $query, MYSQLI_USE_RESULT);                     //  Hacemos consulta a la BD
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


    //Consulta de datos de cobro

    include 'includes/connection.php';                                           // Conexion a BD
    $query3 = "SELECT * FROM cobro_credencial 
    WHERE credencial LIKE '$credencial' OR responsable LIKE '$nombre_razon_social'"; // Consulta del campo necesario
    $resul3 = mysqli_query($conn, $query3, MYSQLI_USE_RESULT);                     //  Hacemos consulta a la BD
    $datos3 = mysqli_fetch_assoc($resul3);
    
    $activo = $datos3["activo"];
    $importante_1 = $datos3["importante_1"];
    $importante_2 = $datos3["importante_2"];

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
		<title>SIWO</title>
	</head>
<body>
	<div class = "container mi_cont">

    <?php include_once('includes/header.php');?>
		<?php include_once('includes/main_menu.php');?>
          
        <div class = "row justify-content-center mi_row">
			<div class = "col-8 mi_col">
				<!-- (row_!Centro!) -->
                <table class="table table-sm table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th colspan="19">Datos importantes:</th>
                        </tr>
                        <tr>
                            <td colspan="19"><small>Revisar y tomar en consideración antes de hacer un despacho de unidad</small></td>
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
                </table>
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
                            <td colspan="3"class="table-primary"><h3><a href="consulta_beneficiarios.php?superdato=<?php echo $credencial;?>">Detalle Beneficiarios</a></h3></td> 
                            <td colspan="3"class="table-primary"><h3><a href="consulta_datos_cobro.php?superdato=<?php echo $credencial;?>">Detalle Cobro</a></h3></td> 
                        </tr>
                        <tr>
                            <td colspan="6"><a href="index.php">Volver</a></td>
                        </tr>
                    </table>
            </div>
        </div>

        <?php include_once('includes/footer.php');?>

	</div>
</body>
</html>