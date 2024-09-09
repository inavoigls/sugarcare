<?php
require_once "dbConnect.php";
require_once "../config/configuration.php";
$mysqli = dbConnect::connection();
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password2'])){
  if($_POST['name']!="" && $_POST['email']!="" && ($_POST['password'] == $_POST['password2'])){
    if($_POST['tipo']=="Usuario") {
      $tipo=2;
    } else {$tipo=3;}
    $query = "INSERT INTO usuarios (nombre,email,password,fechaalta,grupo) values ('".$_POST['name']."','".$_POST['email']."','".md5($_POST['password'])."','".date("d-m-Y")."',$tipo);";
    try { 
	    if(!$mysqli->connect_errno) {
        $rs = $mysqli->query($query);  
        if($mysqli->affected_rows==-1){echo "Error al intentar crear el usuario";}
        else {echo "Usuario creado";}
		  }		
	    $mysqli->close();
    } catch (Exception $ex) {
	    echo $ex->getMessage();
    } 
  } else {echo "Las contraseñas deben coincidir";}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SugarCare | Registrar usuario</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../index.php" class="h1"><b>Sugar</b>Care</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Registrar una nuevo usuario</p>

      <form id="registerForm" action="register.php" method="post">
        <div class="form-group input-group mb-3">
          <input type="text" class="form-control" name="name" placeholder="Nombre completo">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="form-group input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="form-group input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Contraseña">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="form-group input-group mb-3">
          <input type="password" class="form-control" name="password2" placeholder="Vuelve a escribir la contraseña">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="form-group" data-select2-id="29">
          <label>Tipo</label>
          <select class="form-control" style="width: 100%;" type="text" name="tipo">
            <option data-select2-id="01"></option>
            <option data-select2-id="01">Usuario</option>
            <option data-select2-id="02">Personal Médico</option>
          </select>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="form-group icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               Acepto los <a href="#">terminos y condiciones</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <a href="../index.php" class="text-center">Ya tengo un usuario</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
</body>
</html>

<script>
$(function () {
  /*$.validator.setDefaults({
    submitHandler: function () {
      alert( "Form successful submitted!" );
    }
  });*/
  $('#registerForm').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      name: {
        required: true,
      },
      password: {
        required: true,
        minlength: 4
      },
      password2: {
        required: true,
        minlength: 4
      },
      terms: {
        required: true
      },
    },
    messages: {
      email: {
        required: "Please enter a email address",
        email: "Please enter a valid email address"
      },
      name: {
        required: "Please provide a name",
        minlength: "Please enter a Full name"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      password2: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      terms: "Please accept our terms"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>