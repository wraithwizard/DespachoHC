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
    $seleccionarCliente = "SELECT idCliente, nombre, apellidoP, apellidoM FROM cliente";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/dashboard.css" rel="stylesheet">
    <title>Despacho HC - crear póliza</title>
</head>

<body>  
    <?php include("sidebar.php"); ?>
 
    <!--panel-->
    <div class="contenido">
        <div class="contenido-panel">
            <h1>Pólizas</h1>
            <button class="btn-crear-cliente" onclick="location.href='cr-poliza.php'">Crear</button>
        </div>        

        <div class="formulario-cliente">
            <form method="post" action="../model/insercion-poliza.php" enctype="multipart/form-data" onsubmit="return validarPoliza();"> <!--enctype es para la subida del file -->
                <h2>Crear nueva póliza</h2>  
                <div class="form-poliza__div">
                    <!-- el select con option desde DB -->
                    <?php $resultado =  mysqli_query($conexion, $seleccionarCliente); 
                    echo "<select class='form-cliente__input' id='cliente' name='clienteId' required>";
                        // me dal el valor desde la BD -->         
                        while ($row = mysqli_fetch_array($resultado)){    
                            // para obtener el id
                            $id = $row["idCliente"];
                            echo '<option hidden disabled selected value>Seleccionar cliente</option>';
                            // obtiene el id del cliente y muestra sus apellidos
                            echo '<option value="'.$id.'">' .$row["idCliente"]. " ". $row["nombre"]. " ". $row["apellidoP"]. " " .$row["apellidoM"]. '</option>';                 
                        }
                    echo "</select>"
                    ?> 
                    <select class="form-cliente__input" name="ramo" required>
                        <option hidden disabled selected value>Seleccionar ramo</option>
                        <option value="vida">Vida</option>
                        <option value="gastos médicos">Gastos médicos</option>
                        <option value="daños">Daños</option>
                        <option value="autos">Autos</option>
                        <option value="especial">Especiales</option>
                    </select>
                    <select class="form-cliente__input" name="periodicidad" required>
                        <option hidden disabled selected value>Seleccionar Periodicidad</option>
                        <option value="mensual">Mensual</option>
                        <option value="trimestral">Trimestral</option>
                        <option value="semestral">Semestral</option>
                        <option value="anual">Anual</option>
                    </select>
                </div>

                <div class="form-cliente__div">
                    <input type="number" id="sumaA" name="sumaAsegurada" placeholder="Suma asegurada">
                    <input type="number" id="deducible" name="deducible" placeholder="Deducible">
                    <input type="number" id="coaseguro" name="coaseguro" placeholder="Coaseguro">
                </div>

                <div>
                    <label class="poliza-warning" for="vigenciaI">Vigencia inicial:</label>
                    <input type="date" id="vigenciaI" name="vigenciaI" required>
                    <label class="poliza-warning" for="vigenciaF">Vigencia final:</label>
                    <input type="date" id="vigenciaF" name="vigenciaF" placeholder="Vigencia Final" required>
                </div>

                <div class="form-cliente__div">
                    <input type="text" id="numPoliza" name="numeroPoliza" placeholder="Número de póliza" required>
                    <input type="number" id="asegurados" name="asegurados" placeholder="Cantidad de asegurados">
                    <input type="number" id="prima" name="primaNeta" placeholder="Prima Total" required>  
                </div>

                <div class="form-poliza__div">
                    <select class="form-cliente__input" name="tipoCobro" required>
                            <option hidden disabled selected value>Seleccionar Tipo de cobro</option>
                            <option value="domiciliado">Domiciliado</option>
                            <option value="agente">Agente</option>                 
                    </select>
                    <select class="form-cliente__input" name="subtipo" required>
                        <option hidden disabled selected value>Seleccionar subtipo</option>
                        <option value="credito">Crédito</option>
                        <option value="debito">Débito</option>
                        <option value="clabe">Clabe</option>
                        <option value="agente">Efectivo</option>                 
                    </select>
                </div>
                
                <div class="poliza__input">
                    <p class="poliza-warning"> Sólo se aceptan archivos con formato PDF o JPG</p>
                    <input type="file" name="file" required>              
                    <input type="submit" name="submit" value="Registrar Póliza" class="btn-registrar">     
                </div>                 
            </form>      
        </div>
    </div>
    <?php include("footer.php");?>
    <script src="../js/validacionFormClientes.js"></script> 

</body>
</html>