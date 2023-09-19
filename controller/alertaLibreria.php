<!-- librerias para la alerta -->
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="../view/css/style.css" rel="stylesheet">
</head>

<?php
class Alerta{
    function success($location, $text){
        // segun mozilla debo usar replace para redigir
        // https://developer.mozilla.org/en-US/docs/Web/API/Location/href
        echo "<script type='text/javascript'> $(document).ready(function(){
            swal({
                text: '$text',
                button: true,
                button: 'Regresar',
                background: '#262626',
            }).then(function(){                
                window.location.replace('$location');
            })
        }); 
        </script>";
    }
}