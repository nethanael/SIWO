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
	$query = "SELECT * FROM cobro_credencial WHERE credencial LIKE '$credencial'"; // Consulta del campo necesario
	$resul = mysqli_query($conn, $query, MYSQLI_USE_RESULT);                     //  Hacemos consulta a la BD
    $datos = mysqli_fetch_assoc($resul);
    
    $codigo_sistema = $datos["codigo_sistema"];
    $credencial = $datos["credencial"];
    $numero_contrato = $datos["numero_contrato"];
    
    $responsable = $datos["responsable"];
    $rol = $datos["rol"];
    $responsable_2 = $datos["responsable_2"];
    $rol_2 = $datos["rol_2"];
    $monto = $datos["monto"];
    $monto_SI = $datos["monto_SI"];
    $periodicidad = $datos["periodicidad"];
    $direccion_cobro = $datos["direccion_cobro"];
    $fecha_pago = $datos["fecha_pago"];
    $forma_pago = $datos["forma_pago"];

    $corriente_colones_1 = $datos["corriente_colones_1"];
    $iban_colones_1 = $datos["iban_colones_1"];
    $corriente_dolares_1 = $datos["corriente_dolares_1"];
    $iban_dolares_1 = $datos["iban_dolares_1"];
    $nombre_banco_1 = $datos["nombre_banco_1"];

    $marca_tarjeta = $datos["marca_tarjeta"];
    $numero_tarjeta = $datos["numero_tarjeta"];
    $tarjeta_habiente = $datos["tarjeta_habiente"];
    $emisor = $datos["emisor"];
    $vencimiento = $datos["vencimiento"];

    $vendedor = $datos["vendedor"];
    $activo = $datos["activo"];
    $fecha_activacion = $datos["fecha_activacion"];
    $importante_1 = $datos["importante_1"];
    $importante_2 = $datos["importante_2"];

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
			<div class = "col-10 mi_col">
				<!-- (row_!Centro!) -->
                <form name="" method="post" action="scripts/editar_cobro.php"> 
                    <table class="table table-sm table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th colspan="6">Detalles de cobro a editar:</th>
                            </tr>
                        </thead>
                        <tr>
                            <td class="table-primary">*Codigo Sistema:</td>  
                            <td><input name="codigo_sistema" id="codigo_sistema" size="1" value="<?php echo $codigo_sistema;?>"readonly></td>
                            <td class="table-primary">*Credencial:</td>  
                            <td><input name="credencial" id="credencial" size="8" value="<?php echo $credencial;?>"readonly></td>
                            <td class="table-primary">*Contrato:</td>  
                            <td><input name="numero_contrato" id="numero_contrato" size="8" value="<?php echo $numero_contrato;?>"readonly></td>
                        </tr>
                        <tr>
                            <td class="table-primary">*Responsable:</td>  
                            <td colspan="3"><input name="responsable" id="responsable" size="30" value="<?php echo $responsable;?>"></td>
                            <td class="table-primary">*Rol:</td>  
                            <td><input name="rol" id="rol" size="15" value="<?php echo $rol;?>"></td>
                        </tr>
                        <tr>
                            <td class="table-primary">Responsable 2:</td>  
                            <td colspan="3"><input name="responsable_2" id="responsable_2" size="30" value="<?php echo $responsable_2;?>"></td>
                            <td class="table-primary">Rol:</td>  
                            <td><input name="rol_2" id="rol_2" size="15" value="<?php echo $rol_2;?>"></td>
                        </tr>
                        <tr>
                            <td class="table-secondary" colspan="6"></td> 
                        </tr>
                        <tr>
                            <td class="table-success">*Monto con IVA:</td>  
                            <td><input name="monto" id="monto" size="8" value="<?php echo $monto;?>"></td>
                            <td class="table-success">Monto sin IVA: (auto)</td>  
                            <td><span><?php echo $monto_SI;?></span></td>
                            <td class="table-success">*fecha de pago:</td>  
                            <td><input name="fecha_pago" id="fecha_pago" size="8" value="<?php echo $fecha_pago;?>"></td>
                        </tr>
                        <tr>
                            <td class="table-success">*Forma de Pago:</td>  
                            <td><input name="forma_pago" id="forma_pago" size="8" value="<?php echo $forma_pago;?>"></td>
                            <td class="table-success">*Periodicidad:</td>  
                            <td><input name="periodicidad" id="periodicidad" size="8" value="<?php echo $periodicidad;?>"></td>
                        </tr>
                        <tr>
                            <td class="table-success">Banco:</td>  
                            <td><input name="nombre_banco_1" id="nombre_banco_1" size="15" value="<?php echo $nombre_banco_1;?>"></td>
                            <td class="table-success">Cuenta Colones:</td>  
                            <td><input name="corriente_colones_1" id="corriente_colones_1" size="15" value="<?php echo $corriente_colones_1;?>"></td>
                            <td class="table-success">IBAN Colones:</td>  
                            <td><input name="iban_colones_1" id="iban_colones_1" size="15" value="<?php echo $iban_colones_1;?>"></td>                        
                        </tr>
                        <tr>
                            <td class="table-success"></td>  
                            <td></td>
                            <td class="table-success">Cuenta Dolares:</td>  
                            <td><input name="corriente_dolares_1" id="corriente_dolares_1" size="15" value="<?php echo $corriente_dolares_1;?>"></td>
                            <td class="table-success">IBAN Dolares:</td>  
                            <td><input name="iban_dolares_1" id="iban_dolares_1" size="15" value="<?php echo $iban_dolares_1;?>"></td>                        
                        </tr>
                        <tr>
                            <td class="table-warning">Marca Tarjeta:</td>  
                            <td><input name="marca_tarjeta" id="marca_tarjeta" size="15" value="<?php echo $marca_tarjeta;?>"></td>
                            <td class="table-warning">N&uacute;mero de Tarjeta:</td>  
                            <td><input name="numero_tarjeta" id="numero_tarjeta" size="15" value="<?php echo $numero_tarjeta;?>"></td>
                            <td class="table-warning">Tarjetahabiente:</td>  
                            <td><input name="tarjeta_habiente" id="tarjeta_habiente" size="15" value="<?php echo $tarjeta_habiente;?>"></td>                        
                        </tr>
                        <tr>
                            <td class="table-warning"></td>  
                            <td></td>
                            <td class="table-warning">Emisor:</td>  
                            <td><input name="emisor" id="emisor" size="15" value="<?php echo $emisor;?>"></td>
                            <td class="table-warning">Vencimiento:</td>  
                            <td><input name="vencimiento" id="vencimiento" size="15" value="<?php echo $vencimiento;?>"></td>                        
                        </tr>
                        <tr>
                            <td class="table-success">*Direcci&oacute;n Cobro:</td>  
                            <td colspan="5"><input name="direccion_cobro" id="direccion_cobro" size="60" value="<?php echo $direccion_cobro;?>"></td>
                        </tr>
                        <tr>
                            <td class="table-secondary" colspan="6"></td> 
                        </tr>
                        <tr>
                            <td class="table-info">*Estado: (ACTIVO, INACTIVO O PENDIENTE)</td>  
                            <td><input name="activo" id="activo" size="8" value="<?php echo $activo;?>"></td>
                            <td class="table-info">*fecha de Activaci&oacute;n:</td>  
                            <td><input name="fecha_activacion" id="fecha_activacion" size="8" value="<?php echo $fecha_activacion;?>"></td>
                            <td class="table-info">*Vendedor:</td>  
                            <td><input name="vendedor" id="vendedor" size="8" value="<?php echo $vendedor;?>"></td>
                        </tr>
                        <tr>
                            <td class="table-info">Notas Importantes:</td>  
                            <td colspan="5"><input name="importante_1" id="importante_2" size="60" value="<?php echo $importante_1;?>"></td>
                        </tr>
                        <tr>
                            <td class="table-info">Notas Importantes:</td>  
                            <td colspan="5"><input name="importante_2" id="importante_2" size="60" value="<?php echo $importante_2;?>"></td>
                        </tr>
                        <tr>
                            <td class="table-secondary" colspan="6"></td> 
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><input type="submit" name="Submit" value="Actualizar"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="6"><a href="editar_credencial_2.php?superdato=<?php echo $credencial;?>">Volver</a></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <?php include_once('includes/footer.php');?>

	</div>
</body>
</html>