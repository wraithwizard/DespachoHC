<!-- crear otra sidebar para el usuario cliente -->
<?php 
    require("../model/conexion.php");
    
    //adquirir dato de sesion, desde la columna usuario
    $usuarioCliente = $_SESSION["usuarioweb"];
    //consulta para saber quien esta conectado
    $consulta = "SELECT usuario, email FROM usuarioweb WHERE usuario='$usuarioCliente'";
?>

<!-- Sidebar -->
<div class="sidebar">
    <img class="sidebar__logo" src="../img/logo.jpg">
    <h2>Despacho HC</h2>
    <hr>
    <a class="active" href="usuario-web.php">Mis datos</a>
    <a href="mis-polizas.php">Mis pólizas</a>
    <a href="../controller/cerrar-session.php">Cerrar sesión</a>
  
    <?php 
        $resultado =  mysqli_query($conexion, $consulta); 
        if ($row = mysqli_fetch_assoc($resultado)){    
    ?>
    <div class="usuario">
        <img class="sidebar__user"src="../img/users/usuario.png" alt="usuario">
        <p class="sidebar__user--text"><?php echo $row["usuario"], '<br>', $row["email"]; ?></p>
        <?php
            }
        ?>
    </div>
</div>