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

        <script>

        function showCanton(str) {
            if (str == "") {
                document.getElementById("txtCanton").innerHTML = "";
                document.getElementById("txtDistrito").innerHTML = "";
                return;
            } else {

            // Jala Canton
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtCanton").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET","scripts/getCanton.php?q="+str,true);
                xmlhttp.send();

            // Jala Distrito
                var xmlhttp2 = new XMLHttpRequest();
                xmlhttp2.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtDistrito").innerHTML = this.responseText;
                    }
                };
                xmlhttp2.open("GET","scripts/getDistrito.php?q="+str,true);
                xmlhttp2.send();
            }
        }

        </script>

	</head>
<body>
	<div class = "container mi_cont">
		
        <?php include_once('includes/header.php');?>
	    <?php include_once('includes/main_menu.php');?>

    	<div class = "row justify-content-center mi_row">
			<div class = "col-8 mi_col">
				<!-- (row_!Centro!) -->
                <form name="" method="post" action="scripts/nuevo_afiliado_C2_VL.php"> 
                    <table class="table table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th colspan="4">Nueva afiliaci&oacute;n:</th>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <span class="lead text-info">
                                    Ingrese los datos del afiliado tipo de c&eacute;dula Jur&iacute;dica.
                                    </span>
                                </td>
                            </tr>
                        </thead>
                        <tr>
                            <td colspan="4">
                                <span class="text-danger">
                                    <?php echo $_SESSION['AFILIACION_ERROR'];?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>*Credencial:</td>
                            <td> 
                            <input name="credencialA" type="text" id="credencialA" value="<?php echo $_SESSION['AFILIACION_TEMP_1A']; ?>" size="1" maxlength="10">-
                            <input name="credencialB" type="text" id="credencialB" value="<?php echo $_SESSION['AFILIACION_TEMP_1B']; ?>" size="1" maxlength="10">
                            </td>
                            <td>*N&uacute;mero de contrato:</td>
                            <td>
                                <input name="numero_contrato" id="numero_contrato" value="<?php echo $_SESSION['AFILIACION_TEMP_2']; ?>" size="" maxlength="12"></input>
                            </td>
                        </tr>
                        <tr>
                            <td>*Raz&oacute;n Social:</td>
                            <td> 
                                <input name="nombre_razon_social" type="text" id="nombre_razon_social" value="<?php echo $_SESSION['AFILIACION_TEMP_3']; ?>" size="" maxlength="100">
                            </td>
                            <td>*C&eacute;dula Jur&iacute;dica:</td>
                            <td>
                                <input name="cedulaA" id="cedulaA" value="<?php echo $_SESSION['AFILIACION_TEMP_4A']; ?>" size="1" maxlength="1"></input>
                                <input name="cedulaB" id="cedulaB" value="<?php echo $_SESSION['AFILIACION_TEMP_4B']; ?>" size="1" maxlength="3"></input>
                                <input name="cedulaC" id="cedulaC" value="<?php echo $_SESSION['AFILIACION_TEMP_4C']; ?>" size="5" maxlength="6"></input>
                            </td>
                        </tr>
                        <tr>
                        <tr>
                            <td colspan="1">*Actividad Comercial:</td>
                            <td colspan="3">
                                <input name="actividad_comercial" id="actividad_comercial" value="<?php echo $_SESSION['AFILIACION_TEMP_5']; ?>" size="65" maxlength="65"></input>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="1">*Tipo de Negocio:</td>
                            <td colspan="3">
                                <select id="tipo_negocio" name="tipo_negocio">
                                    <option value="comercio">Comercio</option>
                                    <option value="centro educativo">Centro Educativo</option>
                                    <option value="zona franca">Zona Franca</option>
                                    <option value="estatal">Estatal</option>
                                    <option value="centro adulto mayor">Centro Adulto Mayor</option>
                                    <option value="otro">Otro</option>
                                </select>  
                            </td>
                        </tr>
                            <td>*Tel&eacute;fono M&oacute;vil:</td>
                            <td>
                                <input name="telefono_movil" id="telefono_movil" value="<?php echo $_SESSION['AFILIACION_TEMP_6']; ?>" size="" maxlength="40"></input>
                            </td>
                            <td>*Tel&eacute;fono Fijo:</td>
                            <td>
                                <input name="telefono_fijo" id="telefono_fijo" value="<?php echo $_SESSION['AFILIACION_TEMP_7']; ?>" size="" maxlength="40"></input>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="1">*Email:</td>
                            <td colspan="3">
                                <input name="email" id="email" value="<?php echo $_SESSION['AFILIACION_TEMP_8']; ?>" size="65" maxlength="230"></input>
                            </td>
                        </tr>
                        <tr>
                            <td>*Provincia:</td>
                            <td>
                                <select name="provincia" id="provincia" onchange="showCanton(this.value)">
                                    <option value="">Seleccione provincia:</option>
                                    <option value="1">San Jos&eacute;</option>
                                    <option value="2">Alajuela</option>
                                    <option value="3">Cartago</option>
                                    <option value="4">Heredia</option>
                                    <option value="5">Guanacaste</option>
                                    <option value="6">Puntarenas</option>
                                    <option value="7">Lim&oacute;n</option>
                                </select>
                            </td>
                            <td>
                                *Cant&oacute;n
                            </td>
                            <td>
                                <div id="txtCanton">Cant&oacute;n...</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                *Distrito
                            </td>
                            <td>
                                <div id="txtDistrito">Distrito...</div>
                            </td>
                            <td></td><td></td>
                        </tr>
                        <tr>
                            <td colspan="1">*Direcci&oacute;n exacta:</td>
                            <td colspan="3">
                                <input name="direccion_exacta" id="direccion_exacta" value="<?php echo $_SESSION['AFILIACION_TEMP_10']; ?>" size="65" maxlength="200"></input>
                            </td>
                        </tr>
                        </tr>
                            <td>Vehiculo:</td>
                            <td>
                                <input  type="radio" value="SI" name="vehiculo" id="vehiculo"/> S&iacute;<br>
                                <input  type="radio" value="NO" name="vehiculo" id="vehiculo" checked="checked"/> No
                            </td>
                            <td>Flotilla:</td>
                            <td>
                                <input  type="radio" value="SI" name="flotilla" id="flotilla"/> S&iacute;<br>
                                <input  type="radio" value="NO" name="flotilla" id="flotilla" checked="checked"/> No
                            </td>
                        </tr>
                        <tr>
                            <td colspan="1">Placas:</td>
                            <td colspan="3">
                                <input name="placas" id="placas" value="<?php echo $_SESSION['AFILIACION_TEMP_11']; ?>" size="65" maxlength="40"></input>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="1">&Aacute;rea Protegida:</td>
                            <td colspan="1">
                                <input type="radio" id="si" name="area_protegida" value="SI">
                                <label for="SI">S&iacute;</label><br>
                                <input type="radio" id="no" name="area_protegida" value="NO" checked>
                                <label for="NO">No</label><br>
                            </td>
                            <td colspan="1">Hogar protegido:</td>
                            <td colspan="1">
                                 <input type="radio" id="SI" name="hogar_protegido" value="SI">
                                <label for="SI">S&iacute;</label><br>
                                <input type="radio" id="NO" name="hogar_protegido" value="NO" checked>
                                <label for="NO">No</label><br>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="1">Observaciones importantes:</td>
                            <td colspan="3">
                                <textarea id="observaciones" name="observaciones" rows="4" cols="63"><?php echo $_SESSION['AFILIACION_TEMP_13']; ?></textarea>
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