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
$idUsuarioWeb = $_GET["id"];

$eliminarAdmin = "DELETE usuarioweb FROM usuarioweb WHERE usuarioweb.idUsuarioWeb='$idUsuarioWeb'";

try {    
    $resultadoEliminar = mysqli_query($conexion, $eliminarAdmin);
    if ($resultadoEliminar) {
        header("location: ../view/usuarios.php");
    } else {
        // echo "<script>alert ('No se pudo eliminar el objeto seleccionado'); window.history.go(-1); </script>";
        echo '<script type="text/javascript"> $(document).ready(function(){
            swal({
                icon: "error",
                text: "No se pudo actualizar",
                button: true,
                button: "Regresar",
                background: "#262626",
            }).then(function(){
                window.history.go(-1)";
            })
        }); 
        </script>';
    }    
 } catch (mysqli_sql_exception $e) {
     throw $e;
}

