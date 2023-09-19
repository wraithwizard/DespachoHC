<?php 
    //esta funccion debe estar en cada archivo de sesion
    session_start(); 

    //si la varialbe está vavcía
    if (!isset($_SESSION["administrador"])) {
        //redirigir al loging
        header("location: ../index.php");
    }

    include("../model/conexion.php");      
    // capturar id de poliza
    $id = $_GET["id"];
    //consulta para editar la poliza
    $poliza = "SELECT idPoliza, ramo, sumaAsegurada, deducible, coaseguro, periodicidad, vigenciaInicial, vigenciaTerminal, numeroPoliza, cantidadAsegurados, imagenCaratula FROM poliza WHERE idPoliza='$id'";   
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../view/css/dashboard.css" rel="stylesheet">
    <link href="../view/update.css" rel="stylesheet">
    <title>Despacho HC - edición póliza</title>
</head>

<body>  
     <!-- Sidebar -->
     <div class="sidebar">
        <img class="sidebar__logo" src="../img/logo.jpg">
        <h2>Despacho HC</h2>
        <hr>
        <a href="../view/dashboard.php">Clientes</a>
        <a class="active" href="../view/polizas.php">Pólizas</a>
        <a href="../view/siniestros.php">Siniestros</a>
        <a href="../view/cobranza.php">Cobranza</a>
        <a href="../view/usuarios.php">Usuarios</a>
        <a href="../controller/cerrar-session.php">Cerrar sesión</a>
    </div>
 
    <!--panel-->
    <div class="contenido">
        <div class="contenido-panel">
            <h1>Póliza-edición</h1>
            <button class="btn-crear-cliente btn-animated" onclick="location.href='cr-poliza.php'">Crear</button>
        </div> 

        <div>
        <!-- MTETER OPCION PARA EDITAR PDF -->    
        <form class="datos-poliza__view--update" action="actualizar-poliza-caratula.php" method="post"  enctype="multipart/form-data">           
            <div class="tabla__titulo--poliza-update">Datos de la póliza</div>
            <div class="tabla__header">Ramo</div>
            <div class="tabla__header">Suma Asegurada</div>
            <div class="tabla__header">Deducible</div>
            <div class="tabla__header">Coaseguro</div>
            <div class="tabla__header">Periodicidad</div>
            <div class="tabla__header">Vigencia Inicial</div>      
            <div class="tabla__header">Vigencia Final</div>  
            <div class="tabla__header">Número</div>          
            <div class="tabla__header">Cantidad asegurados</div> 

            <?php             
            $resultado =  mysqli_query($conexion, $poliza); 
            //cargar y mostrar datos
            while ($row = mysqli_fetch_assoc($resultado)){            
            ?>     
            
            <!-- se llenan lo campos desde la tabla de la base datos-->
            <input type="hidden" class="tabla__item" value="<?php echo $row["idPoliza"];?>" name="idPoliza">
            <!-- este select me indica cual ramo ya está en la BD y me da la opcionde cambiarlo-->
            <select class="form-cliente__input" name="updatingRamo" required>
                        <option disabled selected value="<?php echo $row["ramo"];?>"><?php echo $row["ramo"];?></option>
                        <option value="vida">Vida</option>
                        <option value="gastos médicos">Gastos médicos</option>
                        <option value="daños">Daños</option>
                        <option value="autos">Autos</option>
                        <option value="especial">Especiales</option>
            </select>
            <input type="number" class="tabla__item" value="<?php echo $row["sumaAsegurada"];?>" name="updatingSumaAsegurada">
            <input type="number" class="tabla__item" value="<?php echo $row["deducible"];?>" name="updatingDeducible">
            <input type="number" class="tabla__item" value="<?php echo $row["coaseguro"];?>" name="updatingCoaseguro">
            <input type="text" class="tabla__item" value="<?php echo $row["periodicidad"];?>" name="updatingPeriodicidad">
            <input type="date" class="tabla__item" value="<?php echo $row["vigenciaInicial"];?>" name="vigenciaI">
            <input type="date" class="tabla__item" value="<?php echo $row["vigenciaTerminal"];?>" name="vigenciaF">
            <input type="text" class="tabla__item" value="<?php echo $row["numeroPoliza"];?>" name="updatingNumero">
            <input type="number" class="tabla__item" value="<?php echo $row["cantidadAsegurados"];?>" name="updatingCantidad">           
        </div>
            <input type="submit" value="Actualizar Datos" class="edit-poliza btn-animated" name="actualizarDatos">  
        
        <div class="caratula">   
            <div class="tabla__header">Carátula</div> 
            <!-- debe mostrar el pdf -->
            <iframe class="pdf" id="pdfviewer" src="http://docs.google.com/gview?embedded=true&url=https://despachohc.online/pdfs/<?php echo $row["imagenCaratula"];?>&amp;embedded=true" frameborder="0"></iframe>
            <!-- <embed class="pdf" src="../pdfs/<?php echo $row["imagenCaratula"];?>" type="application/pdf">  -->
            <input type="file" name="file">    
            <input type="submit" value="Actualizar Carátula" class="edit-poliza btn-animated" name="actualizarPoliza">  
        </div>
            <?php          
                } 
                //libera la memoria
                mysqli_free_result($resultado); 
            ?>               
        </form>
        
    </div>    

    <?php include("../view/footer.php");?>

</body>
</html>