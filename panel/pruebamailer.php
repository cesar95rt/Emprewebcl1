<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php";
$idRegistro = $argv[1];
//PHPMailer Object
$mail = new PHPMailer(true); //Argument true in constructor enables exceptions

$mail->SMTPDebug = 3;

$mail->isSMTP();

$mail->Host = "mail.empreweb.cl";

$mail->SMTPAuth = true;

$mail->Username = "contacto@empreweb.cl";
$mail->Password = "Microfono_1995";
$mail->SMTPSecure = "tls";
$mail->Port = 587;
//From email address and name
$mail->From = "contacto@empreweb.cl";
$mail->FromName = $idRegistro;

//To address and name
$mail->addAddress("cesar95rt@gmail.com", "Recepient Name");
//$mail->addAddress("recepient1@example.com"); //Recipient name is optional

//Address to which recipient will reply
//$mail->addReplyTo("admin@empreweb.cl", "Reply");

//CC and BCC
//$mail->addCC("cc@example.com");
//$mail->addBCC("bcc@example.com");

//Send HTML or Plain Text email
$mail->isHTML(true);

$mail->Subject = "Subjéct Text";
$mail->Body = "<i>Mail body in HTML</i>";
$mail->AltBody = "This is the plain text version of the email content";

try {
    $mail->CharSet = 'UTF-8';
    $mail->send();
    echo "Message has been sent successfully";
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
