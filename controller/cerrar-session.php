<?php 
session_start();
 
//comprobar que un usuario registrado es el que accede al archivo
if (!isset($_SESSION["administrador"]) || !isset($_SESSION["usuarioweb"])) {
    header("location: ../index.php"); 
}
 
//session_unset() libera la variable de sesión que se encuentra registrada 
session_unset($_SESSION["administrador"], $_SESSION["usuarioweb"]);
 
// Destruye la información de la sesión
session_destroy();
 
//volver al login
header("location: ../index.php"); 

?>