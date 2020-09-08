<?php

session_start();

$conexion = new mysqli("localhost","cesar95rt","Microfono_1995","empreweb", "3306");
$acentos = $conexion->query("SET NAMES 'utf8'");

include(__DIR__ . '/funciones.php');

if(isset($_SESSION["empreweb"]))
{
  $datosUsuario = obtenerDatosUsuario();
  $idTienda = $datosUsuario["idTienda"];
  $nombreTienda = $datosUsuario["nombreTienda"];
  $emailTienda = $datosUsuario["emailTienda"];
  $telefonoTienda = $datosUsuario["telefonoTienda"];
  $direccionTienda = $datosUsuario["direccionTienda"];
  $password = $datosUsuario["passwordTienda"];
  $subdominioTienda = $datosUsuario["subdominioTienda"];
  $dominioTienda = $datosUsuario["dominioTienda"];
  $fechaRegistro = $datosUsuario["fechaRegistroTienda"];
  $estadoPlan = $datosUsuario["estadoPlan"];
  $tablaTienda = 'datostienda_' . $idTienda;
  $tablaCategorias = 'categorias_' . $idTienda;
  $tablaSubcategorias = 'subcategorias_' . $idTienda;
  $tablaProductos = 'productos_' . $idTienda;
  $tablaImagenes = 'imagenes_' . $idTienda;
  $tablaTags = 'tags_' . $idTienda;
  $tablaDescripcionesCortas = 'descripcionescortasproducto_' . $idTienda;
  $tablaColores = 'colores_' . $idTienda;
  $tablaPaginaContacto = 'paginacontacto_' . $idTienda;
  $secretKey = $datosUsuario["secretKey"];
  $carpetaTienda = __DIR__ . '/tiendas' . '/' . $secretKey;
}else
{
  $respuestaLogin = '';
  echo '<form action="login.php" method="POST" class="form-inline" role="form" id="return-form">
  <input type="hidden" name="respuestaLogin" value="' . $respuestaLogin . '">
  </form>
  <script>document.getElementById("return-form").submit();</script>';
}

?>
