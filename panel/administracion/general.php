<?php

if(isset($_POST["general"]))
{
  $jsonDatosPagina = file_get_contents("../structure/index.json");
  $arrayDatosPagina = json_decode($jsonDatosPagina);
  $arrayDatosPagina->nombrePagina=$_POST["nombrePagina"];
  $arrayDatosPagina->nombreTienda=$_POST["nombreTienda"];
  $arrayDatosPagina->email=$_POST["email"];
  $arrayDatosPagina->telefono=$_POST["telefono"];
  file_put_contents('../structure/index.json', json_encode($arrayDatosPagina));
}

$jsonDatosPagina = file_get_contents("../structure/index.json");
$arrayDatosPagina = json_decode($jsonDatosPagina);
$nombrePagina = $arrayDatosPagina->nombrePagina;
$nombreTienda = $arrayDatosPagina->nombreTienda;
$email = $arrayDatosPagina->email;
$telefono = $arrayDatosPagina->telefono;

?>

<form action="general.php" method="post">
  <label for="nombrePagina">Título de la página</label><br>
  <input type="text" name="nombrePagina" id="nombrePagina" placeholder="" value="<?php echo $nombrePagina; ?>"><br></br>
  <label for="nombrePagina">Nombre de la tienda</label><br>
  <input type="text" name="nombreTienda" placeholder="" value="<?php echo $nombreTienda; ?>"><br></br>
  <label for="nombrePagina">Email de la tienda</label><br>
  <input type="text" name="email" placeholder="" value="<?php echo $email; ?>"><br></br>
  <label for="nombrePagina">Teléfono de la tienda</label><br>
  <input type="text" name="telefono" placeholder="" value="<?php echo $telefono; ?>"><br></br>
  <input type="submit" name="general" placeholder="" value="Enviar">
</form>
