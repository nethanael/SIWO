<?php 

session_start();

$tipo_despacho = $_POST["tipo_despacho"];

    switch ($tipo_despacho) {
        case "":
            header("Location: ../index.php");
            break;
        case "emergencia":
            header("Location: ../despachar_unidad_B1.php");
            break;
        case "administrativo":
            header("Location: ../despachar_unidad_B2.php");
            break;
        default:
        header("Location: ../index.php");
            break;
    }

?>

