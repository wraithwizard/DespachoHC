<!-- basado en https://www.youtube.com/watch?v=lwgG_uIJYQM -->

<?php 
    //esta funccion debe estar en cada archivo de sesion
    session_start(); 

    //si la varialbe está vavcía
    if (!isset($_SESSION["administrador"])) {
        //redirigir al loging
        header("location: ../index.php");
    }

    include("../model/conexion.php");   

    // variable necesaria para evitar errores
    $buscador = $_POST["buscador"]; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/dashboard.css" rel="stylesheet">
    <title>Despacho HC Dashboard</title>
</head>

<body>  
    <?php include("sidebar.php"); ?>
 
    <!--panel-->
    <div class="contenido">
        <div class="contenido-panel">
            <h1>Listado de clientes</h1>
            <button class="btn-crear-cliente" onclick="location.href='cr-forms.php'">Crear</button>
        </div> 
        
        <!-- buscador -->
        <form class="buscador" action="busqueda.php" method="POST">
            <label for="buscador" class="buscador-label">Buscar por nombre o apellido: </label>
            <input type="text" class="buscador-input" name="buscador" id="buscador">
            <button class="btn-crear-cliente btn-buscador" type="submit" name="buscar">Buscar</button>
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

        <!-- logica del buscador -->
        <?php 
            if (isset($_POST["buscador"])) {
            $busqueda = mysqli_real_escape_string($conexion, $_POST["buscador"]);
            // buscar por nombre o apellido paterno
            $sql = "SELECT * FROM cliente, direccion WHERE nombre LIKE '%$buscador%' AND direccion.idDir = cliente.idDir OR apellidoP LIKE '%$buscador%' AND direccion.idDir = cliente.idDir";
            $result = mysqli_query($conexion, $sql);
            // checa que haya resultados
            $queryResult = mysqli_num_rows($result);
    
            if ($queryResult > 0) {
                while($row = mysqli_fetch_assoc($result)){ ?>                
                    <!-- se llenan lo campos desde la tabla de la base datos-->
                    <div class="tabla__item"><a href="poliza-cliente.php?idCliente=<?php echo $row["idCliente"];?>"><?php echo $row["idCliente"];?></a></div>
                    <div class="tabla__item"><?php echo $row["nombre"];?></div>
                    <div class="tabla__item"><?php echo $row["apellidoP"];?></div>
                    <div class="tabla__item"><?php echo $row["apellidoM"];?></div>
                    <div class="tabla__item"><?php echo $row["email"];?></div>                  
                    <div class="tabla__item"><?php echo $row["rfc"];?></div>
                    <div class="tabla__item"><embed class="imagen" src="../img/ine/<?php echo $row["imagenIne"];?>"></div>
                    <div class="tabla__item"><?php echo $row["telefono"];?></div>
                    <div class="tabla__item"><?php echo $row["calle"];?></div>
                    <div class="tabla__item"><?php echo $row["numero"];?></div>
                    <div class="tabla__item"><?php echo $row["colonia"];?></div>
                    <div class="tabla__item"><?php echo $row["cp"];?></div>
                    <div class="tabla__item"><?php echo $row["municipio"];?></div>
                    <div class="tabla__item">
                        <a href="update.php?id=<?php echo $row["idCliente"];?>">Editar</a>
                        <p> | </p>
                        <a href="../model/delete-cliente.php?id=<?php echo $row["idCliente"];?>" class="btn-eliminar">Eliminar</a>                    
                </div>  
            <?php 
                }
                    //libera la memoria
                    mysqli_free_result($result);     
            }else{
                echo "<script>alert('No existe el cliente'); window.history.go(-1);</script>";
            }
        }?>
        </div>       
    </div> 

    <?php include("footer.php");?>
    <script src="../js/alerta-eliminacion.js"></script>

</body>
</html>