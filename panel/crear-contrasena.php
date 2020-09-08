<?php

include('includes/dbConfig.php');
include('includes/funciones.php');

$hidden = "";
$codigo = "";
$respuestaAction = "";
$colorRespuesta = "";

if( isset($_GET["codCambio"]) )
{
  $codigo = $_GET["codCambio"];
  $resultadoVerificacion = verificarCodigo($codigo);
  $hidden = "hidden";
  if($resultadoVerificacion == 0)
  {
    $hidden = "";
    $respuestaVerificacion = 'Hubo un problema con el código de recuperación de contraseña, por favor, vuelve a intentarlo';
    echo '<form action="recuperar-contrasena.php" method="POST" class="form-inline" role="form" id="return-form">
      <input type="hidden" name="respuestaVerificacion" value="' . $respuestaVerificacion . '">
    </form>
    <script>document.getElementById("return-form").submit();</script>';
  }
}else
{
  if(isset($_POST["respuestaAction"]))
  {
  $codigo = "";
  $hidden = "";
  $respuestaAction = $_POST["respuestaAction"];
  $colorRespuesta = "text-danger";
  }
  else
  {
    $codigo = "";
    $hidden = "";
    $respuestaAction = "";
    $colorRespuesta = "";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Crear una nueva contraseña</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Crea una nueva contraseña</h1>
                <h2 class="h6 text-gray mb-4">Por favor, ingresa el código de recuperación que fue enviado a tu correo electrónico, seguido de tu nueva contraseña</h2>
                <h2 class="h6 <?php echo $colorRespuesta; ?> mb-4"><?php echo $respuestaAction; ?></h2>
              </div>
              <form class="user" action="crear-contrasenaAction.php" method="POST">
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="codigo" <?php echo $hidden; ?> id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Código de recuperación" required value="<?php echo $codigo; ?>">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" name="password" id="exampleInputPassword" placeholder="Contraseña" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" name="confirmPassword" id="exampleRepeatPassword" placeholder="Confirme su contraseña" required>
                  </div>
                </div>
                <input type="submit" class="btn btn-primary btn-user btn-block" value="Crear contraseña">
                </input>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Password confirmation JavaScript-->
  <script src="js/register.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
