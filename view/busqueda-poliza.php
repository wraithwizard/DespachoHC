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
    <title>Despacho HC Póliza</title>
</head>

<body>  
    <?php include("sidebar.php"); ?>
 
    <!--panel-->
    <div class="contenido-polizas">
        <div class="contenido-panel">
            <h1>Pólizas</h1>
            <button class="btn-crear-cliente btn-animated" onclick="location.href='cr-poliza.php'">Crear</button>
        </div> 
        
        <!-- buscador -->
        <form class="buscador" action="busqueda-poliza.php" method="POST">
            <label for="buscador" class="buscador-label">Buscar por nombre o apellido: </label>
            <input type="text" class="buscador-input" name="buscador" id="buscador">
            <button class="btn-crear-cliente btn-buscador btn-animated" type="submit" name="buscar">Buscar</button>
        </form>

        <!-- datos cliente -->
        <div class="datos-poliza__view">       
        <div class="tabla__titulo--poliza">Póliza del cliente</div>
        <div class="tabla__header">Nombre</div>
        <div class="tabla__header">Apellido Paterno</div>
        <div class="tabla__header">Apellido Materno</div> 

        <!-- logica del buscador -->
        <?php 
            if (isset($_POST["buscador"])) {
                $busqueda = mysqli_real_escape_string($conexion, $_POST["buscador"]);
                // buscar por nombre o apellido paterno
                $sql = "SELECT * FROM cliente, poliza WHERE nombre LIKE '%$buscador%' AND cliente.idCliente = poliza.idCliente OR apellidoP LIKE '%$buscador%' AND cliente.idCliente = poliza.idCliente";  

                $result = mysqli_query($conexion, $sql);
                // checa que haya resultados
                $queryResult = mysqli_num_rows($result); 
            
                if ($queryResult > 0) {
                    if($row = mysqli_fetch_assoc($result)){      
                        // intento saber el cliente
                        $idCliente = $row["idCliente"];
                        // echo $idCliente;
        ?>                
                        <!-- se llenan lo campos desde la tabla de la base datos-->             
                        <div class="tabla__item"><?php echo $row["nombre"];?></div>
                        <div class="tabla__item"><?php echo $row["apellidoP"];?></div>
                        <div class="tabla__item"><?php echo $row["apellidoM"];?></div>
        </div> <!-- class="datos__poliza--view -->
        <?php 
                } //termina el if anidado   

                //da resultados de los datos de poliza  
                $resultado2 = mysqli_query($conexion, $sql); 
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
                    <div class="tabla__header">Asegurados</div>  
                    
                    <div class="tabla__item"><?php echo $fila["ramo"];?></div>
                    <div class="tabla__item"><?php echo $fila["sumaAsegurada"];?></div>
                    <div class="tabla__item"><?php echo $fila["deducible"];?></div>
                    <div class="tabla__item"><?php echo $fila["coaseguro"];?></div>
                    <div class="tabla__item"><?php echo $fila["periodicidad"];?></div>
                    <div class="tabla__item"><?php echo $fila["vigenciaInicial"];?></div>
                    <div class="tabla__item"><?php echo $fila["vigenciaTerminal"];?></div>
                    <div class="tabla__item"><?php echo $fila["numeroPoliza"];?></div>
                    <div class="tabla__item"><?php echo $fila["cantidadAsegurados"];?></div>
                    </div> <!-- class="datos-poliza__view--poliz"-->

    <?php 
                } // aqui acaba el while
            
                //da resultados de la caratula(s)
                //consulta solo la caratula
                $caratula = "SELECT idPoliza, imagenCaratula FROM poliza WHERE poliza.idCliente='$idCliente'";
                $resultado3 =  mysqli_query($conexion, $caratula); 

                while($numero = mysqli_fetch_assoc($resultado3)){    
                    //varaible con la id de la poliza
                    $poliza = $numero["idPoliza"];
                    // echo $poliza, " ", $idCliente;
    ?>
                        <!-- si hay mas de 2 polizas, solo poner la caratula -->
                        <div class="tabla__item--pdf">Carátula</div>
                        <!-- muestra el pdf -->
                        <!-- <embed class="pdf" src="../pdfs/<?php echo $numero["imagenCaratula"];?>" type="application/pdf">   -->
                        <!-- asi el PDF es compatible cono dispositivos móviles -->
                        <iframe class="pdf" id="pdfviewer" src="http://docs.google.com/gview?embedded=true&url=https://despachohc.online/pdfs/<?php echo $numero["imagenCaratula"];?>&amp;embedded=true" frameborder="0"></iframe>

                        <div class="pdf__buttons">
                            <button class="btn-crear-cliente edit-poliza btn-animated" onclick="location.href='../model/actualizar-poliza.php?id=<?php echo $poliza; ?>'">Editar póliza</button>     
                            <a class="btn-crear-cliente edit-poliza delete-poliza btn-eliminar btn-animated" href='../model/delete-poliza.php?id=<?php echo $poliza; ?>'>Eliminar póliza</a> 
                        </div>
    <?php       
                }//hasta aca llega el while

            //libera la memoria
            mysqli_free_result($result);  
            } 
            }else{
                echo "<script>alert('No existe el cliente'); window.history.go(-1);</script>";
            }
    ?>
    </div>

    <?php include("footer.php");?>
    <script src="../js/alerta-eliminacion.js"></script>
</body>
</html>