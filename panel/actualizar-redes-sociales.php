<?php

include('includes/config.php');

if(isset($_POST["redesSociales"]))
{

$facebookTiendaMysql=$_POST["facebookTienda"];
$twitterTiendaMysql=$_POST["twitterTienda"];
$linkedinTiendaMysql=$_POST["linkedinTienda"];
$whatsappTiendaMysql=$_POST["whatsappTienda"];

actualizarRedesSocialesTiendaMysql($tablaTienda, $facebookTiendaMysql, $twitterTiendaMysql, $linkedinTiendaMysql, $whatsappTiendaMysql, $idTienda);

$respuestaRedesSociales = 'Las redes sociales de tu tienda han sido actualizadas correctamente';
echo '<form action="redes-sociales" method="POST" class="form-inline" role="form" id="return-form">
  <input type="hidden" name="respuestaRedesSociales" value="' . $respuestaRedesSociales . '">
</form>
<script>document.getElementById("return-form").submit();</script>';

}
else
{
  echo '<script>window.location.replace("redes-sociales");</script>';
}

?>
