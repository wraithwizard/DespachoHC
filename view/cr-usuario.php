<?php 
    //esta funccion debe estar en cada archivo de sesion
    session_start(); 

    //si la varialbe está vavcía
    if (!isset($_SESSION["administrador"])) {
        //redirigir al loging
        header("location: ../index.php");
    }

    include("../model/conexion.php");      
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/dashboard.css" rel="stylesheet">
    <title>Despacho HC Creación de usuario</title>
</head>

<body>  
    <?php include("sidebar.php"); ?>

    <!--panel-->
    <div class="contenido">
        <div class="contenido-panel">
            <h1>Creación de Usuario</h1>
            <button class="btn-crear-cliente" onclick="location.href='cr-usuario.php'">Crear</button>
        </div>        
          
    <div class="formulario-cliente">
        <!--Formulario crear cliente -->
        <form method="post" action="../model/insercion-usuario.php" onsubmit="return validarUser();"> 
        <h2>Crear nuevo usuario</h2>      
        <input type="email" id="email" placeholder="Email" name="email" required>
        <input type="text" id="usuario" placeholder="Nombre de usuario" name="username" required>
        <input type="password" id="pw" placeholder="Contraseña" name="pw">
        <input type="password" placeholder="Confirmar contraseña" name="passwordMatch" required>
        <label class="poliza-warning" for="rol">Seleccionar rol: </label>
        <select name="rol" class="form-cliente__input" required>
            <option hidden disabled selected value>-----------</option>
            <option value="cliente">Cliente</option>
            <option value="admin">Administrador</option>
        </select>
        <input type="submit" name="insert" value="Registrar" class="btn-registrar">                      
        </form>      
    </div>

    <?php include("footer.php");?>
    <script src="../js/validacionFormClientes.js"></script> 

</body>
</html>
  

