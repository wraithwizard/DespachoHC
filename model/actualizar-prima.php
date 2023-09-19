<!--  no tengo internet, checar que funcione con internet la alerta -->

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
$idPrima = $_POST["updatingIdPrima"];
$prima = $_POST["updatingPrima"];
$tipoCobro = $_POST["updatingtipoCobro"];
$subtipo = $_POST["updatingSubtipo"];

$alert = new Alerta();

try {    
    if (isset($_POST["actualizarPrima"])) {
        $actualizar = "UPDATE prima SET primaNeta='$prima', tipoCobro='$tipoCobro', subtipo='$subtipo' WHERE idPrima='$idPrima'";
        $resultado = mysqli_query($conexion, $actualizar);     
    }
    if($resultado){
        $location = "../view/cobranza.php";
        $text = "Actualzación exitosa";
        $alert->success($location, $text);
        // echo "<script>alert('Actualización exitosa'); window.location='../view/cobranza.php'</script>";
    }else{
         //regresar 
        //  $location = "window.history.go(-1)";
        //  $text = "No se pudo actualizar";
        //  $alert->success($location, $text);
        echo "<script>alert('No se pudo actualizar'); window.history.go(-1);</script>";
    }
 } catch (mysqli_sql_exception $e) {
     throw $e;
}


