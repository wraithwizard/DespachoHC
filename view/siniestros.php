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
    //como hacer joins? ref: https://www.w3schools.com/sql/sql_join.asp
    $siniestro = "SELECT *, poliza.numeroPoliza FROM siniestro LEFT JOIN poliza ON siniestro.idPoliza = poliza.idPoliza";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/dashboard.css" rel="stylesheet">
    <title>Despacho HC - siniestros </title>
</head>

<body>  
    <?php include("sidebar.php"); ?>
 
    <!--panel-->
    <div class="contenido">
        <div class="contenido-panel">
            <h1>Listado de Siniestros</h1>
            <button class="btn-crear-cliente btn-animated" onclick="location.href='cr-siniestro.php'">Crear</button>
        </div> 

         <!-- la tabla de siniestro -->
         <div class="datos__siniestros">
            <div class="tabla__titulo--siniestros">Siniestros</div>
            <div class="tabla__header">Número</div>           
            <div class="tabla__header">Nombre</div>
            <div class="tabla__header">Fecha</div>
            <div class="tabla__header">Número de póliza</div>
            <div class="tabla__header">Descripción</div>
            <div class="tabla__header">Indemnización</div>
            <div class="tabla__header">Estado</div>
            <div class="tabla__header">Lugar</div>
            <div class="tabla__header">Finalizar</div>
            <div class="tabla__header">Operación</div>   
            <?php              
                $resultado =  mysqli_query($conexion, $siniestro); 
                //cargar y mostrar datos
                while ($row = mysqli_fetch_assoc($resultado)){ 
            ?>
                <div class="tabla__item"><?php echo $row["folio"];?></div>
                <div class="tabla__item"><?php echo $row["nombreSiniestro"];?></div>
                <div class="tabla__item"><?php echo $row["fechaSiniestro"];?></div>
                <div class="tabla__item"><?php echo $row["numeroPoliza"];?></div>
                <div class="tabla__item"><?php echo $row["diagnostico"];?></div>              
                <div class="tabla__item"><?php echo $row["indemnizacion"];?></div>
                <div class="tabla__item"><?php echo $row["estadoSiniestro"];?></div>
                <div class="tabla__item"><?php echo $row["lugar"];?></div>
                <div class="tabla__item"><?php echo $row["finalizado"];?></div>
                <div class="tabla__item">
                    <!-- checar que funcione -->
                    <a href="update-siniestro.php?id=<?php echo $row["idSiniestro"];?>"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit btn-animated" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                    <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                    <line x1="16" y1="5" x2="19" y2="8" />
                    </svg></a>
                    <p> - </p>
                    <a href="../model/delete-siniestro.php?id=<?php echo $row["idSiniestro"];?>" class="btn-eliminar btn-animated"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
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