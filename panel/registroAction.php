<?php

include('includes/dbConfig.php');
include('includes/funciones.php');

$nombreTienda = $_POST["nombreTienda"];
$emailTienda = $_POST["emailTienda"];
$password = $_POST["password"];

$subdominioTiendaI = str_replace(' ', '', $_POST["nombreTienda"]);
$subdominioTienda = strtolower($subdominioTiendaI);

$resultadoRegistro = verificarRegistro($emailTienda, $subdominioTienda);
echo $resultadoRegistro;

if($resultadoRegistro == 0)
{

    $returnRegistro = registrarUsuario($nombreTienda, $subdominioTienda, $emailTienda, $password);
    $idTienda = $returnRegistro["idTienda"];
    $secretKey = $returnRegistro["secretKey"];
    crearTablaCategorias($idTienda);
    crearTablaDatosTienda($idTienda);
    crearTablaProductos($idTienda);
    crearTablaSubcategorias($idTienda);
    crearTablaImagenes($idTienda);
    llenarTablaDatosTienda($idTienda, $nombreTienda, $emailTienda, $subdominioTienda, $secretKey);
    $dir = __DIR__ . '/tiendas' . '/' . $secretKey;
    mkdir($dir);
    $dir2 = __DIR__ . '/tiendas' . '/' . $secretKey . '/imagenes';
    mkdir($dir2);
    $respuestaLogin = guardarSession($emailTienda);
    echo '<script>window.location.href = "../";</script>';

}
else
{
  if($resultadoRegistro == 1)
  {
    $respuestaRegistro = 'Ya existe una tienda con ese nombre';
    echo '<form action="registro.php" method="POST" class="form-inline" role="form" id="return-form">
      <input type="hidden" name="respuestaRegistro" value="' . $respuestaRegistro . '">
    </form>
    <script>document.getElementById("return-form").submit();</script>';
  }else
  {
    if($resultadoRegistro == 2)
    {
      $respuestaRegistro = 'El email y el nombre de la tienda ingresados ya están registrados';
      echo '<form action="registro.php" method="POST" class="form-inline" role="form" id="return-form">
        <input type="hidden" name="respuestaRegistro" value="' . $respuestaRegistro . '">
      </form>
      <script>document.getElementById("return-form").submit();</script>';
    }else
    {
      $respuestaRegistro = 'El email ingresado ya está registrado';
      echo '<form action="registro.php" method="POST" class="form-inline" role="form" id="return-form">
        <input type="hidden" name="respuestaRegistro" value="' . $respuestaRegistro . '">
      </form>
      <script>document.getElementById("return-form").submit();</script>';

    }
  }
}

?>
