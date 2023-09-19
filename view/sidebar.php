<!-- crear otra sidebar para el usuario cliente -->
<?php 
    require("../model/conexion.php");
    
    //adquirir dato de sesion, desde la columna usuario
    $usuarioAdmin = $_SESSION["administrador"];
    //consulta para saber quien esta conectado
    $consulta = "SELECT usuario FROM usuarioweb WHERE usuario='$usuarioAdmin'";
?>

<!-- Sidebar -->
<div class="sidebar">
    <img class="sidebar__logo" src="../img/logo.jpg">
    <h2>Despacho HC</h2>
    <hr>
    <!-- <a class="active" href="dashboard.php">Clientes</a> -->
    <a href="dashboard.php" class="dashboard">Clientes</a>
    <a href="polizas.php" class="polizas">Pólizas</a>
    <a href="siniestros.php" class="sinietros">Siniestros</a>
    <a href="cobranza.php" class="cobranza">Cobranza</a>
    <a href="usuarios.php" class="usuarios">Usuarios</a> 
    <a href="../controller/cerrar-session.php">Cerrar sesión</a>
  
    <?php 
        $resultado =  mysqli_query($conexion, $consulta); 
        if ($row = mysqli_fetch_assoc($resultado)){    
    ?>
    <div class="sidebar__img">
        <img class="sidebar__admin"src="../img/users/wizard.jpg" alt="usuario">
        <p class="sidebar__user--text"><?php echo $row["usuario"], "<br> " ?></p>
    </div>
    <?php
        }
    ?>
</div>

<!-- detecta y activa la seleccion del sidebar -->
<!-- <script src="../js/sidebarAdmin.js"></script> -->