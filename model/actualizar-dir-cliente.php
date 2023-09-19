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

//datos direccion
$idDireccion = $_POST["idDir"];
$calle = $_POST["updatingCalle"];
$numero = $_POST["updatingNumero"];
$colonia = $_POST["updatingCol"];
$cp = $_POST["updatingCp"];
$municipio = $_POST["updatingMunicipio"];

try {
    if (isset($_POST["actualizarDir"])) {
        $dirActualizada = "UPDATE direccion SET calle='$calle', numero='$numero', colonia='$colonia', cp='$cp', municipio='$municipio' WHERE idDir='$idDireccion'";
        $resultado2 = mysqli_query($conexion, $dirActualizada);   
        //echo "calle: $calle<br> numero: $numero<br> colonia: $colonia<br> municipio: $municipio<br> idDir: $idDireccion<br>";
    }
    if($resultado2){      
        //mensaje de alerta, si tiene exito regresar al index
        //alertar
        $alert = new Alerta();
        $location = "../view/dashboard.php";
        $alert->success($location, "Actualización exitosa");    
        //echo "<script>alert('Actualización exitosa'); window.location='../view/dashboard.php'</script>";
    }else{
        //regresar 
        echo "<script>alert(''No se pudo actualizar''); window.history.go(-1);</script>";
    }
} catch (mysqli_sql_exception $e) {
    throw $e;   
}