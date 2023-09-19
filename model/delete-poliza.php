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
$idPoliza = $_GET["id"];

//borrar archivo
$polizaDelete = "SELECT imagenCaratula FROM poliza WHERE idPoliza = '$idPoliza'";
$nameCheck = mysqli_query($conexion, $polizaDelete); 
    
//recibir nombre
while($row = mysqli_fetch_assoc($nameCheck)){
    $filename = $row["imagenCaratula"];
    //el path del file
    $targetPath = "../pdfs/";
    $targetFilePath = $targetPath . $filename;
}

//borra el archivo
if (file_exists($targetFilePath)) {
    unlink($targetFilePath);
}else{
    return;
}

//Borrar datos
$eliminarPoliza = "DELETE FROM poliza WHERE idPoliza='$idPoliza'";

try {    
    $resultadoEliminar = mysqli_query($conexion, $eliminarPoliza);
    if ($resultadoEliminar) {
        header("location: ../view/polizas.php");
    } else {
        echo "<script>alert ('No se pudo eliminar la póliza seleccionada'); window.history.go(-1); </script>";
    }    
 } catch (mysqli_sql_exception $e) {
     throw $e;
}