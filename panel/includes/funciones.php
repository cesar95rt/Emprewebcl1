<?php

include('dbConfig.php');

function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}

function obtenerDatosUsuario(){
  $sessionString = $_SESSION["empreweb"];
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = "SELECT * FROM tiendas, sesiones WHERE sesiones.sessionString='$sessionString' AND sesiones.idTienda=tiendas.idTienda";
  $resultado = $conexion->query($consulta);
  $datosTienda = $resultado->fetch_array(MYSQLI_ASSOC);
  return $datosTienda;
}

function obtenerDatosTiendaPorEmail($emailTienda){
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = "SELECT nombreTienda, idTienda FROM tiendas WHERE emailTienda='$emailTienda'";
  $resultado = $conexion->query($consulta);
  $datosTienda = $resultado->fetch_array(MYSQLI_ASSOC);
  return $datosTienda;
}

function registrarSolicitudRecuperacionPassword($codigo, $estado, $idUsuario){
   $fecha = obtenerFecha();
   $ipUsuario = obtenerIpUsuario();
   global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
   $consulta = "INSERT INTO recuperacionespassword (idUsuario, codigo, fecha, ipUsuario, estado) VALUES ('$idUsuario', '$codigo', '$fecha', '$ipUsuario', '$estado')";
   $resultado = $conexion->query($consulta);
 }

function registrarCorreoDevolverId($emailDestinatario, $nombreDestinatario, $asunto, $nombreArchivo, $campo1, $campo2, $campo3, $campo4, $campo5){
   $fechaSolicitud = obtenerFecha();
   $ipUsuario = obtenerIpUsuario();
   $estado = 'Solicitado';
   global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
   $consulta = "INSERT INTO correos (emailDestinatario, nombreDestinatario, asunto, fechaSolicitud, ipUsuario, estado, nombreArchivo, campo1, campo2, campo3, campo4, campo5) VALUES ('$emailDestinatario', '$nombreDestinatario', '$asunto', '$fechaSolicitud', '$ipUsuario', '$estado', '$nombreArchivo', '$campo1', '$campo2', '$campo3', '$campo4', '$campo5')";
   $resultado = $conexion->query($consulta);
   $idCorreo = $conexion->insert_id;
   return $idCorreo;
 }

 function obtenerDatosRegistroCorreoPorId($idCorreo){
   global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
   $consulta = "SELECT emailDestinatario, nombreDestinatario, asunto, nombreArchivo, campo1, campo2, campo3, campo4, campo5 FROM correos WHERE idCorreo='$idCorreo'";
   $resultado = $conexion->query($consulta);
   $datosCorreo = $resultado->fetch_array(MYSQLI_ASSOC);
   return $datosCorreo;
 }

 function actualizarEstadoCorreoEnviado($idCorreo){
   $fechaEnvio = obtenerFecha();
   $estado = "Enviado";
   global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
   $consulta = "UPDATE correos SET estado='$estado', fechaEnvio='$fechaEnvio' WHERE idCorreo='$idCorreo'";
   $resultado = $conexion->query($consulta);
 }

 function crearNombreArchivo() {
     $length = 10;
     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
     $charactersLength = strlen($characters);
     $sessionString = '';
     for ($i = 0; $i < $length; $i++) {
         $sessionString .= $characters[rand(0, $charactersLength - 1)];
     }
     $nombreArchivo1GED = obtenerFecha();
     $nombreArchivo1ED = str_replace("-","",$nombreArchivo1GED);
     $nombreArchivo1D = str_replace(" ","",$nombreArchivo1ED);
     $nombreArchivo1 = str_replace(":","",$nombreArchivo1D);
     $nombreArchivo = $nombreArchivo1 . "-" . $sessionString . ".txt";
     return $nombreArchivo;
 }

function obtenerRedesSocialesTienda(){
  global $idTienda;
  global $tablaTienda;
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = "SELECT * FROM $tablaTienda WHERE idTienda='$idTienda'";
  $resultado = $conexion->query($consulta);
  $redesSocialesTienda = $resultado->fetch_array(MYSQLI_ASSOC);
  return $redesSocialesTienda;
}

function iniciarSesion($email, $password){
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta1 = "SELECT emailTienda FROM tiendas WHERE emailTienda='$email'";
  $resultado1 = $conexion->query($consulta1);
  $resultadoFinal1 = $resultado1->num_rows;
  $consulta2 = "SELECT nombreTienda FROM tiendas WHERE emailTienda='$email' AND passwordTienda='$password'";
  $resultado2 = $conexion->query($consulta2);
  $resultadoFinal2 = $resultado2->num_rows;
  if($resultadoFinal1 == 0)
  {
    $resultadoFinal = 0;
  }
  else
  {
    if($resultadoFinal2 == 0)
    {
      $resultadoFinal = 1;
    }
    else
    {
      $resultadoFinal = 2;
    }
  }
  return $resultadoFinal;
}

function guardarSession($email){
  $fecha = obtenerFecha();
  $ip = obtenerIpUsuario();
  $sessionString = crearSessionString();
  ini_set("session.cookie_domain", ".empreweb.cl");
  session_start();
  $_SESSION["empreweb"] = $sessionString;
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta1 = "SELECT * FROM tiendas WHERE tiendas.emailTienda='$email'";
  $resultado1 = $conexion->query($consulta1);
  $datosTienda1 = $resultado1->fetch_array(MYSQLI_ASSOC);
  $idTienda = $datosTienda1["idTienda"];
  $consulta = "INSERT INTO sesiones (idTienda, email, sessionString, fecha, ip) VALUES ('$idTienda', '$email', '$sessionString', '$fecha', '$ip')";
  $resultado = $conexion->query($consulta);
  $idSession = $conexion->insert_id;
}

function obtenerFecha(){
  date_default_timezone_set('America/Santiago');
  $fecha = date('Y-m-d H:i:s');
  return $fecha;
}

