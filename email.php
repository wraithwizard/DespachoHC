<?php
//requeridos para PHPmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if (isset($_POST["email"]) && $_POST["email"] != ""){
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $mensaje = $_POST["area"];
    $subject = "Contacto desde página web";

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

        //habria que cambiar estos datos y permitir acceso a aplicaciones poco seguras en la seguridad de la cuenta
        $mail->Username   = 'unmundoseguro@despachohc.com';            //SMTP username
        $mail->Password   = 'password!';                          //SMTP password

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipientes necesarios
        $mail->setFrom($email, "Despacho HC Contacto Web");
        //este hace que se pueda dar responder desde el email y captura el nombre y el correo del que mando el mensaje de contacto
        $mail->addReplyTo($email, $nombre);
        $mail->addAddress('unmundoseguro@despachohc.com');             //hacia donde va el mensaje

        // //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Contacto web';
        $mail->Body    = $mensaje;

        $mail->send();
        echo 'Mensaje enviado correctamente, nos pondremos en contacto';
    } catch (Exception $e) {
        echo "No se pudo enviar el mensaje: {$mail->ErrorInfo}";
    }
}

