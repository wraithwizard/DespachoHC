<?php
//esta funccion debe estar en cada archivo de sesion
session_start(); 

//si la varialbe está vavcía
if (!isset($_SESSION["usuarioweb"])) {
    //redirigir al loging
    header("location: index.php");
}

include("conexion.php");
include("../controller/alertaLibreria.php");

//datos direccion
$idUserWeb = $_POST["updatingId"];
$email = $_POST["updateEmail"];
$pw = $_POST["updatePw"];

try {
    if (isset($_POST["actualizarUsuarioWeb"])) {
        $userWebUpdate = "UPDATE usuarioweb SET email='$email', contrasena='$pw' WHERE idUsuarioWeb='$idUserWeb'";
        $resultado2 = mysqli_query($conexion, $userWebUpdate);   
    }
    if($resultado2){      
        //mi alerta
        $alerta = new Alerta();  
        $location = "../view/usuario-web.php";    
        $alerta->success($location, "Actualización exitosa");
        // echo "idUsuario: $idUserWeb<br> email: $email<br> usuario: $usuario<br> password: $pw";
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
