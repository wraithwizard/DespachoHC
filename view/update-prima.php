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

    //consulta 
    $prima = "SELECT * FROM prima WHERE idPrima ='$id'";   
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/dashboard.css" rel="stylesheet">
    <title>Despacho HC Dashboard Editar cobranza</title>
</head>

<body>  
    <?php include("sidebar.php"); ?>
 
    <!--panel-->
    <div class="contenido">
        <div class="contenido-panel">
            <h1>Edición de cobranza</h1>
        </div>       
   
        <form class="datos-prima-update" action="../model/actualizar-prima.php" method="post" onsubmit="return validacionCobranzaUpdate();">
            <div class="tabla__titulo-prima-update">Datos de la cobranza</div>
            <!-- <div class="tabla__header">ID</div> -->
            <div class="tabla__header">Prima neta</div>
            <div class="tabla__header">Tipo de cobro</div>
            <div class="tabla__header">Subtipo</div>
            <?php              
                $resultado =  mysqli_query($conexion, $prima); 
                //cargar y mostrar datos
                while ($row = mysqli_fetch_assoc($resultado)){ 
            ?>
                <!-- se llenan lo campos desde la tabla de la base datos-->
                <input type="hidden" class="tabla__item" value="<?php echo $row["idPrima"];?>" name="updatingIdPrima">
                <!-- step="any" valida decimales -->
                <!-- ref: https://isotoma.com/blog/2012/03/02/html5-input-typenumber-and-decimalsfloats-in-chrome/ -->
                <input type="number" step="any" id="prima" class="tabla__item" value="<?php echo $row["primaNeta"];?>" name="updatingPrima">
                <input type="text" id="tipo" class="tabla__item" value="<?php echo $row["tipoCobro"];?>" name="updatingtipoCobro">
                <input type="text" id="subtipo" class="tabla__item" value="<?php echo $row["subtipo"];?>" name="updatingSubtipo">
            <?php          
                } 
                //libera la memoria
                mysqli_free_result($resultado); 
            ?>        
            <input type="submit" value="Actualizar" class="datos-update-submit" name="actualizarPrima">
        </form>
    </div> 

    <?php include("footer.php");?>
    <script src="../js/validacionFormClientes.js"></script> 
</body>
</html>