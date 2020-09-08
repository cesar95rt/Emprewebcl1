<?php

if(isset($_GET["idProducto"]) && isset($_GET["nombreProducto"]))
{
  include('includes/config.php');
  $datosUsuario = obtenerDatosUsuario();
  $idTienda = $datosUsuario["idTienda"];
  $tablaProductos = 'productos_' . $idTienda;
  eliminarProducto($_GET["idProducto"], $_GET["nombreProducto"]);
  echo '<form action="productos.php" method="POST" class="form-inline" role="form" id="return-form">
    <input type="hidden" name="respuestaEliminacion" value="El producto ha sido eliminado correctamente">
    <input type="hidden" name="colorRespuesta" value="text-success">
  </form>
  <script>document.getElementById("return-form").submit();</script>';






}
else
{
  echo '<form action="productos.php" method="POST" class="form-inline" role="form" id="return-form">
  </form>
  <script>document.getElementById("return-form").submit();</script>';
}

?>
