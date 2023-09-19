<?php 
    //esta funccion debe estar en cada archivo de sesion
    session_start(); 

    //si la varialbe está vavcía
    if (!isset($_SESSION["usuarioweb"])) {
        //redirigir al loging
        header("location: ../index.php");
    }

    include("../model/conexion.php");

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
    <title>Despacho HC - mis pólizas</title>
</head>

<body>
    <?php include("header.php");?>
    <?php include("sidebar-usuario-cliente.php");?>
    
    <!--panel-->
    <div class="contenido">
    <h1>Mis pólizas</h1>
  
    <div class="formulario-cliente">
            <form method="post" action="consulta-mi-poliza.php"> 
                <h2>Mis pólizas</h2>  
                <select class="form-cliente__input" name="ramo" required>
                    <option hidden disabled selected value>Seleccionar ramo</option>
                    <option value="vida">Vida</option>
                    <option value="gastos médicos">Gastos médicos</option>
                    <option value="daños">Daños</option>
                    <option value="autos">Autos</option>
                    <option value="especial">Especiales</option>
                </select>
                <div class="form-cliente__div">
                    <input type="email" name="correo" placeholder="Insertar email" required>
                </div>
                <div class="poliza__input">
                    <input type="submit" name="submit" value="Consultar" class="btn-registrar">     
                </div>                 
            </form>      
        
    </div>
    <?php include("footer.php");?>
</body>
</html>
