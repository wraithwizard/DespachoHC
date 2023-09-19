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
    $siniestro = "SELECT * FROM siniestro WHERE idSiniestro ='$id'";   
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <title>Despacho HC Dashboard Editar siniestro</title>
</head>

<body>  
    <?php include("sidebar.php"); ?>
 
    <!--panel-->
    <div class="contenido">
        <div class="contenido-panel">
            <h1>Edición de siniestro</h1>
        </div>       
   
        <form class="datos-prima-update" action="../model/actualizar-siniestro.php" method="post">
            <div class="tabla__titulo-siniestro-update">Datos del siniestro</div>
            <!-- <div class="tabla__header">ID</div> -->
            <div class="tabla__header">Número</div>
            <div class="tabla__header">Nombre</div>
            <div class="tabla__header">Fecha</div>
            <div class="tabla__header">Descripción</div>
            <div class="tabla__header">Indemización</div>
            <div class="tabla__header">Estado</div>
            <div class="tabla__header">Lugar</div>
            <?php              
                $resultado =  mysqli_query($conexion, $siniestro); 
                //cargar y mostrar datos
                while ($row = mysqli_fetch_assoc($resultado)){ 
            ?>
                <!-- se llenan lo campos desde la tabla de la base datos-->
                <input type="text" class="tabla__item" value="<?php echo $row["folio"];?>" name="updatingFolio">
                <input type="hidden" class="tabla__item" value="<?php echo $row["idSiniestro"];?>" name="updatingIdSiniestro">
                <input type="text" class="tabla__item" value="<?php echo $row["nombreSiniestro"];?>" name="updatingNombre">
                <input type="data" class="tabla__item" value="<?php echo $row["fechaSiniestro"];?>" name="updatingFecha">
                <input type="text" class="tabla__item" value="<?php echo $row["diagnostico"];?>" name="updatingDiagnostico">
                <input type="number" class="tabla__item" value="<?php echo $row["indemnizacion"];?>" name="updatingIndemnizacion">
                <input type="text" class="tabla__item" value="<?php echo $row["estadoSiniestro"];?>" name="updatingEdo">
                <input type="text" class="tabla__item" value="<?php echo $row["lugar"];?>" name="updatingLugar">
            <?php          
                } 
                //libera la memoria
                mysqli_free_result($resultado); 
            ?>        
            <input type="submit" value="Actualizar" class="datos-update-submit" name="actualizarSiniestro">
        </form>
    </div> 

    <?php include("footer.php");?>
</body>
</html>