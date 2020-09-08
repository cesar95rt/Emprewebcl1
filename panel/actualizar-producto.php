<?php

include('includes/config.php');

$idProductoAnterior = $_POST["idProducto"];
$datosProducto = obtenerDatosProducto($idProductoAnterior);
$skuProductoAnterior = $datosProducto["skuProducto"];
$nombreProductoAnterior = $datosProducto["nombreProducto"];
$urlSeoAnterior = $datosProducto["urlSeo"]
$imagenAnterior = $datosProducto["imagen"];
$imagenAnterior1 = $datosProducto["imagen1"];
$imagenAnterior2 = $datosProducto["imagen2"];
$imagenAnterior3 = $datosProducto["imagen3"];
$imagenAnterior4 = $datosProducto["imagen4"];
$tipoArchivoAnterior = $datosProducto["tipoArchivo"];
$tipoArchivoAnterior1 = $datosProducto["tipoArchivo1"];
$tipoArchivoAnterior2 = $datosProducto["tipoArchivo2"];
$tipoArchivoAnterior3 = $datosProducto["tipoArchivo3"];
$tipoArchivoAnterior4 = $datosProducto["tipoArchivo4"];

$nombreProducto = $_POST["nombreProducto"];
$idCategoria = $_POST["filtroCategoria"];
$nombreCategoria = obtenerNombreCategoria2($_POST["filtroCategoria"]);
$skuProducto = '';
$nombreArchivo = '';
$imagen = '';
$nombreArchivo1 = '';
$imagen1 = '';
$nombreArchivo2 = '';
$imagen2 = '';
$nombreArchivo3 = '';
$imagen3 = '';
$nombreArchivo4 = '';
$imagen4 = '';
$stockProducto = 0;
$inventarioProducto = 0;
$fecha = obtenerFecha();
$arrayKeyNombreArchivo = array("-", " ", ":");
$keyNombreArchivo = str_replace($arrayKeyNombreArchivo, "", $fecha);
$nombreSubcategoria = '';
$tipoArchivo = '';
$tipoArchivo1 = '';
$tipoArchivo2 = '';
$tipoArchivo3 = '';
$tipoArchivo4 = '';
$idImagen = '';
$idImagen1 = '';
$idImagen2 = '';
$idImagen3 = '';
$idImagen4 = '';
$precioOfertaProducto = 0;
$estadoStarken = 'desactivado';
$pesoProducto = 0;
$altoProducto = 0;
$anchoProducto = 0;
$largoProducto = 0;
$urlSeo = urlSeo($_POST["urlSeo"]);
$diasPreparacion = 0;

if(comprobarNombreProducto($urlSeo)==1 && $urlSeo!=$urlSeoAnterior)
{
  $respuestaRegistroProducto = "<h6 class='h6 text-danger'>Ya existe un producto con la URL Seo " . $urlSeo . "</h6>";
  echo '<form action="nuevo-producto" method="POST" class="form-inline" role="form" id="return-form">
  <input type="hidden" name="respuestaRegistroProducto" value="' . $respuestaRegistroProducto . '">
  </form>
  <script>document.getElementById("return-form").submit();</script>';
  die();
}

if($_POST["changeStarken1"])
{
  $estadoStarken = $_POST["changeStarken1"];
}

$diasPreparacion = $_POST["diasPreparacion"];

$pesoProducto = $_POST["pesoProducto"];
$altoProducto = $_POST["altoProducto"];
$anchoProducto = $_POST["anchoProducto"];
$largoProducto = $_POST["largoProducto"];

