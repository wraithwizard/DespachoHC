<!-- librerias para la alerta -->
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="view/css/style.css" rel="stylesheet">
</head>

<!-- libre de inyeccion sql -->
<?php
include("model/conexion.php");

$usuario = $_POST["usuario"];
$clave = $_POST["clave"];

// $consultaAdmin = "SELECT * FROM administrador WHERE usuario = '$usuario' AND contrasena='$clave'";
// $consultaUsuario = "SELECT * FROM usuarioweb WHERE usuario = '$usuario' AND contrasena='$clave'";

$consultaAdmin = "SELECT * FROM usuarioweb WHERE usuario = ? AND contrasena= ?";

//preparar consulta
$resultado = mysqli_prepare($conexion, $consultaAdmin);

// $resultado = mysqli_query($conexion, $consultaAdmin);
// $resultado2 = mysqli_query($conexion, $consultaUsuario);

//paso de parametros, la s es tipo de dato texto
$ok = mysqli_stmt_bind_param($resultado, "ss", $usuario, $clave);
$ok = mysqli_stmt_execute($resultado);
$ok = mysqli_stmt_bind_result($resultado, $idUsuarioWeb, $email, $usuario, $contrasena, $rol);

if(mysqli_stmt_fetch($resultado)){
    try{
        //comprueba si la variable esta en la tabla administrador
        if (($resultado) && $rol =="admin") {   
            //crea la sesion
            session_start();
            $_SESSION["administrador"] = "$usuario";
            header("location: view/dashboard.php");
            //termina la ejecución
            exit();
        //si el que intena loguear es un cliente...
        } else if(($resultado) && $rol == "cliente"){
            session_start();
            $_SESSION["usuarioweb"] = "$usuario";
            header("location: view/usuario-web.php");
            exit();
        }           
    } catch (mysqli_sql_exception $e) {
        throw $e;    
    }
}else{
    // alerta https://stackoverflow.com/questions/36300919/how-to-reload-a-page-after-clicked-ok-using-sweetalert, https://www.youtube.com/watch?v=clwy6JLMuPU
    echo    '<script type="text/javascript"> $(document).ready(function(){
                swal({
                    icon: "error",
                    text: "Error de autenticación, favor de intentar de nuevo",
                    button: true,
                    button: "Regresar",
                    background: "#262626",
                }).then(function(){
                    window.location.href="index.php";
                })
            }); 
            </script>';
}

 //liberar resultados
mysqli_stmt_free_result($resultado);  

//cerrar conexion
mysqli_close($conexion);