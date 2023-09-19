<?php
 //esta funccion debe estar en cada archivo de sesion
 session_start(); 

 //si la varialbe está vavcía
 if (!isset($_SESSION["administrador"])) {
     //redirigir al loging
     header("location: ../index.php");
 }

include("conexion.php");

//datos cliente
$idCliente = $_GET["id"];

//Borrar datos
$eliminarCliente = "DELETE cliente, direccion FROM cliente, direccion WHERE cliente.idCliente='$idCliente' AND direccion.idDir=cliente.idDir";

try {    
    $resultadoEliminar = mysqli_query($conexion, $eliminarCliente);
    if ($resultadoEliminar) {
        header("location: ../view/dashboard.php");
    } else {
        echo "<script>alert ('No se pudo eliminar el objeto seleccionado'); window.history.go(-1); </script>";
    }    
 } catch (mysqli_sql_exception $e) {
     throw $e;
}

$ineDelete = "SELECT imagenIne FROM cliente WHERE idCliente = '$idCliente'";
$nameCheck = mysqli_query($conexion, $ineDelete); 
    
//recibir nombre
while($row = mysqli_fetch_assoc($nameCheck)){
    $filename = $row["imagenIne"];
    //el path del file
    $targetPath = "../img/ine/";
    $targetFilePath = $targetPath . $filename;
}

//borra el archivo
if (file_exists($targetFilePath)) {
    unlink($targetFilePath);
}else{
    return;
}

