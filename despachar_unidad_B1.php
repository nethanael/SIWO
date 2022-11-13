<?php

    $ts = gmdate("D, d M Y H:i:s") . " GMT";
    header("Expires: $ts");
    header("Last-Modified: $ts");
    header("Pragma: no-cache");
    header("Cache-Control: no-cache, must-revalidate");

    session_start();

    if ($_SESSION['LOGIN_TRASMEDIC'] == FALSE) {header("Location: index.php");}
    if ($_SESSION['ROL'] != 'despachador' ){header("Location: index.php");}

    $fecha = date("Y-m-d");
    $ahora = date("Y-m-d H:i");
    
/* ------------------funcion de revisión de estado de unidades ----------------------------*/

include_once('includes/revisionUnidad.php');

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
                <form name="" method="post" action="scripts/despachar_unidad_C1.php"> 
                    <table class="table table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th colspan="4">Nueva despacho:</th>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <span class="lead text-info">
                                    Ingrese los datos de este despacho de unidad.
                                    </span>
                                </td>
                            </tr>
                        </thead>
                        <tr>
                            <td colspan="4">
                                <span class="text-danger">
                                    <?php echo $_SESSION['DESPACHO_ERROR'];?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>*Credencial:</td>
                            <td> 
                                TM-<input name="credencialA" type="text" id="credencialA" value="<?php echo $_SESSION['DESPACHO_TEMP_A1']; ?>" size="1" maxlength="10"> -
                                <input name="credencialB" type="text" id="credencialB" value="<?php echo $_SESSION['DESPACHO_TEMP_A2']; ?>" size="1" maxlength="10">
                            </td>
                            <td>*Fecha:</td>
                            <td>
                                <input name="fecha_despacho" id="fecha_despacho" value="<?php echo $fecha; ?>" size="8" maxlength="40" readonly></input>
                            </td>
                        </tr>
                        <tr>
                            <td>*Nombre interesado:</td>
                            <td> 
                                <input name="nombre_interesado" type="text" id="nombre_interesado" value="<?php echo $_SESSION['DESPACHO_TEMP_B']; ?>" size="" maxlength="100">
                            </td>
                            <td>*Nombre paciente:</td>
                            <td> 
                                <input name="nombre_paciente" type="text" id="nombre_paciente" value="<?php echo $_SESSION['DESPACHO_TEMP_C']; ?>" size="" maxlength="100">
                            </td>
                        </tr>
                        <tr>
                            <td>*Tipo de Paciente:</td>
                            <td> 
                                <select name="tipo_paciente" id="tipo_paciente">
                                    <option value="privado">privado</option>
                                    <option value="CCSS">CCSS</option>
                                    <option value="INS">INS</option>
                                    <option value="ebais_biblica">EBAIS Biblica</option>
                                    <option value="otro">otro</option>
                                </select>
                            </td>
                            <td>*Unidad:</td>
                            <td> 
                                <select name="unidad" id="unidad">
                                    <option value="KAMUK">KAMUK</option>
                                    <option value="TARRAZU">TARRAZU</option>
                                    <option value="YURUSTI">YURUSTI</option>
                                    <option value="UPI">UPI</option>
                                    <option value="IZTARU">IZTARU</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">
                                <h6>
                                    <span class="badge badge-secondary">Tomar en cuenta que los rojos ya tienen trabajo asignado:</span>
                                </h6>
                            </td>
                        </tr>
                        <tr>
							<td><p class="text-center"><span class="badge badge-<?php revisionUnidad("KAMUK"); ?>">KAMUK</span></p></td>
							<td><p class="text-center"><span class="badge badge-<?php revisionUnidad("TARRAZU"); ?>">TARRAZU</span></p></td>
							<td><p class="text-center"><span class="badge badge-<?php revisionUnidad("YURUSTI"); ?>">YURUSTI</span></p></td>
                            <td><p class="text-center"><span class="badge badge-<?php revisionUnidad("UPI"); ?>">UPI</span></p></td>
                        </tr>
                        <tr>
                            <td><p class="text-center"><span class="badge badge-<?php revisionUnidad("IZTARU"); ?>">IZTARU</span></p></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="1">Diagn&oacute;stico:</td>
                            <td colspan="3">
                            <input name="diagnostico" id="diagnostico" value="<?php echo $_SESSION['DESPACHO_TEMP_D']; ?>" size="65" maxlength="200"></input>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="1">*Direcci&oacute;n:</td>
                            <td colspan="3">
                                <input name="direccion" id="direccion" value="<?php echo $_SESSION['DESPACHO_TEMP_E']; ?>" size="65" maxlength="230"></input>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="1">Destino:</td>
                            <td colspan="3">
                                <input name="destino" id="destino" value="<?php echo $_SESSION['DESPACHO_TEMP_F']; ?>" size="65" maxlength="230"></input>
                            </td>
                        </tr>
                        <tr>
                            <td>Monto:</td>
                            <td>
                                <input name="monto" id="monto" value="<?php echo $_SESSION['DESPACHO_TEMP_G']; ?>" size="" maxlength="40"></input>
                            </td>
                            <td># Factura:</td>
                            <td>
                                <input name="factura" id="factura" value="<?php echo $_SESSION['DESPACHO_TEMP_H']; ?>" size="" maxlength="40"></input>
                            </td>
                        </tr>
                        <tr>
                            <td>KM Salida:</td>
                            <td>
                                <input name="km_salida" id="km_salida" value="<?php echo $_SESSION['DESPACHO_TEMP_I']; ?>" size="" maxlength="40"></input>
                            </td>
                            <td>KM Entrada:</td>
                            <td>
                                <input name="km_entrada" id="km_entrada" value="<?php echo $_SESSION['DESPACHO_TEMP_J']; ?>" size="" maxlength="40"></input>
                            </td>
                        </tr>
                        <tr><td colspan="4">Tiempos:</td></tr>
                        <tr>
                            <td>*Ingreso de Llamada:</td>
                            <td>
                                <input name="tiempo_llamada" type="" id="tiempo_llamada" size="15" maxlength="100" value="<?php echo $ahora;?>" readonly>
                            </td>
                            <td>*Despacho Unidad:</td>
                            <td>
                                <input name="tiempo_despacho" type="time" id="tiempo_despacho" size="8" maxlength="100">
                            </td>
                        </tr>
                        <tr>
                            <td>Salida de Unidad:</td>
                            <td>
                                <input name="tiempo_salida_unidad" type="time" id="tiempo_salida_unidad" size="8" maxlength="100">
                            </td>
                            <td>Llegada a escena:</td>
                            <td>
                                <input name="tiempo_llegada_escena" type="time" id="tiempo_llegada_escena" size="8" maxlength="100">
                            </td>
                        </tr>
                        <tr>
                            <td>Salida de escena:</td>
                            <td>
                                <input name="tiempo_salida_escena" type="time" id="tiempo_salida_escena" size="8" maxlength="100">
                            </td>
                            <td>Llegada hospital:</td>
                            <td>
                                <input name="tiempo_hospital" type="time" id="tiempo_hospital" size="8" maxlength="100">
                            </td>
                        </tr>
                        <tr>
                            <td>Disponible:</td>
                            <td>
                                <input name="tiempo_disponible" type="time" id="tiempo_disponible" size="8" maxlength="100">
                            </td>
                            <td>*Prioridad:</td>
                            <td>
                                <select name="prioridad" id="prioridad">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="1">Observaciones:</td>
                            <td colspan="3">
                                <textarea id="observaciones" name="observaciones" rows="4" cols="68"><?php echo $_SESSION['DESPACHO_TEMP_K']; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                                <td colspan="4"><p class="text-center"><input type="submit" name="Submit" value="Continuar"></p></td>
                        </tr>
                        <tr>
                            <td colspan="4"><p class="text-center"><a href="index.php">Volver</a></p></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <?php include_once('includes/footer.php');?>

	</div>
</body>
</html>