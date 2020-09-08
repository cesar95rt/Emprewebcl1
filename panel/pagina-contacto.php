<?php

include('includes/header.php');

$datosPaginaContacto = obtenerDatosPaginaContacto();

  $titulo1 = $datosPaginaContacto["titulo1"];
  $titulo2 = $datosPaginaContacto["titulo2"];
  $subtitulo1 = $datosPaginaContacto["subtitulo1"];
  $subtitulo2 = $datosPaginaContacto["subtitulo2"];
  $horario1 = $datosPaginaContacto["horario1"];
  $horario2 = $datosPaginaContacto["horario2"];
  $direccionMapa = $datosPaginaContacto["direccion"];
  $estado = $datosPaginaContacto["paginaContacto"];
  $estadoActivada = '';
  $estadoDesactivada = 'selected';
  if($estado==='Activada')
  {
    $estadoActivada = 'selected';
    $estadoDesactivada = '';
  }


?>

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edita la página de contacto de tu tienda</h1>
  </div>
  <?php if(isset($_POST["respuestaDatosPaginaContacto"])){ ?><div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h5 class="h5 mb-0 text-success"><?php if(isset($_POST["respuestaDatosPaginaContacto"])){echo $_POST["respuestaDatosPaginaContacto"];} ?></h5>
  </div><?php } ?>
  <!-- Content Row -->
  <form id="formularioPaginaContacto" action="actualizar-pagina-contacto" method="POST">
    <div class="form-group row">
      <label for="estado"  class="col-sm-12 col-form-label"><b>Estado de la página de contacto:</b> Puedes activar y desactivar la página de contacto de tu tienda cuando lo desees.</label>
      <div class="col-sm-3">
        <select class="form-control" onload="primeraFuncion();" onchange="segundaFuncion();" name="estado" id="estado" value="<?php echo $estado; ?>">
          <option <?php echo $estadoActivada; ?> value="Activada">Activada</option>
          <option <?php echo $estadoDesactivada; ?> value="Desactivada">Desactivada</option>
        </select>
      </div>
    </div>
  <div id="conta1" class="form-group row">
    <label for="titulo1" class="col-sm-12 col-form-label"><b>Título 1:</b> Es el título de la sección de tus datos de contacto. <i>Predeterminado: Contáctanos.</i></label>
    <div class="col-sm-12">
      <input type="text" placeholder="Contáctanos" class="form-control" name="titulo1" id="titulo1" value="<?php echo $titulo1; ?>">
    </div>
  </div>
  <div id="conta2" class="form-group row">
    <label for="titulo2" class="col-sm-12 col-form-label"><b>Título 2:</b> Es el título de la sección del formulario de contacto. <i>Predeterminado: Déjanos un mensaje.</i></label>
    <div class="col-sm-12">
      <input type="text" class="form-control" placeholder="Déjanos un mensaje" name="titulo2" id="titulo2" value="<?php echo $titulo2; ?>">
    </div>
  </div>
  <div id="conta3" class="form-group row">
    <label for="subtitulo1" class="col-sm-12 col-form-label"><b>Subtitulo 1:</b> Agrega un subtítulo a la sección de tus datos de contacto.</label>
    <div class="col-sm-12">
      <input type="text" class="form-control" name="subtitulo1" id="subtitulo1" value="<?php echo $subtitulo1; ?>">
    </div>
  </div>
  <div id="conta4" class="form-group row">
    <label for="subtitulo2" class="col-sm-12 col-form-label"><b>Subtítulo 2:</b> Agrega un subtítulo a la sección del formulario de contacto</label>
    <div class="col-sm-12">
      <input type="text" class="form-control" name="subtitulo2" id="subtitulo2" value="<?php echo $subtitulo2; ?>">
    </div>
  </div>
  <div id="conta5" class="form-group row">
    <label for="direccionMapa" class="col-sm-12 col-form-label"><b>Dirección del mapa:</b> En la página de contacto se mostrará un mapa. Para esto, debes ingresar la dirección de tu tienda, junto a la comuna, ciudad y país. Si está ubicada en un departamento u oficina, no ingreses este dato, eso lo puedes modificar <a href="general">aquí</a>. Este campo de dirección es solo para el mapa. Puedes dejar vacío este campo para que no aparezca el mapa.</label>
    <div class="col-sm-12">
      <input type="text" placeholder="Ejemplo: Calle y N°, Comuna, Ciudad, País" class="form-control" name="direccionMapa" id="direccionMapa" value="<?php echo $direccionMapa; ?>">
    </div>
  </div>
  <div id="conta6" class="form-group row">
    <label for="horario1" class="col-sm-12 col-form-label"><b>Horario - Línea 1:</b></label>
    <div class="col-sm-12">
      <input type="text" class="form-control" name="horario1" id="horario1" value="<?php echo $horario1; ?>">
    </div>
  </div>
  <div id="conta7" class="form-group row">
    <label for="horario2" class="col-sm-12 col-form-label"><b>Horario - Línea 2:</b></label>
    <div class="col-sm-12">
      <input type="text" class="form-control" name="horario2" id="horario2" value="<?php echo $horario2; ?>">
    </div>
  </div>
  <div class="form-row text-center">
    <div class="col">
      <button type="submit" name="paginaContacto" form="formularioPaginaContacto" style="text-align:center" class="btn btn-primary col mb-2">Actualizar página de contacto</button>
    </div>
  </div>
</form>

<script>

window.onload = function primeraFuncion()
{
  var estado = document.getElementById('estado').value;
  if(estado == 'Desactivada')
  {
    document.getElementById('conta1').style.display = 'none';
    document.getElementById('conta2').style.display = 'none';
    document.getElementById('conta3').style.display = 'none';
    document.getElementById('conta4').style.display = 'none';
    document.getElementById('conta5').style.display = 'none';
    document.getElementById('conta6').style.display = 'none';
    document.getElementById('conta7').style.display = 'none';
  }
  else
  {
    document.getElementById('conta1').style.display = 'block';
    document.getElementById('conta2').style.display = 'block';
    document.getElementById('conta3').style.display = 'block';
    document.getElementById('conta4').style.display = 'block';
    document.getElementById('conta5').style.display = 'block';
    document.getElementById('conta6').style.display = 'block';
    document.getElementById('conta7').style.display = 'block';
  }
}

function segundaFuncion()
{
  {
    var estado = document.getElementById('estado').value;
    if(estado == 'Desactivada')
    {
      document.getElementById('conta1').style.display = 'none';
      document.getElementById('conta2').style.display = 'none';
      document.getElementById('conta3').style.display = 'none';
      document.getElementById('conta4').style.display = 'none';
      document.getElementById('conta5').style.display = 'none';
      document.getElementById('conta6').style.display = 'none';
      document.getElementById('conta7').style.display = 'none';
    }
    else
    {
      document.getElementById('conta1').style.display = 'block';
      document.getElementById('conta2').style.display = 'block';
      document.getElementById('conta3').style.display = 'block';
      document.getElementById('conta4').style.display = 'block';
      document.getElementById('conta5').style.display = 'block';
      document.getElementById('conta6').style.display = 'block';
      document.getElementById('conta7').style.display = 'block';
    }
  }
}

</script>

<?php

include('includes/footer.php');

?>
