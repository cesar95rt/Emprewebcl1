<?php

include('includes/header.php');

$caca = '';
?>

<form class="" name="crearProducto" action="tagsAction.php" method="post">

  <label for="tags" class="form-label">Tags (opcional) - Permitirán a tus clientes encontrar con más facilidad el producto. Por ejemplo: zapatillas,correr,ropa deportiva. Separados por comas.</label>
  <input class="form-control" data-role="tagsinput" value="caca 1, caca 2," type="text" name="tags" id="tags">


  <button type="submit" > Crear producto</button>
</form>


<?php
echo count($caca);
include('includes/footer.php');

?>
