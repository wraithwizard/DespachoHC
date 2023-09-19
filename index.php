<?php include("view/header.php");
?>

<body>      
    <header class="header">
            <img class="logo" src="img/LOGOTIPO_RENOVADO.png" alt="logo">
    </header>
    
    <main>    
    <div class="form-box">
        <form class="login" id="loginID" action="loginValidacion.php" method="post" onsubmit="return submitUserForm();">
            <h2>Iniciar sesión</h2>
            <!-- el codigo del placeholder es de https://unicode-table.com/es/-->
            <input type="text" placeholder="&#9919; Usuario" name="usuario">
            <input type="password" placeholder="&#9919; Contraseña" name="clave">

            <!--implementar CAPTCHA v2, el v3 no funciono, el callback es para registra la respuesta-->
            <div class="g-recaptcha" data-sitekey="theKey" data-callback="verifyCaptcha"></div>     
            <div id="g-recaptcha-error"></div>
            
            <div class="checker">
                <!-- <input type="checkbox" class="check-box" id="recuerdame">
                <label for="recuerdame" class="recordar">Recordar usuario</label> -->
            </div>  
            <input class="btn-animated" type="submit" value="Ingresar">
            <a href="#" id=btnRegistrar class="registrar">Registrar</a>          
        </form>   

        <!--Formulario crear usuario-->
        <form class="login" id="loginRegistro" method="post" action="model/insertar-usuarioweb.php" onsubmit="return validar();"> 
            <h2>Crear cuenta</h2>                
            <input type="email" id="email" placeholder="Email" name="email" class="input=40"  required>   
            <input type="text" id="usuario" placeholder="Usuario" name="usuarioRegistro" required>
            <input type="password" id="password" placeholder="Contraseña" name="password" required>
            <input type="password" placeholder="Confirmar contraseña" name="passwordMatch" required>
            <select hidden type="select" name="rol">
                <option value="cliente"></option>
            </select>
            <input type="submit" value="Registrar" class="btn-registrar">
            <p class="recordar-login">¿Ya tienes cuenta?</p><a href="#" id=btnVolver class="btn-recordar">Ingresa aquí</a>      
        </form>      
        </div>  
    </main>  

    <?php include("view/footer.php");?>
   
    <!--API del CAPTCHA al español-->
    <script src="https://www.google.com/recaptcha/api.js?hl=es-419"></script>
    <script src="js/login.js"></script> 
</body>
</html>