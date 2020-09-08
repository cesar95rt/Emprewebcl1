<?php

include('includes/header.php');

$respuesta = '';
$colorRespuesta = '';
$br = '';

if(isset($_GET["idCategoria"]) && $_GET["nombreCategoria"])
{
  if(comprobarCategoria2($_GET["idCategoria"], $_GET["nombreCategoria"])==1)
  {
    $idCategoria = $_GET["idCategoria"];
    $nombreCategoria = $_GET["nombreCategoria"];
    $arraySubcategorias = arraySubcategorias($_GET["idCategoria"]);
    $listaSubcategorias = listaSubcategorias($arraySubcategorias);
    if(isset($_POST["nombreSubcategoria"]))
    {
      if(isset($_POST["eliminar"]))
      {
        $idSubcategoriaEliminar = $_POST["eliminar"];
        echo eliminarSubcategoria($idSubcategoriaEliminar);
        $respuesta = "La subcategoría y todos sus productos han sido eliminados exitosamente";
        $br = "<br>";
        $colorRespuesta = "text-success";
      }
      if(isset($_POST["cambiarNombre"]))
      {
        if($_POST["nombreSubcategoria"]!="")
        {
          if(comprobarNombreSubCategoria($arraySubcategorias, $_POST["nombreSubcategoria"])==1)
          {
            $idSubcategoriaCambiarNombre = $_POST["cambiarNombre"];
            $nuevoNombreSubcategoria = $_POST["nombreSubcategoria"];
            cambiarNombreSubcategoria($idSubcategoriaCambiarNombre, $nuevoNombreSubcategoria);
            $respuesta = "El nombre de la subcategoría ha sido cambiado exitosamente.";
            $colorRespuesta = "text-success";
            $br = "<br>";
          }
          else
          {
            $respuesta = "Ya existe una categoría con el nombre " . $_POST["nombreSubcategoria"];
            $colorRespuesta = "text-danger";
            $br = "<br>";
          }
        }
      }
      if(isset($_POST["agregarSubcategoria"]))
      {
        if($_POST["nombreSubcategoria"]!="")
        {
          if($listaSubcategorias==='Aún no se han agregado subcategorías')
          {
            $comprobarNombreSubcategoria=1;
          }
          else
          {
            $comprobarNombreSubcategoria=comprobarNombreSubCategoria($arraySubcategorias, $_POST["nombreSubcategoria"]);
          }
          if($comprobarNombreSubcategoria==1)
          {
          $nombreNuevaSubcategoria = $_POST["nombreSubcategoria"];
          agregarSubcategoria($nombreNuevaSubcategoria, $idCategoria);
          $respuesta = "La subcategoría " . $nombreNuevaSubcategoria . " ha sido creada exitosamente";
          $colorRespuesta = "text-success";
          $br = "<br>";
          }
          else
          {
            $respuesta = "Ya existe una subcategoría con el nombre " . $_POST["nombreSubcategoria"];
            $colorRespuesta = "text-danger";
            $br = "<br>";
          }
        }
      }
      $arraySubcategorias = arraySubcategorias($idCategoria);
      $listaSubcategorias = listaSubcategorias($arraySubcategorias);
    }
  }
  else
  {
    echo '<form action="categorias.php" method="POST" class="form-inline" role="form" id="return-form">
      <input type="hidden" name="token_ws" value="regreso">
    </form>
  </div>
  </div>
  <script>document.getElementById("return-form").submit();</script>';
  }
}
else
{
  echo '<form action="categorias.php" method="POST" class="form-inline" role="form" id="return-form">
    <input type="hidden" name="token_ws" value="regreso">
  </form>
</div>
</div>
<script>document.getElementById("return-form").submit();</script>';
}



?>

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800" style="text-align:center">Edita las <b>subcategorías</b> de la categoría <b><?php echo $nombreCategoria; ?></b></h1>
    <a href="categorias.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-arrow-left fa-sm text-white-50"></i> Volver a categorías</a>
  </div>
  <div class="d-sm-flex align-items-center justify-content-center mb-4">
<h6 class="h6 <?php echo $colorRespuesta?>"><?php echo $respuesta; ?></h6><?php echo $br; ?>
</div>
  <!-- Content Row -->


  <form id="agregarSubcategoriaForm" action="subcategorias.php?idCategoria=<?php echo $idCategoria; ?>&nombreCategoria=<?php echo $nombreCategoria; ?>" method="POST">
                    <div class="row justify-content-center">
                    <label for="nombreNuevaSubcategoria" style="text-align: center; font-size:22px;" class="col-sm-6 col-form-label"><b>Agregar una nueva subcategoría</b></label></div>
                    <div class="form-group row justify-content-center"><div class="col-sm-6"><input type="text" class="form-control" name="nombreSubcategoria" id="nombreNuevaSubcategoria" placeholder="Ingresa el nombre de tu nueva subcategoria"></div></div>
                      <div class="form-group row justify-content-center"><div class="col-sm-6"><button type="submit" name="agregarSubcategoria" value="1" style="text-align:center" class="btn btn-success col mb-4">Agregar subcategoría</button></div></div>
                    </form>




  <div class="row justify-content-center">
  <p style="text-align:center; font-weight:bold;"><?php echo listaSubcategorias($arraySubcategorias); ?></p>
</div>



<?php

include('includes/footer.php');

?>