function obtenerIpUsuario(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function crearSessionString() {
    $length = 20;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $sessionString = '';
    for ($i = 0; $i < $length; $i++) {
        $sessionString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $sessionString;
}

function verificarNombreTienda($nuevoSubdominioTienda){
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = "SELECT subdominioTienda FROM tiendas WHERE subdominioTienda='$nuevoSubdominioTienda'";
  $resultado = $conexion->query($consulta);
  $nFilas = $resultado->num_rows;
  if($nFilas==1)
  {
    return 0;
  }
  else
  {
    return 1;
  }
}

function verificarEmailTienda($nuevoEmailTienda){
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = "SELECT emailTienda FROM tiendas WHERE emailTienda='$nuevoEmailTienda'";
  $resultado = $conexion->query($consulta);
  $nFilas = $resultado->num_rows;
  if($nFilas==1)
  {
    return 0;
  }
  else
  {
    return 1;
  }
}

function actualizarDatosTiendaMysql($tablaTienda, $nombreTiendaMysql, $subdominioTiendaMysql, $emailTiendaMysql, $idTienda, $direccionTiendaMysql, $telefonoTiendaMysql){
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = "UPDATE tiendas SET nombreTienda='$nombreTiendaMysql', subdominioTienda='$subdominioTiendaMysql', emailTienda='$emailTiendaMysql', direccionTienda='$direccionTiendaMysql', telefonoTienda='$telefonoTiendaMysql' WHERE idTienda='$idTienda'";
  $resultado = $conexion->query($consulta);
  $consulta2 = "UPDATE $tablaTienda SET nombreTienda='$nombreTiendaMysql', subdominioTienda='$subdominioTiendaMysql', emailTienda='$emailTiendaMysql', direccionTienda='$direccionTiendaMysql', telefonoTienda='$telefonoTiendaMysql' WHERE idTienda='$idTienda'";
  $resultado2 = $conexion->query($consulta2);
}

function actualizarRedesSocialesTiendaMysql($tablaTienda, $facebookTiendaMysql, $twitterTiendaMysql, $linkedinTiendaMysql, $whatsappTiendaMysql, $idTienda){
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = "UPDATE $tablaTienda SET facebookTienda='$facebookTiendaMysql', twitterTienda='$twitterTiendaMysql', linkedinTienda='$linkedinTiendaMysql', whatsappTienda='$whatsappTiendaMysql' WHERE idTienda='$idTienda'";
  $resultado = $conexion->query($consulta);
}

function arrayCategorias(){
global $tablaCategorias;
global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
$consultaArrayCategorias = "SELECT * FROM $tablaCategorias";
$datosCategorias = $conexion->query($consultaArrayCategorias);
$nFilasArrayCategorias = $datosCategorias->num_rows;
if($nFilasArrayCategorias==0)
{
  return 0;
}
else
{
  while($categoria = $datosCategorias->fetch_array(MYSQLI_ASSOC))
  {
    $arrayCategorias[] = $categoria;
  }
}
return $arrayCategorias;
}

function listaCategorias($arrayCategorias){
  $listaCategorias = '';
  if($arrayCategorias == 0)
  {
    $listaCategorias = 'Aún no se han agregado categorías';
  }
    else
    {
      foreach($arrayCategorias as $categoria)
      {
        $eliminarModal = '  <div class="modal fade" id="eModal' . $categoria["idCategoria"] . '" tabindex="-1" role="dialog" aria-labelledby="eliminarModal' . $categoria["idCategoria"] . '" aria-hidden="true">
          <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="eliminarModal' . $categoria["idCategoria"] . '">Si eliminas esta categoría, también se borrarán todos sus productos.</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">¿Estás seguro que deseas borrar la categoría <b>' . $categoria['nombreCategoria'] . '</b>?</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="submit" data-dismiss="modal">Cancelar</button>
              <button type="submit" name="eliminar" value="' . $categoria["idCategoria"] . '" class="btn btn-danger">Eliminar</button>
            </div>
          </div>
          </div>
          </div>';
        $listaCategorias .= '
                        <div class="form-group col-sm-6">
                        <div class="container border border-secondary-dotted rounded">
                        <form id="categoriasForm" action="categorias.php" method="POST">
                          <div class="row justify-content-center">
                          <label for="' . $categoria["idCategoria"] . '" style="text-align: center; font-size:22px;" class="col-sm-6 col-form-label"><b>' . $categoria["nombreCategoria"] . '</b></label></div>
                          <div class="form-group row justify-content-center"><div class="col"><input type="text" class="form-control" name="nombreCategoria" id="' . $categoria["idCategoria"] . '" placeholder="Puedes ingresar un nuevo nombre para esta categoría"></div></div>
                            <div class="form-group row justify-content-center"><div class="col-sm-4"><button type="submit" name="cambiarNombre" value="' . $categoria["idCategoria"] . '" class="btn btn-success col mb-4">Cambiar nombre</button></div>
                            <div class="col-sm-4"><a href="subcategorias.php?idCategoria=' . $categoria["idCategoria"] . '&nombreCategoria=' . $categoria["nombreCategoria"] . '" class="btn btn-primary col mb-4">Ver subcategorías</a></div>
                            <div class="col-sm-4"><a href="#" class="btn btn-danger col mb-4" data-toggle="modal" data-target="#eModal' . $categoria["idCategoria"] . '">Eliminar</a>' . $eliminarModal . '</div></div>
                            </form>
                            </div>
                          </div>';
    }
  }
  return $listaCategorias;
}

function comprobarNombreCategoria($arrayCategorias, $nuevoNombreCategoria){
  $respuesta = 1;
  foreach($arrayCategorias as $categoria)
  {
    if($categoria["nombreCategoria"]===$nuevoNombreCategoria)
    {
      $respuesta = 0;
    }
  }
  return $respuesta;
}

function agregarCategoria($nombreNuevaCategoria){
  global $tablaCategorias;
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = "INSERT INTO $tablaCategorias (nombreCategoria) VALUES ('$nombreNuevaCategoria')";
  $resultado = $conexion->query($consulta);
}

function cambiarNombreCategoria($idCategoriaCambiarNombre, $nuevoNombreCategoria){
  global $tablaCategorias;
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = "UPDATE $tablaCategorias SET nombreCategoria='$nuevoNombreCategoria' WHERE idCategoria='$idCategoriaCambiarNombre'";
  $resultado = $conexion->query($consulta);
}

function eliminarCategoria($idCategoriaEliminar){
  global $tablaCategorias;
  global $tablaSubcategorias;
  global $tablaProductos;
  global $secretKey;
  global $tablaImagenes;
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta1 = "DELETE FROM $tablaCategorias WHERE idCategoria='$idCategoriaEliminar'";
  $resultado1 = $conexion->query($consulta1);
  $consulta2 = "DELETE FROM $tablaSubcategorias WHERE idCategoria='$idCategoriaEliminar'";
  $resultado2 = $conexion->query($consulta2);
  $consulta4 = "SELECT idProducto FROM $tablaProductos WHERE idCategoria='$idCategoriaEliminar'";
  $resultado4 = $conexion->query($consulta4);
  $nFilas = $resultado4->num_rows;
  if($nFilas==0)
  {
    $arrayProductos = 0;
  }
  else
  {
    while($producto = $resultado4->fetch_array(MYSQLI_ASSOC))
    {
      $arrayProductos[] = $producto;
    }
  }
  if($arrayProductos==0)
  {
    $tablaProductos = '';
  }
  else
  {
    foreach($arrayProductos as $producto)
    {
      $idProductoEliminar = $producto['idProducto'];
      $carpeta = 'tiendas' . '/' . $secretKey . '/imagenes' . '/' . $idProductoEliminar . '/';
      borrarCarpeta($carpeta);
      $consulta2 = "DELETE FROM $tablaImagenes WHERE idProducto='$idProductoEliminar'";
      $resultado2 = $conexion->query($consulta2);
    }
  }
  $consulta3 = "DELETE FROM $tablaProductos WHERE idCategoria='$idCategoriaEliminar'";
  $resultado3 = $conexion->query($consulta3);
}

function arraySubCategorias($idCategoria){
global $tablaSubcategorias;
global $tablaCategorias;
global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
$consulta = "SELECT $tablaSubcategorias.idSubcategoria as idSubcategoria, $tablaSubcategorias.idCategoria as idCategoria, $tablaSubcategorias.nombreSubcategoria as nombreSubcategoria, $tablaCategorias.nombreCategoria as nombreCategoria FROM $tablaSubcategorias, $tablaCategorias WHERE $tablaSubcategorias.idCategoria='$idCategoria' AND $tablaCategorias.idCategoria=$tablaSubcategorias.idCategoria";
$resultado = $conexion->query($consulta);
$nFilasArraySubcategorias = $resultado->num_rows;
if($nFilasArraySubcategorias==0)
{
  return 0;
}
else
{
  while($subcategoria = $resultado->fetch_array(MYSQLI_ASSOC))
  {
    $arraySubcategorias[] = $subcategoria;
  }
}
return $arraySubcategorias;
}

function listaSubCategorias($arraySubcategorias){
  $listaSubcategorias = '';
  if($arraySubcategorias == 0)
  {
    $listaSubcategorias = 'Aún no se han agregado subcategorías';
  }
    else
    {
      foreach($arraySubcategorias as $subcategoria)
      {
        $eliminarModal = '  <div class="modal fade" id="eModal' . $subcategoria["idSubcategoria"] . '" tabindex="-1" role="dialog" aria-labelledby="eliminarModal' . $subcategoria["idSubcategoria"] . '" aria-hidden="true">
          <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="eliminarModal' . $subcategoria["idSubcategoria"] . '">Si eliminas esta categoría, también se borrarán todos sus productos.</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">¿Estás seguro que deseas borrar la subcategoría <b>' . $subcategoria['nombreSubcategoria'] . '</b>?</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="submit" data-dismiss="modal">Cancelar</button>
              <button type="submit" name="eliminar" value="' . $subcategoria["idSubcategoria"] . '" class="btn btn-danger">Eliminar</button>
            </div>
          </div>
          </div>
          </div>';
        $listaSubcategorias .= '
                      <div class="form-group col-sm-6">
                      <div class="container border border-secondary-dotted rounded">
                        <form id="subcategoriasForm" action="subcategorias.php?idCategoria=' . $subcategoria["idCategoria"] . '&nombreCategoria=' . $subcategoria["nombreCategoria"] . '" method="POST">
                          <div class="row justify-content-center">
                          <label for="' . $subcategoria["idSubcategoria"] . '" style="text-align: center; font-size:22px;" class="col-sm-6 col-form-label"><b>' . $subcategoria["nombreSubcategoria"] . '</b></label></div>
                          <div class="form-group row justify-content-center"><div class="col"><input type="text" class="form-control" name="nombreSubcategoria" id="' . $subcategoria["idSubcategoria"] . '" placeholder="Puedes ingresar un nuevo nombre para esta subcategoría"></div></div>
                            <div class="form-group row justify-content-center"><div class="col-sm-4"><button type="submit" name="cambiarNombre" value="' . $subcategoria["idSubcategoria"] . '" class="btn btn-success col mb-4">Cambiar nombre</button></div>
                            <div class="col-sm-4"><a href="productos.php?filtroCategoria=' . $subcategoria["idCategoria"] . '&filtroSubcategoria=' . $subcategoria["idSubcategoria"] . '" class="btn btn-primary col mb-4">Ver productos</a></div>
                            <div class="col-sm-4"><a href="" class="btn btn-danger col mb-4" data-toggle="modal" data-target="#eModal' . $subcategoria["idSubcategoria"] . '">Eliminar</a>' . $eliminarModal . '</div></div>
                            </form>
                      </div>
                    </div>';
    }
  }
  return $listaSubcategorias;
}

function comprobarNombreSubCategoria($arraySubcategorias, $nuevoNombreSubcategoria){
  $respuesta = 1;
  foreach($arraySubcategorias as $subcategoria)
  {
    if($subcategoria["nombreSubcategoria"]===$nuevoNombreSubcategoria)
    {
      $respuesta = 0;
    }
  }
  return $respuesta;
}

function agregarSubCategoria($nombreNuevaSubcategoria, $idCategoria){
  global $tablaSubcategorias;
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = "INSERT INTO $tablaSubcategorias (idCategoria, nombreSubcategoria) VALUES ('$idCategoria', '$nombreNuevaSubcategoria')";
  $resultado = $conexion->query($consulta);
}

function cambiarNombreSubCategoria($idSubcategoriaCambiarNombre, $nuevoNombreSubcategoria){
  global $tablaSubcategorias;
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = "UPDATE $tablaSubcategorias SET nombreSubcategoria='$nuevoNombreSubcategoria' WHERE idSubcategoria='$idSubcategoriaCambiarNombre'";
  $resultado = $conexion->query($consulta);
}

function eliminarSubCategoria($idSubcategoriaEliminar){
  global $tablaSubcategorias;
  global $tablaProductos;
  global $secretKey;
  global $tablaImagenes;
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = "DELETE FROM $tablaSubcategorias WHERE idSubcategoria='$idSubcategoriaEliminar'";
  $resultado = $conexion->query($consulta);
  $consulta3 = "SELECT idProducto FROM $tablaProductos WHERE idSubcategoria='$idSubcategoriaEliminar'";
  $resultado3 = $conexion->query($consulta3);
  $nFilas = $resultado3->num_rows;
  if($nFilas==0)
  {
    $arrayProductos = 0;
  }
  else
  {
    while($producto = $resultado3->fetch_array(MYSQLI_ASSOC))
    {
      $arrayProductos[] = $producto;
    }
  }
  if($arrayProductos==0)
  {
    $tablaProductos = '';
  }
  else
  {
    foreach($arrayProductos as $producto)
    {
      $idProductoEliminar = $producto['idProducto'];
      $carpeta = 'tiendas' . '/' . $secretKey . '/imagenes' . '/' . $idProductoEliminar . '/';
      borrarCarpeta($carpeta);
      $consulta2 = "DELETE FROM $tablaImagenes WHERE idProducto='$idProductoEliminar'";
      $resultado2 = $conexion->query($consulta2);
    }
  }
  $consulta2 = "DELETE FROM $tablaProductos WHERE idSubcategoria='$idSubcategoriaEliminar'";
  $resultado2 = $conexion->query($consulta2);
}

function comprobarCategoria($idCategoria){
global $tablaCategorias;
global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
$consulta = "SELECT * FROM $tablaCategorias WHERE idCategoria='$idCategoria'";
$resultado = $conexion->query($consulta);
$nFilasArrayCategorias = $resultado->num_rows;
if($nFilasArrayCategorias==0)
{
  return 0;
}
else
{
  return 1;
}
}

function comprobarCategoria2($idCategoria, $nombreCategoria){
global $tablaCategorias;
global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
$consulta = "SELECT * FROM $tablaCategorias WHERE idCategoria='$idCategoria' AND nombreCategoria='$nombreCategoria'";
$resultado = $conexion->query($consulta);
$nFilasArrayCategorias = $resultado->num_rows;
if($nFilasArrayCategorias==0)
{
  return 0;
}
else
{
  return 1;
}
}

function comprobarProducto($idProducto){
global $tablaProductos;
global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
$consulta = "SELECT * FROM $tablaProductos WHERE idProducto='$idProducto'";
$resultado = $conexion->query($consulta);
$nFilasArrayProductos = $resultado->num_rows;
if($nFilasArrayProductos==0)
{
  return 0;
}
else
{
  return 1;
}
}

function obtenerNombreCategoria2($idCategoria){
  global $tablaCategorias;
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = "SELECT * FROM $tablaCategorias WHERE idCategoria='$idCategoria'";
  $resultado = $conexion->query($consulta);
  $datosCategoria = $resultado->fetch_array(MYSQLI_ASSOC);
  $nombreCategoria = $datosCategoria["nombreCategoria"];
  return $nombreCategoria;
}

function obtenerNombreSubcategoria2($idSubcategoria){
  global $tablaSubcategorias;
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = "SELECT * FROM $tablaSubcategorias WHERE idSubcategoria='$idSubcategoria'";
  $resultado = $conexion->query($consulta);
  $datosSubcategoria = $resultado->fetch_array(MYSQLI_ASSOC);
  $nombreSubcategoria = $datosSubcategoria["nombreSubcategoria"];
  return $nombreSubcategoria;
}

function arrayProductos($filtro, $tipoFiltro){
  global $tablaProductos;
  global $tablaCategorias;
  global $tablaSubcategorias;
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  if($tipoFiltro==0)
  {
    $consulta = "SELECT * FROM $tablaProductos";
    $resultado = $conexion->query($consulta);
    $nFilas = $resultado->num_rows;
    if($nFilas==0)
    {
      $arrayProductos = 0;
    }
    else
    {
      while($producto = $resultado->fetch_array(MYSQLI_ASSOC))
      {
        $arrayProductos[] = $producto;
      }
    }
  }
  if($tipoFiltro==1)
  {
    $consulta = "SELECT * FROM $tablaProductos WHERE $tablaProductos.idCategoria='$filtro'";
    $resultado = $conexion->query($consulta);
    $nFilas = $resultado->num_rows;
    if($nFilas==0)
    {
      $arrayProductos = 0;
    }
    else
    {
      while($producto = $resultado->fetch_array(MYSQLI_ASSOC))
      {
        $arrayProductos[] = $producto;
      }
    }
  }
  if($tipoFiltro==2)
  {
    $consulta = "SELECT * FROM $tablaProductos WHERE $tablaProductos.idSubcategoria='$filtro' ";
    $resultado = $conexion->query($consulta);
    $nFilas = $resultado->num_rows;
    if($nFilas==0)
    {
      $arrayProductos = 0;
    }
    else
    {
      while($producto = $resultado->fetch_array(MYSQLI_ASSOC))
      {
        $arrayProductos[] = $producto;
      }
    }
  }
  return $arrayProductos;
}

function tablaMostrarProductos($arrayProductos){
  $tablaMostrarProductos='';
  $trtd = "<tr><td>";

  $tdtd = "</td><td>";

  $tdtr = "</td></tr>";
  if($arrayProductos==0)
  {
    $tablaProductos = '';
  }
  else
  {
    foreach($arrayProductos as $producto)
    {
      $tablaMostrarProductos .= $trtd . $producto['skuProducto'] . $tdtd . $producto['nombreProducto'] . $tdtd . $producto['precioProducto'] . $tdtd . $producto['nombreCategoria'] . $tdtd . $producto['nombreSubcategoria'] . $tdtd . $producto['stockProducto'] . $tdtd . '<a class="btn btn-success" href="editar-producto.php?idProducto=' . $producto['idProducto'] . '">Editar</a>' . $tdtd . '<a class="btn btn-danger" href="eliminar-producto.php?idProducto=' . $producto['idProducto'] . '&nombreProducto=' . $producto['nombreProducto'] . '">Eliminar</a>' . $tdtr;
    }
  }
  return $tablaMostrarProductos;
}

function opcionesCategorias($arrayCategorias){
  $opcionesCategorias = '';
  if($arrayCategorias == 0)
  {
    $opcionesCategorias = '<option disabled>Aún no se han agregado categorías</option>';
  }
    else
    {
      foreach($arrayCategorias as $categoria)
      {
        $opcionesCategorias .= '<option value="' . $categoria["idCategoria"] . '">' . $categoria["nombreCategoria"] . '</option>';
      }
    }
  return $opcionesCategorias;
}

function opcionesCategorias2($arrayCategorias, $idCategoria){
  $opciones2 = '';
  $opciones1 = '';
  if($arrayCategorias == 0)
  {
    $opciones1 = '<option disabled>Aún no se han agregado categorías</option>';
  }
    else
    {
      foreach($arrayCategorias as $categoria)
      {
        if($categoria["idCategoria"]==$idCategoria)
        {
          $opciones1 = '<option selected value="' . $categoria["idCategoria"] . '">' . $categoria["nombreCategoria"] . '</option>';
        }
        else
        {
        $opciones2 .= '<option value="' . $categoria["idCategoria"] . '">' . $categoria["nombreCategoria"] . '</option>';
        }
      }
    }
  $opcionesCategorias = $opciones1 . $opciones2;
  return $opcionesCategorias;
}

function opcionesSubCategorias($arraySubcategorias){
  $opcionesSubcategorias = '';
  $opciones1 = '';
  $opciones2 = '';
  if($arraySubcategorias == 0)
  {
    $opciones1 = '<option disabled selected hidden>Selecciona una subcategoría (opcional)</option>';
    $opciones2 = '<option disabled>Aún no se han agregado subcategorías</option>';
  }
    else
    {
      $opciones1 = '<option disabled selected hidden>Selecciona una subcategoría (opcional)</option>';
      foreach($arraySubcategorias as $subcategoria)
      {
        $opciones2 .= '<option value="' . $subcategoria["idSubcategoria"] . '">' . $subcategoria["nombreSubcategoria"] . '</option>';
      }
    }
  $opcionesSubcategorias = $opciones1 . $opciones2;
  return $opcionesSubcategorias;
}

function opcionesSubCategorias2($arraySubcategorias, $idSubcategoria){
  $opcionesSubcategorias = '';
  $opciones2 = '';
  if($arraySubcategorias == 0)
  {
    $opciones1 = '<option disabled selected hidden>Selecciona una subcategoría (opcional)</option>';
    $opciones2 = '<option disabled>Aún no se han agregado subcategorías</option>';
  }
    else
    {
      if($idSubcategoria==0)
      {
        $opciones1 = '<option disabled selected hidden>Selecciona una subcategoría (opcional)</option>';
        foreach($arraySubcategorias as $subcategoria)
        {
          $opciones2 .= '<option value="' . $subcategoria["idSubcategoria"] . '">' . $subcategoria["nombreSubcategoria"] . '</option>';
        }
      }
      else
      {
        foreach($arraySubcategorias as $subcategoria)
        {
          if($subcategoria["idSubcategoria"]==$idSubcategoria)
          {
            $opciones1 = '<option selected value="' . $subcategoria["idSubcategoria"] . '">' . $subcategoria["nombreSubcategoria"] . '</option>';
          }
          else
          {
            $opciones2 .= '<option value="' . $subcategoria["idSubcategoria"] . '">' . $subcategoria["nombreSubcategoria"] . '</option>';
          }
        }
      }
    }
  $opcionesSubcategorias = $opciones1 . $opciones2;
  return $opcionesSubcategorias;
}

function obtenerNombreCategoria($idCategoria){
  global $tablaCategorias;
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = "SELECT $tablaCategorias.idCategoria, $tablaCategorias.nombreCategoria FROM $tablaCategorias WHERE $tablaCategorias.idCategoria='$idCategoria'";
  $resultado = $conexion->query($consulta);
  $datos = $resultado->fetch_array(MYSQLI_ASSOC);
  $datosFinal = '<a href="productos.php">Productos</a> > <a href="?filtroCategoria=' . $datos["idCategoria"] . '">' . $datos["nombreCategoria"] . '</a>';
  return $datosFinal;
}

function obtenerNombreSubcategoria($idSubcategoria){
  global $tablaCategorias;
  global $tablaSubcategorias;
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = "SELECT $tablaSubcategorias.idSubcategoria, $tablaSubcategorias.idCategoria, $tablaSubcategorias.nombreSubcategoria, $tablaCategorias.nombreCategoria FROM $tablaSubcategorias, $tablaCategorias WHERE $tablaSubcategorias.idSubcategoria='$idSubcategoria' AND $tablaCategorias.idCategoria=$tablaSubcategorias.idCategoria";
  $resultado = $conexion->query($consulta);
  $datos = $resultado->fetch_array(MYSQLI_ASSOC);
  $datosFinal = '<a href="productos.php">Productos</a> > <a href="?filtroCategoria=' . $datos["idCategoria"] . '">' . $datos["nombreCategoria"] . '</a>' . ' > <a href="?filtroCategoria=' . $datos["idCategoria"] . '&filtroSubcategoria=' . $datos["idSubcategoria"] . '">' . $datos["nombreSubcategoria"] . '</a>';
  return $datosFinal;
}

function eliminarProducto($idProductoEliminar, $nombreProductoEliminar){
  global $tablaProductos;
  global $tablaImagenes;
  global $secretKey;
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = "DELETE FROM $tablaProductos WHERE idProducto='$idProductoEliminar'";
  $consulta2 = "DELETE FROM $tablaImagenes WHERE idProducto='$idProductoEliminar'";
  $resultado2 = $conexion->query($consulta2);
  $resultado = $conexion->query($consulta);
  $carpeta = 'tiendas' . '/' . $secretKey . '/imagenes' . '/' . $idProductoEliminar . '/';
  borrarCarpeta($carpeta);
}

function verificarRegistro($emailTienda, $subdominioTienda){
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta1 = "SELECT emailTienda FROM tiendas WHERE emailTienda='$emailTienda'";
  $resultado1 = $conexion->query($consulta1);
  $resultadoFinal1 = $resultado1->num_rows;
  $consulta2 = "SELECT subdominioTienda FROM tiendas WHERE subdominioTienda='$subdominioTienda'";
  $resultado2 = $conexion->query($consulta2);
  $resultadoFinal2 = $resultado2->num_rows;
  if($resultadoFinal1 == 0)
  {
    if($resultadoFinal2 == 0)
    {
      $resultadoFinal = 0;
    }else
    {
      $resultadoFinal = 1;
    }
  }else
  {
    if($resultadoFinal2 == 1)
    {
      $resultadoFinal = 2;
    }else
    {
      $resultadoFinal = 3;
    }
  }
  return $resultadoFinal;
}

function registrarUsuario($nombreTienda, $subdominioTienda, $emailTienda, $passwordTienda){
  $fechaRegistroTienda = obtenerFecha();
  $secretKeyI = crearSecretKey();
  $secretKey = $subdominioTienda . $secretKeyI;
  $ipRegistroTienda = obtenerIpUsuario();
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = "INSERT INTO tiendas (nombreTienda, emailTienda, passwordTienda, fechaRegistroTienda, ipRegistroTienda, subdominioTienda, secretKey) VALUES ('$nombreTienda', '$emailTienda', '$passwordTienda', '$fechaRegistroTienda', '$ipRegistroTienda', '$subdominioTienda', '$secretKey')";
  $resultado = $conexion->query($consulta);
  $idTienda = $conexion->insert_id;
  $returnRegistro["idTienda"] = $idTienda;
  $returnRegistro["secretKey"] = $secretKey;
  return $returnRegistro;
}

function crearSecretKey() {
  $length = 8;
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $sessionString = '';
  for ($i = 0; $i < $length; $i++) {
      $sessionString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $sessionString;
}

function crearTablaSubcategorias($idTienda)
{
  $nombreTabla = 'subcategorias_' . $idTienda;
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = 'CREATE TABLE ' . $nombreTabla . ' (
  idSubcategoria int(11) NOT NULL AUTO_INCREMENT,
  idCategoria int(11) DEFAULT NULL,
  nombreSubcategoria varchar(255) DEFAULT NULL,
  PRIMARY KEY (idSubcategoria)
)';
  $resultado = $conexion->query($consulta);
}

function crearTablaProductos($idTienda)
{
  $nombreTabla = 'productos_' . $idTienda;
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = 'CREATE TABLE ' . $nombreTabla . ' (
  idProducto int(11) NOT NULL AUTO_INCREMENT,
  skuProducto varchar(255) DEFAULT NULL,
  nombreCategoria varchar(255) DEFAULT NULL,
  nombreSubcategoria varchar(255) DEFAULT NULL,
  nombreProducto varchar(255) DEFAULT NULL,
  precioProducto int(11) DEFAULT NULL,
  stockProducto int(11) DEFAULT NULL,
  inventarioProducto int(11) DEFAULT NULL,
  imagen varchar(255) DEFAULT NULL,
  imagen1 varchar(255) DEFAULT NULL,
  imagen2 varchar(255) DEFAULT NULL,
  imagen3 varchar(255) DEFAULT NULL,
  imagen4 varchar(255) DEFAULT NULL,
  idCategoria int(11) DEFAULT NULL,
  idSubcategoria int(11) DEFAULT NULL,
  tipoArchivo varchar(255) DEFAULT NULL,
  tipoArchivo1 varchar(255) DEFAULT NULL,
  tipoArchivo2 varchar(255) DEFAULT NULL,
  tipoArchivo3 varchar(255) DEFAULT NULL,
  tipoArchivo4 varchar(255) DEFAULT NULL,
  precioOfertaProducto int(11) DEFAULT NULL,
  descripcionProducto varchar(255) DEFAULT NULL,
  PRIMARY KEY (idProducto)
)';
  $resultado = $conexion->query($consulta);
}

function crearTablaDatosTienda($idTienda)
{
  $nombreTabla = 'datostienda_' . $idTienda;
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = 'CREATE TABLE ' . $nombreTabla . ' (
  idTienda int(11) NOT NULL,
  nombreTienda varchar(255) DEFAULT NULL,
  direccionTienda varchar(255) DEFAULT NULL,
  emailTienda varchar(255) DEFAULT NULL,
  telefonoTienda varchar(255) DEFAULT NULL,
  facebookTienda varchar(255) DEFAULT NULL,
  twitterTienda varchar(255) DEFAULT NULL,
  linkedinTienda varchar(255) DEFAULT NULL,
  whatsappTienda varchar(255) DEFAULT NULL,
  subdominioTienda varchar(255) DEFAULT NULL,
  secretKey varchar(255) DEFAULT NULL,
  PRIMARY KEY (idTienda)
)';
  $resultado = $conexion->query($consulta);
}

