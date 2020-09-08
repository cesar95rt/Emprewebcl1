<?php

$fileName = $_FILES['afile']['name'];
$fileSize1 = $_FILES['afile']['size'];
$fileTmp = $_FILES['afile']['tmp_name'];
$fileType = $_FILES['afile']['type'];
$fileSize = $fileSize1/1024;
$fileContent = file_get_contents($_FILES['afile']['tmp_name']);

if ($_FILES['afile']['error'] !== 0){
  $respuesta = "Hubo un error al subir el archivo, por favor, vuelve a intentarlo más tarde o comunícate con contacto@empreweb.cl / +56 9 9079 9074";
  $respuesta2 = 0;
}else{
  if($fileType == 'image/jpeg' || $fileType == 'image/png' || $fileType == 'image/jpg' || $fileType == 'image/x-png')
  {
    if(mime_content_type($fileTmp) =='image/jpeg' || mime_content_type($fileTmp) =='image/png' || mime_content_type($fileTmp) =='image/jpg' || mime_content_type($fileTmp) =='image/x-png'){
      $respuesta = "El archivo tiene un formato correcto: " . mime_content_type($fileTmp);
      $respuesta2 = 1;
    }else{
      $respuesta = "El archivo del archivo no está permitido: " . mime_content_type($fileType);
      $respuesta2 = 0;
    }
  }else{
    $respuesta = "El formato del archivo no está permitido: " . $fileType;
    $respuesta2 = 0;
  }
  $json = json_encode(array(
    'name' => $fileName,
    'type' => $respuesta,
    'respuesta' => $respuesta2,
    'size' => $fileSize
  ));
echo $json;
}

?>
