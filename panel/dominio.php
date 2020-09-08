<?php

include('includes/header.php');

if($dominioTienda != '')
{
  $placeholderDominio = $dominioTienda;
  $titulo = 'Edita el dominio principal de tu tienda';
  $descripcion = 'Actualmente, el dominio de tu tienda es: <b>' . $dominioTienda . '</b>.<br></br>
  Si deseas cambiarlo, recuerda apuntar las DNS (Name server - Nombre de servidor) de tu nuevo dominio a:<br>
  <b>ns1.digitalocean.com</b><br>
  <b>ns2.digitalocean.com</b><br>
  <b>ns3.digitalocean.com</b><br></br>';
  $boton = 'Actualizar dominio';
}
else
{
  $placeholderDominio = 'tudominio.com';
  $titulo = 'Agrega tu propio dominio a tu tienda';
  $descripcion = 'Si tienes un dominio propio, puedes agregarlo a tu tienda para que tus clientes puedan usarlo para acceder a ella.<br></br>
  Para esto, primero debes apuntar las DNS (Name server - Nombre de servidor) de tu dominio a:<br>
  <b>ns1.digitalocean.com</b><br>
  <b>ns2.digitalocean.com</b><br>
  <b>ns3.digitalocean.com</b><br></br>
  Para poder utilizar esta opción, <b>es necesario que tengas contratado un plan de pago</b>.<br>
  Si sigues en el período de prueba, <a href="mi-plan">puedes actualizar ahora mismo tu plan aquí.</a><br></br>
  Si aún no tienes tu propio dominio, <a href="contratar-dominio">puedes contratarlo con nosotros aquí.</a><br></br>';
  $boton = 'Agregar dominio';
}

?>

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $titulo; ?></h1>
  </div>
<div class="">
  <?php echo $descripcion; ?>
</div>
<div class="form-group">
<label for="twitterTienda" class="col-form-label">Ingresa el nombre de tu dominio sin anteponer <b><i>www</i></b>, <b><i>http</i></b> ni <b><i>https</i></b>. Por ejemplo: <b>empreweb.cl</b></label>
<input type="text" id="dominioCliente" class="form-control col-sm-6" name="dominioCliente" placeholder="<?php echo $placeholderDominio; ?>" value="">
</div>
<div class="form-group">
<button type="button" class="btn btn-primary" onclick="comprobarCrearDominio(); return false" name="button"><?php echo $boton; ?></button>
</div>
<div id="respuestaPruebaDominio" class="">
</div>
<br>
<hr>
<div id="avisoSSL" class="">
<b>*IMPORTANTE*</b><br>
Podrás acceder a tu tienda a través de tu nuevo dominio al instante, pero el certificado SSL quedará habilitado a las 5:00 am del día siguiente, <b>solo si es que registraste tu dominio antes de las 22:00.</b><br>
Si lo registraste después de este horario, el certificado de seguridad tardará 24 horas adicionales en ser activado.<br>
Por ejemplo, si registras tu dominio un día sábado a las 21:50, el certificado estará activo el día domingo desde las 5:00 am.<br>
En cambio, si lo registras el mismo día sábado, pero a las 22:01, el certificado SSL estará disponible desde el día lunes a las 5:00 am.
</div>

<script>
function comprobarCrearDominio()
{
  var xmlhttp;
  var dominioCliente = document.getElementById("dominioCliente").value;
  if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  }
  else
  {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

  xmlhttp.open("GET","/includes/comprobarAgregarDominio?dominioCliente=" + dominioCliente, true);
  xmlhttp.send();

  xmlhttp.onreadystatechange = function() {
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("respuestaPruebaDominio").innerHTML = xmlhttp.responseText;
    }
  }
}
</script>

<?php

include('includes/footer.php');

?>
