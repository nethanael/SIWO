<?php

    $ts = gmdate("D, d M Y H:i:s") . " GMT";
    header("Expires: $ts");
    header("Last-Modified: $ts");
    header("Pragma: no-cache");
    header("Cache-Control: no-cache, must-revalidate");

    session_start();

    if ($_SESSION['LOGIN_TRASMEDIC'] == FALSE) {header("Location: index.php");}
    if ($_SESSION['ROL'] != 'vendedor' ){header("Location: index.php");}

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
			<div class = "col-8 mi_col table-responsive">
				<!-- (row_!Centro!) -->
                <form name="" method="post" action="scripts/nuevo_cobro_info_VL.php"> 
                    <table class="table table-sm table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th colspan="4">Informaci&oacute;n para cobro:</th>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <span class="lead text-info">
                                    Ingrese los datos relacionados al cobro de la crendecial <?php echo $_SESSION['CREDENCIAL'];?> adendum del contrato <?php echo $_SESSION['NUMERO_CONTRATO'];?>.
                                    </span>
                                </td>
                            </tr>
                        </thead>
                        <tr>
                            <td colspan="4">
                                <span class="text-danger">
                                    <?php echo $_SESSION['COBRO_ERROR'];?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>*Credencial:</td>
                            <td> 
                                <input name="credencial" type="text" id="credencial" value="<?php echo $_SESSION['CREDENCIAL']; ?>" size="" maxlength="100" readonly>
                            </td>
                            <td>*N&uacute;mero de contrato:</td>
                            <td>
                                <input name="numero_contrato" id="numero_contrato" value="<?php echo $_SESSION['NUMERO_CONTRATO']; ?>" size="" maxlength="12" readonly></input>
                            </td>
                        </tr>
                        <tr class="alert alert-warning">
                            <td>*Responsable:</td>
                            <td> 
                                <input name="responsable" type="text" id="responsable" value="<?php echo $_SESSION['COBRO_TEMP_1']; ?>" size="" maxlength="100">
                            </td>
                            <td>*Rol:</td>
                            <td>
                                <input name="rol" id="rol" value="<?php echo $_SESSION['COBRO_TEMP_11']; ?>" size="" maxlength="20"></input>
                            </td>
                        </tr>
                        <tr class="alert alert-warning">
                            <td>Responsable2:</td>
                            <td> 
                                <input name="responsable_2" type="text" id="responsable_2" value="<?php echo $_SESSION['COBRO_TEMP_A']; ?>" size="" maxlength="100">
                            </td>
                            <td>Rol:</td>
                            <td>
                                <input name="rol_2" id="rol_2" value="<?php echo $_SESSION['COBRO_TEMP_AA']; ?>" size="" maxlength="20"></input>
                            </td>
                        </tr >
                        <tr class="alert alert-danger">
                            <td>*Monto de Venta (IVA):</td>
                            <td>
                                <input name="monto" id="monto" value="<?php echo $_SESSION['COBRO_TEMP_2']; ?>" size="" maxlength="20"></input>
                            </td>
                            <td><!-- Monto de Venta (Sin IVA): --></td>
                            <td>
                                <!-- <input name="monto_SI" id="monto_SI" value="<?php echo $_SESSION['COBRO_TEMP_21']; ?>" size="" maxlength="20"></input> -->
                            </td>
                        </tr>
                        <tr class="alert alert-danger">
                            <td>*Periodicidad:</td>
                            <td>
                                <select id="periodicidad" name="periodicidad">
                                    <option value="Mensual">Mensual</option>
                                    <option value="Semestral">Semestral</option>
                                    <option value="Anual">Anual</option>
                                </select>
                            </td>
                            <td>*Fecha de Pago:</td>
                            <td>
                                <input name="fecha_pago" id="fecha_pago" value="<?php echo $_SESSION['COBRO_TEMP_3']; ?>" size="" maxlength="50"></input>
                            </td>
                        </tr>
                        <tr class="alert alert-danger">
                            <td>*Forma de Pago:</td>
                            <td colspan="3">
                                <select id="forma_pago" name="forma_pago">
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Cobrador">Cobrador</option>
                                    <option value="Transferencia">Transferencia</option>
                                    <option value="Descargo_Automatico">Descargo Autom&aacute;tico</option>
                                    <option value="Otros">Otros</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="alert alert-success">
                            <td>Nombre Banco:</td>
                            <td colspan="3">
                                <input name="nombre_banco_1" id="nombre_banco_1" value="<?php echo $_SESSION['COBRO_TEMP_NOMBRE_BANCO_1']; ?>" size="" maxlength="100"></input>
                           </td>
                        </tr>
                        <tr class="alert alert-success">
                            <td>Cuenta Colones:</td>
                            <td>
                                <input name="corriente_colones_1" id="corriente_colones_1" value="<?php echo $_SESSION['COBRO_TEMP_40']; ?>" size="" maxlength="100"></input>
                            </td>
                            <td>IBAN Colones:</td>
                            <td>
                                <input name="iban_colones_1" id="iban_colones_1" value="<?php echo $_SESSION['COBRO_TEMP_41']; ?>" size="" maxlength="100"></input>
                            </td>
                        </tr>
                        <tr class="alert alert-success">
                            <td>Cuenta Dolares:</td>
                            <td>
                                <input name="corriente_dolares_1" id="corriente_dolares_1" value="<?php echo $_SESSION['COBRO_TEMP_42']; ?>" size="" maxlength="100"></input>
                            </td>
                            <td>IBAN Dolares:</td>
                            <td>
                                <input name="iban_dolares_1" id="iban_dolares_1" value="<?php echo $_SESSION['COBRO_TEMP_43']; ?>" size="" maxlength="100"></input>
                            </td>
                        </tr>
                        <tr class="alert alert-info">
                            <td>Marca de Tarjeta:</td>
                            <td>
                                <input type="radio" name="marca_tarjeta" value="VISA">
                                <label for="huey">VISA</label><br>
                                <input type="radio" name="marca_tarjeta" value="MASTERCARD">
                                <label for="dewey">MASTERCARD</label><br>
                            </td>
                            <td>
                                <input type="radio" name="marca_tarjeta" value="AMERICAN_EXPRESS">
                                <label for="louie">AMERICAN</label><br>
                                <input type="radio" name="marca_tarjeta" value="ST">
                                <label for="louie">ST</label><br>
                            </td>
                            <td>
                                <input type="radio" name="marca_tarjeta" value="DINNERS_CLUB">
                                <label for="louie">DINNERS CLUB</label><br>
                                <input type="radio" name="marca_tarjeta" value="BANCO_POPULAR">
                                <label for="louie">BANCO POPULAR</label><br>
                            </td>
                        </tr>
                        <tr class="alert alert-info">
                            <td>N&uacute;mero de Tarjeta:</td>
                            <td colspan="3">
                                <input name="numero_tarjeta_1" id="numero_tarjeta_1" value="<?php echo $_SESSION['COBRO_TEMP_44A']; ?>" size="1" maxlength="4"></input> -
                                <input name="numero_tarjeta_2" id="numero_tarjeta_2" value="<?php echo $_SESSION['COBRO_TEMP_44B']; ?>" size="1" maxlength="4"></input> -
                                <input name="numero_tarjeta_3" id="numero_tarjeta_3" value="<?php echo $_SESSION['COBRO_TEMP_44C']; ?>" size="1" maxlength="4"></input> -
                                <input name="numero_tarjeta_4" id="numero_tarjeta_4" value="<?php echo $_SESSION['COBRO_TEMP_44D']; ?>" size="1" maxlength="4"></input>
                            </td>
                        </tr>
                        <tr class="alert alert-info">
                        <td>Tarjeta Habiente:</td>
                            <td colspan="3">
                                <input name="tarjeta_habiente" id="tarjeta_habiente" value="<?php echo $_SESSION['COBRO_TEMP_45']; ?>" size="50" maxlength="100"></input>
                            </td>
                        </tr>
                        <tr class="alert alert-info">
                            <td>Emisor:</td>
                            <td>
                                <input name="emisor" id="emisor" value="<?php echo $_SESSION['COBRO_TEMP_46']; ?>" size="" maxlength="100"></input>
                            </td>
                            <td>Vencimiento:</td>
                            <td>
                                <input name="vencimiento_1" id="vencimiento_1" value="<?php echo $_SESSION['COBRO_TEMP_47A']; ?>" size="1" maxlength="2"></input> /
                                <input name="vencimiento_2" id="vencimiento_2" value="<?php echo $_SESSION['COBRO_TEMP_47B']; ?>" size="1" maxlength="2"></input>
                            </td>
                        </tr>
                        <tr class="alert alert-warning">
                            <td colspan="1">*Dirección de Cobro:</td>
                            <td colspan="3">
                                <input name="direccion_cobro" id="direccion_cobro" value="<?php echo $_SESSION['MIDIRECCION']; ?>" size="65" maxlength="200"></input>
                            </td>
                        </tr>
                        <tr class="alert alert-warning">
                            <td colspan="1">Importante 1:</td>
                            <td colspan="3">
                                <textarea id="importante_1" name="importante_1" rows="4" cols="63"><?php echo $_SESSION['COBRO_TEMP_6']; ?></textarea>
                            </td>
                        </tr>
                        <tr class="alert alert-warning">
                            <td colspan="1">Importante 2:</td>
                            <td colspan="3">
                                <textarea id="importante_2" name="importante_2" rows="4" cols="63"><?php echo $_SESSION['COBRO_TEMP_7']; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                                <td colspan="4"><p class="text-center"><input type="submit" name="Submit" value="Continuar"></p></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <?php include_once('includes/footer.php');?>

	</div>
</body>
</html>