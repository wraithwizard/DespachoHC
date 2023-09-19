<?php 
    //esta funccion debe estar en cada archivo de sesion
    session_start(); 

    //si la varialbe está vavcía
    if (!isset($_SESSION["administrador"])) {
        //redirigir al loging
        header("location: ../index.php");
    }

    include("../model/conexion.php");      
    //recibir variable id
    $idUser = $_GET["id"];

    //consulta 
    $admin = "SELECT idUsuarioWeb, email, usuario, contrasena, rol FROM usuarioweb WHERE idUsuarioWeb ='$idUser'";   
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <title>Despacho HC Dashboard Editar usuario</title>
</head>

<body>  
    <?php include("sidebar.php"); ?>
 
    <!--panel-->
    <div class="contenido">
        <div class="contenido-panel">
            <h1>Edición de usuario</h1>
            <button class="btn-crear-cliente" onclick="location.href='cr-usuario.php'">Crear</button>
        </div>       
   
        <form class="datos-users-update" action="../model/actualizar-usuario.php" method="post">
            <div class="tabla__titulo-users-update">Datos del usuario</div>
            <!-- <div class="tabla__header">ID</div> -->
            <div class="tabla__header">Email</div>
            <div class="tabla__header">Usuario</div>
            <div class="tabla__header">Contrasena</div>
            <div class="tabla__header">Rol</div>
            <?php              
                $resultado =  mysqli_query($conexion, $admin); 
                //cargar y mostrar datos
                while ($row = mysqli_fetch_assoc($resultado)){ 
            ?>
                <!-- se llenan lo campos desde la tabla de la base datos-->
                <input type="hidden" class="tabla__item" value="<?php echo $row["idUsuarioWeb"];?>" name="updatingIdAdmin">
                <input type="text" class="tabla__item" value="<?php echo $row["email"];?>" name="updatingEmail">
                <input type="text" class="tabla__item" value="<?php echo $row["usuario"];?>" name="updatingUsuario">
                <input type="text" class="tabla__item" value="<?php echo $row["contrasena"];?>" name="updatingPassword">
                <input type="text" class="tabla__item" value="<?php echo $row["rol"];?>" name="updatingRol">
            <?php          
                } 
                //libera la memoria
                mysqli_free_result($resultado); 
            ?>        
            <input type="submit" value="Actualizar" class="datos-update-submit" name="actualizarUsuario">
        </form>
    </div> 

    <?php include("footer.php");?>
</body>
</html>