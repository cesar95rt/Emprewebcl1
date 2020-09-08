<?php

$emailTienda = $_GET['emailTienda'];
$nombreTienda = $_GET['nombreTienda'];
$idTienda = $_GET['idTienda'];

include(__DIR__ . '/funciones.php');

$codigo = crearSessionString();

registrarSolicitudCambioPassword($codigo, $idTienda);

$asunto = 'Solicitud de cambio de contraseña';

$cuerpo = "<p><strong>¡Hola " . $nombreTienda . "!</strong></p>
<p>Recibimos tu solicitud de cambio de contraseña.</p>
<p>El código para realizar esta modificación es: $codigo</p>
<p><br></p>
<p>Se despide atentamente,</p>
<p>El equipo de Empreweb.</p>";

$nombreArchivo = crearNombreArchivo();

$archivo = fopen(__DIR__ . "/mails/cuerpos/$nombreArchivo", "w");
fwrite($archivo, "$cuerpo");
fclose($archivo);
$mailSenderDir = __DIR__ . '/mails/mailSender.php';

$var = registrarCorreoDevolverId($emailTienda, $nombreTienda, $asunto, $nombreArchivo);
$cmd = "php -q " . $mailSenderDir . " " . $var . " > /dev/null 2>&1 &";
shell_exec($cmd);
echo 'El código ha sido enviado a tu correo';

?>
