<?php

if(isset($_GET["codigo"]))
{
  $codigoProducto = $_GET["codigo"];
  if(isset($_POST["actualizarProducto"]))
  {
    $jsonProductosPost = file_get_contents("../structure/productos.json");
    $arrayProductosPost = json_decode($jsonProductosPost, true);
    foreach ($arrayProductosPost as $productoPost) {
      if ($productoPost['codigo'] == $codigoProducto) {
        $arrayProductosPost[$codigoProducto-1]['categoria']=$_POST["categoria"];

        $arrayProductosPost[$codigoProducto-1]['nombre']=$_POST["nombre"];
        $arrayProductosPost[$codigoProducto-1]['precio']=$_POST["precio"];
      }
    }
    file_put_contents('../structure/productos.json', json_encode($arrayProductosPost));
  }

  $jsonProductos = file_get_contents("../structure/productos.json");
  $arrayProductos = json_decode($jsonProductos, true);
  foreach ($arrayProductos as $producto) {
    if ($producto['codigo'] == $codigoProducto) {
        $categoria = $producto['categoria'];
        $nombre = $producto['nombre'];
        $precio = $producto['precio'];
    }
  }
}
else
{
  echo '<script>window.location.replace("https://tiendas.empreweb.cl/administracion/lista-productos.php");</script>';
}

?>

<?php if(isset($_GET['codigo'])) ?>
<form action="editar-producto.php?codigo=<?php echo $codigoProducto; ?>" method="post">
  <label for="categoria">Categoria</label><br>
  <input type="text" name="categoria" id="categoria" placeholder="" value="<?php echo $categoria; ?>"><br></br>
  <label for="codigo">Codigo del producto</label><br>
  <input type="text" name="codigo" id="codigo" placeholder="" disabled value="<?php echo $codigoProducto; ?>"><br></br>
  <label for="nombre">Nombre del producto</label><br>
  <input type="text" name="nombre" id="nombre" placeholder="" value="<?php echo $nombre; ?>"><br></br>
  <label for="precio">Precio del producto</label><br>
  <input type="text" name="precio" id="precio" placeholder="" value="<?php echo $precio; ?>"><br></br>
  <input type="submit" name="actualizarProducto" placeholder="" value="Actualizar Producto">
</form>
