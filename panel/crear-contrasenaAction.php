<?php

include('includes/dbConfig.php');
include('includes/funciones.php');

$codigo = $_POST["codigo"];
$newPassword = $_POST["password"];
$resultadoVerificacion = verificarCodigo($codigo);

if($resultadoVerificacion == 1){
  $datosTienda = obtenerDatosUsuarioPorCodigo($codigo);
  $idTienda = $datosTienda["idTienda"];
  $currentPassword = $datosTienda["passwordTienda"];
  $idRecuperacion = $datosTienda["id"];
  $emailTienda = $datosTienda["emailTienda"];
  $nombreTienda = $datosTienda["nombreTienda"];
  crearPassword($newPassword, $currentPassword, $idTienda, $codigo, $idRecuperacion);

  $respuestaAction = 'Su contraseña ha sido modificada exitosamente. Por favor, inicie sesión';

  $asunto = "Contraseña recuperada exitosamente";

  $nombreArchivo = 'crear-contrasena.php';

  $campo1 = '';
  $campo2 = '';
  $campo3 = '';
  $campo4 = '';
  $campo5 = '';

  $var = registrarCorreoDevolverId($emailTienda, $nombreTienda, $asunto, $nombreArchivo, $campo1, $campo2, $campo3, $campo4, $campo5);
  $cmd = "php -q includes/mails/mailSender.php " . $var . " > /dev/null 2>&1 &";
  echo shell_exec($cmd);

  echo '<form action="login" method="POST" class="form-inline" role="form" id="return-form">
    <input type="hidden" name="respuestaLogin" value="' . $respuestaAction . '">
    <input type="hidden" name="colorRespuesta" value="text-success">
  </form>
  <script>document.getElementById("return-form").submit();</script>';
}else
{
  $respuestaAction = 'El código ingresado es erróneo, por favor, vuelve a intentarlo';
  echo '<form action="crear-contrasena" method="POST" class="form-inline" role="form" id="return-form">
    <input type="hidden" name="respuestaAction" value="' . $respuestaAction . '">
  </form>
  <script>document.getElementById("return-form").submit();</script>';
}

?>
