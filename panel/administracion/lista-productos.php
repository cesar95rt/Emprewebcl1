<?php

if(isset($_GET["nombreCategoria"]))
{
  $jsonProductos = file_get_contents("../structure/productos.json");
  $arrayProductos = json_decode($jsonProductos, true);

  $nombreCategoria = $_GET["nombreCategoria"];

  $listaProductos = "";

  foreach ($arrayProductos as $producto) {
    if ($producto['categoria'] == $nombreCategoria) {
          $listaProductos .= '<a href="editar-producto.php?codigo='. $producto["codigo"] .'">' . $producto["codigo"] . '.- ' . $producto["nombre"] . ' $' . $producto["precio"] . '</a><br></br>';
    }
  }
}
else
{
  $jsonProductos = file_get_contents("../structure/productos.json");
  $arrayProductos = json_decode($jsonProductos, true);

  $listaProductos = '';

  foreach($arrayProductos as $producto){
    $listaProductos .= '<a href="editar-producto.php?codigo='. $producto["codigo"] .'">' . $producto["codigo"] . '.- ' . $producto["nombre"] . ' $' . $producto["precio"] . '</a><br></br>';
  }
}



?>

<?php echo $listaProductos; ?>
