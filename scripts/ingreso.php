<?php 

session_start();

$user =  $_POST["user"];
$pass =  md5($_POST["pass"]);

if ($user == '' || $pass == '') 
{

	$_SESSION['LOGIN_ERROR'] = "Datos incompletos!";
	$_SESSION['USUARIO_TEMP'] = $user;
	header("Location: ../index.php");
}
else 
{
	include '../includes/connection.php';
	$query = "SELECT * FROM usuarios WHERE usuario like '$user'";
	$resul = mysqli_query($conn, $query, MYSQLI_USE_RESULT);
	$datos = mysqli_fetch_assoc($resul);
	$user_bd = $datos["usuario"];
	$pass_bd = $datos["contrasena"];
	mysqli_free_result($resul); 

	if ($user == $user_bd) 
	{
		if ($pass == $pass_bd) 
		{
			include '../includes/session_start.php';
			$rol = $_SESSION['ROL'];
			if ($rol == 'vendedor_supervisor') 
			{
				header("Location: ../home_vendedor_supervisor.php");
			} 	

			if ($rol == 'vendedor') 
			{
				header("Location: ../home_vendedor.php");
			} 	
			
			if ($rol == 'despachador')
			{
				header("Location: ../home_despachador.php");
			}

			if ($rol == 'unidad')
			{
				header("Location: ../home_unidad.php");
			}
			
		}
			else
			{
				$_SESSION['LOGIN_ERROR'] = "Clave Incorrecta";
				$_SESSION['USUARIO_TEMP'] = $user;
				header("Location: ../index.php");
			}
	}
	else 
	{ 
		$_SESSION['LOGIN_ERROR'] = "Usuario no registrado";
		$_SESSION['TEMP'] = '';
		header("Location: ../index.php");
	}
}

?>

