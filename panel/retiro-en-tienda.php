<?php

include('includes/header.php');

$configuracionRetiro = obtenerConfiguracionRetiro($idTienda);

$region = '';
$comuna = '';
$direccion = '';
$oficina = '';
$horario1 = '';
$horario2 = '';
$selected1 = '';
$selected2 = 'selected';

if($configuracionRetiro==0)
{
  $region = '';
  $comuna = '';
  $direccion = '';
  $oficina = '';
  $horario1 = '';
  $horario2 = '';
  $selected1 = '';
  $selected2 = 'selected';
}
else
{
  $region = $configuracionRetiro["region"];
  $comuna = $configuracionRetiro["comuna"];
  $direccion = $configuracionRetiro["direccion"];
  $oficina = $configuracionRetiro["oficina"];
  $horario1 = $configuracionRetiro["horario1"];
  $horario2 = $configuracionRetiro["horario2"];
  $estado = $configuracionRetiro["estado"];
  if($estado==='activado')
  {
    $selected1 = 'selected';
    $selected2 = '';
  }
  else
  {
    $selected2 = 'selected';
    $selected1 = '';
  }
}

?>

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Métodos de envío: Retiro en tienda</h1>
  </div>
  <?php if(isset($_POST["respuestaRedesSociales"])){ ?><div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h5 class="h5 mb-0 text-success"><?php if(isset($_POST["respuestaRedesSociales"])){echo $_POST["respuestaRedesSociales"];} ?></h5>
  </div><?php } ?>
  <p>Si cuentas con una tienda o domicilio físico en el cuál tus clientes pueden retirar sus productos comprados, puedes activar esta opción
  llenando el formulario que te presentamos a continuación.</p><br>
  <!-- Content Row -->
  <input id="preseleccionado" hidden style="display:none;" name="preseleccionado" value="<?php echo $origen; ?>">
  <form id="formularioRetiro" action="retiro-en-tiendaAction" method="POST">
  <div class="form-group row">
    <label for="estado" class="col-sm-12 col-form-label"><b>Estado del método de entrega RETIRO EN TIENDA</b></label>
    <p class="col-sm-12">(Activado - Desactivado)</p>
    <div class="col-sm-4">
      <select class="form-control mb-4" onchange="divOrigen()" id="estado" name="estado">
        <option <?php echo $selected1; ?> value="activado">Activado</option>
        <option <?php echo $selected2; ?> value="desactivado">Desactivado</option>
      </select>
    </div>
  </div>
  <div id="divOrigen" style="display:none;" class="form-group row">
    <div class="col-sm-4 mb-4">
      <label for="regionRetiro" ><b>Región</b></label>
      <input type="text" class="form-control" required id="regionRetiro" name="regionRetiro" value="<?php echo $region; ?>">
    </div>
    <div class="col-sm-4 mb-4">
      <label for="comunaRetiro" ><b>Comuna</b></label>
      <input type="text" class="form-control" required id="comunaRetiro" name="comunaRetiro" value="<?php echo $comuna; ?>">
    </div>
    <div class="col-sm-4 mb-4">
      <label for="direccionRetiro" ><b>Calle y número</b></label>
      <input type="text" class="form-control" required id="direccionRetiro" name="direccionRetiro" value="<?php echo $direccion; ?>">
    </div>
    <div class="col-sm-4 mb-4">
      <label for="oficinaRetiro" ><b>N° de oficina o de departamento (opcional)</b></label>
      <input type="text" class="form-control" id="oficinaRetiro" name="oficinaRetiro" value="<?php echo $oficina; ?>">
    </div>
    <div class="col-sm-4 mb-4">
      <label for="horario1Retiro" ><b>Horario 1</b></label>
      <input type="text" class="form-control" required id="horario1Retiro" name="horario1Retiro" value="<?php echo $horario1; ?>">
    </div>
    <div class="col-sm-4 mb-4">
      <label for="horario2Retiro" ><b>Horario 2 (opcional)</b></label>
      <input type="text" class="form-control" id="horario2Retiro" name="horario2Retiro" value="<?php echo $horario2; ?>">
    </div>
  </div>
  <div class="form-row">
    <div class="col-sm-4">
      <button type="submit" name="botonRetiro" style="text-align:center" class="btn btn-primary col mb-2">Guardar</button>
    </div>
  </div>
</form>

<script type="text/javascript">
  window.addEventListener('load', function() {
    var estado = document.getElementById("estado").value;
    if(estado=="activado")
    {
      document.getElementById("divOrigen").style.display = '';
    }
    document.getElementById("origen").value = document.getElementById("preseleccionado").value;
  });

  function divOrigen()
  {
    var estado = document.getElementById("estado").value;
    if(estado=="activado")
    {
      document.getElementById("divOrigen").style.display = '';
    }
    else
    {
      document.getElementById("divOrigen").style.display = 'none';
    }
  }
</script>
<?php

include('includes/footer.php');

?>