function crearTablaCategorias($idTienda)
{
  $nombreTabla = 'categorias_' . $idTienda;
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = 'CREATE TABLE ' . $nombreTabla . ' (
  idCategoria int(11) NOT NULL AUTO_INCREMENT,
  nombreCategoria varchar(255) DEFAULT NULL,
  PRIMARY KEY (idCategoria)
)';
  $resultado = $conexion->query($consulta);
}

function crearTablaImagenes($idTienda)
{
  $nombreTabla = 'categorias_' . $idTienda;
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = 'CREATE TABLE ' . $nombreTabla . ' (
  idImagen int(11) NOT NULL AUTO_INCREMENT,
  nombreImagen varchar(255) DEFAULT NULL,
  tipoImagen varchar(255) DEFAULT NULL,
  pesoImagen int(11) DEFAULT NULL,
  carpetaImagen varchar(255) DEFAULT NULL,
  urlImagen varchar(255) DEFAULT NULL,
  fecha datetime DEFAULT NULL,
  ipUsuario varchar(255) DEFAULT NULL,
  idProducto int(11) DEFAULT NULL,
  PRIMARY KEY (idImagen)
)';
}

function llenarTablaDatosTienda($idTienda, $nombreTienda, $emailTienda, $subdominioTienda, $secretKey){
  $nombreTabla = 'datostienda_' . $idTienda;
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = "INSERT INTO $nombreTabla (idTienda, nombreTienda, emailTienda, subdominioTienda, secretKey) VALUES ('$idTienda', '$nombreTienda', '$emailTienda', '$subdominioTienda', '$secretKey')";
  $resultado = $conexion->query($consulta);
}

