<?php
    session_start();

    if ($_SESSION['LOGIN_TRASMEDIC'] == FALSE) {header("Location: ../index.php");}
    if ($_SESSION['ROL'] != 'vendedor_supervisor' ){header("Location: ../index.php");}

    $codigo_sistema = $_POST['codigo_sistema'];
    $credencial = $_POST['credencial'];
    $numero_contrato = $_POST['numero_contrato'];

    $cedula = $_POST["cedula"];
    $nombre = $_POST['nombre'];
    $genero = $_POST["genero"];
	
    $telefono_movil = $_POST["telefono_movil"];
    $telefono_fijo = $_POST["telefono_fijo"];

    $provincia = $_POST["provincia"];
    $canton = $_POST["canton"];
    $distrito = $_POST["distrito"];
	$direccion_exacta = $_POST["direccion_exacta"];
    
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $antecedentes_medicos = $_POST["antecedentes_medicos"];
    $observaciones = $_POST["observaciones"];    

    if ($codigo_sistema == '' || $credencial == '') 
	{
        $myheader = "Location: ../editar_beneficiarios_2.php?superdato=" . $codigo_sistema;
        //echo $myheader;
		header($myheader);
	}
	else
	{		

        include '../includes/connection.php';

        $query = "UPDATE beneficiarios_credencial set nombre = '$nombre', telefono_fijo = '$telefono_fijo', 
        telefono_movil = '$telefono_movil', cedula = '$cedula', provincia = '$provincia', canton = '$canton', 
        distrito = '$distrito', direccion_exacta = '$direccion_exacta', genero = '$genero', fecha_nacimiento = '$fecha_nacimiento',
        antecedentes_medicos = '$antecedentes_medicos', observaciones = '$observaciones' 
        WHERE codigo_sistema LIKE '$codigo_sistema'";

        //echo $query;
        $resul = mysqli_query($conn, $query);
		
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
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/test_borders.css">
		<title>SIWO</title>
	</head>
<body>
	<div class = "container mi_cont">

        <?php include_once('../includes/header.php');?>
	    <?php //include_once('../includes/main_menu.php');?>

    	<div class = "row justify-content-center mi_row">
			<div class = "col-8 mi_col ">
				<!-- (row_!Centro!) -->
				<span class="text-center"><h3>Edici&oacute;n completa</h3></span>
				<span class="text-center"><h5>Edici&oacute;n realizada con &eacute;xito por <?php echo $_SESSION['NOMBRE'];?></h5></span>
                <div class = "col-12 mi_col table-responsive">
                    <table class="table table-sm table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th colspan="6">Detalles del beneficiario a editar:</th>
                                </tr>
                            </thead>
                            <tr>
                                <td class="table-primary">Codigo Sistema:</td>  
                                <td><?php echo $codigo_sistema;?></td>
                                <td class="table-primary">Credencial:</td>  
                                <td><?php echo $credencial;?></td>
                                <td class="table-primary">Contrato:</td>  
                                <td><?php echo $numero_contrato;?></td>
                            </tr>
                            <tr>
                                <td class="table-primary">C&eacute;dula:</td>  
                                <td><?php echo $cedula;?></td>
                                <td class="table-primary">Nombre:</td>  
                                <td><?php echo $nombre;?></td>
                                <td class="table-primary">G&eacute;nero:</td>  
                                <td><?php echo $genero;?></td>
                            </tr>
                            <tr>
                                <td class="table-primary">Tel&eacute;fono M&oacute;vil:</td>  
                                <td><?php echo $telefono_movil;?></td>
                                <td class="table-primary">Tel&eacute;fono Fijo:</td>  
                                <td><?php echo $telefono_fijo;?></td>
                                <td class="table-primary">Fecha Nacimiento:</td>  
                                <td><?php echo $fecha_nacimiento;?></td>
                            </tr>
                            <tr>
                                <td class="table-secondary" colspan="6"></td> 
                            </tr>
                            <tr>
                                <td class="table-success">*Provincia:</td>  
                                <td><?php echo $provincia;?></td>
                                <td class="table-success">*Cant&oacute;n:</td>  
                                <td><?php echo $canton;?></td>
                                <td class="table-success">*Distrito:</td>  
                                <td><?php echo $distrito;?></td>
                            </tr>
                            <tr>
                                <td class="table-success">*Direcci&oacute;n:</td>  
                                <td colspan="5"><?php echo $direccion_exacta;?></td>
                            </tr>
                            <tr>
                                <td class="table-secondary" colspan="6"></td> 
                            </tr>
                            <tr>
                                <td class="table-info">Antec. Medicos:</td>  
                                <td colspan="5"><?php echo $antecedentes_medicos;?></td>
                            </tr>
                            <tr>
                                <td class="table-info">Observaciones:</td>  
                                <td colspan="5"><?php echo $observaciones;?></td>
                            </tr>
                            <tr>
                                <td class="table-secondary" colspan="6"></td> 
                            </tr>
                            <tr>
                                <td colspan="6"><a href="../editar_beneficiarios_1.php?superdato=<?php echo $credencial;?>&superdato2=<?php echo $numero_contrato;?>">Volver</a></td>
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