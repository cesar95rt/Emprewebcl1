<?php

include('includes/dbConfig.php');
include('includes/funciones.php');

if(!isset($_POST["emailTienda"]))
{
  echo '<script>window.location.href = "recuperar-contrasena";</script>';
}

$emailTienda = $_POST["emailTienda"];
$resultadoVerificacion = verificarEmailTienda($emailTienda);
$codigo = crearSessionString();
$link = "https://panel.empreweb.cl/crear-contrasena?codCambio=" . $codigo;
$estado = "Solicitud";

if($resultadoVerificacion == 1)
{
  $respuestaVerificacion = "El correo electrónico ingresado no existe en nuestros registros";
  echo '<form action="recuperar-contrasena" method="POST" class="form-inline" role="form" id="return-form">
    <input type="hidden" name="respuestaVerificacion" value="' . $respuestaVerificacion . '">
  </form>
  <script>document.getElementById("return-form").submit();</script>';
}
else
{
  $datosTienda = obtenerDatosTiendaPorEmail($emailTienda);
  $idTienda = $datosTienda["idTienda"];
  $nombreTienda = $datosTienda["nombreTienda"];
  registrarSolicitudRecuperacionPassword($codigo, $estado, $idTienda);

  $asunto = 'Solicitud de recuperación de contraseña';

  $nombreArchivo = 'recuperar-contrasena.php';

  $campo1 = $codigo;
  $campo2 = '';
  $campo3 = '';
  $campo4 = '';
  $campo5 = '';

  $var = registrarCorreoDevolverId($emailTienda, $nombreTienda, $asunto, $nombreArchivo, $campo1, $campo2, $campo3, $campo4, $campo5);
  $cmd = "php -q includes/mails/mailSender.php " . $var . " > /dev/null 2>&1 &";
  echo shell_exec($cmd);
  echo '<script>window.location.href = "crear-contrasena";</script>';
}

?>
