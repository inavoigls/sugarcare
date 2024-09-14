<?php 
require_once("session.php");
require_once "dbConnect.php";
require_once "../config/configuration.php";
function save(){
/*if(isset($_POST['glicemia']) && $_POST['glicemia']!="" && $_POST['fecha']!="" && $_POST['hora']!=""){
$mysqli = dbConnect::connection();
$grupo=$_SESSION['grupo'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$glicemia=$_POST['glicemia'];
$query = "INSERT INTO registro_glucosa (usuario,fecha,glucosa,hora) values ($grupo, '$fecha', $glicemia,'$hora');";
try {
    if(!$mysqli->connect_errno) {
        if($rs = $mysqli->query($query)){
            echo "Registro de glicemia realizado"; 
        }
	}
	$mysqli->close();
    } catch (Exception $ex) {
      echo "El registro glicemia no se ha podido realizar. Inténtalo de nuevo."; 
	    echo $ex->getMessage();
    }
}*/
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SugarCare | Edit User</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Preloader -->
  <?php require_once("components/preloader.php"); ?>
  <!-- /.Preloader -->

  <!-- Navbar -->
  <?php require_once("components/navbar.php"); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php require_once("components/main-sidebar.php"); ?>
  <!-- /.Main Sidebar Container -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Registro Glicemia</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="main.php">Home</a></li>
              <li class="breadcrumb-item active">Registro Glicemia</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Registro Glicemia</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Fecha</label>
                    <input type="text" class="form-control" name="fecha" placeholder="dd/mm/aaaa">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Hora</label>
                    <input type="text" class="form-control" name="hora" placeholder="00:00">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Glucosa</label>
                    <input type="text" class="form-control" name="glicemia" placeholder="mg/dl">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
              </form>
            </div>
            <?php save();?>     
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- Footer -->
  <?php require_once("components/footer.php"); ?>
  <!-- /.Footer -->

  <!-- Control Sidebar -->
  <?php require_once("components/control-sidebar.php"); ?>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/app.js"></script>
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>