function registrarImagen($nombreImagen, $tipoImagen, $pesoImagen, $secretKey, $tablaImagenes, $idProducto){
  $fecha = obtenerFecha();
  $ipUsuario = obtenerIpUsuario();
  $urlImagen = 'https://panel.empreweb.cl/tiendas/' . $secretKey . '/imagenes' . '/' . $idProducto . '/' . $nombreImagen;
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = "INSERT INTO $tablaImagenes (nombreImagen, tipoImagen, pesoImagen, carpetaImagen, urlImagen, fecha, ipUsuario, idProducto) VALUES ('$nombreImagen', '$tipoImagen', '$pesoImagen', '$secretKey', '$urlImagen', '$fecha', '$ipUsuario', '$idProducto')";
  $resultado = $conexion->query($consulta);
  $idImagen = $conexion->insert_id;
  return $idImagen;
}

function actualizarImagen($nombreImagen, $tipoImagen, $pesoImagen, $secretKey, $tablaImagenes, $idProducto){
  $fecha = obtenerFecha();
  $ipUsuario = obtenerIpUsuario();
  $urlImagen = 'https://panel.empreweb.cl/tiendas/' . $secretKey . '/imagenes' . '/' . $idProducto . '/' . $nombreImagen;
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = "UPDATE $tablaImagenes SET tipoImagen='$tipoImagen', pesoImagen='$pesoImagen', carpetaImagen='$secretKey', urlImagen='$urlImagen', fecha='$fecha', ipUsuario='$ipUsuario' WHERE idProducto='$idProducto' AND nombreImagen='$nombreImagen'";
  $resultado = $conexion->query($consulta);
  $idImagen = $conexion->insert_id;
  return $idImagen;
}

