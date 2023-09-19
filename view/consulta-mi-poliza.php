<?php 
    //esta funccion debe estar en cada archivo de sesion
    session_start(); 

    //si la varialbe está vavcía
    if (!isset($_SESSION["usuarioweb"])) {
        //redirigir al loging
        header("location: ../index.php");
    }

    include("../model/conexion.php");
    include("../controller/alertaLibreria.php");

//datos del form
$ramo = $_POST["ramo"];
$email = $_POST["correo"];
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
    <?php include("sidebar-usuario-cliente.php");?>
 
     <!--panel-->
    <div class="contenido">
    <h1>Mis pólizas</h1>
  
    <div class="formulario-cliente">
            <form method="post" action="consulta-mi-poliza.php"> 
                <h2>Mis pólizas</h2>  
                <select class="form-cliente__input" name="ramo" required>
                    <option hidden disabled selected value>Seleccionar ramo</option>
                    <option value="vida">Vida</option>
                    <option value="gastos médicos">Gastos médicos</option>
                    <option value="daños">Daños</option>
                    <option value="autos">Autos</option>
                    <option value="especial">Especiales</option>
                </select>
                <div class="form-cliente__div">
                    <input type="email" name="correo" placeholder="Insertar email" required>
                </div>
                <div class="poliza__input">
                    <input type="submit" name="submit" value="Consultar" class="btn-registrar">     
                </div>                 
            </form>    
    </div>

    <div>
            <!-- busca la poliza -->
            <?php 
                if(isset($_POST["correo"])){
                    $busqueda = mysqli_real_escape_string($conexion, $_POST["correo"]);
                    //buscar por email
                    $sql = "SELECT cliente.idCliente, cliente.email, poliza.imagenCaratula, poliza.ramo FROM cliente, poliza WHERE cliente.email LIKE'%$email%' AND poliza.ramo = '$ramo'";
                 
                    $result = mysqli_query($conexion, $sql);
                    // checa que haya resultados
                    $queryResult = mysqli_num_rows($result); 

                    // intento saber el cliente por su idCliente
                    if ($queryResult > 0) {
                        if($row = mysqli_fetch_assoc($result)){   
                            //datos de comprobacion   
                            $idCliente = $row["idCliente"];
                            // echo $idCliente, "<br>";
                            // echo "Eligio: ", $ramo, "<br>";
                            // echo "El email escrito fue: ", $email;

                            //consulta para la poliza
                            $caratula = "SELECT poliza.ramo, poliza.imagenCaratula, cliente.email FROM poliza, cliente WHERE poliza.idCliente='$idCliente'";

                            $resultado3 =  mysqli_query($conexion, $caratula); 
                            //booleano para que no repita el mensaje del else
                            $found = false;
                            while($numero = mysqli_fetch_assoc($resultado3)){ 
                                //comparo los datos, si son identicos, mostrar caratula
                                if($ramo == $numero["ramo"] && $email == $numero["email"] && !$found){   
                                    // echo "<br>El resultado es: ";
                                    // echo "<br><br>Datos del if: <br> Ramo: ", $ramo, "<br>Email: ", $email, "<br>Imagen Caratula: ", $numero["imagenCaratula"];
                                    
            ?>
                                    <!-- solo poner la caratula -->
                                    <div class="tabla__item--pdf">Carátula</div>
                                    <!-- muestra el pdf -->
                                    <iframe class="pdf" id="pdfviewer" src="http://docs.google.com/gview?embedded=true&url=https://despachohc.online/pdfs/<?php echo $numero["imagenCaratula"];?>&amp;embedded=true" frameborder="0"></iframe>
                                    <!-- <embed class="pdf" src="../pdfs/<?php echo $numero["imagenCaratula"];?>" type="application/pdf">   -->
                                        
            <?php   
                                    $found = true;
                                }
                            }//hasta aca llega el while
                            
                            //si no encontrola poliza, marcar error
                            if(!$found){
                                $alerta = new Alerta();
                                $location = "mis-polizas.php";
                                $mensaje = "Datos no encontrados";
                                $alerta->success($location, $mensaje);
                            }
                            
                        }
                    } // aqui acaba el segundo if
                //libera la memoria
                mysqli_free_result($result);  
            }
            ?>
    </div>

    <?php include("footer.php");?>
</body>
</html>
