<?php
require_once "config/configuration.php";
session_start();
if(isset($_SESSION["nombre"]) && $_SESSION["nombre"]!=""){
  header("Location: logout.php");
}
if(isset($_POST['email']) && isset($_POST['password'])){
  if($_POST['email']!="" && $_POST['password'] != ""){
    require_once "app/dbConnect.php";
    $mysqli = dbConnect::connection();
    $query = "SELECT nombre, email, activo, grupo FROM usuarios WHERE email='".$_POST['email']."' and password='".md5($_POST['password'])."' and activo = 1;";
    try { 
	    if(!$mysqli->connect_errno) {
      if($rs = $mysqli->query($query)){
        if($rs->num_rows!=1){echo "El usuario no existe o está bloqueado. Consulte con el administrador";}
        else {
          $row = $rs->fetch_assoc();
          $_SESSION["nombre"] = $row["nombre"];
          $_SESSION["grupo"] = $row["grupo"];
          header("Location: app/main.php");
        }
		  }
	    $mysqli->close();
      }
    } catch (Exception $ex) {
	    echo $ex->getMessage();
    } 
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SugarCare | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index.php" class="h1"><b>Sugar</b>Care</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Introduce tus datos para iniciar tu sesión</p>

      <form action="index.php" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Contraseña">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="remember" id="remember">
              <label for="remember">
                Recuérdame
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mb-1">
        <a href="app/forgot-password.php">Olvidé mi contraseña</a>
      </p>
      <p class="mb-0">
        <a href="app/register.php" class="text-center">Registrarse</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>