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
    <title>Despacho HC Dashboard</title>
</head>

<body>  
    <?php include("sidebar.php"); ?>
 
    <!--panel-->
    <div class="contenido">
        <div class="contenido-panel">
            <h1>Listado de clientes</h1>
            <button class="btn-crear-cliente" onclick="location.href='cr-forms.php'">Crear</button>
        </div>         
          
    <div class="formulario-cliente">
        <!--Formulario crear cliente -->
        <form method="post" action="../model/insercion-cliente.php" enctype="multipart/form-data" onsubmit="return validarClientes();"> <!--enctype es para la subida del file -->
        <h2>Crear nuevo cliente</h2>      
        <div class="formulario__cliente--nombres">
            <input type="text" id="nombre" placeholder="Nombre" name="nombre" required>
            <input type="text" id="apellidoP" placeholder="Apellido Paterno" name="apellidoP" required>
            <input type="text" id="apellidoM" placeholder="Apellido Materno" name="apellidoM" required>
        </div>
        <div class="formulario__cliente--email">
            <input type="email" id="email" placeholder="Email" name="email" required>          
            <input type="text" id="curp" placeholder="CURP" name="rfc" required>   
            <input type="tel"  id="telefono" placeholder="Teléfono 10 dígitos" name="tel" pattern="[0-9]{10}">
        </div>
        <label class="ine" for="elINE">INE: </label>
        <input type="file" id="elINE" name="ine" required>    
        <div class="formulario__cliente--domicilio">      
            <input type="text"  id="calle" placeholder="Calle" name="calle">
            <input type="number" id="numero" placeholder="Número" name="numero">
            <input type="text" id="colonia" placeholder="Colonia" name="col">
        </div>
        <div class="formulario__cliente--cp">
            <input type="text" id="cp" placeholder="Código Postal" name="cp">
            <input type="text" id="municipio" placeholder="Municipio" name="municipio">
        </div>
        <input type="submit" name="insert" value="Registrar" class="btn-registrar">                      
        </form>      
    </div>

    <?php include("footer.php");?>
    <script src="../js/validacionFormClientes.js"></script> 

</body>
</html>