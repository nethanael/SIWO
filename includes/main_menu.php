    <div class = "row justify-content-center mi_row">
        <div class = "col-6 mi_col">
        <!-- (row_!nav!) -->
            <p class="text-center font-weight-light">
            <a href="index.php" class="btn btn-secondary" role="button">Inicio</a>
            <a href="includes/session_kill.php" class="btn btn-secondary" role="button">Cerrar Sesi&oacute;n</a> 
            <a href="cambio_pass.php" class="btn btn-secondary" role="button">Cambiar Contrase&ntilde;a</a><br>
            Usuario: <?php echo $_SESSION['USUARIO'];?>
            </p>
        </div>
    </div>