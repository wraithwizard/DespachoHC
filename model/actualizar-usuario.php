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

//datos direccion
$idAdmin = $_POST["updatingIdAdmin"];
$email = $_POST["updatingEmail"];
$usuario = $_POST["updatingUsuario"];
$rol = $_POST["updatingRol"];
$pw = $_POST["updatingPassword"];

try {
    if (isset($_POST["actualizarUsuario"])) {
        $userUpdate = "UPDATE usuarioweb SET email='$email', usuario='$usuario', contrasena='$pw', rol='$rol' WHERE idUsuarioWeb='$idAdmin'";
        $resultado2 = mysqli_query($conexion, $userUpdate);   
    }
    if($resultado2){      
        //mi alerta
        $alerta = new Alerta();  
        $location = "../view/usuarios.php";    
        $alerta->success($location, "Actualización exitosa");
        //echo "idUsuario: $idAdmin<br> email: $email<br> usuario: $usuario<br> rol: $rol<br> password: $pw";
    }else{
        //regresar 
        // echo "<script>alert(''No se pudo actualizar''); window.history.go(-1);</script>";
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
