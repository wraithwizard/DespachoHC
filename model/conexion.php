<?php
//cambiar segun servidor
$conexion = mysqli_connect("localhost", "root", "admin", "proyectoterminal");

//para los caracteres
mysqli_set_charset($conexion, "utf8");

if (!$conexion) {
    echo "Error: No se pudo conectar a MySQL.";  
    echo "error de depuración: " . mysqli_connect_error();
    //funciona como trycatch
    exit;
}