<?php  
  //esta funccion debe estar en cada archivo de sesion
  session_start(); 

  //si la varialbe está vavcía
  if (!isset($_SESSION["administrador"])) {
      //redirigir al loging
      header("location: ../index.php");
  }
  
require ("conexion.php");
include("../controller/alertaLibreria.php");

$cliente = $_POST["clienteId"];
$ramo = $_POST["ramo"];
$suma = $_POST["sumaAsegurada"];
$deducible = $_POST["deducible"];
$coaseguro = $_POST["coaseguro"];
$periodicidad = $_POST["periodicidad"];
$vigenciaI = $_POST["vigenciaI"];
$vigenciaF = $_POST["vigenciaF"];
$numeroPoliza = $_POST["numeroPoliza"];
$cantidadAsegurados = $_POST["asegurados"];
// manejo del file
$targetDir = "../pdfs/";
$filename = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $filename;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

// datos para la tabla prima
$prima = $_POST["primaNeta"];
$tipo = $_POST["tipoCobro"];
$subtipo = $_POST["subtipo"];

$alert = new Alerta();

if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
    // permitir formato pdf
    $allowTypes = array('jpg', 'pdf');
    //determina el limite del archivo en kb
    $limite = 15000;
    // dentro del condicional deberia estar: $_FILES["file"]["size"] <= limite * 1024;
    // ref: https://www.youtube.com/watch?v=gkHpTSUFmrg
    if (in_array($fileType, $allowTypes) && $_FILES["file"]["size"] <= $limite * 1024) {
        // subir archivo
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            //insercion de nombre a la tabla poliza
            $insertarPDF = "INSERT INTO poliza (ramo, sumaAsegurada, deducible, coaseguro, periodicidad, vigenciaInicial, VigenciaTerminal, numeroPoliza, cantidadAsegurados, imagenCaratula, idCliente) VALUES ('$ramo', '$suma', '$deducible', '$coaseguro', '$periodicidad', '$vigenciaI', '$vigenciaF', '$numeroPoliza', '$cantidadAsegurados', '$filename', '$cliente')";
            $insert = mysqli_query($conexion, $insertarPDF);  
            //me da el id de la poliza
            $idPoliza = mysqli_insert_id($conexion);
            if ($insert) {
                //insertar datos en tabla prima
                $insertPrima = "INSERT INTO prima (primaNeta, tipoCobro, subtipo) VALUES ('$prima', '$tipo', '$subtipo')";
                $resultado2 = mysqli_query($conexion, $insertPrima);

                if($insert && $insertPrima){
                    //capturar id de la prima
                    $idPrima = mysqli_insert_id($conexion);
                    //y actualizar la tabla poliza
                    $updatePoliza = "UPDATE poliza SET idPrima = '$idPrima' WHERE idPoliza = '$idPoliza'";
                    $actualizacion = mysqli_query($conexion, $updatePoliza);
                }
                //alertar
                //echo "Numero poliza:" ,$numeroPoliza;
                $location = "../view/dashboard.php";
                $alert->success($location, "Registro exitoso");             
            }
        }else{
            echo "<script>alert('Error al subir el archivo'); window.history.go(-1);</script>";
        }           
    }else{
        "<script>alert('Sólo pueden subir archivos PDF o jpg menores a 15MB'); window.history.go(-1);</script>";
    }
    }else{
        "<script>alert('Favor de seleccionar un archivo'); window.history.go(-1);</script>";
}