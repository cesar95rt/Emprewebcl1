<?php

//$auth = 'sudo doctl auth init -t 87be3470d6964def5a1449523ae58017bce7a7bbbf215d550317a6cbb446fe1f';
//$exec = shell_exec($auth);
//echo $exec;
//$agregarDominio = 'sudo doctl compute domain create caquita1.cl';
//$exec = shell_exec($comando);
//echo $exec;
//$crearARecord = 'doctl compute domain records create caquita1.cl --record-name @ --record-type A --record-data 64.227.9.58';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'phpwhois/whois.main.php';
$whois = new Whois();

if(isset($_GET["dominioCliente"]))
{
  $query = 'empreweb.cl';
  $result = $whois->Lookup($query,false);
  $array = $result['rawdata'];
  $i = 0;
  foreach($array as $prueba)
  {
    if(substr($prueba, 13)==='ns1.digitalocean.com'||substr($prueba, 13)==='ns2.digitalocean.com'||substr($prueba, 13)==='ns3.digitalocean.com')
    {
      $i++;
    }
  }
  if($i==3)
  {
    //$auth = 'sudo doctl auth init -t 87be3470d6964def5a1449523ae58017bce7a7bbbf215d550317a6cbb446fe1f';
    //$exec = shell_exec($auth);
    //echo $exec;
    //$agregarDominio = 'sudo doctl compute domain create caquita1.cl';
    //$exec = shell_exec($comando);
    //echo $exec;
    //$crearARecord = 'doctl compute domain records create caquita1.cl --record-name @ --record-type A --record-data 64.227.9.58';
  }
}
else
{
  echo 'error';
}

?>
