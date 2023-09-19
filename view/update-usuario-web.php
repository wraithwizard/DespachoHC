<?php 
    //esta funccion debe estar en cada archivo de sesion
    session_start(); 

    //si la varialbe está vavcía
    if (!isset($_SESSION["usuarioweb"])) {
        //redirigir al loging
        header("location: index.php");
    }

    include("../model/conexion.php");
    //recibir variable id
    $id = $_GET["id"];

    //adquirir dato de sesion
    $usuarioCliente = $_SESSION["usuarioweb"];   
    //consulta datos
    $usuario = "SELECT idUsuarioWeb, email, usuario, contrasena FROM usuarioweb WHERE usuario = '$usuarioCliente'";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/dashboard.css" rel="stylesheet">
    <title>Despacho HC - Editar usuario</title>
</head>

<body>
    <?php include("header.php");?>
    <?php include("sidebar-usuario-cliente.php");?>
    
    <!--panel-->
    <div class="contenido">
    <h1>Edición de datos</h1>
  
        <!-- la tabla de clientes -->
        <form class="datos-usuario--update" action="../model/actualizar-usuario-web.php" method="post">
            <div class="tabla__titulo--usuariosweb--update">Mis datos</div>
            <div class="tabla__header">Email</div>
            <div class="tabla__header">Contraseña</div>
            <div class="tabla__header">Operación</div>   
            <!--pido conexion, se pone primero la conexion, despues la variable con el query-->
            <?php              
                $resultado =  mysqli_query($conexion, $usuario); 
                //cargar y mostrar datos
                while ($row = mysqli_fetch_assoc($resultado)){ 
            ?>
                <!-- se llenan lo campos desde la tabla de la base datos-->
                <input type="hidden" class="tabla__item" value="<?php echo $row["idUsuarioWeb"];?>" name="updatingId">
                <input type="email" class="tabla__item" value="<?php echo $row["email"];?>" name="updateEmail">
                <!-- el password en asteriscos -->
                <input type="password" class="tabla__item" value="<?php echo $row['contrasena'];?>" name="updatePw">
                <div class="tabla__item">
                    <a href="update-usuario-web.php?id=<?php echo $row["idUsuarioWeb"];?>"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                    <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                    <line x1="16" y1="5" x2="19" y2="8" />
                    </svg></a>
                    <p> - </p>
                    <a href="#?id=<?php echo $row["idUsuarioWeb"];?>" class="btn-eliminar"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <line x1="4" y1="7" x2="20" y2="7" />
                    <line x1="10" y1="11" x2="10" y2="17" />
                    <line x1="14" y1="11" x2="14" y2="17" />
                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                    </svg></a>                    
                </div>               
            <?php
                } //hasta aca llega el while

                //libera la memoria
                mysqli_free_result($resultado); 
            ?>
             <input type="submit" value="Actualizar" class="datos-update-submit btn-animated" name="actualizarUsuarioWeb">             
        </form>
    </div>
    <?php include("footer.php");?>
</body>
</html>
