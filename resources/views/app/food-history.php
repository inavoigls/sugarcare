<?php 
require_once("session.php");
require_once "dbConnect.php";
require_once "../config/configuration.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SugarCare | Food history</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Custom style -->
  <link rel="stylesheet" href="../dist/css/custom.css">
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
            <h1>Histórico de Comidas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="main.php">Home</a></li>
              <li class="breadcrumb-item active">Histórico Glicemia</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Comida</th>
                    <th>Descripción</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $mysqli = dbConnect::connection();
                  //$query = "SELECT * FROM registro_glucosa rg INNER JOIN usuarios u on u.id = rg.usuario WHERE u.nombre = '".$_SESSION["nombre"]."';";
                  $query = "SELECT fecha, hora, CONVERT(foto USING utf8) as foto, descripcion  FROM alimentacion WHERE usuario = '".$_SESSION["id"]."';";
                  try { 
	                  if(!$mysqli->connect_errno) {
                      if($rs = $mysqli->query($query)){
                        while($row = $rs->fetch_assoc()){
                          echo "<tr><td><a href='#'>".$row["fecha"]."</a></td>";
                          echo "<td>".$row["hora"]."</td>";
                          echo '<td><a href="#"><img class="imghistory" src="data:image/jpg;base64, '.$row["foto"].'" ></a></td>';
                          echo "<td>".$row["descripcion"]."</td></tr>";
                        }
                      }
		                }
	                  $mysqli->close();
                  } catch (Exception $ex) {
	                  echo $ex->getMessage();
                  } 
                  ?>
                  </tbody>
                  <!--<tfoot>
                  <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Comida</th>
                    <th>Descripción</th>
                  </tr>
                  </tfoot>-->
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
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

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/app.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      /*"buttons": ["copy", "csv", "excel", "pdf", "print"/*, "colvis"]*/
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
</body>
</html>