<?php
include ("conexion.php");

$nombre = $_POST["nombre"];
$apellidoP = $_POST["apellidoP"];
$apellidoM = $_POST["apellidoM"];
$username = $_POST["username"];
$pw = $_POST["pw"];

$insertarAdmin = "INSERT INTO administrador (nombre, apellidoP, apellidoM, usuario, contrasena) VALUES ('$nombre', '$apellidoP', '$apellidoM', '$username','$pw')";

try{
    $insercionAdmin = mysqli_query($conexion, $insertarAdmin);  
    if ($insercionAdmin) {       
        //revisar direccion al subir al host, cambiar a: windows.location=/view/dashboard'
        echo "<script>alert('Registro de cliente exitoso'); window.location='../view/usuarios.php'</script>";
    } else {
        //regresar 
        echo "<script>alert('No se pudo registrar al cliente'); window.history.go(-1);</script>";
    }
} catch (mysqli_sql_exception $f) {
        throw $f;   
}
