<?php

include('includes/config.php');

if(isset($_POST["estado"]))
{
  $estado = "desactivado";
  $region = '';
  $comuna = '';
  $direccion = '';
  $oficina = '';
  $horario1 = '';
  $horario2 = '';
  if($_POST["estado"]==="desactivado")
  {
    $estado = "desactivado";
  }
  else
  {
    $estado = $_POST["estado"];
  }
  if($_POST["regionRetiro"]=="")
  {
    $estado = "desactivado";
    $region = '';
    $comuna = '';
    $direccion = '';
    $oficina = '';
    $horario1 = '';
    $horario2 = '';
  }
  else
  {
    $region = $_POST["regionRetiro"];
    $comuna = $_POST["comunaRetiro"];
    $direccion = $_POST["direccionRetiro"];
    $oficina = $_POST["oficinaRetiro"];
    $horario1 = $_POST["horario1Retiro"];
    $horario2 = $_POST["horario2Retiro"];
  }
  actualizarConfiguracionRetiro($idTienda, $region, $estado, $comuna, $direccion, $oficina, $horario1, $horario2);
  echo '<script>window.location.replace("metodos-de-envio");</script>';
}
else
{
  echo '<script>window.location.replace("retiro-en-tienda");</script>';
}

?>
