<?php

	//inciar variables principales

	$_SESSION['LOGIN_TRASMEDIC'] = TRUE;
	$_SESSION['USUARIO'] = $datos["usuario"];
	$_SESSION['NOMBRE'] = $datos["nombre"];
	$_SESSION['APELLIDOS'] = $datos["apellidos"];
	$_SESSION['CEDULA'] = $datos["cedula"];
	$_SESSION['ROL'] = $datos["rol"];
	$_SESSION['EMAIL'] = $datos["email"];
	$_SESSION['CODIGO_USUARIO'] = $datos["codigo_usuario"];
	$_SESSION['TELEFONO'] = $datos["telefono"];

	//recordar vaciar todas las variables de sesión.

	$_SESSION['LOGIN_ERROR'] = '';
	$_SESSION['USUARIO_TEMP'] = '';
	
	$_SESSION['CAMBIO_PASS_ERROR'] = '';

	$_SESSION['AFILIACION_ERROR'] = '';
	$_SESSION['BENEFICIARIO_ERROR'] = '';
	$_SESSION['COBRO_ERROR'] = '';
	$_SESSION['DESPACHO_ERROR'] = '';
	$_SESSION['CREDENCIAL'] = '';

?>