<?php
include('includes/dbConfig.php');
include './includes/funciones.php';

$email = $_POST["email"];
$password = $_POST["password"];
$resultadoLogin = iniciarSesion($email, $password);

if($resultadoLogin == 0)
{
  $respuestaLogin = 'El correo electrónico ingresado no existe en nuestros registros';
  echo '<form action="login" method="POST" class="form-inline" role="form" id="return-form">
    <input type="hidden" name="respuestaLogin" value="' . $respuestaLogin . '">
    <input type="hidden" name="colorRespuesta" value="text-danger">
  </form>
  <script>document.getElementById("return-form").submit();</script>';
}else
{
  if($resultadoLogin == 1)
  {
    $respuestaLogin = 'La contraseña ingresada es incorrecta';
    echo '<form action="login" method="POST" class="form-inline" role="form" id="return-form">
      <input type="hidden" name="respuestaLogin" value="' . $respuestaLogin . '">
      <input type="hidden" name="colorRespuesta" value="text-danger">
    </form>
    <script>document.getElementById("return-form").submit();</script>';
  }else
  {
      $respuestaLogin = guardarSession($email);
      echo '<script>window.location.href = "../";</script>';
  }
}

?>
