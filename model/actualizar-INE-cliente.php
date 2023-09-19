<?php
  //esta funccion debe estar en cada archivo de sesion
  session_start(); 

  //si la varialbe está vavcía
  if (!isset($_SESSION["administrador"])) {
      //redirigir al loging
      header("location: ../index.php");
  }
  
include("conexion.php");

//datos
$idCliente = $_POST["idCliente"];

try {
    if (isset($_POST["actualizarINE"]) && !empty($_FILES["imagenIne"]["name"])) {
        //conocer el nombre del archivo viejo
        $ineUpdate = "SELECT imagenIne FROM cliente WHERE idCliente = '$idCliente'";
        $nameCheck = mysqli_query($conexion, $ineUpdate);   
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
        }    
        
        //subir el nuevo archivo
        $targetDir = "../img/ine/";
        $filename = basename($_FILES["imagenIne"]["name"]);
        $targetFilePath = $targetDir . $filename;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);   
        $allowTypes = array('jpg', 'pdf', 'png');

        if (in_array($fileType, $allowTypes)) {
            //subir archivo
            if (move_uploaded_file($_FILES["imagenIne"]["tmp_name"], $targetFilePath)) {
                //inserta en la tabla de clientes
                $insertarPDF = "UPDATE cliente SET imagenIne='$filename' WHERE idCliente='$idCliente'";
                $insert = mysqli_query($conexion, $insertarPDF);  
                if ($insert) {
                    echo "<script>alert('Actualización del INE exitosa'); window.location='../view/dashboard.php'</script>";
                }
            }else{
                echo "<script>alert('Error al subir el archivo'); window.history.go(-1);</script>";
            }
        }else{
            "<script>alert('Sólo pueden subir archivos PDF, png o jpg'); window.history.go(-1);</script>";
        }
    }else{
        //regresar 
        echo "<script>alert('No se pudo actualizar'); window.history.go(-1);</script>";
    }
} catch (mysqli_sql_exception $e) {
    throw $e;   
}