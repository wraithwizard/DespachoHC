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
$idCliente = $_POST["updatingIdCliente"];
$nombre = $_POST["updatingNombre"];
$apellidoP = $_POST["updatingApellidoP"];
$apellidoM = $_POST["updatingApellidoM"];
$email = $_POST["updatingEmail"];
$rfc = $_POST["updatingRfc"];
$telefono = $_POST["updatingTel"];

try {    
    if (isset($_POST["actualizarCliente"])) {
        $actualizar = "UPDATE cliente SET nombre='$nombre', apellidoP='$apellidoP', apellidoM='$apellidoM', email='$email', rfc='$rfc', telefono='$telefono' WHERE idCliente='$idCliente'";
        $resultado3 = mysqli_query($conexion, $actualizar);        
        // echo "idCliente = $idCliente <br> nombre=$nombre <br> apellidoP=$apellidoP <br> apellidoM=$apellidoM <br> email=$email <br> rfc=$rfc <br> telefono: $telefono";
    }
    if($resultado3){
    //mensaje de alerta, si tiene exito regresar al index
        echo "<script>alert('Actualización exitosa'); window.location='../view/dashboard.php'</script>";
    }else{
         //regresar 
        echo "<script>alert('No se pudo actualizar'); window.history.go(-1);</script>";
    }
 } catch (mysqli_sql_exception $e) {
     throw $e;
}


