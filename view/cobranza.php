<?php 
    //esta funccion debe estar en cada archivo de sesion
    session_start(); 

    //si la varialbe está vavcía
    if (!isset($_SESSION["administrador"])) {
        //redirigir al loging
        header("location: ../index.php");
    }

    include("../model/conexion.php");
    
    //consulta valores desde bd, muestra las fechas del dia actual a 15 dias posteriores
    //ref: https://stackoverflow.com/questions/27640363/getting-next-15-days-data-from-current-date
    $data = "SELECT poliza.idPrima, poliza.numeroPoliza, cliente.nombre, cliente.apellidoP, prima.primaNeta, poliza.periodicidad, poliza.vigenciaTerminal, prima.idPrima,  prima.tipoCobro, prima.subtipo FROM poliza, cliente, prima WHERE poliza.idPrima = prima.idPrima AND poliza.idCliente = cliente.idCliente AND poliza.vigenciaTerminal >= CURDATE() AND vigenciaTerminal <= CURDATE() + INTERVAL 15 DAY";

    //conocer la fecha del dia 
    //referencia: https://www.tutorialrepublic.com/faq/how-to-get-the-current-date-and-time-in-php.php#:~:text=Answer%3A%20Use%20the%20PHP%20date,s%27)%20%2C%20and%20so%20on.
    //primero establecer el timezone local
    date_default_timezone_set('America/Monterrey');
    //obtener la fecha y hora exacta
    $date = date('Y-m-d'); //la 'Y' me da el año completo
    //echo "date es: ", $date, "<br>";        
    //crear el objeto date
    $diaActual = date_create($date);
    //formato correcto 
    //echo "dia actual: ", $diaActual->format('Y-m-d');

    //hacer icono de alerta con simbolito a color cuando exista una alerta

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/dashboard.css" rel="stylesheet">   
    <title>Despacho HC - cobranza</title>
</head>