if($_POST["skuProducto"]!='')
{
  $skuProducto = $_POST["skuProducto"];
  $comprobarSkuProducto = comprobarSkuProducto($skuProducto);
  if($comprobarSkuProducto==1 && $skuProducto!=$skuProductoAnterior)
  {
    $respuestaRegistroProducto = "<h6 class='h6 text-danger'>Ya existe un producto con el SKU " . $skuProducto . "</h6>";

    echo '<form action="editar-producto.php?idProducto=' . $idProductoAnterior . '" method="POST" class="form-inline" role="form" id="return-form">
    <input type="hidden" name="respuestaRegistroProducto" value="' . $respuestaRegistroProducto . '">
    </form>
    <script>document.getElementById("return-form").submit();</script>';
  }
  else
  {
    $nombreProducto = $_POST["nombreProducto"];
    $comprobarNombreProducto = comprobarNombreProducto($nombreProducto);
    if($comprobarNombreProducto==1 && $nombreProducto!=$nombreProductoAnterior)
    {
      $respuestaRegistroProducto = "<h6 class='h6 text-danger'>Ya existe un producto llamado " . $nombreProducto . "</h6>";

      echo '<form action="editar-producto.php?idProducto=' . $idProductoAnterior . '" method="POST" class="form-inline" role="form" id="return-form">
      <input type="hidden" name="respuestaRegistroProducto" value="' . $respuestaRegistroProducto . '">
      </form>
      <script>document.getElementById("return-form").submit();</script>';
    }
    else
    {
      if($_POST["optradio1"]=="1")
      {
        $stockProducto = $_POST["stockProducto"];
        $inventarioProducto = 1;
      }
      else
      {
        $stockProducto = 0;
        $inventarioProducto = 0;
      }

      if(isset($_POST["filtroSubcategoria"]))
      {
        $idSubcategoria = $_POST["filtroSubcategoria"];
        if($idSubcategoria===''){$idSubcategoria=0;}
        $nombreSubcategoria = obtenerNombreSubcategoria2($idSubcategoria);
      }
      else
      {
        $idSubcategoria = 0;
      }
      if(isset($_POST["descripcionProducto"]))
      {
        $descripcionProducto = $_POST["descripcionProducto"];
      }
      else
      {
        $descripcionProducto = '';
      }

      $precioProducto1 = $_POST["precioProducto"];
      $precioProducto = preg_replace("/[^0-9]/", "", $precioProducto1 );

      if($_POST["precioOfertaProducto"]!='$')
      {
        $precioOfertaProducto1 = $_POST["precioOfertaProducto"];
        $precioOfertaProducto = preg_replace("/[^0-9]/", "", $precioOfertaProducto1 );
      }
      else
      {
        $precioOfertaProducto = 0;
      }
      if($_FILES['file-ip']['tmp_name']!='')
      {
        $imagen = '1';
        $nombreArchivo = $_FILES['file-ip']['name'];
        $file_name_array = explode(".", $nombreArchivo);
        $tipoArchivo = end($file_name_array);
      }
      else
      {
        if($imagenAnterior==='1')
        {
          $imagen = '1';
          $tipoArchivo = $tipoArchivoAnterior;
        }
        else
        {
          $imagen = '';
          $tipoArchivo = '';
        }
      }
      if($_FILES['file-ip-1']['tmp_name']!='')
      {
        $imagen1 = '1';
        $nombreArchivo1 = $_FILES['file-ip-1']['name'];
        $file_name_array1 = explode(".", $nombreArchivo1);
        $tipoArchivo1 = end($file_name_array1);
      }
      else
      {
        if($imagenAnterior1==='1')
        {
          $imagen1 = '1';
          $tipoArchivo1 = $tipoArchivoAnterior1;
        }
        else
        {
          $imagen1 = '';
          $tipoArchivo1 = '';
        }
      }
      if($_FILES['file-ip-2']['tmp_name']!='')
      {
        $imagen2 = '1';
        $nombreArchivo2 = $_FILES['file-ip-2']['name'];
        $file_name_array2 = explode(".", $nombreArchivo2);
        $tipoArchivo2 = end($file_name_array2);
      }
      else
      {
        if($imagenAnterior2==='1')
        {
          $imagen2 = '1';
          $tipoArchivo2 = $tipoArchivoAnterior2;
        }
        else
        {
          $imagen2 = '';
          $tipoArchivo2 = '';
        }
      }
      if($_FILES['file-ip-3']['tmp_name']!='')
      {
        $imagen3 = '1';
        $nombreArchivo3 = $_FILES['file-ip-3']['name'];
        $file_name_array3 = explode(".", $nombreArchivo3);
        $tipoArchivo3 = end($file_name_array3);
      }
      else
      {
        if($imagenAnterior3==='1')
        {
          $imagen3 = '1';
          $tipoArchivo3 = $tipoArchivoAnterior3;
        }
        else
        {
          $imagen3 = '';
          $tipoArchivo3 = '';
        }
      }
      if($_FILES['file-ip-4']['tmp_name']!='')
      {
        $imagen4 = '1';
        $nombreArchivo4 = $_FILES['file-ip-4']['name'];
        $file_name_array4 = explode(".", $nombreArchivo4);
        $tipoArchivo4 = end($file_name_array4);
      }
      else
      {
        if($imagenAnterior4==='1')
        {
          $imagen4 = '1';
          $tipoArchivo4 = $tipoArchivoAnterior4;
        }
        else
        {
          $imagen4 = '';
          $tipoArchivo4 = '';
        }
      }
      if($_POST["descripcionProducto"]!='')
      {
        $descripcionProducto = 1;
      }
      else
      {
        $descripcionProducto = 0;
      }
      $idProducto = actualizarProducto($secretKey, $tablaProductos, $inventarioProducto, $skuProducto, $idCategoria, $idSubcategoria, $nombreProducto, $precioProducto, $stockProducto, $imagen, $imagen1, $imagen2, $imagen3, $imagen4, $nombreSubcategoria, $nombreCategoria, $tipoArchivo, $tipoArchivo1, $tipoArchivo2, $tipoArchivo3, $tipoArchivo4, $precioOfertaProducto, $idProductoAnterior, $descripcionProducto, $pesoProducto, $altoProducto, $anchoProducto, $largoProducto, $estadoStarken, $urlSeo, $diasPreparacion);
      $my_file = 'tiendas/' . $secretKey . '/imagenes' . '/' . $idProductoAnterior . '/descripcionproducto.txt';
      $handle = fopen($my_file, 'w');
      $data = $_POST["descripcionProducto"];
      fwrite($handle, $data);
      fclose($handle);
      borrarTags($idProductoAnterior);
      if(isset($_POST["tags"]))
      {
        $tags = $_POST["tags"];
        if($tags!="")
        {
          $contadorTags = 0;
          $arrayTags = explode(",", $tags);
          $contadorTags = count($arrayTags);
          if($contadorTags>10)
          {
            $cantidadTags = 10;
          }
          else
          {
            $cantidadTags = $contadorTags;
          }
        }
        else
        {
          $arrayTags[0] = $nombreProducto;
          $cantidadTags = 1;
        }
        registrarTags($arrayTags, $cantidadTags, $idProductoAnterior);
      }
      if($_FILES['file-ip']['tmp_name']!=''){
        $archivo = $_FILES['file-ip']['tmp_name'];
        $nombreArchivo = $_FILES['file-ip']['name'];
        $file_name_array = explode(".", $nombreArchivo);
        $tipoArchivo = end($file_name_array);
        $nombreArchivoSinTipo = $file_name_array['0'];
        $nombreArchivo = 'imagen' . '.' . $tipoArchivo;
        $pesoArchivo = round(($_FILES['file-ip']['size'])/1024);
        move_uploaded_file($archivo, 'tiendas/' . $secretKey . '/imagenes' . '/' . $idProductoAnterior . '/' . $nombreArchivo);
        if($imagenAnterior==='1')
        {
          $idImagen = actualizarImagen($nombreArchivo, $tipoArchivo, $pesoArchivo, $secretKey, $tablaImagenes, $idProductoAnterior);
        }
        else
        {
          $idImagen = registrarImagen($nombreArchivo, $tipoArchivo, $pesoArchivo, $secretKey, $tablaImagenes, $idProductoAnterior);
        }
      }else{
        $nombreArchivo = '';
        $idImagen = '';
      }
      if($_FILES['file-ip-1']['tmp_name']!=''){
        $archivo1 = $_FILES['file-ip-1']['tmp_name'];
        $nombreArchivo1 = $_FILES['file-ip-1']['name'];
        $file_name_array = explode(".", $nombreArchivo1);
        $tipoArchivo1 = end($file_name_array);
        $nombreArchivoSinTipo1 = $file_name_array['0'];
        $nombreArchivo1 = 'imagen' . '1.' . $tipoArchivo1;
        $pesoArchivo1 = round(($_FILES['file-ip-1']['size'])/1024);
        move_uploaded_file($archivo1, 'tiendas/' . $secretKey . '/imagenes' . '/' . $idProductoAnterior . '/' . $nombreArchivo1);
        if($imagenAnterior1==='1')
        {
          $idImagen = actualizarImagen($nombreArchivo1, $tipoArchivo1, $pesoArchivo1, $secretKey, $tablaImagenes, $idProductoAnterior);
        }
        else
        {
          $idImagen = registrarImagen($nombreArchivo1, $tipoArchivo1, $pesoArchivo1, $secretKey, $tablaImagenes, $idProductoAnterior);
        }
      }else{
        $nombreArchivo1 = '';
        $idImagen1 = '';
      }

      if($_FILES['file-ip-2']['tmp_name']!=''){
        $archivo2 = $_FILES['file-ip-2']['tmp_name'];
        $nombreArchivo2 = $_FILES['file-ip-2']['name'];
        $file_name_array = explode(".", $nombreArchivo2);
        $tipoArchivo2 = end($file_name_array);
        $nombreArchivoSinTipo2 = $file_name_array['0'];
        $nombreArchivo2 = 'imagen' . '2.' . $tipoArchivo2;
        $pesoArchivo2 = round(($_FILES['file-ip-2']['size'])/1024);
        move_uploaded_file($archivo2, 'tiendas/' . $secretKey . '/imagenes' . '/' . $idProductoAnterior . '/' . $nombreArchivo2);

        if($imagenAnterior2==='1')
        {
          $idImagen2 = actualizarImagen($nombreArchivo2, $tipoArchivo2, $pesoArchivo2, $secretKey, $tablaImagenes, $idProductoAnterior);
        }
        else
        {
          $idImagen2 = registrarImagen($nombreArchivo2, $tipoArchivo2, $pesoArchivo2, $secretKey, $tablaImagenes, $idProductoAnterior);
        }
      }else{
        $nombreArchivo2 = '';
        $idImagen2 = '';
      }

      if($_FILES['file-ip-3']['tmp_name']!=''){
        $archivo3 = $_FILES['file-ip-3']['tmp_name'];
        $nombreArchivo3 = $_FILES['file-ip-3']['name'];
        $file_name_array = explode(".", $nombreArchivo3);
        $tipoArchivo3 = end($file_name_array);
        $nombreArchivoSinTipo3 = $file_name_array['0'];
        $nombreArchivo3 = 'imagen' . '3.' . $tipoArchivo3;
        $pesoArchivo3 = round(($_FILES['file-ip-3']['size'])/1024);
        move_uploaded_file($archivo3, 'tiendas/' . $secretKey . '/imagenes' . '/' . $idProductoAnterior . '/' . $nombreArchivo3);

        if($imagenAnterior3==='1')
        {
          $idImagen3 = actualizarImagen($nombreArchivo3, $tipoArchivo3, $pesoArchivo3, $secretKey, $tablaImagenes, $idProductoAnterior);
        }
        else
        {
          $idImagen3 = registrarImagen($nombreArchivo3, $tipoArchivo3, $pesoArchivo3, $secretKey, $tablaImagenes, $idProductoAnterior);
        }
      }else{
        $nombreArchivo3 = '';
        $idImagen3 = '';
      }

      if($_FILES['file-ip-4']['tmp_name']!=''){
        $archivo4 = $_FILES['file-ip-4']['tmp_name'];
        $nombreArchivo4 = $_FILES['file-ip-4']['name'];
        $file_name_array = explode(".", $nombreArchivo4);
        $tipoArchivo4 = end($file_name_array);
        $nombreArchivoSinTipo4 = $file_name_array['0'];
        $nombreArchivo4 = 'imagen' . '4.' . $tipoArchivo4;
        $pesoArchivo4 = round(($_FILES['file-ip-4']['size'])/1024);
        move_uploaded_file($archivo4, 'tiendas/' . $secretKey . '/imagenes' . '/' . $idProductoAnterior . '/' . $nombreArchivo4);

        if($imagenAnterior4==='1')
        {
          $idImagen4 = actualizarImagen($nombreArchivo4, $tipoArchivo4, $pesoArchivo4, $secretKey, $tablaImagenes, $idProductoAnterior);
        }
        else
        {
          $idImagen4 = registrarImagen($nombreArchivo4, $tipoArchivo4, $pesoArchivo4, $secretKey, $tablaImagenes, $idProductoAnterior);
        }
      }else{
        $nombreArchivo4 = '';
        $idImagen4 = '';
      }


      $respuestaRegistroProducto = "<h6 class='h6 text-success'>El producto ha sido actualizado correctamente</h6>";

      echo '<form action="editar-producto.php?idProducto=' . $idProductoAnterior . '" method="POST" class="form-inline" role="form" id="return-form">
      <input type="hidden" name="respuestaRegistroProducto" value="' . $respuestaRegistroProducto . '">
      </form>
      <script>document.getElementById("return-form").submit();</script>';
    }
  }
}
else
{
  $nombreProducto = $_POST["nombreProducto"];
  $comprobarNombreProducto = comprobarNombreProducto($nombreProducto);
  if($comprobarNombreProducto==1 && $nombreProducto!=$nombreProductoAnterior)
  {
    $colorRespuesta = 'text-danger';
    $respuestaRegistroProducto = "<h6 class='h6 text-danger'>Ya existe un producto llamado " . $nombreProducto . "</h6>";

    echo '<form action="editar-producto.php?idProducto=' . $idProductoAnterior . '" method="POST" class="form-inline" role="form" id="return-form">
    <input type="hidden" name="respuestaRegistroProducto" value="' . $respuestaRegistroProducto . '">
    </form>
    <script>document.getElementById("return-form").submit();</script>';
  }
  else
  {
    if($_POST["optradio1"]=="1")
    {
      $stockProducto = $_POST["stockProducto"];
      $inventarioProducto = 1;
    }
    else
    {
      $stockProducto = 0;
      $inventarioProducto = 0;
    }

    if(isset($_POST["filtroSubcategoria"]))
    {
      $idSubcategoria = $_POST["filtroSubcategoria"];
      if($idSubcategoria===''){$idSubcategoria=0;}
      $nombreSubcategoria = obtenerNombreSubcategoria2($idSubcategoria);
    }
    else
    {
      $idSubcategoria = 0;
    }
    if(isset($_POST["descripcionProducto"]))
    {
      $descripcionProducto = $_POST["descripcionProducto"];
    }
    else
    {
      $descripcionProducto = '';
    }

    $precioProducto1 = $_POST["precioProducto"];
    $precioProducto = preg_replace("/[^0-9]/", "", $precioProducto1 );

    if($_POST["precioOfertaProducto"]!='$')
    {
      $precioOfertaProducto1 = $_POST["precioOfertaProducto"];
      $precioOfertaProducto = preg_replace("/[^0-9]/", "", $precioOfertaProducto1 );
    }
    else
    {
      $precioOfertaProducto = 0;
    }

    if($_FILES['file-ip']['tmp_name']!='')
    {
      $imagen = '1';
      $nombreArchivo = $_FILES['file-ip']['name'];
      $file_name_array = explode(".", $nombreArchivo);
      $tipoArchivo = end($file_name_array);
    }
    else
    {
      if($imagenAnterior==='1')
      {
        $imagen = '1';
        $tipoArchivo = $tipoArchivoAnterior;
      }
      else
      {
        $imagen = '';
        $tipoArchivo = '';
      }

    }
    if($_FILES['file-ip-1']['tmp_name']!='')
    {
      $imagen1 = '1';
      $nombreArchivo1 = $_FILES['file-ip-1']['name'];
      $file_name_array1 = explode(".", $nombreArchivo1);
      $tipoArchivo1 = end($file_name_array1);
    }
    else
    {
      if($imagenAnterior1==='1')
      {
        $imagen1 = '1';
        $tipoArchivo1 = $tipoArchivoAnterior1;
      }
      else
      {
        $imagen1 = '';
        $tipoArchivo1 = '';
      }
    }
    if($_FILES['file-ip-2']['tmp_name']!='')
    {
      $imagen2 = '1';
      $nombreArchivo2 = $_FILES['file-ip-2']['name'];
      $file_name_array2 = explode(".", $nombreArchivo2);
      $tipoArchivo2 = end($file_name_array2);
    }
    else
    {
      if($imagenAnterior2==='1')
      {
        $imagen2 = '1';
        $tipoArchivo2 = $tipoArchivoAnterior2;
      }
      else
      {
        $imagen2 = '';
        $tipoArchivo2 = '';
      }
    }
    if($_FILES['file-ip-3']['tmp_name']!='')
    {
      $imagen3 = '1';
      $nombreArchivo3 = $_FILES['file-ip-3']['name'];
      $file_name_array3 = explode(".", $nombreArchivo3);
      $tipoArchivo3 = end($file_name_array3);
    }
    else
    {
      if($imagenAnterior3==='1')
      {
        $imagen3 = '1';
        $tipoArchivo3 = $tipoArchivoAnterior3;
      }
      else
      {
        $imagen3 = '';
        $tipoArchivo3 = '';
      }
    }
    if($_FILES['file-ip-4']['tmp_name']!='')
    {
      $imagen4 = '1';
      $nombreArchivo4 = $_FILES['file-ip-4']['name'];
      $file_name_array4 = explode(".", $nombreArchivo4);
      $tipoArchivo4 = end($file_name_array4);
    }
    else
    {
      if($imagenAnterior4==='1')
      {
        $imagen4 = '1';
        $tipoArchivo4 = $tipoArchivoAnterior4;
      }
      else
      {
        $imagen4 = '';
        $tipoArchivo4 = '';
      }
    }
    if($_POST["descripcionProducto"]!='')
    {
      $descripcionProducto = 1;
    }
    else
    {
      $descripcionProducto = 0;
    }
    $idProducto = actualizarProducto($secretKey, $tablaProductos, $inventarioProducto, $skuProducto, $idCategoria, $idSubcategoria, $nombreProducto, $precioProducto, $stockProducto, $imagen, $imagen1, $imagen2, $imagen3, $imagen4, $nombreSubcategoria, $nombreCategoria, $tipoArchivo, $tipoArchivo1, $tipoArchivo2, $tipoArchivo3, $tipoArchivo4, $precioOfertaProducto, $idProductoAnterior, $descripcionProducto, $pesoProducto, $altoProducto, $anchoProducto, $largoProducto, $estadoStarken, $urlSeo, $diasPreparacion);
    $my_file = 'tiendas/' . $secretKey . '/imagenes' . '/' . $idProductoAnterior . '/' . 'descripcionproducto.txt';
    $handle = fopen($my_file, 'w');
    $data = $_POST["descripcionProducto"];
    fwrite($handle, $data);
    fclose($handle);
    borrarTags($idProductoAnterior);
    if(isset($_POST["tags"]))
    {
      $tags = $_POST["tags"];
      if($tags!="")
      {
        $contadorTags = 0;
        $arrayTags = explode(",", $tags);
        $contadorTags = count($arrayTags);
        if($contadorTags>10)
        {
          $cantidadTags = 10;
        }
        else
        {
          $cantidadTags = $contadorTags;
        }
      }
      else
      {
        $arrayTags[0] = $nombreProducto;
        $cantidadTags = 1;
      }
      registrarTags($arrayTags, $cantidadTags, $idProductoAnterior);
    }
    if($_FILES['file-ip']['tmp_name']!=''){
      $archivo = $_FILES['file-ip']['tmp_name'];
      $nombreArchivo = $_FILES['file-ip']['name'];
      $file_name_array = explode(".", $nombreArchivo);
      $tipoArchivo = end($file_name_array);
      $nombreArchivoSinTipo = $file_name_array['0'];
      $nombreArchivo = 'imagen' . '.' . $tipoArchivo;
      $pesoArchivo = round(($_FILES['file-ip']['size'])/1024);
      move_uploaded_file($archivo, 'tiendas/' . $secretKey . '/imagenes' . '/' . $idProductoAnterior . '/' . $nombreArchivo);
      if($imagenAnterior==='1')
      {
        $idImagen = actualizarImagen($nombreArchivo, $tipoArchivo, $pesoArchivo, $secretKey, $tablaImagenes, $idProductoAnterior);
      }
      else
      {
        $idImagen = registrarImagen($nombreArchivo, $tipoArchivo, $pesoArchivo, $secretKey, $tablaImagenes, $idProductoAnterior);
      }
    }else{
      $nombreArchivo = '';
      $idImagen = '';
    }

    if($_FILES['file-ip-1']['tmp_name']!=''){
      $archivo1 = $_FILES['file-ip-1']['tmp_name'];
      $nombreArchivo1 = $_FILES['file-ip-1']['name'];
      $file_name_array = explode(".", $nombreArchivo1);
      $tipoArchivo1 = end($file_name_array);
      $nombreArchivoSinTipo1 = $file_name_array['0'];
      $nombreArchivo1 = 'imagen' . '1.' . $tipoArchivo1;
      $pesoArchivo1 = round(($_FILES['file-ip-1']['size'])/1024);
      move_uploaded_file($archivo1, 'tiendas/' . $secretKey . '/imagenes' . '/' . $idProductoAnterior . '/' . $nombreArchivo1);
      if($imagenAnterior1==='1')
      {
        $idImagen1 = actualizarImagen($nombreArchivo1, $tipoArchivo1, $pesoArchivo1, $secretKey, $tablaImagenes, $idProductoAnterior);
      }
      else
      {
        $idImagen1 = registrarImagen($nombreArchivo1, $tipoArchivo1, $pesoArchivo1, $secretKey, $tablaImagenes, $idProductoAnterior);
      }
    }else{
      $nombreArchivo1 = '';
      $idImagen1 = '';
    }

    if($_FILES['file-ip-2']['tmp_name']!=''){
      $archivo2 = $_FILES['file-ip-2']['tmp_name'];
      $nombreArchivo2 = $_FILES['file-ip-2']['name'];
      $file_name_array = explode(".", $nombreArchivo2);
      $tipoArchivo2 = end($file_name_array);
      $nombreArchivoSinTipo2 = $file_name_array['0'];
      $nombreArchivo2 = 'imagen' . '2.' . $tipoArchivo2;
      $pesoArchivo2 = round(($_FILES['file-ip-2']['size'])/1024);
      move_uploaded_file($archivo2, 'tiendas/' . $secretKey . '/imagenes' . '/' . $idProductoAnterior . '/' . $nombreArchivo2);
      if($imagenAnterior2==='1')
      {
        $idImagen2 = actualizarImagen($nombreArchivo2, $tipoArchivo2, $pesoArchivo2, $secretKey, $tablaImagenes, $idProductoAnterior);
      }
      else
      {
        $idImagen2 = registrarImagen($nombreArchivo2, $tipoArchivo2, $pesoArchivo2, $secretKey, $tablaImagenes, $idProductoAnterior);
      }
    }else{
      $nombreArchivo2 = '';
      $idImagen2 = '';
    }

    if($_FILES['file-ip-3']['tmp_name']!=''){
      $archivo3 = $_FILES['file-ip-3']['tmp_name'];
      $nombreArchivo3 = $_FILES['file-ip-3']['name'];
      $file_name_array = explode(".", $nombreArchivo3);
      $tipoArchivo3 = end($file_name_array);
      $nombreArchivoSinTipo3 = $file_name_array['0'];
      $nombreArchivo3 = 'imagen' . '3.' . $tipoArchivo3;
      $pesoArchivo3 = round(($_FILES['file-ip-3']['size'])/1024);
      move_uploaded_file($archivo3, 'tiendas/' . $secretKey . '/imagenes' . '/' . $idProductoAnterior . '/' . $nombreArchivo3);
      if($imagenAnterior3==='1')
      {
        $idImagen3 = actualizarImagen($nombreArchivo3, $tipoArchivo3, $pesoArchivo3, $secretKey, $tablaImagenes, $idProductoAnterior);
      }
      else
      {
        $idImagen3 = registrarImagen($nombreArchivo3, $tipoArchivo3, $pesoArchivo3, $secretKey, $tablaImagenes, $idProductoAnterior);
      }
    }else{
      $nombreArchivo3 = '';
      $idImagen3 = '';
    }

    if($_FILES['file-ip-4']['tmp_name']!=''){
      $archivo4 = $_FILES['file-ip-4']['tmp_name'];
      $nombreArchivo4 = $_FILES['file-ip-4']['name'];
      $file_name_array = explode(".", $nombreArchivo4);
      $tipoArchivo4 = end($file_name_array);
      $nombreArchivoSinTipo4 = $file_name_array['0'];
      $nombreArchivo4 = 'imagen' . '4.' . $tipoArchivo4;
      $pesoArchivo4 = round(($_FILES['file-ip-4']['size'])/1024);
      move_uploaded_file($archivo4, 'tiendas/' . $secretKey . '/imagenes' . '/' . $idProductoAnterior . '/' . $nombreArchivo4);
      if($imagenAnterior4==='1')
      {
        $idImagen4 = actualizarImagen($nombreArchivo4, $tipoArchivo4, $pesoArchivo4, $secretKey, $tablaImagenes, $idProductoAnterior);
      }
      else
      {
        $idImagen4 = registrarImagen($nombreArchivo4, $tipoArchivo4, $pesoArchivo4, $secretKey, $tablaImagenes, $idProductoAnterior);
      }
    }else{
      $nombreArchivo4 = '';
      $idImagen4 = '';
    }

    $respuestaRegistroProducto = "<h6 class='h6 text-success'>El producto ha sido actualizado correctamente</h6>";

    echo '<form action="editar-producto.php?idProducto=' . $idProductoAnterior . '" method="POST" class="form-inline" role="form" id="return-form">
    <input type="hidden" name="respuestaRegistroProducto" value="' . $respuestaRegistroProducto . '">
    </form>
    <script>document.getElementById("return-form").submit();</script>';





  }
}



?>
