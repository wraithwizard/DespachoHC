<?php
include ("conexion.php");

$email = $_POST["email"];
$usuario = $_POST["usuarioRegistro"];
$password = $_POST["password"];
$rol = $_POST["rol"];
$passwordConfirm = $_POST["passwordMatch"];

//para conocer si ya existe el usuario
$consultaCheck = "SELECT usuario FROM usuarioweb WHERE usuario = '$usuario'";
$resultado2 = mysqli_query($conexion, $consultaCheck);
$count = mysqli_num_rows($resultado2);

if ($passwordConfirm != $password) {
    echo "<script>alert('Las contraseñas no coinciden'); window.history.go(-1);</script>";
    exit();
//si ya existe el email...
}else if($count > 0) {
    echo "<script>alert('El usuario ya existe'); window.history.go(-1);</script>";
    exit();
}else{
    try {
        $insertar = "INSERT INTO usuarioweb (email, usuario, contrasena, rol) VALUES ('$email', '$usuario', '$password', '$rol')";
        $resultado = mysqli_query($conexion, $insertar);     

        if ($resultado){
            echo "<script>alert('Registro exitoso'); window.location='../index.php'</script>";
            exit();
        }else{
            echo "<script>alert('No se pudo registrar'); window.history.go(-1);</script>";
            exit();
        }
    } catch (mysqli_sql_exception $e) {
        throw $e;   
    }
}