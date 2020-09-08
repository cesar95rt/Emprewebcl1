<?php

include('includes/config.php');

if(isset($_POST["estado"]))
{
  $estado = "desactivado";
  $origen = "0";
  if($_POST["estado"]==="desactivado")
  {
    $estado = "desactivado";
  }
  else
  {
    $estado = $_POST["estado"];
  }
  if($_POST["origen"]=="0")
  {
    $estado = "desactivado";
    $origen = "0";
  }
  else
  {
    $origen = $_POST["origen"];
  }
  actualizarConfiguracionStarken($idTienda, $origen, $estado);
  echo '<script>window.location.replace("metodos-de-envio");</script>';
}
else
{
  echo '<script>window.location.replace("starken");</script>';
}

?>