function agregarProducto($secretKey, $tablaProductos, $inventarioProducto, $skuProducto, $idCategoria, $idSubcategoria, $nombreProducto, $precioProducto, $stockProducto, $imagen, $imagen1, $imagen2, $imagen3, $imagen4, $nombreSubcategoria, $nombreCategoria, $tipoArchivo, $tipoArchivo1, $tipoArchivo2, $tipoArchivo3, $tipoArchivo4, $precioOfertaProducto, $descripcionProducto, $pesoProducto, $altoProducto, $anchoProducto, $largoProducto, $estadoStarken, $urlSeo, $diasPreparacion){
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = "INSERT INTO $tablaProductos (inventarioProducto, skuProducto, idCategoria, idSubcategoria, nombreProducto, precioProducto, stockProducto, imagen, imagen1, imagen2, imagen3, imagen4, nombreSubcategoria, nombreCategoria, tipoArchivo, tipoArchivo1, tipoArchivo2, tipoArchivo3, tipoArchivo4, precioOfertaProducto, descripcionProducto, pesoProducto, altoProducto, anchoProducto, largoProducto, estadoStarken, urlSeo, diasPreparacion) VALUES ('$inventarioProducto', '$skuProducto', '$idCategoria', '$idSubcategoria', '$nombreProducto', '$precioProducto', '$stockProducto', '$imagen', '$imagen1', '$imagen2', '$imagen3', '$imagen4', '$nombreSubcategoria', '$nombreCategoria', '$tipoArchivo', '$tipoArchivo1', '$tipoArchivo2', '$tipoArchivo3', '$tipoArchivo4', '$precioOfertaProducto', '$descripcionProducto', '$pesoProducto', '$altoProducto', '$anchoProducto', '$largoProducto', '$estadoStarken', '$urlSeo', '$diasPreparacion')";
  $resultado = $conexion->query($consulta);
  $idProducto = $conexion->insert_id;
  return $idProducto;
}

