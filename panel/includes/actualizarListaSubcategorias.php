<?php
  session_start();

  $opt = $_GET['filtroCategoria'];
  include(__DIR__ . '/funciones.php');

  $datosUsuario = obtenerDatosUsuario();
  $idTienda = $datosUsuario["idTienda"];
  $tablaCategorias = 'categorias_' . $idTienda;
  $tablaSubcategorias = 'subcategorias_' . $idTienda;
  $tablaProductos = 'productos_' . $idTienda;

  $arraySubcategorias = arraySubCategorias($opt);
  $opcionesSubcategorias = opcionesSubCategorias($arraySubcategorias);



  if($opt==""){
    echo '
          <option>Selecciona una subcategoría (opcional)</option>
         ';
  }
  else
  {
    echo $opcionesSubcategorias;
  }

?>
