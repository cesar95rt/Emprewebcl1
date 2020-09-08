<?php


session_start();

if(isset($_SESSION["empreweb"]))
{
  echo '<script>window.location.href = "https://clientes.empreweb.cl/index.php";</script>';
}else
{
if(isset($_POST["rut"]))
{
$nombres = $_POST["nombres"];
$apellidos = $_POST["apellidos"];
$rut = $_POST["rut"];
$email = $_POST["email"];
$password = $_POST["password"];
}else
{
  echo '<script>window.location.href = "https://clientes.empreweb.cl/login.php";</script>';
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

  <title>Cuenta de transferencias</title>

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
                <h1 class="h4 text-gray-900 mb-4">Cuenta de transferencias</h1>
                <h2 class="h6 text-gray mb-4">Por favor, ingresa los datos de transferencia de la cuenta bancaria a la que debemos enviar el dinero de tus cobros</h2>
              </div>
              <form class="user" action="registro-cobradorAction.php" method="POST">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <select style="padding:0.7rem; height: calc(2.9em + .75rem + 2px);" class="form-control form-control-user" name="banco" id="banco" required>
                      <option value="" disabled selected>Selecciona tu banco</option>
                      <option value="Santander">Banco Santander</option>
                      <option value="Scotiabank Azul">Scotiabank Azul</option>
                      <option value="Corriente">Banco Internacional</option>
                      <option value="Vista">Banco Itaú</option>
                      <option value="Corriente">Banco de Chile / Edwards-Citi</option>
                      <option value="Vista">Corpbanca</option>
                      <option value="Corriente">Banco Crédito e Inversiones</option>
                      <option value="Vista">Banco del Desarrollo</option>
                      <option value="Corriente">Banco Estado</option>
                      <option value="Vista">Banco Falabella</option>
                      <option value="Corriente">Banco Security</option>
                      <option value="Vista">Scotiabank</option>
                      <option value="Corriente">Rabobank</option>
                      <option value="Vista">HSBC Bank</option>
                      <option value="Corriente">Banco Ripley</option>
                      <option value="Vista">Banco Paris</option>
                      <option value="Corriente">Banco Consorcio</option>
                      <option value="Vista">Coopeuch</option>
                      <option value="Corriente">Prepago Los Heroes</option>
                      <option value="Vista">Tenpo Prepago S.A.</option>
                    </select>
                  </div>
                  <div class="col-sm-6">
                    <select style="padding:0.7rem; height: calc(2.9em + .75rem + 2px);" class="form-control form-control-user" name="tipoCuenta" id="tipoCuenta" required>
                      <option value="" disabled selected>Tipo de cuenta</option>
                      <option value="Corriente">Cuenta Corriente</option>
                      <option value="Vista">Cuenta Vista</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="nombre" id="nombre" placeholder="Nombre o razón social" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="nCuenta" id="nCuenta" placeholder="N° de cuenta" required>
                  </div>
                </div>
                <div class="form-group">
                  <input name="rutCuenta" id="rut" type="text" class="form-control form-control-user" placeholder="Ingrese un RUT" onkeypress="return isNumber(event)" oninput="checkRut(this)" required />
                </div>
                <input type="hidden" name="nombres" value="<?php echo $nombres; ?>">
                <input type="hidden" name="apellidos" value="<?php echo $apellidos; ?>">
                <input type="hidden" name="rut" value="<?php echo $rut; ?>">
                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <input type="hidden" name="password" value="<?php echo $password; ?>">
                <input type="submit" class="btn btn-primary btn-user btn-block" value="Finalizar registro">
                </input>
              </form>
              <hr>
              <div class="text-center">
                <a class="medium"><b>¿No quieres recibir pagos a través de Empreweb?</b></a>
              </div>
              <div class="text-center">
                <a class="medium" href="register.php"><b>Haz click aquí para volver</b></a>
              </div>
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
