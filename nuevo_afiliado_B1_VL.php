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
			<div class = "col-8 mi_col table-responsive">
				<!-- (row_!Centro!) -->
                <form name="" method="post" action="scripts/nuevo_afiliado_C1_VL.php"> 
                    <table class="table table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th colspan="4">Nueva afiliaci&oacute;n:</th>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <span class="lead text-info">
                                    Ingrese los datos del afiliado tipo de c&eacute;dula f&iacute;sica.
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
                            <td>*Nombre afiliado:</td>
                            <td> 
                                <input name="nombre_razon_social" type="text" id="nombre_razon_social" value="<?php echo $_SESSION['AFILIACION_TEMP_3']; ?>" size="" maxlength="100">
                            </td>
                            <td>*C&eacute;dula identidad:</td>
                            <td>
                                <input name="cedulaA" id="cedulaA" value="<?php echo $_SESSION['AFILIACION_TEMP_4A']; ?>" size="1" maxlength="1"></input>
                                <input name="cedulaB" id="cedulaB" value="<?php echo $_SESSION['AFILIACION_TEMP_4B']; ?>" size="1" maxlength="4"></input>
                                <input name="cedulaC" id="cedulaC" value="<?php echo $_SESSION['AFILIACION_TEMP_4C']; ?>" size="1" maxlength="4"></input>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Utilizar este campo para "Persona F&iacute;sica Residente":</td>
                            <td>C&eacute;dula residencia:</td>
                            <td>
                                <input name="cedulaR" id="cedulaR" value="<?php echo $_SESSION['AFILIACION_TEMP_4D']; ?>" size="20" maxlength="20"></input>
                            </td>
                        </tr>
                        <tr>
                            <td>*Tel&eacute;fono M&oacute;vil:</td>
                            <td>
                                <input name="telefono_movil" id="telefono_movil" value="<?php echo $_SESSION['AFILIACION_TEMP_5']; ?>" size="" maxlength="40"></input>
                            </td>
                            <td>*Tel&eacute;fono Fijo:</td>
                            <td>
                                <input name="telefono_fijo" id="telefono_fijo" value="<?php echo $_SESSION['AFILIACION_TEMP_6']; ?>" size="" maxlength="40"></input>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="1">*Email:</td>
                            <td colspan="3">
                                <input name="email" id="email" value="<?php echo $_SESSION['AFILIACION_TEMP_7']; ?>" size="65" maxlength="230"></input>
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
                            <input name="direccion_exacta" id="direccion_exacta" value="<?php echo $_SESSION['AFILIACION_TEMP_9']; ?>" size="65" maxlength="200"></input>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="1">Hogar protegido:</td>
                            <td colspan="1">
                                 <input type="radio" id="SI" name="hogar_protegido" value="SI">
                                <label for="SI">S&iacute;</label><br>
                                <input type="radio" id="NO" name="hogar_protegido" value="NO" checked>
                                <label for="NO">No</label><br>
                            </td>
                            <td colspan="1">Veh&iacute;culo:</td>
                            <td colspan="1">
                                 <input type="radio" id="SI" name="vehiculo" value="SI">
                                <label for="SI">S&iacute;</label><br>
                                <input type="radio" id="NO" name="vehiculo" value="NO" checked>
                                <label for="NO">No</label><br>
                            </td>
                        </tr>
                        <tr>
                        <td colspan="1">Placas:</td>
                            <td colspan="3">
                                <input name="placas" id="placas" value="<?php echo $_SESSION['AFILIACION_TEMP_11']; ?>" size="65" maxlength="40"></input>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">Antecedentes M&eacute;dicos:</td>
                            
                        </tr>
                        <tr>
                            <td>Respiratorios:</td>
                            <td>
                                <input type="checkbox" id="respiratorio_1" name="respiratorio_1" value="Asma">
                                <label for="respiratorio_1">Asma</label><br>
                                <input type="checkbox" id="respiratorio_2" name="respiratorio_2" value="EPOC">
                                <label for="respiratorio_2">EPOC</label><br>
                                <input type="checkbox" id="respiratorio_3" name="respiratorio_3" value="Enfisema">
                                <label for="respiratorio_3">Enfisema</label><br>
                            </td>
                            <td>Cardipatias:</td>
                            <td>
                                <input type="checkbox" id="cardipatias_1" name="cardipatias_1" value="HTA">
                                <label for="cardipatias_1">HTA</label><br>
                                <input type="checkbox" id="cardipatias_2" name="cardipatias_2" value="Isquemia">
                                <label for="cardipatias_2">Isquemia</label><br>
                                <input type="checkbox" id="cardipatias_3" name="cardipatias_3" value="IAM">
                                <label for="cardipatias_3">IAM</label><br>
                                <input type="checkbox" id="cardipatias_4" name="cardipatias_4" value="Valvulopatias">
                                <label for="cardipatias_4">Valvulopatias</label>
                            </td>
                        </tr>
                        <tr>
                            <td>Neuronales:</td>
                            <td>
                                <input type="checkbox" id="neuronales_1" name="neuronales_1" value="AVC">
                                <label for="neuronales_1">AVC</label><br>
                                <input type="checkbox" id="neuronales_2" name="neuronales_2" value="Isquemia">
                                <label for="neuronales_2">Isquemia</label><br>
                                <input type="checkbox" id="neuronales_3" name="neuronales_3" value="Enfermedad Neurodegenerativa">
                                <label for="neuronales_3">Enfer. Neurodegenerativa</label><br>
                                <input type="checkbox" id="neuronales_4" name="neuronales_4" value="Epilepsia">
                                <label for="neuronales_4">Epilepsia</label><br>
                                <input type="checkbox" id="neuronales_5" name="neuronales_5" value="Convulsiones">
                                <label for="neuronales_5">Convulsiones</label><br>
                            </td>
                            <td>Hepaticas:</td>
                            <td>
                                <input type="checkbox" id="hepaticas_1" name="hepaticas_1" value="Hepatitis A">
                                <label for="hepaticas_1">Hepatitis A</label><br>
                                <input type="checkbox" id="hepaticas_2" name="hepaticas_2" value="Hepatitis B">
                                <label for="hepaticas_2">Hepatitis B</label><br>
                                <input type="checkbox" id="hepaticas_3" name="hepaticas_3" value="Hepatitis C">
                                <label for="hepaticas_3">Hepatitis C</label><br>
                                <input type="checkbox" id="hepaticas_4" name="hepaticas_4" value="Hepatitis D">
                                <label for="hepaticas_4">Hepatitis D</label><br>
                                <input type="checkbox" id="hepaticas_5" name="hepaticas_5" value="Hepatitis E">
                                <label for="hepaticas_5">Hepatitis E</label><br>
                                <input type="checkbox" id="hepaticas_6" name="hepaticas_6" value="Calculos Biliares">
                                <label for="hepaticas_6">Calculos Biliares</label><br>
                            </td>
                        </tr>
                        <td>Renales:</td>
                            <td>
                                <input type="checkbox" id="renales_1" name="renales_1" value="Calculos Renales">
                                <label for="renales_1">Calculos Renales</label><br>
                                <input type="checkbox" id="renales_2" name="renales_2" value="Nefropatias">
                                <label for="renales_2">Nefropatias</label><br>
                            </td>
                            <td>Endocrinas:</td>
                            <td>
                                <input type="checkbox" id="endocrinas_1" name="endocrinas_1" value="DM">
                                <label for="endocrinas_1">DM</label><br>
                                <input type="checkbox" id="endocrinas_2" name="endocrinas_2" value="Tiroides">
                                <label for="endocrinas_2">Tiroides</label><br>
                            </td>
                        </tr>
                        <tr>
                            <td>Gastro Intestinales:</td>
                            <td>
                                <input type="checkbox" id="gastro_intestinales_1" name="gastro_intestinales_1" value="Gastritis">
                                <label for="gastro_intestinales_1">Gastritis</label><br>
                                <input type="checkbox" id="gastro_intestinales_2" name="gastro_intestinales_2" value="Hernia Hiatal">
                                <label for="gastro_intestinales_2">Hernia Hiatal</label><br>
                                <input type="checkbox" id="gastro_intestinales_3" name="gastro_intestinales_3" value="Ulceras">
                                <label for="gastro_intestinales_3">Ulceras</label><br>
                                <input type="checkbox" id="gastro_intestinales_4" name="gastro_intestinales_4" value="Enf. de Crohn">
                                <label for="gastro_intestinales_4">Enfermedad de Crohn</label><br>
                                <input type="checkbox" id="gastro_intestinales_5" name="gastro_intestinales_5" value="Celiaquia">
                                <label for="gastro_intestinales_5">Celiaquia</label><br>
                                <input type="checkbox" id="gastro_intestinales_6" name="gastro_intestinales_6" value="ERGE">
                                <label for="gastro_intestinales_6">ERGE</label><br>
                            </td>
                            <td>Psiquiatricas:</td>
                            <td>
                                <input type="checkbox" id="psiquiatricas_1" name="psiquiatricas_1" value="Transtorno de Ansiedad">
                                <label for="psiquiatricas_1">Transt. de Ansiedad</label><br>
                                <input type="checkbox" id="psiquiatricas_2" name="psiquiatricas_2" value="Transtorno de Animo">
                                <label for="psiquiatricas_2">Transt. de Animo</label><br>
                                <input type="checkbox" id="psiquiatricas_3" name="psiquiatricas_3" value="Transtorno de Personalidad">
                                <label for="psiquiatricas_3">Transt. de Personalidad</label><br>
                                <input type="checkbox" id="psiquiatricas_4" name="psiquiatricas_4" value="Transtorno Psicotico">
                                <label for="psiquiatricas_4">Transt. Psicotico</label><br>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="1">Informaci&oacute;n m&eacute;dica adicional:</td>
                            <td colspan="3">
                                <textarea id="informacion_medica" name="informacion_medica" rows="4" cols="63"><?php echo $_SESSION['AFILIACION_TEMP_10']; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="1">Observaciones importantes:</td>
                            <td colspan="3">
                                <textarea id="observaciones" name="observaciones" rows="4" cols="63"><?php echo $_SESSION['AFILIACION_TEMP_12']; ?></textarea>
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