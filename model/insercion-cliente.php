<?php
  //esta funccion debe estar en cada archivo de sesion
  session_start(); 

  //si la varialbe está vavcía
  if (!isset($_SESSION["administrador"])) {
      //redirigir al loging
      header("location: ../index.php");
  }
include ("conexion.php");

$nombre = $_POST["nombre"];
$apellidoP = $_POST["apellidoP"];
$apellidoM = $_POST["apellidoM"];
$email = $_POST["email"];
$rfc = $_POST["rfc"];
$telefono = $_POST["tel"];
// //inserta la imagenen la tabla clientes
// manejo del file
$targetDir = "../img/ine/";
$filename = basename($_FILES["ine"]["name"]);
$targetFilePath = $targetDir . $filename;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

$calle = $_POST["calle"];
$numero = $_POST["numero"];
$colonia = $_POST["col"];
$cp = $_POST["cp"];
$municipio = $_POST["municipio"];

// echo "Nombre: $nombre<br> ApellidoP: $apellidoP<br> apellidoM: $apellidoM<br> Email: $email<br> RFC: $rfc<br> Telefono: $telefono<br>
// Calle: $calle<br> Numero: $numero<br> Colonia: $colonia<br> Municipio: $municipio";

$allowTypes = array('jpg', 'pdf', 'png');

if (in_array($fileType, $allowTypes)) {
    //subir archivo
    if (move_uploaded_file($_FILES["ine"]["tmp_name"], $targetFilePath)) {
        $insertarTablaCliente = "INSERT INTO cliente (nombre, apellidoP, apellidoM, email, rfc, imagenIne, telefono) VALUES ('$nombre', '$apellidoP', '$apellidoM', '$email', '$rfc', '$filename','$telefono')";
        $insercionCliente = mysqli_query($conexion, $insertarTablaCliente);
        try{
            $idCliente = mysqli_insert_id($conexion);
            //echo "idCliente=$idCliente";
            if ($insercionCliente) {
                $insertarTablaDireccion = "INSERT INTO direccion (calle, numero, colonia, cp, municipio) VALUES ('$calle', '$numero','$colonia', '$cp', '$municipio')";
                $result2 = mysqli_query($conexion, $insertarTablaDireccion);
                if ($insercionCliente && $result2) {
                    //capturo PK de la tabla direccion
                    $idDir = mysqli_insert_id($conexion);     
                    //echo "idDir=$idDir";
                    //actualizo la tabla clientes
                    $updateClaveDir = "UPDATE cliente SET idDir='$idDir' WHERE idCliente = '$idCliente'";
                    $actualizacion = mysqli_query($conexion, $updateClaveDir);
                }      
                //mensaje de alerta, si tiene exito regresar la lisa de clientes
                //revisar direccion al subir al host, cambiar a: windows.location=/view/dashboard'
                echo "<script>alert('Registro de cliente exitoso'); window.location='../view/dashboard.php'</script>";
                //echo "si se puedo";
            } else {
                //regresar 
                echo "<script>alert('No se pudo registrar al cliente'); window.history.go(-1);</script>";
            }
        } catch (mysqli_sql_exception $f) {
                throw $f;   
        }
    }else{
        "<script>alert('Sólo pueden subir archivos PDF, pgn o jpg'); window.history.go(-1);</script>";
    }
}else{
    "<script>alert('Favor de seleccionar un archivo'); window.history.go(-1);</script>";
}