<?php

session_start();
include('funciones.php');
$datosTienda = obtenerDatosUsuario();
$secretKey = $datosTienda["secretKey"];

if(isset($_FILES['upload']['name']))
{
  $file = $_FILES['upload']['tmp_name'];
  $file_name = $_FILES['upload']['name'];
  $file_name_array = explode(".", $file_name);
  $extension = end($file_name_array);
  $new_image_name = rand() . '.' . $extension;
  $allowed_extension = array("jpg", "jpeg", "png");

  if(in_array($extension, $allowed_extension))
  {
    move_uploaded_file($file, '../tiendas/' . $secretKey . '/' . $new_image_name);
    $function_number = $_GET['CKEditorFuncNum'];
    echo $_GET['CKEditorFuncNum'];
    $url = 'https://tiendas.empreweb.cl/tiendas/' . $secretKey . '/' . $new_image_name;
    $message = 'La imagen se ha subido correctamente.';
    echo "<script>window.parent.CKEDITOR.tools.callFunction('" . $function_number . "', '" . $url . "', '" . $message . "');</script>";
  }
  else{
    $function_number = 1;
    $url = '';
    $message = 'El formato de la imagen debe ser JPG, JPEG o PNG.';
    echo "<script>window.parent.CKEDITOR.tools.callFunction('" . $function_number . "', '" . $url . "', '" . $message . "');</script>";
  }
}

?>
