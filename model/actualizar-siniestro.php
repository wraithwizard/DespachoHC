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

$idSiniestro = $_POST["updatingIdSiniestro"];
$nombre = $_POST["updatingNombre"];
$fecha = $_POST["updatingFecha"];
$diagnostico = $_POST["updatingDiagnostico"];
$indemnizacion = $_POST["updatingIndemnizacion"];
$estado = $_POST["updatingEdo"];
$folio = $_POST["updatingFolio"];
$lugar = $_POST["updatingLugar"];

$alert = new Alerta();

try {    
    if (isset($_POST["actualizarSiniestro"])) {
        $actualizar = "UPDATE siniestro SET nombreSiniestro='$nombre', fechaSiniestro='$fecha', diagnostico='$diagnostico', indemnizacion = '$indemnizacion', estadoSiniestro = '$estado', folio = '$folio', lugar = '$lugar' WHERE idSiniestro='$idSiniestro'";
        $resultado = mysqli_query($conexion, $actualizar);    

        // echo "id = $idSiniestro, <br>nombre = $nombre, <br>fecha = $fecha, <br>diagnostico = $diagnostico, <br>indemnizacion = $indemnizacion, <br>estado = $estado, <br>folio = $folio, <br>lugar = $lugar";
    }
    if($resultado){
        $location = "../view/siniestros.php";
        $alert->success($location, "Actualización exitosa");     
    }else{
         //regresar 
        echo "<script>alert('No se pudo actualizar'); window.history.go(-1);</script>";
    }
} catch (mysqli_sql_exception $e) {
     throw $e;
}

