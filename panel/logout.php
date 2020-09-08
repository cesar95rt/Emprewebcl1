<?php

session_start();

if(isset($_SESSION["empreweb"]))
{
  session_unset();
  session_destroy();
  echo '<script>window.location.href = "https://tiendas.empreweb.cl/login.php";</script>';
}else
{
  echo '<script>window.location.href = "https://tiendas.empreweb.cl/login.php";</script>';
}

?>
