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

//datos poliza
$idPoliza = $_POST["idPoliza"];
$ramo = $_POST["updatingRamo"];
$suma = $_POST["updatingSumaAsegurada"];
$deducible = $_POST["updatingDeducible"];
$coaseguro = $_POST["updatingCoaseguro"];
$vigenciaI = $_POST["vigenciaI"];
$vigenciaF  = $_POST["vigenciaF"];
$numero = $_POST["updatingNumero"];
$cantidad = $_POST["updatingCantidad"];

// actualiza los datos
try {
    if (isset($_POST["actualizarDatos"])) {
        $polizaUpdate = "UPDATE poliza SET ramo='$ramo', sumaAsegurada='$suma', deducible='$deducible', coaseguro='$coaseguro', vigenciaInicial='$vigenciaI', vigenciaTerminal='$vigenciaF', numeroPoliza='$numero', cantidadAsegurados='$cantidad' WHERE idPoliza='$idPoliza'";
        $resultado = mysqli_query($conexion, $polizaUpdate);   
        
        if($resultado){      
            //mensaje de alerta, si tiene exito regresar al index
            echo "<script>alert('Actualización exitosa'); window.history.go(-1);</script>";
        }else{
            //regresar 
            echo "<script>alert('No se pudo actualizar'); window.history.go(-1);</script>";
        }
    // actualiza la caratula y comprueba si el boton de actualizarCaratula fue oprimido y borra el archio de la carátula vieja
    }else if(isset($_POST["actualizarPoliza"]) && !empty($_FILES["file"]["name"] && !isset($_POST["actualizarDatos"]))){
        //saber el nombre del viejo archivo
        $viejoArchivo = "SELECT imagenCaratula FROM poliza WHERE idPoliza='$idPoliza'";
        $nameCheck = mysqli_query($conexion, $viejoArchivo);      
           
        //me da el nombre del arhivo viejo
        //pasar el nombre aun string
        // concanternar el path con el string
            while ($row = mysqli_fetch_assoc($nameCheck)){
            $filename = $row["imagenCaratula"];
            //echo "el filename es, $fileType";
            //el path del file
            $targetPath = "../pdfs/";
            $targetFilePath = $targetPath . $filename;
        }

        //borra el archivo
        if (file_exists($targetFilePath)) {
            unlink($targetFilePath);
            //echo "Archivo viejo borrado";
        }else{
            //echo "No pude borrar el archivo viejo";
        }            

        // para editar, solo se debe subir otro archivo
        $targetDir = "../pdfs/";
        $filename = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $filename;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);   
        //echo $targetDir, $filename, $targetFilePath, $fileType;
        // permitir formato pdf
        $allowTypes = array('jpg', 'pdf');
        // determina el limite del archivo en kb
        $limite = 50000;
        // ref: https://www.youtube.com/watch?v=gkHpTSUFmrg
        if (in_array($fileType, $allowTypes) && $_FILES["file"]["size"] <= $limite * 1024) {
            // subir archivo
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                //intento de insercion de nombre a la tabla poliza
                $insertarPDF = "UPDATE poliza SET imagenCaratula='$filename' WHERE idPoliza='$idPoliza'";
                $insert = mysqli_query($conexion, $insertarPDF);  
                if ($insert) {
                    echo "<script>alert('Actualización de carátula exitosa'); window.history.go(-1);</script>";
                }
            }else{
                echo "<script>alert('Error al subir el archivo'); window.history.go(-1);</script>";
            }           
        }else{
            "<script>alert('Sólo pueden subir archivos PDF o jpg'); window.history.go(-1);</script>";
        }
        }else{
            "<script>alert('Favor de seleccionar un archivo'); window.history.go(-1);</script>";        
    }  
} catch (mysqli_sql_exception $e) {
    throw $e;   
}