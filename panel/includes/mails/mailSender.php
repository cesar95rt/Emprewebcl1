<?php

include('/var/www/html/empreweb.cl/panel/includes/dbConfig.php');
include('/var/www/html/empreweb.cl/panel/includes/funciones.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "/var/www/html/empreweb.cl/panel/vendor/autoload.php";
$fromName = 'Empreweb';
$idCorreo = $argv[1];
//$idCorreo = 12;

$datos = obtenerDatosRegistroCorreoPorId($idCorreo);

$emailDestinatario = $datos["emailDestinatario"];
$nombreDestinatario = $datos["nombreDestinatario"];
$asunto = $datos["asunto"];
$nombreArchivo = $datos["nombreArchivo"];
$campo1 = $datos["campo1"];
$campo2 = $datos["campo2"];
$campo3 = $datos["campo3"];
$campo4 = $datos["campo4"];
$campo5 = $datos["campo5"];
if($campo5!='')
{
  $fromName = $campo5;
}

$direccionArchivo = "plantillas/" . $nombreArchivo;

include($direccionArchivo);

//PHPMailer Object
$mail = new PHPMailer(true); //Argument true in constructor enables exceptions

$mail->SMTPDebug = 0;

$mail->isSMTP();

$mail->Host = "mail.empreweb.cl";

$mail->SMTPAuth = true;

$mail->Username = "contacto@empreweb.cl";
$mail->Password = "Microfono_1995";
$mail->SMTPSecure = "tls";
$mail->Port = 587;
//From email address and name
$mail->From = "contacto@empreweb.cl";
$mail->FromName = $fromName;

//To address and name
$mail->addAddress("$emailDestinatario", "$nombreDestinatario");

$mail->addReplyTo("contacto@empreweb.cl", "Reply");
$mail->addCC("admin@empreweb.cl");

//$mail->addBCC("bcc@example.com");

//Send HTML or Plain Text email
$mail->isHTML(true);

$mail->Subject = "$asunto";
$mail->Body = "$cuerpo";

try {
    $mail->CharSet = 'UTF-8';
    $mail->send();
    actualizarEstadoCorreoEnviado($idCorreo);
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
