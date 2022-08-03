<?php
    function revisionUnidad($unidad) {

    include 'connection.php';  
    $sql = "SELECT * FROM despachos WHERE estado LIKE 'ABIERTO' AND unidad LIKE '$unidad'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
            echo "danger";
    } else {
        echo "primary";
    }
    $conn->close();
    }
?>