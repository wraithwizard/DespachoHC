<?php
//esta funccion debe estar en cada archivo de sesion
session_start(); 

//si la varialbe está vavcía
if (!isset($_SESSION["usuarioweb"])) {
    //redirigir al loging
    header("location: ../index.php");
}

include("conexion.php");

//datos cliente
$idUsuarioWeb = $_GET["id"];

$deleteUsuarioWeb = "DELETE usuarioweb FROM usuarioweb WHERE usuarioweb.idUsuarioWeb='$idUsuarioWeb'";

try {    
    $resultadoEliminar = mysqli_query($conexion, $deleteUsuarioWeb);
    if ($resultadoEliminar) {
        //session_unset() libera la variable de sesión que se encuentra registrada 
        session_unset($_SESSION["usuarioweb"]);
        // Destruye la información de la sesión
        session_destroy();
        //volver al login
        header("location: ../index.php"); 
    } else {
        echo '<script type="text/javascript"> $(document).ready(function(){
            swal({
                icon: "error",
                text: "No se pudo eliminar",
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

