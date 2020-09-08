<?php

include(__DIR__ . '/config.php');
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
if($estadoPlan==0)
{
  echo '<h6 class="h6 text-danger">Actualmente, tu plan está vencido, para poder registrar un dominio, debes actualizarlo. <a href="mi-plan">Puedes hacerlo aquí.</a></h6>';
}
else
{
  if($estadoPlan==1)
  {
    echo '<h6 class="h6 text-danger">Lo sentimos, todavía estás en el período de prueba, para poder registrar un dominio, debes contratar un plan. <a href="mi-plan">Puedes hacerlo aquí.</a></h6>';
  }
  else
  {
    if(isset($_GET["dominioCliente"]))
    {
      if($_GET["dominioCliente"]!="")
      {
        if($dominioTienda === $_GET["dominioCliente"] || substr($_GET["dominioCliente"], -11)=='empreweb.cl' || $_GET["dominioCliente"]=='www.empreweb.cl' || $_GET["dominioCliente"]=='empreweb.cl')
        {
          echo '<h6 class="h6 text-danger">El dominio ingresado ya está registrado en tu tienda.</h6>';
        }
        else
        {
          $dominioCliente = $_GET["dominioCliente"];
          $pruebaHTTPWWW = $dominioCliente[0] . $dominioCliente[1] . $dominioCliente[2] . $dominioCliente[3];
          $pruebaTLD4A = substr($dominioCliente, -5);
          $pruebaTLD4 = substr($pruebaTLD4A, 0, 1);
          $pruebaTLD3A = substr($dominioCliente, -4);
          $pruebaTLD3 = substr($pruebaTLD3A, 0, 1);
          $pruebaTLD2A = substr($dominioCliente, -3);
          $pruebaTLD2 = substr($pruebaTLD2A, 0, 1);
          if($pruebaHTTPWWW==='http' || $pruebaHTTPWWW==='www.')
          {
            echo '<h6 class="h6 text-danger">Debes ingresar tu dominio sin anteponer <b>http, https ni www</b>.<br>Por ejemplo: <b>empreweb.cl</b></h6>';
          }
          else
          {
            if($pruebaTLD4!='.' && $pruebaTLD3!='.' && $pruebaTLD2!='.')
            {
              echo '<h6 class="h6 text-danger">Debes ingresar tu dominio sin anteponer <b>http, https ni www</b>.<br>Por ejemplo: <b>empreweb.cl</b></h6>';
            }
            else
            {
              $result = $whois->Lookup($dominioCliente,false);
              $array = $result['rawdata'];
              $i = 0;
              $i2 = 0;
              foreach($array as $prueba)
              {
                $nameServer = substr($prueba, 0, 4);
                if($nameServer==='Name')
                {
                  $NS[$i] = substr($prueba, 13);
                  $i++;
                }
                if(substr($prueba, 13)==='ns1.digitalocean.com' || substr($prueba, 13)==='ns2.digitalocean.com' || substr($prueba,13)==='ns3.digitalocean.com')
                {
                  $i2++;
                }
              }
              if($i2==3)
              {
                $auth = 'sudo doctl auth init -t 87be3470d6964def5a1449523ae58017bce7a7bbbf215d550317a6cbb446fe1f';
                shell_exec($auth);
                $agregarDominio = 'sudo doctl compute domain create ' . $dominioCliente;
                shell_exec($agregarDominio);
                $crearARecord = 'sudo doctl compute domain records create ' . $dominioCliente . ' --record-name @ --record-type A --record-data 64.227.9.58';
                shell_exec($crearARecord);
                echo 'text-success">¡El dominio <b>' . $dominioCliente . '</b> ha sido agregado correctamente!<br>En menos de 24 horas podrá usarlo para acceder a su tienda.</h6>';
                $agregarHtaccess = '

#' . $dominioCliente . '
RewriteEngine on
RewriteCond %{HTTP_HOST} ^' . $dominioCliente . '$ [NC,OR]
RewriteCond %{HTTP_HOST} ^' . $dominioCliente . '$
RewriteCond %{REQUEST_URI} !tiendas/template1/
RewriteRule (.*) /tiendas/template1/$1 [L]
RewriteEngine On
RewriteCond %{HTTP_HOST} ^www.' . $dominioCliente . ' [NC]
RewriteRule ^(.*)$ https://' . $dominioCliente . '.cl/$1 [L,R=301]
#' . $dominioCliente . '

                ';
                $text = trim($agregarHtaccess);
                $textAr = explode("\n", $text);
                $textAr = array_filter($textAr, 'trim');
                $upOne = '/var/www/html/empreweb.cl';
                $dirHtaccess = $upOne . '/.htaccess';
                $file = fopen($dirHtaccess, 'a') or die('Fail to open .htaccess file');
                foreach ($textAr as $line) {
                    fwrite($file, $line.PHP_EOL);
                }
                fwrite($file, "\n");
                fclose($file);
                registrarDominio($dominioCliente, $idTienda);
              }
              else
              {
                if($i!=0)
                {
                  $respuesta1 = '<h6 class="h6 text-danger">Sus DNS aún no apuntan a nuestro servidor.<br>Actualmente son:<br></h6>';
                  $respuesta2 = '';
                  for($cont=0;$cont<$i;$cont++)
                  {
                    $respuesta2 .= '<b>' . $NS[$cont] . '</b><br>';
                  }
                  echo $respuesta1 . $respuesta2 . 'Por favor, cámbielas a:<br><b>ns1.digitalocean.com</b><br><b>ns2.digitalocean.com</b><br><b>ns3.digitalocean.com</b></h6>';
                }
                else
                {
                  echo '<h6 class="h6 text-danger">No se ha encontrado ninguna DNS en este dominio. Si cree que es un error, por favor, comuníquese con nosotros a la brevedad posible.</h6>';
                }
              }
            }
          }
        }
      }
      else
      {
        echo '<h6 class="h6 text-danger">Por favor, ingrese su dominio.</h6>';
      }
    }
    else
    {
      echo '<h6 class="h6 text-danger">error</h6>';
    }
  }
}


?>
