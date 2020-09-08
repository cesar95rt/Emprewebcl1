<?php

include('includes/config.php');

if(isset($_POST["color1"]))
{
  $arrayColores[0]["colorElegido"] = $_POST["color1"];
  $arrayColores[0]["idColor"] = 1;
  $arrayColores[1]["colorElegido"] = $_POST["color2"];
  $arrayColores[1]["idColor"] = 2;
  $arrayColores[2]["colorElegido"] = $_POST["color3"];
  $arrayColores[2]["idColor"] = 3;
  $arrayColores[3]["colorElegido"] = $_POST["color4"];
  $arrayColores[3]["idColor"] = 4;
  $arrayColores[4]["colorElegido"] = $_POST["color5"];
  $arrayColores[4]["idColor"] = 5;
  $arrayColores[5]["colorElegido"] = $_POST["color6"];
  $arrayColores[5]["idColor"] = 6;
  actualizarColores($arrayColores);
  $respuestaEdicionColores = 'Los colores de tu tienda han sido actualizados correctamente';
  echo '<form action="colores" method="POST" class="form-inline" role="form" id="return-form">
    <input type="hidden" name="respuestaEdicionColores" value="' . $respuestaEdicionColores . '">
  </form>
  <script>document.getElementById("return-form").submit();</script>';
}
else
{
  echo '<script>window.location.replace("colores");</script>';
}

?>
