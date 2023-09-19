<?php
 //esta funccion debe estar en cada archivo de sesion
 session_start(); 

 //si la varialbe está vavcía
 if (!isset($_SESSION["administrador"])) {
     //redirigir al loging
     header("location: ../index.php");
 }

include("conexion.php");
include("../controller/alertaLibreria.php");

//datos cliente
$idPrima = $_GET["id"];

//Borrar datos
$eliminarPrima = "DELETE prima FROM prima WHERE idPrima='$idPrima'";

try {    
    $resultadoEliminar = mysqli_query($conexion, $eliminarPrima);
    if ($resultadoEliminar) {
        header("location: ../view/cobranza.php");
    } else {
        echo "<script>alert ('No se pudo eliminar el objeto seleccionado'); window.history.go(-1); </script>";
    }    
 } catch (mysqli_sql_exception $e) {
     throw $e;
}