<?php

include('includes/header.php');

$redesSocialesTienda = obtenerRedesSocialesTienda();
$facebookTienda = $redesSocialesTienda["facebookTienda"];
$twitterTienda = $redesSocialesTienda["twitterTienda"];
$linkedinTienda = $redesSocialesTienda["linkedinTienda"];
$whatsappTienda = $redesSocialesTienda["whatsappTienda"];

?>

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edita las redes sociales de tu tienda</h1>
  </div>
  <?php if(isset($_POST["respuestaRedesSociales"])){ ?><div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h5 class="h5 mb-0 text-success"><?php if(isset($_POST["respuestaRedesSociales"])){echo $_POST["respuestaRedesSociales"];} ?></h5>
  </div><?php } ?>
  <!-- Content Row -->
  <form id="redesSocialesForm" action="actualizar-redes-sociales" method="POST">
  <div class="form-group row">
    <label for="facebookTienda" class="col-sm-10 col-form-label"><b>Facebook:</b> <i>Si tu enlace a Facebook es facebook.com/emprewebcl, ingresa solo <b>emprewebcl</b></i></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="facebookTienda" id="facebookTienda" value="<?php echo $facebookTienda; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="twitterTienda" class="col-sm-10 col-form-label"><b>Twitter:</b> <i>Si tu enlace a Twitter es twitter.com/emprewebcl, ingresa solo <b>emprewebcl</b></i></label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="twitterTienda" id="twitterTienda" value="<?php echo $twitterTienda; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="linkedinTienda" class="col-sm-10 col-form-label"><b>Linkedin:</b> <i>Ingresa el <b>enlace completo</b> a tu Linkedin, por ejemplo <b>https://www.linkedin.com/company/empreweb</b>.</i></label>
    <div class="col-sm-10">
      <input type="url" class="form-control" name="linkedinTienda" id="linkedinTienda" value="<?php echo $linkedinTienda; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="whatsappTienda" class="col-sm-10 col-form-label"><b>Whatsapp:</b> <i>Ingresa <b>solo números</b>, si tu Whatsapp es (+56)912345678, ingresa solo <b>56912345678</b></i></label>
    <div class="col-sm-10">
      <input type="number" class="form-control" name="whatsappTienda" id="whatsappTienda" value="<?php echo $whatsappTienda; ?>">
    </div>
  </div>
  <div class="form-row text-center">
    <div class="col">
      <button type="submit" name="redesSociales" style="text-align:center" class="btn btn-primary col mb-2">Actualizar datos</button>
    </div>
  </div>
</form>

<?php

include('includes/footer.php');

?>