function actualizarProducto($secretKey, $tablaProductos, $inventarioProducto, $skuProducto, $idCategoria, $idSubcategoria, $nombreProducto, $precioProducto, $stockProducto, $imagen, $imagen1, $imagen2, $imagen3, $imagen4, $nombreSubcategoria, $nombreCategoria, $tipoArchivo, $tipoArchivo1, $tipoArchivo2, $tipoArchivo3, $tipoArchivo4, $precioOfertaProducto, $idProductoAnterior, $descripcionProducto, $pesoProducto, $altoProducto, $anchoProducto, $largoProducto, $estadoStarken, $urlSeo, $diasPreparacion){
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = "UPDATE $tablaProductos SET inventarioProducto='$inventarioProducto', skuProducto='$skuProducto', idCategoria='$idCategoria', idSubcategoria='$idSubcategoria', nombreProducto='$nombreProducto', precioProducto='$precioProducto', stockProducto='$stockProducto', imagen='$imagen', imagen1='$imagen1', imagen2='$imagen2', imagen3='$imagen3', imagen4='$imagen4', nombreSubcategoria='$nombreSubcategoria', nombreCategoria='$nombreCategoria', tipoArchivo='$tipoArchivo', tipoArchivo1='$tipoArchivo1', tipoArchivo2='$tipoArchivo2', tipoArchivo3='$tipoArchivo3', tipoArchivo4='$tipoArchivo4', precioOfertaProducto='$precioOfertaProducto', descripcionProducto='$descripcionProducto', pesoProducto='$pesoProducto', altoProducto='$altoProducto', anchoProducto='$anchoProducto', largoProducto='$largoProducto', estadoStarken='$estadoStarken', urlSeo='$urlSeo', diasPreparacion='$diasPreparacion' WHERE idProducto='$idProductoAnterior'";
  $resultado = $conexion->query($consulta);
}

