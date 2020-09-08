<?php

include('./includes/config.php');

if(isset($_POST["general"]))
{
  $editarMysql = 0;
  $nombreTiendaMysql = $nombreTienda;
  $subdominioTiendaMysql = $subdominioTienda;
  $emailTiendaMysql = $emailTienda;
  $telefonoTiendaMysql = $telefonoTienda;
  $direccionTiendaMysql = $direccionTienda;
  $respuestaCambioNombreTienda = "";
  $respuestaCambioEmailTienda = "";
  $respuestaCambioTelefonoTienda = "";
  $respuestaCambioDireccionTienda = "";
  if($_POST["nombreTienda"]!="")
  {
    $nuevoSubdominioTienda1 = str_replace(' ', '', $_POST["nombreTienda"]);
    $nuevoSubdominioTienda = strtolower($nuevoSubdominioTienda1);
    if(verificarNombreTienda($nuevoSubdominioTienda)==1)
    {
      $nombreTiendaMysql = $_POST["nombreTienda"];
      $subdominioTiendaMysql = $nuevoSubdominioTienda;
      $respuestaCambioNombreTienda = "<h6 class='h6 text-success'>El nombre de la tienda ha sido actualizado correctamente</h6><br>";
      $editarMysql = 1;
    }
    else
    {
      $respuestaCambioNombreTienda = "<h6 class='h6 text-danger'>Ya hay una tienda con ese nombre</h6><br>";
    }
  }
  if($_POST["emailTienda"]!="")
  {
    $nuevoEmailTienda = $_POST["emailTienda"];
    if(verificarEmailTienda($nuevoEmailTienda)==1)
    {
      $emailTiendaMysql = $_POST["emailTienda"];
      $respuestaCambioEmailTienda = "<h6 class='h6 text-success'>El email de la tienda ha sido actualizado correctamente</h6><br>";
      $editarMysql = 1;
    }
    else
    {
      $respuestaCambioEmailTienda = "<h6 class='h6 text-danger'>Ese email ya está registrado</h6><br>";
    }
  }
  if($_POST["telefonoTienda"]!="")
  {
    $telefonoTiendaMysql=$_POST["telefonoTienda"];
    $respuestaCambioTelefonoTienda = "<h6 class='h6 text-success'>El teléfono de la tienda ha sido actualizado correctamente</h6><br>";
    $editarMysql = 1;
  }
  if($_POST["direccionTienda"]!="")
  {
    $direccionTiendaMysql=$_POST["direccionTienda"];
    $respuestaCambioDireccionTienda = "<h6 class='h6 text-success'>La dirección de la tienda ha sido actualizada correctamente</h6><br>";
    $editarMysql = 1;
  }
  if($editarMysql==1)
  {
    actualizarDatosTiendaMysql($tablaTienda, $nombreTiendaMysql, $subdominioTiendaMysql, $emailTiendaMysql, $idTienda, $direccionTiendaMysql, $telefonoTiendaMysql);
    $respuesta = $respuestaCambioNombreTienda . $respuestaCambioEmailTienda . $respuestaCambioTelefonoTienda . $respuestaCambioDireccionTienda;
    echo '<form action="general" method="POST" class="form-inline" role="form" id="return-form">
      <input type="hidden" name="respuesta" value="' . $respuesta . '">
    </form>
  </div>
  </div>
  <script>document.getElementById("return-form").submit();</script>';
  }
}

?>
