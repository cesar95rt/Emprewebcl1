<?php
include('includes/header.php');
$contador2 = 0;
if(isset($_POST["tags"]))
{
  $tags = $_POST["tags"];
  if($tags!="")
  {
    $contadorTags = 0;
    $arrayTags = explode(",", $tags);
    $contador2 = count($arrayTags);
    foreach($arrayTags as $tag)
    {
      $contadorTags++;
    }
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
    echo "no";
  }
}
echo $contador2;
include('includes/footer.php');
?>
