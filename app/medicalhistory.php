<?php
require_once("session.php");
require_once "dbConnect.php";
require_once "../config/configuration.php";
if(isset($_POST['editar_historia']) && isset($_POST['editar_indicaciones']) && isset($_POST['editar_medicacion'])){
  $mysqli = dbConnect::connection();
  $usuario = $_SESSION['id'];
  $historia = $_POST['editar_historia'];
  $indicaciones = $_POST['editar_indicaciones'];
  $medicacion=$_POST['editar_medicacion'];
  $query = "UPDATE historial SET historia = '$historia', indicaciones = '$indicaciones', medicacion = '$medicacion' WHERE usuario = $usuario;";
  //echo "QUERY:".$query;
  try {
      if(!$mysqli->connect_errno) {
          if($rs = $mysqli->query($query)){
              echo "Registro de historial actualizado";
              unset($_POST['editar_historia'],$_POST['editar_indicaciones'],$_POST['editar_medicacion']);
          }
      }
      $mysqli->close();
  } catch (Exception $ex) {
    echo "El registro del historial no se ha podido actualizar. Inténtalo de nuevo."; 
    echo $ex->getMessage();
  }
}
//Load historial data
$query = "SELECT * FROM historial h INNER JOIN usuarios u on u.id = h.usuario WHERE u.nombre = '".$_SESSION["nombre"]."';";
try {
  $mysqli = dbConnect::connection();
  if(!$mysqli->connect_errno) {
    if($rs = $mysqli->query($query)){
      while($row = $rs->fetch_assoc()){
        if($row["historia"]){$historia = $row["historia"];}
        if($row["indicaciones"]){$indicaciones = $row["indicaciones"];}
        if($row["medicacion"]){$medicacion = $row["medicacion"];}
      }
    }
  }
  $mysqli->close();
} catch (Exception $ex) {
  echo $ex->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SugarCare | Dashboard</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
  <!-- Custom -->
  <link rel="stylesheet" href="../css/custom.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Historial Médico</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="main.php">Home</a></li>
              <li class="breadcrumb-item active">Historial Médico</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    <form method="post">
      <div class="container-fluid">
        
      <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Historial Médico</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title"></h6>
                <div class="form-group" id="editar_historia">
                  <textarea id="inputDescription"  name="editar_historia" class="form-control" rows="25"><?php echo $historia;?></textarea>
                </div>
                <div class="card-text" id="historia" name="historia">
                  <?php echo $historia;?>
                </div>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
          <!-- /.col-md-6 -->
          <div class="col-lg-6">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Indicaciones</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title"></h6>
                <div class="form-group" id="editar_indicaciones">
                  <textarea id="inputDescription" name="editar_indicaciones" class="form-control" rows="5"><?php echo $indicaciones;?></textarea>
                </div>
                <div class="card-text" id="indicaciones" name="indicaciones">
                  <?php echo $indicaciones;?>
                </div>
              </div>
            </div>
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Medicación</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title"></h6>
                <div class="form-group" id="editar_medicacion">
                  <textarea id="inputDescription" name="editar_medicacion" class="form-control" rows="5"><?php echo $medicacion;?></textarea>
                </div>
                <div class="card-text" id="medicacion" name="medicacion">
                  <?php echo $medicacion;?>
                </div>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
      </div>
      <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
      <div class="card-footer">
        <!-- <button class="btn btn-primary" oncli>Editar</button>-->
        <a href="#" onclick='editar()' id="btn_editar" class="btn btn-primary" oncli>Editar</a>
        <button type="submit" id="btn_guardar" class="btn btn-primary">Guardar</button>
        <button type="cancel" id="btn_cancelar" class="btn btn-primary">Cancelar</button>
      </div>
      </form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!-- Footer -->
  <?php require_once("components/footer.php"); ?>
  <!-- /.Footer -->

  <!-- Control Sidebar -->
  <?php require_once("components/control-sidebar.php"); ?>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- Dependencias -->
<?php //require_once("components/js-dependencies.php"); ?>
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE -->
<script src="../dist/js/adminlte.js"></script>
<!-- App JS -->
<script src="../dist/js/app.js"></script>
<!-- AdminLTE dashboard -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- Dependencias -->
<script>
//Set initial properties
document.getElementById("editar_historia").style.display = "none";
document.getElementById("editar_indicaciones").style.display = "none";
document.getElementById("editar_medicacion").style.display = "none";
document.getElementById("btn_guardar").style.display = "none";
document.getElementById("btn_cancelar").style.display = "none";

function editar(){
  document.getElementById("historia").style.display = "none";
  document.getElementById("editar_historia").style.display = "block";
  document.getElementById("indicaciones").style.display = "none";
  document.getElementById("editar_indicaciones").style.display = "block";
  document.getElementById("medicacion").style.display = "none";
  document.getElementById("editar_medicacion").style.display = "block";
  document.getElementById("btn_editar").style.display = "none";
  document.getElementById("btn_guardar").style.display = "inline-block";
  document.getElementById("btn_cancelar").style.display = "inline-block";
}
</script>
</body>
</html>