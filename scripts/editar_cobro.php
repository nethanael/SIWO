<?php
    session_start();

    if ($_SESSION['LOGIN_TRASMEDIC'] == FALSE) {header("Location: ../index.php");}
	if ($_SESSION['ROL'] != 'vendedor_supervisor' ){header("Location: ../index.php");}

    $codigo_sistema = $_POST['codigo_sistema'];
    $credencial = $_POST['credencial'];
    $numero_contrato = $_POST['numero_contrato'];

    $responsable = $_POST["responsable"];
    $rol = $_POST["rol"];
    $responsable_2 = $_POST["responsable_2"];
    $rol_2 = $_POST["rol_2"];
    $monto = $_POST["monto"];
    //$monto_SI = $_POST["monto_SI"];
    $periodicidad = $_POST["periodicidad"];
    $direccion_cobro = $_POST["direccion_cobro"];
    $fecha_pago = $_POST["fecha_pago"];
    $forma_pago = $_POST["forma_pago"];

    $nombre_banco_1 = $_POST["nombre_banco_1"];
    $corriente_colones_1 = $_POST["corriente_colones_1"];
    $iban_colones_1 = $_POST["iban_colones_1"];
    $corriente_dolares_1 = $_POST["corriente_dolares_1"];
    $iban_dolares_1 = $_POST["iban_dolares_1"];

    $marca_tarjeta = $_POST["marca_tarjeta"];
    $numero_tarjeta = $_POST["numero_tarjeta"];
    $tarjeta_habiente = $_POST["tarjeta_habiente"];
    $emisor = $_POST["emisor"];
    $vencimiento = $_POST["vencimiento"];

    $vendedor = $_POST["vendedor"];
    $activo = $_POST["activo"];
    $fecha_activacion = $_POST["fecha_activacion"];
    $importante_1 = $_POST["importante_1"];
    $importante_2 = $_POST["importante_2"];

    if ($responsable == '' || $rol == '' || $monto == '' || $periodicidad == '' || $fecha_activacion == '' || $activo == '') 
	{
        $myheader = "Location: ../editar_cobro_1.php?superdato=" . $credencial;
        //echo $myheader;
		header($myheader);
	}
	else
	{		

        include '../includes/connection.php';

        $monto_SI = $monto - ($monto * 0.04);

        $query = "UPDATE cobro_credencial set responsable = '$responsable', rol = '$rol', responsable_2 = '$responsable_2', 
        rol_2 = '$rol_2', monto = '$monto', monto_SI = '$monto_SI', periodicidad = '$periodicidad', direccion_cobro = '$direccion_cobro', 
        fecha_pago = '$fecha_pago', forma_pago = '$forma_pago', corriente_colones_1 = '$corriente_colones_1', 
        iban_colones_1 = '$iban_colones_1', corriente_dolares_1 = '$corriente_dolares_1', iban_dolares_1 = '$iban_dolares_1', 
        nombre_banco_1 = '$nombre_banco_1', marca_tarjeta = '$marca_tarjeta', numero_tarjeta = '$numero_tarjeta', 
        tarjeta_habiente = '$tarjeta_habiente', emisor = '$emisor', vencimiento = '$vencimiento', 
        vendedor = '$vendedor', activo = '$activo', fecha_activacion = '$fecha_activacion', importante_1 = '$importante_1', 
        importante_2 = '$importante_2' WHERE credencial LIKE '$credencial'";

        //echo $query;
        $resul = mysqli_query($conn, $query);
		
		include '../includes/connection.php';                                           // Conexion a BD
		$query2 = "SELECT * FROM cobro_credencial WHERE codigo_sistema LIKE '$codigo_sistema'"; // Consulta del campo necesario
		$resul = mysqli_query($conn, $query2, MYSQLI_USE_RESULT);                     //  Hacemos consulta a la BD
		$datos = mysqli_fetch_assoc($resul);
		
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

        $nombre_banco_1 = $datos["nombre_banco_1"];
        $corriente_colones_1 = $datos["corriente_colones_1"];
        $iban_colones_1 = $datos["iban_colones_1"];
        $corriente_dolares_1 = $datos["corriente_dolares_1"];
        $iban_dolares_1 = $datos["iban_dolares_1"];
    
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
				<div class = "col-12 mi_col table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th colspan="6">Resumen de datos en la base de datos:</th>
                            </tr>
                        </thead>
                        <tr>
                            <td class="table-primary">*Codigo Sistema:</td>  
                            <td><?php echo $codigo_sistema;?></td>
                            <td class="table-primary">*Credencial:</td>  
                            <td><?php echo $credencial;?></td>
                            <td class="table-primary">*Contrato:</td>  
                            <td><?php echo $numero_contrato;?></td>
                        </tr>
                        <tr>
                            <td class="table-primary">*Responsable:</td>  
                            <td colspan="3"><?php echo $responsable;?></td>
                            <td class="table-primary">*Rol:</td>  
                            <td><?php echo $rol;?></td>
                        </tr>
                        <tr>
                            <td class="table-primary">Responsable 2:</td>  
                            <td colspan="3"><?php echo $responsable_2;?></td>
                            <td class="table-primary">Rol:</td>  
                            <td><?php echo $rol_2;?></td>
                        </tr>
                        <tr>
                            <td class="table-secondary" colspan="6"></td> 
                        </tr>
                        <tr>
                            <td class="table-success">*Monto con IVA:</td>  
                            <td><?php echo $monto;?></td>
                            <td class="table-success">*Monto Sin IVA:</td>  
                            <td><?php echo $monto_SI;?></td>
                            <td class="table-success">*fecha de pago:</td>  
                            <td><?php echo $fecha_pago;?></td>
                        </tr>
                        <tr>
                            <td class="table-success">*Forma de Pago:</td>  
                            <td><?php echo $forma_pago;?></td>
                            <td class="table-success">*Periodicidad:</td>  
                            <td><?php echo $periodicidad;?></td>
                        </tr>
                        <tr>
                            <td class="table-success">Banco:</td>  
                            <td><?php echo $nombre_banco_1;?></td>
                            <td class="table-success">Cuenta Colones:</td>  
                            <td><?php echo $corriente_colones_1;?></td>
                            <td class="table-success">IBAN Colones:</td>  
                            <td><?php echo $iban_colones_1;?></td>                        
                        </tr>
                        <tr>
                            <td class="table-success"></td>  
                            <td></td>
                            <td class="table-success">Cuenta Dolares:</td>  
                            <td><?php echo $corriente_dolares_1;?></td>
                            <td class="table-success">IBAN Dolares:</td>  
                            <td><?php echo $iban_dolares_1;?></td>                        
                        </tr>
                        <tr>
                            <td class="table-warning">Marca Tarjeta:</td>  
                            <td><?php echo $marca_tarjeta;?></td>
                            <td class="table-warning">N&uacute;mero Tarjeta:</td>  
                            <td><?php echo $numero_tarjeta;?></td>
                            <td class="table-warning">Tarjetahabiente:</td>  
                            <td><?php echo $tarjeta_habiente;?></td>                        
                        </tr>
                        <tr>
                            <td class="table-warning"></td>  
                            <td></td>
                            <td class="table-warning">Emisor:</td>  
                            <td><?php echo $emisor;?></td>
                            <td class="table-warning">vencimiento:</td>  
                            <td><?php echo $vencimiento;?></td>                        
                        </tr>
                        <tr>
                            <td class="table-success">*Direcci&oacute;n Cobro:</td>  
                            <td colspan="5"><?php echo $direccion_cobro;?></td>
                        </tr>
                        <tr>
                            <td class="table-secondary" colspan="6"></td> 
                        </tr>
                        <tr>
                            <td class="table-info">*Estado:</td>  
                            <td><?php echo $activo;?></td>
                            <td class="table-info">*fecha de Activaci&oacute;n:</td>  
                            <td><?php echo $fecha_activacion;?></td>
                            <td class="table-info">*Vendedor:</td>  
                            <td><?php echo $vendedor;?></td>
                        </tr>
                        <tr>
                            <td class="table-info">Notas Importantes:</td>  
                            <td colspan="5"><?php echo $importante_1;?></td>
                        </tr>
                        <tr>
                            <td class="table-info">Notas Importantes:</td>  
                            <td colspan="5"><?php echo $importante_2;?></td>
                        </tr>
                        <tr>
                            <td class="table-secondary" colspan="6"></td> 
                        </tr>
                        <tr>
                            <td colspan="6"><a href="../editar_credencial_2.php?superdato=<?php echo $credencial;?>">Volver</a></td>
                        </tr>
                    </table>
                </div>
			</div>
    	</div>

        <?php include_once('../includes/footer.php');?>

	</div>

	<?php 
        }  
        ?>
</body>
</html>