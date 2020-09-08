<?php

include('includes/header.php');

$respuesta="";

if(isset($_POST["respuesta"]))
{
  $respuesta1 = '<div class="mb-4">';
  $respuesta2 = $_POST["respuesta"];
  $respuesta3 = '</div>';
  $respuesta = $respuesta1 . $respuesta2 . $respuesta3;
}

?>

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edita los datos generales de tu tienda</h1>
  </div>
  <?php echo $respuesta; ?>
  <!-- Content Row -->
  <form id="generalForm" action="generalAction" method="POST">
  <div class="form-group row">
    <label for="nombreTienda" class="col-sm-10 col-form-label"><b>Nombre de la tienda:</b> <em>Si cambias el nombre de tu tienda, también se modificará el subdominio <b>(Actual: <?php echo $subdominioTienda; ?>.empreweb.cl)</b></em></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="nombreTienda" id="nombreTienda" placeholder="<?php echo $nombreTienda; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="emailTienda" class="col-sm-10 col-form-label"><b>Email de la tienda:</b> <em>El email de este campo se utiliza como usuario de acceso y es el correo al que enviamos todas las notificaciones.</em></label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="emailTienda" id="emailTienda" placeholder="<?php echo $emailTienda; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="telefonoTienda" class="col-sm-10 col-form-label"><b>Teléfono de la tienda:</b></label>
    <div class="col-sm-10">
      <input type="number" class="form-control" name="telefonoTienda" id="telefonoTienda" placeholder="<?php echo $telefonoTienda; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="direccionTienda" class="col-sm-10 col-form-label"><b>Dirección de la tienda:</b></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="direccionTienda" id="direccionTienda" placeholder="<?php echo $direccionTienda; ?>">
    </div>
  </div>
  <div class="form-row text-center">
    <div class="col">
      <button type="submit" name="general" style="text-align:center" class="btn btn-primary col mb-2">Actualizar datos</button>
    </div>
  </div>
</form>

<?php

include('includes/footer.php');

?>
