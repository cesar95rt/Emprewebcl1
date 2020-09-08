<?php

include('includes/header.php');

?>

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cambia tu contraseña</h1>
  </div>
  <?php if(isset($_POST["respuestaSi"])){echo '<div class="d-sm-flex align-items-center justify-content-between mb-4"><h5 class="h5 mb-0 text-success">' . $_POST["respuestaSi"] . '</h5></div>';}else{
      if(isset($_POST["respuestaNo"])){echo '<div class="d-sm-flex align-items-center justify-content-between mb-4"><h5 class="h5 mb-0 text-danger">' . $_POST["respuestaNo"] . '</h5></div>';}else{}}?>

  <!-- Content Row -->
  <div id="formularioSolicitud" class="row mb-4">
    <label for="botonSolicitud" class="col-sm-12 col-form-label mb-4">Para cambiar tu contraseña, debes hacer clic en el siguiente botón para solicitar un código de cambio de contraseña, que será enviado automáticamente a tu correo electrónico.<br>Todo esto, con el fin de ofrecerle la mayor seguridad posible a nuestros clientes.</label>
    <div class="col-sm-12">
      <a class="btn btn-primary" href="#" onclick="enviarCodigo(); return false" id="botonSolicitud" name="button">Solicitar cambio de contraseña</a>
      <input type="text" hidden id="emailTienda" name="emailTienda" value="<?php echo $emailTienda; ?>">
      <input type="text" hidden id="nombreTienda" name="nombreTienda" value="<?php echo $nombreTienda; ?>">
      <input type="text" hidden id="idTienda" name="idTienda" value="<?php echo $idTienda; ?>">
    </div>
  </div>
  <form style="display:none;" id="formularioCambio" action="cambiar-contrasenaAction" method="POST">
  <p id="respuestaSolicitud" class="text-success"></p>
  <div class="form-group row">
    <label for="codigoCambio" class="col-sm-12 col-form-label"><b>Código:</b> Ingresa el código que fue enviado recientemente a tu correo electrónico</label>
    <div class="col-sm-12">
      <input type="text" class="form-control" name="codigoCambio" id="codigoCambio">
    </div>
  </div>
  <div class="form-group row">
    <label for="currentPassword" class="col-sm-12 col-form-label"><b>Contraseña actual:</b></label>
    <div class="col-sm-12">
      <input type="password" class="form-control" name="currentPassword" id="currentPassword" value="">
    </div>
  </div>
  <div class="form-group row">
    <label for="exampleInputPassword" class="col-sm-12 col-form-label"><b>Nueva contraseña:</b></label>
    <div class="col-sm-12">
      <input type="password" class="form-control" name="password" id="exampleInputPassword" value="">
    </div>
  </div>
  <div class="form-group row">
    <label for="exampleRepeatPassword" class="col-sm-12 col-form-label"><b>Confirma tu nueva contraseña:</b></label>
    <div class="col-sm-12">
      <input type="password" class="form-control" name="confirmPassword" id="exampleRepeatPassword" value="">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-10">
      <input type="submit" class="btn btn-success" name="cambiarPassword" value="Cambiar contraseña">
    </div>
  </div>
</form>

<script>

  function enviarCodigo(str)
  {
    var idTienda = document.getElementById("idTienda").value;
    var emailTienda = document.getElementById("emailTienda").value;
    var nombreTienda = document.getElementById("nombreTienda").value;
     var xmlhttp;

     if (window.XMLHttpRequest)
     {// code for IE7+, Firefox, Chrome, Opera, Safari
       xmlhttp=new XMLHttpRequest();
     }
     else
     {// code for IE6, IE5
       xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
     }

     xmlhttp.onreadystatechange = function() {
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
       {
         document.getElementById('formularioSolicitud').style.display = 'none';
         document.getElementById('formularioCambio').style.display = 'block';
         document.getElementById("respuestaSolicitud").innerHTML = xmlhttp.responseText;
       }
     }

     xmlhttp.open("GET","./includes/correoCambioContrasena.php?emailTienda="+emailTienda+"&idTienda="+idTienda+"&nombreTienda="+nombreTienda, true);
     xmlhttp.send();
 }
</script>
<script src="../js/register.js"></script>

<?php

include('includes/footer.php');

?>