function comprobarNombreProducto($nombreProducto){
global $tablaProductos;
global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
$consulta = "SELECT nombreProducto FROM $tablaProductos WHERE nombreProducto='$nombreProducto'";
$resultado = $conexion->query($consulta);
$nFilasArrayCategorias = $resultado->num_rows;
if($nFilasArrayCategorias==0)
{
  return 0;
}
else
{
  return 1;
}
}

function comprobarUrlSeo($urlSeo){
global $tablaProductos;
global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
$consulta = "SELECT urlSeo FROM $tablaProductos WHERE urlSeo='$urlSeo'";
$resultado = $conexion->query($consulta);
$nFilasArrayCategorias = $resultado->num_rows;
if($nFilasArrayCategorias==0)
{
  return 0;
}
else
{
  return 1;
}
}

function comprobarSkuProducto($skuProducto){
global $tablaProductos;
global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
$consulta = "SELECT skuProducto FROM $tablaProductos WHERE skuProducto='$skuProducto'";
$resultado = $conexion->query($consulta);
$nFilasArrayCategorias = $resultado->num_rows;
if($nFilasArrayCategorias==0)
{
  return 0;
}
else
{
  return 1;
}
}

function borrarCarpeta($path) {

	$files = glob($path . '/*');
	foreach ($files as $file) {
		is_dir($file) ? borrarCarpeta($file) : unlink($file);
	}
	rmdir($path);

	return;
}

function obtenerDatosProducto($idProducto){
  global $tablaProductos;
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = "SELECT * FROM $tablaProductos WHERE $tablaProductos.idProducto='$idProducto'";
  $resultado = $conexion->query($consulta);
  $datosProducto = $resultado->fetch_array(MYSQLI_ASSOC);
  return $datosProducto;
}

function obtenerDescripcionCortaProducto($idProducto){
  global $tablaDescripcionesCortas;
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = "SELECT * FROM $tablaDescripcionesCortas WHERE $tablaDescripcionesCortas.idProducto='$idProducto'";
  $resultado = $conexion->query($consulta);
  $descripcionCorta = $resultado->fetch_array(MYSQLI_ASSOC);
  return $descripcionCorta;
}

function registrarTags($arrayTags, $cantidadTags, $idProducto){
  global $tablaTags;
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  for($i=0; $i<$cantidadTags; $i++)
  {
    $consulta = "INSERT INTO $tablaTags (idProducto, tag) VALUES ('$idProducto', '$arrayTags[$i]')";
    $resultado = $conexion->query($consulta);
  }
}

function borrarTags($idProducto){
  global $tablaTags;
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = "DELETE FROM $tablaTags WHERE idProducto='$idProducto'";
  $resultado = $conexion->query($consulta);
}

function obtenerTags($idProducto){
  global $tablaTags;
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = "SELECT tag FROM $tablaTags WHERE idProducto='$idProducto'";
  $resultado = $conexion->query($consulta);
  $nFilasArrayTags = $resultado->num_rows;
  if($nFilasArrayTags==0)
  {
    return '';
  }
  else
  {
    while($tag = $resultado->fetch_array(MYSQLI_ASSOC))
    {
      $arrayTags[] = $tag;
    }
  }
  return $arrayTags;
  }

function registrarDominio($dominioCliente, $idTienda){
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  global $tablaTienda;
  $consulta1 = "UPDATE tiendas SET dominioTienda='$dominioCliente' WHERE idTienda='$idTienda'";
  $consulta2 = "UPDATE $tablaTienda SET dominioTienda='$dominioCliente'";
  $resultado1 = $conexion->query($consulta1);
  $resultado2 = $conexion->query($consulta2);
}

function agregarDescripcionCorta($idProducto, $descripcionCorta){
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  global $tablaDescripcionesCortas;
  $consulta = "INSERT INTO $tablaDescripcionesCortas (idProducto, descripcionCorta) VALUES ('$idProducto', '$descripcionCorta')";
  $resultado = $conexion->query($consulta);
}

function actualizarColores($arrayColores){
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  global $tablaColores;
  foreach($arrayColores as $color)
  {
    $colorElegido = $color["colorElegido"];
    $idColor = $color["idColor"];
    $consulta = "UPDATE $tablaColores SET colorElegido='$colorElegido' WHERE idColor = '$idColor'";
    $resultado = $conexion->query($consulta);
  }
}

function obtenerDatosPaginaContacto(){
  global $conexion;
  global $tablaPaginaContacto;
  global $tablaTienda;
  $consulta = "SELECT $tablaPaginaContacto.titulo1, $tablaPaginaContacto.titulo2, $tablaPaginaContacto.subtitulo1, $tablaPaginaContacto.subtitulo2, $tablaPaginaContacto.horario1, $tablaPaginaContacto.horario2, $tablaPaginaContacto.direccion, $tablaTienda.paginaContacto FROM $tablaPaginaContacto, $tablaTienda WHERE $tablaPaginaContacto.idTienda=$tablaTienda.idTienda";
  $resultado = $conexion->query($consulta);
  $nFilasArrayPaginaContacto = $resultado->num_rows;
  if($nFilasArrayPaginaContacto==0)
  {
    return 0;
  }
  else
  {
    $datosPaginaContacto = $resultado->fetch_array(MYSQLI_ASSOC);
    return $datosPaginaContacto;
  }
}

function actualizarPaginaContacto($estado, $idTienda, $titulo1, $titulo2, $subtitulo1, $subtitulo2, $direccionMapa, $horario1, $horario2){
global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
global $tablaPaginaContacto;
global $tablaTienda;
$consulta = "UPDATE $tablaPaginaContacto SET titulo1='$titulo1', titulo2='$titulo2', subtitulo1='$subtitulo1', subtitulo2='$subtitulo2', horario1='$horario1', horario2='$horario2', direccion='$direccionMapa' WHERE idTienda = '$idTienda'";
$resultado = $conexion->query($consulta);
$consulta2 = "UPDATE $tablaTienda SET paginaContacto='$estado' WHERE idTienda='$idTienda'";
$resultado2 = $conexion->query($consulta2);
echo $consulta2;
}

function verificarCodigo($codigo){
 $estado = 'Solicitud';
 global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
 $consulta = "SELECT id FROM recuperacionespassword WHERE codigo='$codigo' AND estado='$estado'";
 $resultado = $conexion->query($consulta);
 $resultadoFinal = $resultado->num_rows;
 if($resultadoFinal==0)
 {
   return 0;
 }
 else
 {
   return 1;
 }
}

function verificarCodigoCambioPassword($codigo){
 $estado = 'Solicitud';
 global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
 $consulta = "SELECT idSolicitud FROM solicitudescambiospassword WHERE codigo='$codigo' AND estado='$estado'";
 $resultado = $conexion->query($consulta);
 $resultadoFinal = $resultado->num_rows;
 if($resultadoFinal==0)
 {
   return 0;
 }
 else
 {
   return 1;
 }
}

