<!-- librerias para la alerta -->
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="../view/css/style.css" rel="stylesheet">
</head>

<?php
include ("conexion.php");

$email = $_POST["email"];
$rol = $_POST["rol"];
$username = $_POST["username"];
$pw = $_POST["pw"];
$passwordConfirm = $_POST["passwordMatch"];

//para conocer si ya existe el usuario
$consultaCheck = "SELECT usuario, email FROM usuarioweb WHERE usuario = '$username'";
$resultado2 = mysqli_query($conexion, $consultaCheck);
$count = mysqli_num_rows($resultado2);

if($passwordConfirm != $pw){   
    echo '<script type="text/javascript"> $(document).ready(function(){
        swal({
            icon: "error",
            text: "Las contraseñas no coinciden, favor de intentar de nuevo",
            button: true,
            button: "Regresar",
            background: "#262626",
        }).then(function(){
            window.location.href="../view/cr-usuario.php";
        })
    }); 
    </script>';
    exit();
   
    //validacion de que no exista el usuario
    }else if($count> 0){
        echo '<script type="text/javascript"> $(document).ready(function(){
            swal({
                icon: "error",
                text: "El usuario ya existe",
                button: true,
                button: "Regresar",
                background: "#262626",
            }).then(function(){
                window.location.href="../view/cr-usuario.php";
            })
        }); 
        </script>';
        exit();
    }else{
        try{
            $insertarAdmin = "INSERT INTO usuarioweb (email, usuario, contrasena, rol) VALUES ('$email', '$username', '$pw', '$rol')";
            $insercionUser = mysqli_query($conexion, $insertarAdmin);  
            if ($insercionUser) {       
                //revisar direccion al subir al host, cambiar a: windows.location=/view/dashboard'
                // echo "<script>alert('Registro de cliente exitoso'); window.location='../view/usuarios.php'</script>";
                echo '<script type="text/javascript"> $(document).ready(function(){
                    swal({
                        text: "Usuario registrado exitosamente",
                        button: true,
                        button: "Regresar",
                        background: "#262626",
                    }).then(function(){
                        window.location.href="../view/cr-usuario.php";
                    })
                }); 
                </script>';
            } else {
                //regresar 
                echo '<script type="text/javascript"> $(document).ready(function(){
                    swal({
                        icon: "success",
                        text: "Usuario registrado exitosamente",
                        button: true,
                        button: "Regresar",
                        background: "#262626",
                    }).then(function(){
                        window.history.go(-1;
                    })
                }); 
                </script>';

                // echo "<script>alert('No se pudo registrar al cliente'); window.history.go(-1);</script>";
            }
        } catch (mysqli_sql_exception $f) {
                throw $f;   
        }
    }