<body>  
    <?php include("sidebar.php"); ?>
   
    <!--panel-->
    <div class="contenido">
        <div class="contenido-panel">
            <h1>Cobranza</h1>
            <div class="alertas-cobranza">
                <div class="contenido__alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-urgent" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffec00" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M8 16v-4a4 4 0 0 1 8 0v4" />
                    <path d="M3 12h1m8 -9v1m8 8h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7" />
                    <rect x="6" y="16" width="12" height="4" rx="1" />
                    </svg>
                    <h3>Quedan entre 8 y 15 días</h3>
                </div>
                <div class="contenido__alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-urgent" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff9300" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M8 16v-4a4 4 0 0 1 8 0v4" />
                    <path d="M3 12h1m8 -9v1m8 8h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7" />
                    <rect x="6" y="16" width="12" height="4" rx="1" />
                    </svg>
                    <h3>Quedan entre 4 y 7 días</h3>
                </div>
                <div class="contenido__alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-urgent" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff4500" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M8 16v-4a4 4 0 0 1 8 0v4" />
                    <path d="M3 12h1m8 -9v1m8 8h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7" />
                    <rect x="6" y="16" width="12" height="4" rx="1" />
                    </svg>
                    <h3>Queda entre 1 y 3 días</h3>
                </div>
                <div class="contenido__alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-urgent" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#6f32be" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M8 16v-4a4 4 0 0 1 8 0v4" />
                    <path d="M3 12h1m8 -9v1m8 8h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7" />
                    <rect x="6" y="16" width="12" height="4" rx="1" />
                    </svg>
                    <h3>Inactiva</h3>
                </div>
            </div>
        </div>    
 
        <div class="datos-users__cobranza">
            <div class="tabla__titulo--cobranza">Cobranza</div>
            <div class="tabla__header">Póliza</div>
            <div class="tabla__header">Nombre</div>
            <div class="tabla__header">Apellido</div>
            <div class="tabla__header">Prima</div>
            <div class="tabla__header">Periodicidad</div>
            <div class="tabla__header">Días restantes</div>
            <div class="tabla__header">Fecha límite</div>     
            <div class="tabla__header">Tipo de cobro</div>     
            <div class="tabla__header">Subtipo</div>
            <div class="tabla__header">Estatus</div>                        
            <div class="tabla__header">Operación</div>  
            <?php              
                $resultado =  mysqli_query($conexion, $data); 
                while ($row = mysqli_fetch_assoc($resultado)){ 
                    //conocer la vigencia terminal de la poliza
                    $fechaPoliza = $row["vigenciaTerminal"];
                    //creo el objeto fecha                   
                    $dateTest = date_create($fechaPoliza);
                    //compara las fechas
                    $intervalo = date_diff($diaActual, $dateTest);
                    //da el formato de la fecha
                    //echo "<br>intervalo es :", $intervalo->format("%R%a days");

                    //el icono de la alerta
                    $alert = "";
                    // alertar segun dias que quedan      
                    // si faltan de 8 a 15 dias...         
                    if($intervalo->format("%R%a days") <= 15 && $intervalo->format("%R%a days") >= 8){
                        //cambiar estatus a AMARILLO
                        $alert = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-urgent" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffec00" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M8 16v-4a4 4 0 0 1 8 0v4" />
                        <path d="M3 12h1m8 -9v1m8 8h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7" />
                        <rect x="6" y="16" width="12" height="4" rx="1" />
                        </svg>';                
                        //si faltan de 4 a 7 dias...
                    }else if($intervalo->format("%R%a days") <= 7 && $intervalo->format("%R%a days") >= 4){
                        //cambiar estatus a naranja
                        $alert = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-urgent" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff9300" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M8 16v-4a4 4 0 0 1 8 0v4" />
                        <path d="M3 12h1m8 -9v1m8 8h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7" />
                        <rect x="6" y="16" width="12" height="4" rx="1" />
                        </svg>';
                        // si faltan de 1 a 3 dias...
                    }else if($intervalo->format("%R%a days") <= 3 && $intervalo->format("%R%a days") >= 1 || $intervalo->format("%R%a days") == 0){
                        //cambiar estatus a rojo
                        $alert = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-urgent" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff4500" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M8 16v-4a4 4 0 0 1 8 0v4" />
                        <path d="M3 12h1m8 -9v1m8 8h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7" />
                        <rect x="6" y="16" width="12" height="4" rx="1" />
                        </svg>';
                        // si se agoto el tiempo...                        
                    }else if($intervalo->format("%R%a days") < 0){
                        //indicar que no se cobro
                        $alert = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-urgent" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M8 16v-4a4 4 0 0 1 8 0v4" />
                        <path d="M3 12h1m8 -9v1m8 8h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7" />
                        <rect x="6" y="16" width="12" height="4" rx="1" />
                        </svg>';
                    }
            ?>
                <!-- se llenan lo campos desde la tabla de la base datos-->
                <div class="tabla__item"><?php echo $row["numeroPoliza"];?></div>
                <div class="tabla__item"><?php echo $row["nombre"];?></div>
                <div class="tabla__item"><?php echo $row["apellidoP"];?></div>
                <div class="tabla__item"><?php echo $row["primaNeta"];?></div>
                <div class="tabla__item"><?php echo $row["periodicidad"];?></div>
                <!-- me indica la diferencia de dias -->
                <div class="tabla__item"><?php echo $intervalo->format("%r%a dias");?></div>
                <div class="tabla__item"><?php echo $row["vigenciaTerminal"];?></div>
                <div class="tabla__item"><?php echo $row["tipoCobro"];?></div>
                <div class="tabla__item"><?php echo $row["subtipo"];?></div>
                <!-- mi icono de alerta desde la variable -->
                <div class="tabla__item"><?php echo $alert ;?></div>

                <div class="tabla__item">
                    <a href="update-prima.php?id=<?php echo $row["idPrima"];?>"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit btn-animated" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                    <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                    <line x1="16" y1="5" x2="19" y2="8" />
                    </svg></a>
                    <p> - </p>
                    <a href="../model/delete-prima.php?id=<?php echo $row["idPrima"];?>" class="btn-eliminar"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash btn-animated" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <line x1="4" y1="7" x2="20" y2="7" />
                    <line x1="10" y1="11" x2="10" y2="17" />
                    <line x1="14" y1="11" x2="14" y2="17" />
                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                    </svg></a>
                </div>               
            <?php
                }
            ?>             
        </div>

        <!-- div historial -->
        <div class="datos-users__cobranza">
            <div class="tabla__titulo--cobranza">Canceladas</div>
            <div class="tabla__header">Póliza</div>
            <div class="tabla__header">Nombre</div>
            <div class="tabla__header">Apellido</div>
            <div class="tabla__header">Prima</div>
            <div class="tabla__header">Periodicidad</div>
            <div class="tabla__header">Días pasados</div>
            <div class="tabla__header">Fecha límite</div>     
            <div class="tabla__header">Tipo de cobro</div>     
            <div class="tabla__header">Subtipo</div>
            <div class="tabla__header">Estatus</div>                        
            <div class="tabla__header">Operación</div>  
            <?php              
                //presenta las cobranzas pasadas
                $historial = "SELECT poliza.idPrima, poliza.numeroPoliza, cliente.nombre, cliente.apellidoP, prima.primaNeta, poliza.periodicidad, poliza.vigenciaTerminal, prima.idPrima,  prima.tipoCobro, prima.subtipo FROM poliza, cliente, prima WHERE poliza.idPrima = prima.idPrima AND poliza.idCliente = cliente.idCliente AND poliza.vigenciaTerminal < CURDATE()";

                $resultado =  mysqli_query($conexion, $historial); 
                while ($row = mysqli_fetch_assoc($resultado)){ 
                    //conocer la vigencia terminal de la poliza
                    $fechaPoliza = $row["vigenciaTerminal"];
                    //creo el objeto fecha                   
                    $dateTest = date_create($fechaPoliza);
                    //compara las fechas
                    $intervalo = date_diff($diaActual, $dateTest);
                    //da el formato de la fecha
                    //echo "<br>intervalo es :", $intervalo->format("%R%a days");

                    //el icono de la alerta
                    $alert = "";
                    if($intervalo->format("%R%a days") < 0){
                        //indicar que no se cobro
                        $alert = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-urgent" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#6f32be" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M8 16v-4a4 4 0 0 1 8 0v4" />
                        <path d="M3 12h1m8 -9v1m8 8h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7" />
                        <rect x="6" y="16" width="12" height="4" rx="1" />
                        </svg>';
                    }
            ?>
                <!-- se llenan lo campos desde la tabla de la base datos-->
                <div class="tabla__item"><?php echo $row["numeroPoliza"];?></div>
                <div class="tabla__item"><?php echo $row["nombre"];?></div>
                <div class="tabla__item"><?php echo $row["apellidoP"];?></div>
                <div class="tabla__item"><?php echo $row["primaNeta"];?></div>
                <div class="tabla__item"><?php echo $row["periodicidad"];?></div>
                <!-- me indica la diferencia de dias -->
                <div class="tabla__item"><?php echo $intervalo->format("%r%a dias");?></div>
                <div class="tabla__item"><?php echo $row["vigenciaTerminal"];?></div>
                <div class="tabla__item"><?php echo $row["tipoCobro"];?></div>
                <div class="tabla__item"><?php echo $row["subtipo"];?></div>
                <!-- mi icono de alerta desde la variable -->
                <div class="tabla__item"><?php echo $alert ;?></div>

                <div class="tabla__item">
                    <a href="update-prima.php?id=<?php echo $row["idPrima"];?>"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit btn-animated" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                    <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                    <line x1="16" y1="5" x2="19" y2="8" />
                    </svg></a>
                    <p> - </p>
                    <a href="../model/delete-prima.php?id=<?php echo $row["idPrima"];?>" class="btn-eliminar btn-animated"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <line x1="4" y1="7" x2="20" y2="7" />
                    <line x1="10" y1="11" x2="10" y2="17" />
                    <line x1="14" y1="11" x2="14" y2="17" />
                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                    </svg></a>
                </div>               
            <?php
                }
                //libera la memoria
                mysqli_free_result($resultado); 
            ?>             
        </div>
    </div> 

    <?php include("footer.php");?>
    <script src="../js/alerta-eliminacion.js"></script>
   
</body>
</html>