function obtenerDatosUsuarioPorCodigo($codigo){
   global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
   $consulta = "SELECT tiendas.idTienda, tiendas.nombreTienda, tiendas.emailTienda, tiendas.passwordTienda, recuperacionespassword.id FROM tiendas, recuperacionespassword WHERE tiendas.idTienda=recuperacionespassword.idUsuario";
   $resultado = $conexion->query($consulta);
   $datosTienda = $resultado->fetch_array(MYSQLI_ASSOC);
   return $datosTienda;
 }

 function crearPassword($newPassword, $currentPassword, $idUsuario, $codigo, $idRecuperacion){
   $tipoCambio = "Recuperacion";
   $fecha = obtenerFecha();
   $ipUsuario = obtenerIpUsuario();
   $estado = "Realizada";
   global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
   $consulta1 = "UPDATE tiendas SET passwordTienda='$newPassword' WHERE idTienda='$idUsuario'";
   $resultado1 = $conexion->query($consulta1);
   $consulta2 = "INSERT INTO cambiospassword (idUsuario, passwordAnterior, passwordNueva, ipUsuario, fechaCambio, tipoCambio, codigoRecuperacion) VALUES ('$idUsuario', '$currentPassword', '$newPassword', '$ipUsuario', '$fecha', '$tipoCambio', '$codigo')";
   $resultado2 = $conexion->query($consulta2);
   $consulta3 = "UPDATE recuperacionespassword SET estado='$estado' WHERE codigo='$codigo'";
   $resultado3 = $conexion->query($consulta3);
 }

function actualizarPassword($currentPassword, $newPassword, $emailTienda, $idTienda, $codigo){
  $ipUsuario = obtenerIpUsuario();
  $fechaCambio = obtenerFecha();
  $tipoCambio = 'Cambio';
  $estado = 'Realizado';
  global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
  $consulta = "UPDATE tiendas SET passwordTienda='$newPassword' WHERE emailTienda='$emailTienda' AND passwordTienda='$currentPassword'";
  $resultado = $conexion->query($consulta);
  if($conexion->affected_rows !== 0){
    $consulta2 = "INSERT INTO cambiospassword (idUsuario, passwordAnterior, passwordNueva, ipUsuario, fechaCambio, tipoCambio, codigoRecuperacion) VALUES ('$idTienda', '$currentPassword', '$newPassword', '$ipUsuario', '$fechaCambio', '$tipoCambio', '$codigo')";
    $resultado2 = $conexion->query($consulta2);
    $consulta3 = "UPDATE solicitudescambiospassword SET estado='$estado' WHERE codigo='$codigo'";
    $resultado3 = $conexion->query($consulta3);
    return 1;
  }
  else
  {
    return 0;
  }
}

function registrarSolicitudCambioPassword($codigo, $idTienda){
   $fecha = obtenerFecha();
   $ip = obtenerIpUsuario();
   $estado = 'Solicitud';
   global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
   $consulta = "INSERT INTO solicitudescambiospassword (idTienda, codigo, fecha, ip, estado) VALUES ('$idTienda', '$codigo', '$fecha', '$ip', '$estado')";
   $resultado = $conexion->query($consulta);
 }

 function obtenerMetodosDeEnvio($idTienda){
   global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
   $consulta = "SELECT nombreMetodo, estado FROM metodosdeenvio WHERE idTienda='$idTienda'";
   $resultado = $conexion->query($consulta);
   $nFilasResultado = $resultado->num_rows;
   if($nFilasResultado==0)
   {
     return 0;
   }
   else
   {
     while($metodoDeEnvio = $resultado->fetch_array(MYSQLI_ASSOC))
     {
       $metodosDeEnvio[] = $metodoDeEnvio;
     }
     return $metodosDeEnvio;
   }
 }

 function obtenerConfiguracionStarken($idTienda){
   global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
   $consulta = "SELECT origen, estado FROM metodosdeenvio WHERE idTienda='$idTienda' AND nombreMetodo='starken'";
   $resultado = $conexion->query($consulta);
   $nFilasResultado = $resultado->num_rows;
   if($nFilasResultado==0)
   {
     return 0;
   }
   else
   {
     $configuracionStarken = $resultado->fetch_array(MYSQLI_ASSOC);
     return $configuracionStarken;
   }
 }

 function obtenerConfiguracionRetiro($idTienda){
   global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
   $consulta = "SELECT estado, region, comuna, direccion, oficina, horario1, horario2 FROM metodosdeenvio WHERE idTienda='$idTienda' AND nombreMetodo='retiro'";
   $resultado = $conexion->query($consulta);
   $nFilasResultado = $resultado->num_rows;
   if($nFilasResultado==0)
   {
     return 0;
   }
   else
   {
     $configuracionRetiro = $resultado->fetch_array(MYSQLI_ASSOC);
     return $configuracionRetiro;
   }
 }

 function actualizarConfiguracionStarken($idTienda, $origen, $estado){
   global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
   $consulta = "SELECT origen FROM metodosdeenvio WHERE idTienda='$idTienda' AND nombreMetodo='starken'";
   $resultado = $conexion->query($consulta);
   $nFilasResultado = $resultado->num_rows;
   if($nFilasResultado==0)
   {
     $consulta2 = "INSERT INTO metodosdeenvio (idTienda, nombreMetodo, origen, estado) VALUES ('$idTienda', 'starken', '$origen', '$estado')";
   }
   else
   {
     $consulta2 = "UPDATE metodosdeenvio SET origen='$origen', estado='$estado' WHERE idTienda='$idTienda' AND nombreMetodo='starken'";
   }
   $resultado2 = $conexion->query($consulta2);
 }

 function actualizarConfiguracionRetiro($idTienda, $region, $estado, $comuna, $direccion, $oficina, $horario1, $horario2){
   global $conexion; $acentos = $conexion->query("SET NAMES 'utf8'");
   $consulta = "SELECT region FROM metodosdeenvio WHERE idTienda='$idTienda' AND nombreMetodo='retiro'";
   $resultado = $conexion->query($consulta);
   $nFilasResultado = $resultado->num_rows;
   if($nFilasResultado==0)
   {
     $consulta2 = "INSERT INTO metodosdeenvio (idTienda, nombreMetodo, estado, region, comuna, direccion, oficina, horario1, horario2) VALUES ('$idTienda', 'retiro', '$estado', '$region', '$comuna', '$direccion', '$oficina', '$horario1', '$horario2')";
   }
   else
   {
     $consulta2 = "UPDATE metodosdeenvio SET region='$region', estado='$estado', comuna='$comuna', direccion='$direccion', oficina='$oficina', horario1='$horario1', horario2='$horario2' WHERE idTienda='$idTienda' AND nombreMetodo='retiro'";
   }
   $resultado2 = $conexion->query($consulta2);
 }

 function urlSeo($input){
     $input = str_replace(array("'", "-"), "", $input); //remove single quote and dash
     $input = mb_convert_case($input, MB_CASE_LOWER, "UTF-8"); //convert to lowercase
     $input = preg_replace("#[^a-zA-Z0-9]+#", "-", $input); //replace everything non an with dashes
     $input = preg_replace("#(-){2,}#", "$1", $input); //replace multiple dashes with one
     $input = trim($input, "-"); //trim dashes from beginning and end of string if any
     return $input;
}

?>
