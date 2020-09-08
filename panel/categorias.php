<?php

include('includes/header.php');
$arrayCategorias = arrayCategorias();
$listaCategorias = listaCategorias($arrayCategorias);
$respuesta = '';
$colorRespuesta = '';
$br = '';

if(isset($_POST["nombreCategoria"]))
{
  if(isset($_POST["eliminar"]))
  {
    $idCategoriaEliminar = $_POST["eliminar"];
    echo eliminarCategoria($idCategoriaEliminar);
    $respuesta = "La categoría y todos sus productos han sido eliminados exitosamente";
    $br = "<br>";
    $colorRespuesta = "text-success";
  }
  if(isset($_POST["cambiarNombre"]))
  {
    if($_POST["nombreCategoria"]!="")
    {
      if(comprobarNombreCategoria($arrayCategorias, $_POST["nombreCategoria"])==1)
      {
        $idCategoriaCambiarNombre = $_POST["cambiarNombre"];
        $nuevoNombreCategoria = $_POST["nombreCategoria"];
        cambiarNombreCategoria($idCategoriaCambiarNombre, $nuevoNombreCategoria);
        $respuesta = "El nombre de la categoría ha sido cambiado exitosamente.";
        $colorRespuesta = "text-success";
        $br = "<br>";
      }
      else
      {
        $respuesta = "Ya existe una categoría con el nombre " . $_POST["nombreCategoria"];
        $colorRespuesta = "text-danger";
        $br = "<br>";
      }
    }
  }
  if(isset($_POST["agregarCategoria"]))
  {
    if($_POST["nombreCategoria"]!="")
    {
      if($listaCategorias==='Aún no se han agregado categorías')
      {
        $comprobarNombreCategoria=1;
      }
      else
      {
        $comprobarNombreCategoria=comprobarNombreCategoria($arrayCategorias, $_POST["nombreCategoria"]);
      }
      if($comprobarNombreCategoria==1)
      {
      $nombreNuevaCategoria = $_POST["nombreCategoria"];
      agregarCategoria($nombreNuevaCategoria);
      $respuesta = "La categoría " . $nombreNuevaCategoria . " ha sido creada exitosamente";
      $colorRespuesta = "text-success";
      $br = "<br>";
      }
      else
      {
        $respuesta = "Ya existe una categoría con el nombre " . $_POST["nombreCategoria"];
        $colorRespuesta = "text-danger";
        $br = "<br>";
      }
    }
  }
  $arrayCategorias = arrayCategorias();
  $listaCategorias = listaCategorias($arrayCategorias);
}

if(isset($_POST["debesAgregarCategorias"]))
{
  $respuesta = "Para poder crear un producto, debes tener como mínimo una categoría";
  $colorRespuesta = "text-danger";
  $br = "<br>";
}

?>

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edita las <b>categorías</b> de tu tienda</h1>
  </div>
  <div class="d-sm-flex align-items-center justify-content-center mb-4">
<h6 class="h6 <?php echo $colorRespuesta?>"><?php echo $respuesta; ?></h6><?php echo $br; ?>
</div>
  <!-- Content Row -->
  <form id="agregarCategoriaForm" action="categorias.php" method="POST">
                    <div class="row justify-content-center">
                    <label for="nombreNuevaCategoria" style="text-align: center; font-size:22px;" class="col-sm-6 col-form-label"><b>Agregar una nueva categoría</b></label></div>
                    <div class="form-group row justify-content-center"><div class="col-sm-6"><input type="text" class="form-control" name="nombreCategoria" id="nombreNuevaCategoria" placeholder="Ingresa el nombre de tu nueva categoria"></div></div>
                      <div class="form-group row justify-content-center"><div class="col-sm-6"><button type="submit" name="agregarCategoria" value="1" style="text-align:center" class="btn btn-success col mb-4">Agregar categoría</button></div></div>
                      </form>


  <div class="row justify-content-center">
  <?php echo listaCategorias($arrayCategorias); ?>
</div>


<?php

include('includes/footer.php');

?>
