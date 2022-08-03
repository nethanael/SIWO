<?php 

session_start();

$tipo_cedula = $_POST["tipo_cedula"];

    switch ($tipo_cedula) {
        case "":
            header("Location: ../index.php");
            break;
        case "fisica":
            header("Location: ../nuevo_afiliado_B1.php");
            break;
        case "juridica":
            header("Location: ../nuevo_afiliado_B2.php");
            break;
        default:
        header("Location: ../index.php");
            break;
    }

?>

