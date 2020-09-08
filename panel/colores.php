<?php

include('includes/header.php');

$consultaColores = "SELECT * FROM $tablaColores";
$resultadoColores = $conexion->query($consultaColores);
while($color = $resultadoColores->fetch_array(MYSQLI_ASSOC))
{
  $arrayColores[] = $color;
}
$i = 0;
foreach($arrayColores as $color)
{
  if($color["colorElegido"]==='' || is_null($color["colorElegido"]))
  {
    $arrayColoresFinal[$i]["colorFinal"] = $color["colorDefault"];
  }
  else
  {
    $arrayColoresFinal[$i]["colorFinal"] = $color["colorElegido"];
  }
  $i++;
}

?>

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edita los colores de tu tienda</h1>
    <button form="formularioColores" name="actualizarColores" class="btn btn-success">Actualizar colores</button>
  </div>
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h5 class="h5 mb-0 text-success"><?php if(isset($_POST["respuestaEdicionColores"])){echo $_POST["respuestaEdicionColores"];} ?></h5>
  </div>
  <form action="actualizar-colores" name="formularioColores" id="formularioColores" method="POST">
  <div class="row">
      <div class="col-sm-4">
        <div class="container">
        <h5 style="text-align:center;"><label for="color1" class="col-form-label"><?php echo $arrayColores[0]["descripcionColor"]; ?></label></h5><br>
        <input type="color" id="color1" class="form-control col-sm-12 mb-4" name="color1" value="<?php echo $arrayColoresFinal[0]["colorFinal"]; ?>">
        <div class="row">
          <b class="col-sm-9">Regresar a color anterior: </b><input type="button" onclick="volverAnterior(this.id); return false;" id="anterior1" class="btn col-sm-3 mb-4" name="anterior1" style="<?php echo 'border-color:black; border-radius:30px; background-color:' . $arrayColoresFinal[0]["colorFinal"] . '; color:' . $arrayColoresFinal[0]["colorFinal"] . ';" value="' . $arrayColoresFinal[0]["colorFinal"]; ?>"><br>
        </div>
        <div class="row">
          <b class="col-sm-9">Regresar a color predeterminado: </b><input type="button" onclick="volverDefault(this.id); return false;" id="predeterminado1" class="btn col-sm-3 mb-4" name="predeterminado1" style="<?php echo 'border-color:black; border-radius:30px; background-color:' . $arrayColores[0]["colorDefault"] . '; color:' . $arrayColores[0]["colorDefault"] . ';" value="' . $arrayColores[0]["colorDefault"]; ?>"><br>
        </div>
      </div>
    </div>
  <div class="col-sm-4">
    <div class="container">
    <h5 style="text-align:center;"><label for="color2" class="col-form-label"><?php echo $arrayColores[1]["descripcionColor"]; ?></label></h5><br>
    <input type="color" id="color2" class="form-control col-lg-12 mb-4" name="color2" value="<?php echo $arrayColoresFinal[1]["colorFinal"]; ?>">
    <div class="row">
      <b class="col-sm-9">Regresar a color anterior: </b><input type="button" onclick="volverAnterior(this.id); return false;" id="anterior2" class="btn col-sm-3 mb-4" name="anterior2" style="<?php echo 'border-color:black; border-radius:30px; background-color:' . $arrayColoresFinal[1]["colorFinal"] . '; color:' . $arrayColoresFinal[1]["colorFinal"] . ';" value="' . $arrayColoresFinal[1]["colorFinal"]; ?>"><br>
    </div>
    <div class="row">
      <b class="col-sm-9">Regresar a color predeterminado: </b><input type="button" onclick="volverDefault(this.id); return false;" id="predeterminado2" class="btn col-sm-3 mb-4" name="predeterminado2" style="<?php echo 'border-color:black; border-radius:30px; background-color:' . $arrayColores[1]["colorDefault"] . '; color:' . $arrayColores[1]["colorDefault"] . ';" value="' . $arrayColores[1]["colorDefault"]; ?>"><br>
    </div>
  </div>
  </div>
  <div class="col-sm-4">
    <div class="container">
    <h5 style="text-align:center;"><label for="color3" class="col-form-label"><?php echo $arrayColores[2]["descripcionColor"]; ?></label></h5><br>
    <input type="color" id="color3" class="form-control col-lg-12 mb-4" name="color3" value="<?php echo $arrayColoresFinal[2]["colorFinal"]; ?>">
    <div class="row">
      <b class="col-sm-9">Regresar a color anterior: </b><input type="button" onclick="volverAnterior(this.id); return false;" id="anterior3" class="btn col-sm-3 mb-4" name="anterior3" style="<?php echo 'border-color:black; border-radius:30px; background-color:' . $arrayColoresFinal[2]["colorFinal"] . '; color:' . $arrayColoresFinal[2]["colorFinal"] . ';" value="' . $arrayColoresFinal[2]["colorFinal"]; ?>"><br>
    </div>
    <div class="row">
      <b class="col-sm-9">Regresar a color predeterminado: </b><input type="button" onclick="volverDefault(this.id); return false;" id="predeterminado3" class="btn col-sm-3 mb-4" name="predeterminado3" style="<?php echo 'border-color:black; border-radius:30px; background-color:' . $arrayColores[2]["colorDefault"] . '; color:' . $arrayColores[2]["colorDefault"] . ';" value="' . $arrayColores[2]["colorDefault"]; ?>"><br>
    </div>
  </div>
  </div>
  </div>
  <hr style="visibility:hidden;">
  <div class="row">
  <div class="col-sm-4">
    <div class="container">
    <h5 style="text-align:center;"><label for="color4" class="col-form-label"><?php echo $arrayColores[3]["descripcionColor"]; ?></label></h5><br>
    <input type="color" id="color4" class="form-control col-lg-12 mb-4" name="color4" value="<?php echo $arrayColoresFinal[3]["colorFinal"]; ?>">
    <div class="row">
      <b class="col-sm-9">Regresar a color anterior: </b><input type="button" onclick="volverAnterior(this.id); return false;" id="anterior4" class="btn col-sm-3 mb-4" name="anterior4" style="<?php echo 'border-color:black; border-radius:30px; background-color:' . $arrayColoresFinal[3]["colorFinal"] . '; color:' . $arrayColoresFinal[3]["colorFinal"] . ';" value="' . $arrayColoresFinal[3]["colorFinal"]; ?>"><br>
    </div>
    <div class="row">
      <b class="col-sm-9">Regresar a color predeterminado: </b><input type="button" onclick="volverDefault(this.id); return false;" id="predeterminado4" class="btn col-sm-3 mb-4" name="predeterminado4" style="<?php echo 'border-color:black; border-radius:30px; background-color:' . $arrayColores[3]["colorDefault"] . '; color:' . $arrayColores[3]["colorDefault"] . ';" value="' . $arrayColores[3]["colorDefault"]; ?>"><br>
    </div>
  </div>
  </div>
  <div class="col-sm-4">
    <div class="container">
    <h5 style="text-align:center;"><label for="color5" class="col-form-label"><?php echo $arrayColores[4]["descripcionColor"]; ?></label></h5><br>
    <input type="color" id="color5" class="form-control col-lg-12 mb-4" name="color5" value="<?php echo $arrayColoresFinal[4]["colorFinal"]; ?>">
    <div class="row">
      <b class="col-sm-9">Regresar a color anterior: </b><input type="button" onclick="volverAnterior(this.id); return false;" id="anterior5" class="btn col-sm-3 mb-4" name="anterior5" style="<?php echo 'border-color:black; border-radius:30px; background-color:' . $arrayColoresFinal[4]["colorFinal"] . '; color:' . $arrayColoresFinal[4]["colorFinal"] . ';" value="' . $arrayColoresFinal[4]["colorFinal"]; ?>"><br>
    </div>
    <div class="row">
      <b class="col-sm-9">Regresar a color predeterminado: </b><input type="button" onclick="volverDefault(this.id); return false;" id="predeterminado5" class="btn col-sm-3 mb-4" name="predeterminado5" style="<?php echo 'border-color:black; border-radius:30px; background-color:' . $arrayColores[4]["colorDefault"] . '; color:' . $arrayColores[4]["colorDefault"] . ';" value="' . $arrayColores[4]["colorDefault"]; ?>"><br>
    </div>
  </div>
  </div>
  <div class="col-sm-4">
    <div class="container">
    <h5 style="text-align:center;"><label for="color6" class="col-form-label"><?php echo $arrayColores[5]["descripcionColor"]; ?></label></h5><br>
    <input type="color" id="color6" class="form-control col-lg-12 mb-4" name="color6" value="<?php echo $arrayColoresFinal[5]["colorFinal"]; ?>">
    <div class="row">
      <b class="col-sm-9">Regresar a color anterior: </b><input type="button" onclick="volverAnterior(this.id); return false;" id="anterior6" class="btn col-sm-3 mb-4" name="anterior6" style="<?php echo 'border-color:black; border-radius:30px; background-color:' . $arrayColoresFinal[5]["colorFinal"] . '; color:' . $arrayColoresFinal[5]["colorFinal"] . ';" value="' . $arrayColoresFinal[5]["colorFinal"]; ?>"><br>
    </div>
    <div class="row">
      <b class="col-sm-9">Regresar a color predeterminado: </b><input type="button" onclick="volverDefault(this.id); return false;" id="predeterminado6" class="btn col-sm-3 mb-4" name="predeterminado6" style="<?php echo 'border-color:black; border-radius:30px; background-color:' . $arrayColores[5]["colorDefault"] . '; color:' . $arrayColores[5]["colorDefault"] . ';" value="' . $arrayColores[5]["colorDefault"]; ?>"><br>
    </div>
  </div>
  </div>
</div>
<hr style="visibility:hidden;">
<div class="row center">
  <input type="submit" name="actualizarColores" class="btn btn-success" value="Actualizar colores">
</div>
</form>

<script>
  function volverAnterior(primerId)
  {
    var nId = primerId.substr(8);
    var inputId = 'color' + nId;
    document.getElementById(inputId).value = document.getElementById(primerId).value;
  }

  function volverDefault(primerId)
  {
    var nId = primerId.substr(14);
    var inputId = 'color' + nId;
    document.getElementById(inputId).value = document.getElementById(primerId).value;
  }
</script>

<?php

include('includes/footer.php');

?>
