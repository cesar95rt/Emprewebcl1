<?php

$jsonCategorias = file_get_contents("../structure/categorias.json");
$arrayCategorias = json_decode($jsonCategorias, true);

$listaCategorias = '';

foreach($arrayCategorias as $categoria){
  $listaCategorias .= '<a href="lista-productos.php?nombreCategoria='. $categoria["nombre"] .'">' . $categoria["nombre"] . '</a><br></br>';
}

?>

<?php echo $listaCategorias; ?>
