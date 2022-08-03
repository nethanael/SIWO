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
    $hogar_protegido = $datos["hogar_protegido"];
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
    $fecha_afiliacion = $datos["fecha_afiliacion"];

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
	</head>
<body>
	<div class = "container mi_cont">

    <?php include_once('includes/header.php');?>
		<?php include_once('includes/main_menu.php');?>
          
        <div class = "row justify-content-center mi_row">
			<div class = "col-12 mi-col table-responsive">
				<!-- (row_!Centro!) -->
                <form name="" method="post" action="scripts/editar_credencial.php"> 
                    <table class="table table-sm table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th colspan="6">Detalles de la credencial principal a editar:</th>
                            </tr>
                        </thead>
                        <tr>
                            <td class="table-primary">*Credencial:</td>  
                            <td><input name="credencial" id="credencial" size="8" value="<?php echo $credencial;?>"readonly></td>
                            <td class="table-primary">*Contrato:</td>  
                            <td><input name="numero_contrato" id="numero_contrato" size="8" value="<?php echo $numero_contrato;?>"readonly></td>
                            <td class="table-primary">*Tipo de C&eacute;dula:</td>  
                            <td><input name="tipo_afiliado" id="tipo_afiliado" size="8" value="<?php echo $tipo_afiliado;?>"readonly></td>
                        </tr>
                        <tr>
                            <td class="table-primary">*C&eacute;dula:</td>  
                            <td><input name="cedula" id="cedula" size="8" value="<?php echo $cedula;?>"></td>
                            <td class="table-primary">*Nombre:</td>  
                            <td><input name="nombre_razon_social" id="nombre_razon_social" size="15" value="<?php echo $nombre_razon_social;?>"></td>
                            <td class="table-primary">Actividad Comercial:</td>  
                            <td><input name="actividad_comercial" id="actividad_comercial" size="8" value="<?php echo $actividad_comercial;?>"></td>
                        </tr>
                        <tr>
                            <td class="table-primary">*Tel&eacute;fono M&oacute;vil:</td>  
                            <td><input name="telefono_movil" id="telefono_movil" size="8" value="<?php echo $telefono_movil;?>"></td>
                            <td class="table-primary">*Tel&eacute;fono Fijo:</td>  
                            <td><input name="telefono_fijo" id="telefono_fijo" size="8" value="<?php echo $telefono_fijo;?>"></td>
                            <td class="table-primary">Tipo de Negocio:</td>  
                            <td><input name="tipo_negocio" id="tipo_negocio" size="8" value="<?php echo $tipo_negocio;?>"></td> </tr>
                        <tr>
                            <td class="table-primary">*Email:</td>  
                            <td colspan="5"><input name="email" id="email" size="20" value="<?php echo $email;?>"></td>
                        </tr>
                        <tr>
                            <td class="table-secondary" colspan="6"></td> 
                        </tr>
                        <tr>
                            <td class="table-success">*Provincia:</td>  
                            <td><input name="provincia" id="provincia" size="8" value="<?php echo $provincia;?>"></td>
                            <td class="table-success">*Cant&oacute;n:</td>  
                            <td><input name="canton" id="canton" size="8" value="<?php echo $canton;?>"></td>
                            <td class="table-success">*Distrito:</td>  
                            <td><input name="distrito" id="distrito" size="8" value="<?php echo $distrito;?>"></td>
                        </tr>
                        <tr>
                            <td class="table-success">*Direcci&oacute;n:</td>  
                            <td colspan="5"><input name="direccion_exacta" id="direccion_exacta" size="60" value="<?php echo $direccion_exacta;?>"></td>
                        </tr>
                        <tr>
                            <td class="table-secondary" colspan="6"></td> 
                        </tr>
                        <tr>
                            <td class="table-info">Info. Medica:</td>  
                            <td colspan="2"><input name="informacion_medica" id="informacion_medica" size="16" value="<?php echo $informacion_medica;?>"></td>
                            <td class="table-info">Antec. Medicos:</td>  
                            <td colspan="2"><input name="antecedentes_medicos" id="antecedentes_medicos" size="16" value="<?php echo $antecedentes_medicos;?>"></td>
                        </tr>
                        <tr>
                            <td class="table-info">Observaciones:</td>  
                            <td colspan="5"><input name="observaciones" id="observaciones" size="60" value="<?php echo $observaciones;?>"></td>
                        </tr>
                        <tr>
                            <td class="table-secondary" colspan="6"></td> 
                        </tr>
                        <tr>
                            <td class="table-warning">Veh&iacute;culo:</td>  
                            <td><input name="vehiculo" id="vehiculo" size="1" value="<?php echo $vehiculo;?>"></td>
                            <td class="table-warning">Flotilla:</td>  
                            <td><input name="flotilla" id="flotilla" size="1" value="<?php echo $flotilla;?>"></td>
                            <td class="table-warning">Placas:</td>  
                            <td><input name="placas" id="placas" size="8" value="<?php echo $placas;?>"></td>
                        </tr>
                        <tr>
                            <td class="table-warning">&Aacute;rea Protegida:</td>  
                            <td colspan=""><input name="area_protegida" id="area_protegida" size="1" value="<?php echo $area_protegida;?>"></td>
                            <td class="table-warning">Hogar Protegido:</td>  
                            <td colspan=""><input name="hogar_protegido" id="hogar_protegido" size="1" value="<?php echo $hogar_protegido;?>"></td>
                            <td class="table-warning">Fecha Afiliaci&oacute;n:</td>  
                            <td colspan=""><input name="fecha_afiliacion" id="fecha_afiliacion" size="8" value="<?php echo $fecha_afiliacion;?>"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><input type="submit" name="Submit" value="Actualizar"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="table-primary"><h3><a href="editar_beneficiarios_1.php?superdato=<?php echo $credencial;?>&superdato2=<?php echo $numero_contrato;?>">Editar Beneficiarios</a></h3></td> 
                            <td colspan="3" class="table-primary"><h3><a href="editar_cobro_1.php?superdato=<?php echo $credencial;?>">Editar Datos Cobro</a></h3></td> 
                        </tr>
                        <tr>
                            <td colspan="3" style="background-color: red"><a href="eliminar_credencial_1.php?superdato=<?php echo $credencial;?>" style="font-weight: bold; color: black">Eliminar Credencial</a></td> 
                        </tr>
                        <tr>
                            <td colspan="6"><a href="consulta_edicion_credencial.php">Volver</a></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <?php include_once('includes/footer.php');?>

	</div>
</body>
</html>