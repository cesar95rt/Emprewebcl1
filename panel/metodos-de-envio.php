<?php

include('includes/header.php');
$estadoStarken = 'Desactivado';
$estadoRetiro = 'Desactivado';
$estadoPersonalizado = 'Desactivado';
$metodosDeEnvio = obtenerMetodosDeEnvio($idTienda);
if($metodosDeEnvio==0)
{
  $estadoStarken = 'Desactivado';
  $estadoRetiro = 'Desactivado';
  $estadoPersonalizado = 'Desactivado';
}
else
{
  foreach($metodosDeEnvio as $metodoDeEnvio)
  {
    if($metodoDeEnvio["nombreMetodo"]==="starken")
    {
      if($metodoDeEnvio["estado"]==='activado')
      {
        $estadoStarken = "Activado";
      }
    }
    if($metodoDeEnvio["nombreMetodo"]==="retiro")
    {
      if($metodoDeEnvio["estado"]==='activado')
      {
        $estadoRetiro = "Activado";
      }
    }
    if($metodoDeEnvio["nombreMetodo"]==="personalizado")
    {
      if($metodoDeEnvio["estado"]==='activado')
      {
        $estadoPersonalizado = "Activado";
      }
    }
  }
}

?>

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Métodos de envío</h1>
  </div>
  <p>Activa los métodos de envío que ofrecerás a tus clientes para recibir sus productos comprados.<br>
  Posteriormente, al crear cada producto, tendrás la opción de elegir cuáles de tus métodos de envío activados habilitarás para cada uno.</p>
  <br>
  <div class="row">
    <div class="col-sm-4">
      <div class="container">
        <div class="center row">
          <h4>Starken</h4>
        </div>
        <div class="center row">
          <p>Estado: <?php echo $estadoStarken; ?></p>
        </div>
        <div class="center row">
          <a href="starken" class="btn btn-primary" name="botonStarken">Configurar</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="container">
        <div class="center row">
          <h4>Retiro en tienda</h4>
        </div>
        <div class="center row">
          <p>Estado: <?php echo $estadoRetiro; ?></p>
        </div>
        <div class="center row">
          <a href="retiro-en-tienda" class="btn btn-primary" name="botonRetiro">Configurar</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="container">
        <div class="center row">
          <h4>Envío personalizado</h4>
        </div>
        <div class="center row">
          <p>Estado: <?php echo $estadoPersonalizado; ?></p>
        </div>
        <div class="center row">
          <a href="envio-personalizado" class="btn btn-primary" name="botonPersonalizado">Configurar</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Content Row -->


<?php

include('includes/footer.php');

?>
