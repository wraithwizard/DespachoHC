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
    $id = $_GET["idCliente"];

    //consulta para editar el idCliente
    $poliza = "SELECT cliente.idCliente, cliente.nombre, cliente.apellidoP, cliente.apellidoM, poliza.imagenCaratula FROM cliente, poliza WHERE cliente.idCliente='$id' AND poliza.idCliente=cliente.idCliente";   
    
    //consulta los datos de poliza
    $polizaDatos = "SELECT poliza.ramo, poliza.sumaAsegurada, poliza.deducible, poliza.periodicidad, poliza.coaseguro, poliza.vigenciaInicial, poliza.vigenciaTerminal, poliza.numeroPoliza, poliza.cantidadAsegurados FROM poliza, cliente WHERE cliente.idCliente = '$id' AND poliza.idCliente = cliente.idCliente";

    //consulta solo la caratula
    $caratula = "SELECT idPoliza, imagenCaratula FROM poliza WHERE poliza.idCliente = '$id'";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/dashboard.css" rel="stylesheet">
    <title>Despacho HC - Póliza cliente</title>
</head>

<body>  
    <?php include("sidebar.php"); ?>
 
    <!--panel-->
    <div class="contenido-polizas">
        <div class="contenido-panel">
            <h1>Pólizas</h1>
            <button class="btn-crear-cliente btn-animated" onclick="location.href='cr-poliza.php'">Crear</button>
        </div> 

        <!-- datos cliente -->
        <div class="datos-poliza__view">       
            <div class="tabla__titulo--poliza">Póliza del cliente</div>
            <div class="tabla__header">Nombre</div>
            <div class="tabla__header">Apellido Paterno</div>
            <div class="tabla__header">Apellido Materno</div>    

        <!--pido conexion, se pone primero la conexion, despues la variable con el query-->
        <?php              
                // da resultados de los datos del cliente
                $resultado =  mysqli_query($conexion, $poliza); 
                //cargar y mostrar datos
                if ($row = mysqli_fetch_assoc($resultado)){                  
        ?>  
            <div class="tabla__item"><?php echo $row["nombre"];?></div>
            <div class="tabla__item"><?php echo $row["apellidoP"];?></div>
            <div class="tabla__item"><?php echo $row["apellidoM"];?></div>
        </div> 
        <?php
            } 
                   
            //da resultados de los datos de poliza  
            $resultado2 = mysqli_query($conexion, $polizaDatos); 
            while ($fila = mysqli_fetch_assoc($resultado2)){                  
        ?>  

        <!-- datos poliza -->
        <div class="datos-poliza__view--poliz">       
            <div class="tabla__header">Ramo</div>
            <div class="tabla__header">Suma Asegurada</div>
            <div class="tabla__header">Deducible</div>  
            <div class="tabla__header">Coaseguro</div>    
            <div class="tabla__header">Periodicidad</div>     
            <div class="tabla__header">Vigencia Inicial</div>    
            <div class="tabla__header">Vigencia Terminal</div>    
            <div class="tabla__header">Número</div>    
            <div class="tabla__header">Cantidad de asegurados</div>   
        
            <div class="tabla__item"><?php echo $fila["ramo"];?></div>
            <div class="tabla__item"><?php echo $fila["sumaAsegurada"];?></div>
            <div class="tabla__item"><?php echo $fila["deducible"];?></div>
            <div class="tabla__item"><?php echo $fila["coaseguro"];?></div>
            <div class="tabla__item"><?php echo $fila["periodicidad"];?></div>
            <div class="tabla__item"><?php echo $fila["vigenciaInicial"];?></div>
            <div class="tabla__item"><?php echo $fila["vigenciaTerminal"];?></div>
            <div class="tabla__item"><?php echo $fila["numeroPoliza"];?></div>
            <div class="tabla__item"><?php echo $fila["cantidadAsegurados"];?></div>
        </div> 
        <?php 
            }
            
            //da resultados de la caratula(s)
            $resultado3 =  mysqli_query($conexion, $caratula); 
            while ($numero = mysqli_fetch_assoc($resultado3)){    
            //varaible con la id de la poliza
            $poliza = $numero["idPoliza"];
        ?>           
            <!-- si hay mas de 2 polizas, solo poner la caratula -->
            <div class="tabla__item--pdf">Carátula</div>
            <!-- muestra el pdf -->
            <!-- <embed class="pdf" src="../pdfs/<?php echo $numero["imagenCaratula"];?>" type="application/pdf">   -->
            <iframe class="pdf" id="pdfviewer" src="http://docs.google.com/gview?embedded=true&url=https://despachohc.online/pdfs/<?php echo $numero["imagenCaratula"];?>&amp;embedded=true" frameborder="0"></iframe>
           
                <!-- obtengo el id -->
                <!-- el id debe ser de la poliza, no del cliente -->
            <div class="pdf__buttons">
                <button class="btn-crear-cliente edit-poliza btn-animated" onclick="location.href='../model/actualizar-poliza.php?id=<?php echo $poliza; ?>'">Editar póliza</button>     
                <a class="btn-crear-cliente edit-poliza delete-poliza btn-eliminar btn-animated" href='../model/delete-poliza.php?id=<?php echo $poliza; ?>&idCliente=<?php echo $id; ?>'>Eliminar póliza</a>     
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