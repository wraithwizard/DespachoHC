<?php 
    //esta funccion debe estar en cada archivo de sesion
    session_start(); 

    //si la varialbe está vavcía
    if (!isset($_SESSION["administrador"])) {
        //redirigir al loging
        header("location: ../index.php");
    }

    include("../model/conexion.php");      
    //recibir variable id
    $id = $_GET["id"];

    //consulta para editar el idCliente
    $clientes = "SELECT cliente.idCliente, cliente.nombre, cliente.apellidoP, cliente.apellidoM, cliente.email, cliente.rfc, cliente.imagenIne, cliente.telefono, cliente.idDir, direccion.idDir, direccion.calle, direccion.numero, direccion.colonia, direccion.cp, direccion.municipio FROM cliente, direccion WHERE direccion.idDir=cliente.idDir AND cliente.idCliente='$id'";   
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="css/update.css" rel="stylesheet">
    <title>Despacho HC Dashboard-edición</title>
</head>

<body>  
    <?php include("sidebar.php"); ?>
 
    <!--panel-->
    <div class="contenido">
        <div class="contenido-panel">
            <h1>Listado de clientes-edición</h1>
            <button class="btn-crear-cliente btn-animated" onclick="location.href='cr-forms.php'">Crear</button>
        </div> 
        
        <div class="buscador"></div>

        <!-- la tabla de clientes -->
        <form class="datos" action="../model/actualizar-cliente.php" method="post" enctype="multipart/form-data" onsubmit="return validarActualizacionClientes();">
            <div class="tabla__titulo">Datos del cliente</div>
            <!-- <div class="tabla__header">ID</div> -->
            <div class="tabla__header">Nombre</div>
            <div class="tabla__header">Apellido Paterno</div>
            <div class="tabla__header">Apellido Materno</div>
            <div class="tabla__header">Email</div>          
            <div class="tabla__header">RFC</div>
            <div class="tabla__header">Teléfono</div>            
            <!--items que son las columnas en la tabla de cliente-->
            <!--pido conexion, se pone primero la conexion, despues la variable con el query-->
            <?php              
                $resultado =  mysqli_query($conexion, $clientes); 
                //cargar y mostrar datos
                while ($row = mysqli_fetch_assoc($resultado)){ 
            ?>
                <!-- se llenan lo campos desde la tabla de la base datos-->
                <input type="hidden" class="tabla__item" value="<?php echo $row["idCliente"];?>" name="updatingIdCliente">
                <input type="text" class="tabla__item" value="<?php echo $row["nombre"];?>" id="updatingNombre" name="updatingNombre">
                <input type="text" class="tabla__item" value="<?php echo $row["apellidoP"];?>" id="updatingApellidoP" name="updatingApellidoP">
                <input type="text" class="tabla__item" value="<?php echo $row["apellidoM"];?>" id="updatingApellidoM" name="updatingApellidoM">
                <input type="email" class="tabla__item" value="<?php echo $row["email"];?>" id="updatingEmail" name="updatingEmail">              
                <input type="text" class="tabla__item" value="<?php echo $row["rfc"];?>" id="updatingRfc" name="updatingRfc">               
                <input type="tel" class="tabla__item" value="<?php echo $row["telefono"];?>" id="updatingTel" name="updatingTel"  pattern="[0-9]{10}">    
            <?php          
                } 
                //libera la memoria
                mysqli_free_result($resultado); 
            ?>        
            <input type="submit" value="Actualizar" class="datos-update-submit btn-animated" name="actualizarCliente">
        </form>
    </div> 

    <!-- MTETER OPCION PARA EDITAR IMAGEN -->    
     <form class="datos-INE" action="../model/actualizar-INE-cliente.php" method="post"  enctype="multipart/form-data">           
            <div class="tabla__header">INE</div>            
            <?php             
                $resultado =  mysqli_query($conexion, $clientes); 
                //cargar y mostrar datos
                while ($row = mysqli_fetch_assoc($resultado)){
                    if (empty($row ["imagenIne"])) {
            ?>          
                        <input class="datos__INE-img" type="file" name="imagenIne">   
                        <input type="hidden" class="tabla__item" value="<?php echo $row["idCliente"];?>" name="idCliente">    
            <?php          
                    }else{ 
            ?>
                        <input type="hidden" class="tabla__item" value="<?php echo $row["idCliente"];?>" name="idCliente">
                        <img class="datos__INE-img" src="../img/ine/<?php echo $row["imagenIne"];?>">
                        <input type="file" name="imagenIne">       
            <?php   }
                }
                //libera la memoria
                mysqli_free_result($resultado); 
            ?>        
            <input type="submit" value="Actualizar" class="datos-update-submit btn-animated" name="actualizarINE">
        </form>
    </div>      

     <!-- la tabla de direccion -->
     <form class="datos-dir" action="../model/actualizar-dir-cliente.php" method="post">           
            <div class="tabla__header">Calle</div>
            <div class="tabla__header">Número</div>
            <div class="tabla__header">Colonia</div>
            <div class="tabla__header">Código Postal</div>
            <div class="tabla__header">Municipio</div>          
            <!--pido conexion, se pone primero la conexion, despues la variable con el query-->
            <?php              
                $resultado =  mysqli_query($conexion, $clientes); 
                //cargar y mostrar datos
                while ($row = mysqli_fetch_assoc($resultado)){ 
            ?>
                <!-- se llenan lo campos desde la tabla de la base datos-->
                <input type="hidden" class="tabla__item" value="<?php echo $row["idDir"];?>" name="idDir">
                <input type="text" class="tabla__item" value="<?php echo $row["calle"];?>" name="updatingCalle">
                <input type="text" class="tabla__item" value="<?php echo $row["numero"];?>" name="updatingNumero">
                <input type="text" class="tabla__item" value="<?php echo $row["colonia"];?>" name="updatingCol">
                <input type="text" class="tabla__item" value="<?php echo $row["cp"];?>" name="updatingCp">
                <input type="text" class="tabla__item" value="<?php echo $row["municipio"];?>" name="updatingMunicipio">
            <?php          
                } 
                //libera la memoria
                mysqli_free_result($resultado); 
            ?>        
            <input type="submit" value="Actualizar" class="datos-update-submit btn-animated" name="actualizarDir">
        </form>
    </div>      

    <?php include("footer.php");?>
    <script src="../js/validacionFormClientes.js"></script> 

</body>
</html>