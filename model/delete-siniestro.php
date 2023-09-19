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
$idSiniestro = $_GET["id"];

//Borrar datos
$eliminarSiniestro = "DELETE siniestro FROM siniestro WHERE idSiniestro='$idSiniestro'";

try {    
    $resultadoEliminar = mysqli_query($conexion, $eliminarSiniestro);
    if ($resultadoEliminar) {
        header("location: ../view/siniestros.php");
    } else {
        echo "<script>alert ('No se pudo eliminar el objeto seleccionado'); window.history.go(-1); </script>";
    }    
 } catch (mysqli_sql_exception $e) {
     throw $e;
}