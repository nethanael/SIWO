<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();

    if ($_SESSION['LOGIN_TRASMEDIC'] == FALSE) {header("Location: index.php");}
    if ($_SESSION['ROL'] != 'vendedor_supervisor' ){header("Location: index.php");}

    $codigo_sistema = $_GET['superdato'];
    
    include 'includes/connection.php';                                           // Conexion a BD
	$query = "SELECT * FROM beneficiarios_credencial WHERE codigo_sistema LIKE '$codigo_sistema'"; // Consulta del campo necesario
	$resul = mysqli_query($conn, $query, MYSQLI_USE_RESULT);                     //  Hacemos consulta a la BD
    $datos = mysqli_fetch_assoc($resul);
    
    $credencial = $datos["credencial"];
    $numero_contrato = $datos["numero_contrato"];
    $cedula = $datos["cedula"];
    $nombre = $datos["nombre"];
    $provincia = $datos["provincia"];
    $canton = $datos["canton"];
    $distrito = $datos["distrito"];
    $direccion_exacta = $datos["direccion_exacta"];
    $telefono_fijo = $datos["telefono_fijo"];
    $telefono_movil = $datos["telefono_movil"];
    $antecedentes_medicos = $datos["antecedentes_medicos"];
    $fecha_nacimiento = $datos["fecha_nacimiento"];
    $genero = $datos["genero"];
    $observaciones = $datos["observaciones"];

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
                <form name="" method="post" action="scripts/editar_beneficiario.php"> 
                    <table class="table table-sm table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th colspan="6">Detalles del beneficiario a editar:</th>
                            </tr>
                        </thead>
                        <tr>
                            <td class="table-primary">*C&oacute;digo Beneficiario:</td>  
                            <td><input name="codigo_sistema" id="codigo_sistema" size="1" value="<?php echo $codigo_sistema;?>"readonly></td>
                            <td class="table-primary">*Credencial:</td>  
                            <td><input name="credencial" id="credencial" size="8" value="<?php echo $credencial;?>"readonly></td>
                            <td class="table-primary">*Contrato:</td>  
                            <td><input name="numero_contrato" id="numero_contrato" size="8" value="<?php echo $numero_contrato;?>"readonly></td>
                        </tr>
                        <tr>
                            <td class="table-primary">*C&eacute;dula:</td>  
                            <td><input name="cedula" id="cedula" size="8" value="<?php echo $cedula;?>"></td>
                            <td class="table-primary">*Nombre:</td>  
                            <td><input name="nombre" id="nombre" size="15" value="<?php echo $nombre;?>"></td>
                            <td class="table-primary">*G&eacute;nero:</td>  
                            <td><input name="genero" id="genero" size="8" value="<?php echo $genero;?>"></td>
                        </tr>
                        <tr>
                            <td class="table-primary">*Tel&eacute;fono M&oacute;vil:</td>  
                            <td><input name="telefono_movil" id="telefono_movil" size="8" value="<?php echo $telefono_movil;?>"></td>
                            <td class="table-primary">*Tel&eacute;fono Fijo:</td>  
                            <td><input name="telefono_fijo" id="telefono_fijo" size="8" value="<?php echo $telefono_fijo;?>"></td>
                            <td class="table-primary">*Fecha Nacimiento:</td>  
                            <td><input name="fecha_nacimiento" id="fecha_nacimiento" size="8" value="<?php echo $fecha_nacimiento;?>"></td>
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
                            <td class="table-info">Antec. Medicos:</td>  
                            <td colspan="5"><input name="antecedentes_medicos" id="antecedentes_medicos" size="60" value="<?php echo $antecedentes_medicos;?>"></td>
                        </tr>
                        <tr>
                            <td class="table-info">Observaciones:</td>  
                            <td colspan="5"><input name="observaciones" id="observaciones" size="60" value="<?php echo $observaciones;?>"></td>
                        </tr>
                        <tr>
                            <td class="table-secondary" colspan="6"></td> 
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><input type="submit" name="Submit" value="Actualizar"></td>
                            <td class="alert alert-danger"><a href="scripts/eliminar_beneficiario.php?superdato=<?php echo $codigo_sistema;?>">Eliminar Beneficiario</a></td>
                        </tr>
                        <tr>
                            <td colspan="6"><a href="editar_beneficiarios_1.php?superdato=<?php echo $credencial;?>&superdato2=<?php echo $numero_contrato;?>">Volver</a></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <?php include_once('includes/footer.php');?>

	</div>
</body>
</html>