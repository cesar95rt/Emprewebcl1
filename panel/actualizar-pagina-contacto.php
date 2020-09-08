<?php

include('includes/config.php');

if(isset($_POST["titulo1"]))
{
  $titulo1 = $_POST["titulo1"];
  $titulo2 = $_POST["titulo2"];
  $subtitulo1 = $_POST["subtitulo1"];
  $subtitulo2 = $_POST["subtitulo2"];
  $direccionMapa = $_POST["direccionMapa"];
  $horario1 = $_POST["horario1"];
  $horario2 = $_POST["horario2"];
  $estado = $_POST["estado"];
  actualizarPaginaContacto($estado, $idTienda, $titulo1, $titulo2, $subtitulo1, $subtitulo2, $direccionMapa, $horario1, $horario2);
}
else
{
  echo '<script>window.location.replace("pagina-contacto");</script>';
}

?>
