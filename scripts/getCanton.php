
<?php
    session_start();

    if ($_SESSION['LOGIN_TRASMEDIC'] == FALSE) {header("Location: ../index.php");}
    //if ($_SESSION['ROL'] != 'vendedor_supervisor' ){header("Location: ../index.php");}

    $q = intval($_GET['q']);

    include '../includes/connection.php';
    //mysqli_query("SET NAMES 'utf8'");  

    mysqli_select_db($conn);
    $sql="SELECT nombre FROM canton WHERE id_provincia = '".$q."'";
    $result = mysqli_query($conn,$sql);

    echo '<select id="canton" name="canton">';
    while($row = mysqli_fetch_array($result)) {
        echo '<option value='. '"' .$row["nombre"] . '"' .'>' . $row['nombre'] . "</option>";
    }
    mysqli_close($conn);
?>