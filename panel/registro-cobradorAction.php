<?php

include './lib/funciones.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$nombres = $_POST["nombres"];
$apellidos = $_POST["apellidos"];
$rut = $_POST["rut"];
$email = $_POST["email"];
$password = $_POST["password"];
$nombre = $_POST["nombre"];
$banco = $_POST["banco"];
$rutCuenta = $_POST["rutCuenta"];
$tipoCuenta = $_POST["email"];
$nCuenta = $_POST["nCuenta"];
$nombresApellidos = $nombres . " " . $apellidos;
$link = "https://clientes.empreweb.cl/login.php";

require_once "vendor/autoload.php";

$idUsuario = registrarUsuario($nombres, $apellidos, $email, $rut, $password);

registrarCuentaBancaria($idUsuario, $banco, $nombre, $tipoCuenta, $nCuenta, $rutCuenta);

$mail = new PHPMailer(true);
//Enable SMTP debugging.
$mail->SMTPDebug = 0;
//Set PHPMailer to use SMTP.
$mail->isSMTP();
//Set SMTP host name
$mail->Host = "mail.empreweb.cl";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;
//Provide username and password
$mail->Username = "contacto@empreweb.cl";
$mail->Password = "Microfono_1995";
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "ssl";
//Set TCP port to connect to
$mail->Port = 465;
//From email address and name
$mail->From = "contacto@empreweb.cl";
$mail->FromName = "Empreweb - Portal de Pagos";
//To address and name
$mail->addAddress("$email", "$nombresApellidos");
//Address to which recipient will reply
$mail->addReplyTo("contacto@empreweb.cl", "Reply");
//CC and BCC
$mail->addCC("admin@empreweb.cl");
//$mail->addBCC("bcc@example.com");
//Send HTML or Plain Text email
$mail->isHTML(true);
$mail->Subject = "Bienvenido a Empreweb";
$mail->Body = "Estimado $nombresApellidos,<br>
Tu registro en Empreweb ha sido realizado con éxito.<br>
Puedes acceder a tu nueva cuenta a través del siguiente link $link.";
try {
    $mail->send();
}catch (Exception $e) {
  $hola = "hola";
}





$respuestaLogin = guardarSession($email);
echo '<script>window.location.href = "https://clientes.empreweb.cl/index.php";</script>';

?>
