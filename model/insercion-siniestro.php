<?php
  //esta funccion debe estar en cada archivo de sesion
  session_start(); 

  //si la varialbe está vavcía
  if (!isset($_SESSION["administrador"])) {
      //redirigir al loging
      header("location: ../index.php");
  }

include ("conexion.php");
include("../controller/alertaLibreria.php");

$numPoliza = $_POST["numPoliza"];
$nombre = $_POST["nombreSiniestro"];
$fecha = $_POST["fecha"];
$diagnostico = $_POST["descripcion"];
$indemnizacion = $_POST["indemnizacion"];
$estadoSiniestro = $_POST["estado"];
$folio = $_POST["folio"];
$lugar = $_POST["lugar"];
$finalizado = $_POST["finalizado"];

$alert = new Alerta();

if (isset($_POST["submit"])){
    $insertarSiniestro = "INSERT INTO siniestro (nombreSiniestro, fechaSiniestro, diagnostico, indemnizacion, estadoSiniestro, folio, lugar, finalizado) VALUES ('$nombre', '$fecha', '$diagnostico', '$indemnizacion', '$estadoSiniestro', '$folio', '$lugar', '$finalizado')";
    $insert = mysqli_query($conexion, $insertarSiniestro); 

    try{
        $idSiniestro = mysqli_insert_id($conexion);

        //hacer consulta del numero de poliza y obtener su idPoliza y actualizarlo en la tabla siniestro
        if ($insert) {
            $buscarIdPoliza = "SELECT idPoliza, numeroPoliza FROM poliza WHERE $numPoliza = numeroPoliza";
            $resultado = mysqli_query($conexion, $buscarIdPoliza);

            // echo "El idSiniestro: " ,$idSiniestro;
            if($resultado){
                $row = mysqli_fetch_array($resultado);
                //obtengo el numero de poliza
                $idPoliza = $row["idPoliza"];
                // echo "<br>El número de poliza es: " , $idPoliza;
                $updateSiniestro = "UPDATE siniestro SET idPoliza = '$idPoliza' WHERE idSiniestro = '$idSiniestro'";
                //hago el query
                $actualizacion = mysqli_query($conexion, $updateSiniestro);
            }
        }
        //alertar
        $location = "../view/siniestros.php";
        $alert->success($location, "Registro de siniestro exitoso");    
    }catch (mysqli_sql_exception $e){
        throw $e;
    }
}else{
    echo "<script>alert('Error al registrar'); window.history.go(-1);</script>";
}