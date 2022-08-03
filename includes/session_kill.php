<?php

	session_start();

	//Vaciar variables principales

	$_SESSION['LOGIN_TRASMEDIC'] = FALSE;
	$_SESSION['USUARIO'] = '';
	$_SESSION['NOMBRE'] = '';
	$_SESSION['APELLIDOS'] = '';
	$_SESSION['CEDULA'] = '';
	$_SESSION['ROL'] = '';
	$_SESSION['EMAIL'] = $datos[""];
	$_SESSION['CODIGO_USUARIO'] = '';
	$_SESSION['TELEFONO'] = '';

	//recordar vaciar todas las variables de sesión.

	$_SESSION['LOGIN_ERROR'] = '';
	$_SESSION['USUARIO_TEMP'] = '';
	
	$_SESSION['CAMBIO_PASS_ERROR'] = '';

	$_SESSION['AFILIACION_ERROR'] = '';
	$_SESSION['BENEFICIARIO_ERROR'] = '';
	$_SESSION['COBRO_ERROR'] = '';
	$_SESSION['DESPACHO_ERROR'] = '';

	$_SESSION['CREDENCIAL'] = '';
	
	header("Location: ../index.php");

?>
