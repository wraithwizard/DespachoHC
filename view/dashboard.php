<?php 
    //esta funccion debe estar en cada archivo de sesion
    session_start(); 

    //si la varialbe está vavcía
    if (!isset($_SESSION["administrador"])) {
        //redirigir al loging
        header("location: ../index.php");
    }

    include("../model/conexion.php");
    
    //consulta 
    $clientes = "SELECT cliente.idCliente, cliente.nombre, cliente.apellidoP, cliente.apellidoM, cliente.email, cliente.rfc, cliente.imagenIne, cliente.telefono, direccion.calle, direccion.numero, direccion.colonia, direccion.cp, direccion.municipio FROM cliente, direccion WHERE direccion.idDir=cliente.idDir";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/dashboard.css" rel="stylesheet">
    <title>Despacho HC Dashboard</title>
    <!-- el icono del titulo -->
    <link rel="shortcut icon" href="../img/favicon.ico" />
</head>

<body>  
    <?php include("sidebar.php"); ?>
 
    <!--panel-->
    <div class="contenido">
        <div class="contenido-panel">
            <h1>Listado de clientes</h1>
            <button class="btn-crear-cliente btn-animated" onclick="location.href='cr-forms.php'">Crear</button>
        </div> 
        
        <!-- buscador -->
        <form class="buscador" action="busqueda.php" method="POST">
            <label for="buscador" class="buscador-label">Buscar por nombre o apellido: </label>
            <input type="text" class="buscador-input" name="buscador" id="buscador">
            <button class="btn-crear-cliente btn-buscador btn-animated" type="submit" name="buscar">Buscar</button>
        </form>

        <!-- la tabla de clientes -->
        <div class="datos">
            <div class="tabla__titulo">Datos del cliente</div>
            <div class="tabla__header">ID</div>
            <div class="tabla__header">Nombre</div>
            <div class="tabla__header">Apellido Paterno</div>
            <div class="tabla__header">Apellido Materno</div>
            <div class="tabla__header">Email</div>           
            <div class="tabla__header">CURP</div>
            <div class="tabla__header">INE</div> 
            <div class="tabla__header">Teléfono</div>  
            <div class="tabla__header">Calle</div>      
            <div class="tabla__header">Número</div>      
            <div class="tabla__header">Colonia</div>    
            <div class="tabla__header">CP</div>        
            <div class="tabla__header">Municipio</div>     
            <div class="tabla__header">Operación</div>   
            <!--items que son las columnas en la tabla de cliente-->
            <!--pido conexion, se pone primero la conexion, despues la variable con el query-->
            <?php              
                $resultado =  mysqli_query($conexion, $clientes); 
                //cargar y mostrar datos
                while ($row = mysqli_fetch_assoc($resultado)){ 
            ?>
                <!-- se llenan lo campos desde la tabla de la base datos-->
                <!-- Obtener el id -->
                <div class="tabla__item"><a href="poliza-cliente.php?idCliente=<?php echo $row["idCliente"];?>"><?php echo $row["idCliente"];?></a></div>
                <div class="tabla__item"><?php echo $row["nombre"];?></div>
                <div class="tabla__item"><?php echo $row["apellidoP"];?></div>
                <div class="tabla__item"><?php echo $row["apellidoM"];?></div>
                <div class="tabla__item"><?php echo $row["email"];?></div>              
                <!-- convierte en link el echo de la variable rfc (https://stackoverflow.com/questions/10051007/make-php-variable-provide-link) -->
                <div class="tabla__item"><?php echo $row["rfc"];?></div>
                <div class="tabla__item"><embed class="imagen" src="../img/ine/<?php echo $row["imagenIne"];?>"></div>
                <!-- datos direccion -->
                <div class="tabla__item"><?php echo $row["telefono"];?></div>
                <div class="tabla__item"><?php echo $row["calle"];?></div>
                <div class="tabla__item"><?php echo $row["numero"];?></div>
                <div class="tabla__item"><?php echo $row["colonia"];?></div>
                <div class="tabla__item"><?php echo $row["cp"];?></div>
                <div class="tabla__item"><?php echo $row["municipio"];?></div>
                <div class="tabla__item">
                    <!-- checar que funcione -->
                    <a href="update.php?id=<?php echo $row["idCliente"];?>"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit btn-animated" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                    <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                    <line x1="16" y1="5" x2="19" y2="8" />
                    </svg></a>
                    <p> - </p>
                    <a href="../model/delete-cliente.php?id=<?php echo $row["idCliente"];?>" class="btn-eliminar"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash btn-animated" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <line x1="4" y1="7" x2="20" y2="7" />
                    <line x1="10" y1="11" x2="10" y2="17" />
                    <line x1="14" y1="11" x2="14" y2="17" />
                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                    </svg></a>                    
                </div>               
            <?php
                } //hasta aca llega el while

                //libera la memoria
                mysqli_free_result($resultado); 
            ?>             
        </div>
    </div> 

    <?php include("footer.php");?>
    <script src="../js/alerta-eliminacion.js"></script>
</body>
</html>