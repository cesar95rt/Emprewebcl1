<?php

include('includes/config.php');

if(!isset($_POST["cambiarPassword"]))
{
  echo '<script>window.location.replace("cambiar-contrasena");</script>';
}
else
{
  $codigo = $_POST["codigoCambio"];
  $currentPassword = $_POST["currentPassword"];
  $newPassword = $_POST["password"];
  $resultadoVerificacion = verificarCodigoCambioPassword($codigo);
  if($resultadoVerificacion==1)
  {
    if(actualizarPassword($currentPassword, $newPassword, $emailTienda, $idTienda, $codigo)==1)
    {
      $respuestaAction = 'Su contraseña ha sido cambiada exitosamente.';

      $asunto = "Contraseña modificada exitosamente";

      $nombreArchivo = crearNombreArchivo();

      $cuerpo =  "Estimado " . $nombreTienda . ",<br>
      Tu contraseña ha sido cambiada con éxito.";

      $archivo = fopen("includes/mails/cuerpos/$nombreArchivo", "w");
      fwrite($archivo, "$cuerpo");
      fclose($archivo);

      $var = registrarCorreoDevolverId($emailTienda, $nombreTienda, $asunto, $nombreArchivo);
      $cmd = "php -q includes/mails/mailSender.php " . $var . " > /dev/null 2>&1 &";
      echo shell_exec($cmd);

      echo '<form action="cambiar-contrasena" method="POST" class="form-inline" role="form" id="return-form">
        <input type="hidden" name="respuestaSi" value="' . $respuestaAction . '">
        <input type="hidden" name="colorRespuesta" value="text-success">
      </form>
      <script>document.getElementById("return-form").submit();</script>';
    }
    else
    {
      $respuestaAction = 'La contraseña actual es errónea, por favor, vuelve a intentarlo';
      echo '<form action="cambiar-contrasena" method="POST" class="form-inline" role="form" id="return-form">
        <input type="hidden" name="respuestaNo" value="' . $respuestaAction . '">
      </form>
      <script>document.getElementById("return-form").submit();</script>';
    }
  }
  else
  {
    $respuestaAction = 'El código ingresado es erróneo, por favor, vuelve a intentarlo';
    echo '<form action="cambiar-contrasena" method="POST" class="form-inline" role="form" id="return-form">
      <input type="hidden" name="respuestaNo" value="' . $respuestaAction . '">
    </form>
    <script>document.getElementById("return-form").submit();</script>';
  }

}

?>
