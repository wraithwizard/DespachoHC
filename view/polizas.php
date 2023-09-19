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
    <title>Despacho HC Pólizas</title>
</head>

<body>  
    <?php include("sidebar.php"); ?>
 
    <!--panel-->
    <div class="contenido-poliza">
        <div class="contenido-panel">
            <h1>Pólizas</h1>
            <button class="btn-crear-cliente btn-animated" onclick="location.href='cr-poliza.php'">Crear</button>
        </div>       

        <!-- buscador -->
        <form class="buscador" action="busqueda-poliza.php" method="POST">
            <label for="buscador" class="buscador-label">Buscar por nombre o apellido: </label>
            <input type="text" class="buscador-input" name="buscador" id="buscador">
            <button class="btn-crear-cliente btn-buscador btn-animated" type="submit" name="buscar">Buscar</button>
        </form>
       
        <div class="datos-poliza">         
            <div class="tabla__header">Póliza</div>          
        </div>
    </div> 

    <?php include("footer.php");?>
</body>
</html>