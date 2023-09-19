<?php 
    //esta funccion debe estar en cada archivo de sesion
    session_start(); 

    //si la varialbe está vavcía
    if (!isset($_SESSION["administrador"])) {
        //redirigir al loging
        header("location: ../index.php");
    }

    include("../model/conexion.php");   
    
     //consulta de num. poliza
     $seleccionarPoliza = "SELECT cliente.idCliente, cliente.nombre, cliente.apellidoP, poliza.numeroPoliza FROM poliza, cliente WHERE poliza.idCliente = cliente.idCliente";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/dashboard.css" rel="stylesheet">
    <title>Despacho HC - crear siniestro</title>
</head>

<body>  
    <?php include("sidebar.php"); ?>
 
    <!--panel-->
    <div class="contenido">
        <div class="contenido-panel">
            <h1>Siniestro</h1>
            <button class="btn-crear-cliente btn-animated" onclick="location.href='cr-siniestro.php'">Crear</button>
        </div>        

        <div class="formulario-cliente">
            <form method="post" action="../model/insercion-siniestro.php" onsubmit="return validarCrearSiniestro();"> 
                <h2>Registrar siniestro</h2>  
                <div class="form-poliza__div">                
                    <?php $resultado =  mysqli_query($conexion, $seleccionarPoliza); 
                    echo "<select class='form-cliente__input' name='numPoliza' required>";
                        // me dal el valor desde la BD -->         
                        while ($row = mysqli_fetch_array($resultado)){    
                            echo '<option hidden disabled selected value>Seleccionar Número de Póliza</option>';
                            $id = $row["numeroPoliza"];
                            echo '<option value="'.$id.'">'.$row["numeroPoliza"]. " " .$row["nombre"] ." " .$row["apellidoP"] .'</option>';                 
                        }
                    echo "</select>"
                    ?> 
                </div>
                <input type="text" id="nombre" name="nombreSiniestro" placeholder="Nombre Siniestro" required>
                <label class="poliza-warning" for="fecha">Fecha: </label>
                    <input type="date" name="fecha" placeholder="Fecha">
                <textarea class="siniestro__textarea" name="descripcion" placeholder="Descripción"></textarea>
                <div class="form__siniestro--div">
                    <input type="number" step="any" name="indemnizacion" placeholder="Indemnización">
                    <input type="text" id="estado" name="estado" placeholder="Estado del siniestro">
                    <input type="text" id="folio" name="folio" placeholder="Número de siniestro">
                </div>
                <div>
                    <input type="text" id="lugar" name="lugar" placeholder="Lugar">
                    <select hidden aria-label="Default select example" name="finalizado">
                        <option value="n"></option>  
                    </select>
                </div>
                <div class="poliza__input">
                    <input type="submit" name="submit" value="Registrar Siniestro" class="btn-registrar">     
                </div>                 
            </form>      
        </div>
    </div>
    <?php include("footer.php");?>
    <script src="../js/validacionFormClientes.js"></script>

</body>
</html>