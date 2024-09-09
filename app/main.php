<?php require_once("session.php");
require_once("../config/configuration.php");
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
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">

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
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="main.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
      <div class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-lg-6">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Datos del usuario:</h5>
              </div>
              <div class="card-body">
                <!--<h6 class="card-title">Titulo</h6>-->
                <p class="card-text">
                  <?php
                    echo "<b>Nombre: </b>".$_SESSION["nombre"];
                    echo "<br><b>Email: </b>".$_SESSION["email"];
                    echo "<br><b>Grupo: </b>".$_SESSION["grupo"];
                    if($_SESSION["idgrupo"]==2){
                      if($_SESSION["fecha_nacimiento"]!=""){echo "<br><b>Fecha Nacimiento: </b>".$_SESSION["fecha_nacimiento"];}
                      $date = date('d/m/Y');
                      $year = explode('/',$date);
                      $fnac=explode('/',$_SESSION["fecha_nacimiento"]);
                      if($_SESSION["fecha_nacimiento"]!=""){echo "<br><b>Edad: </b>".($year[2]-$fnac[2]);}
                      if($_SESSION["altura"]!=""){echo "<br><b>Altura: </b>".$_SESSION["altura"];}
                      if($_SESSION["complexion"]!=""){echo "<br><b>Complexión: </b>".$_SESSION["complexion"];}
                      if($_SESSION["foto"]!=""){echo "<br><b>Foto: </b>".$_SESSION["foto"];}
                    }
                  ?>
                </p>
                <!--<a href="#" class="btn btn-primary">Ir</a>-->
              </div>
            </div>
            <?php if($_SESSION["idgrupo"]==2){?>
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Personal médico asignado</h5>
              </div>
              <div class="card-body">
                <!--<h6 class="card-title">Titulo Contenedor 2</h6>-->
                <p class="card-text">
                  <?php
                  $mysqli = dbConnect::connection();
                  $query = "SELECT um.medico, (SELECT u2.nombre FROM usuarios u2 WHERE u2.id = um.medico) as nombre_medico
                              FROM usuarios u
                              LEFT JOIN usuarios_medicos um on um.usuario = u.id
                              WHERE u.id = ".$_SESSION['id'];           
                    try {
                        if(!$mysqli->connect_errno) {
                          if($rs = $mysqli->query($query)){
                            while($row = $rs->fetch_assoc()){
                              if($row["medico"]==""){echo "No hay médico asignado aún";} 
                              else {echo '<a href="send-message.php?usr='.$row["medico"].'">'.$row["nombre_medico"].'</a>';
                                if(!isset($_SESSION["medicalview"])) {
                                  echo ' | <a href="../api/unallocate.php?key='.base64_encode(configuration::hash.$row["medico"]."_".$_SESSION["id"]).'">Eliminar asignación</a>';
                                }
                              }
                            }
                          }
                        }
                        $mysqli->close();
                    } catch (Exception $ex) {
                      echo $ex->getMessage();
                    }
                  ?>
                </p>
                <!--<a href="#" class="btn btn-primary">Ir</a>-->

              </div>
            </div><?php } ?>
          </div>
          <!-- /.col-md-6 -->

          <!-- /.col-md-6 -->
          <?php if($_SESSION["idgrupo"]==2){?>
          <div class="col-lg-6">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Código QR</h5>
              </div>
              <div class="card-body">
                <!--<h6 class="card-title"></h6>-->
                <p class="card-text"><div id="codigoqr"></div></p>
                <!--<a href="#" class="btn btn-primary">Ir</a>-->
              </div>
            </div>

            <!--<div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Contenedor informativo 4</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title">Titulo Contenedor 4</h6>

                <p class="card-text">Texto contenedor infomativo 4</p>
                <a href="#" class="btn btn-primary">Ir</a>
              </div>
            </div>-->
          </div><?php } ?>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
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
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE -->
<script src="../dist/js/app.js"></script>
<!-- QrCode -->
<script src="../dist/js/qrcode.js"></script>
<!-- Page specific script -->
<!-- Dependencias -->

<?php echo '<script>var option="'.base64_encode(configuration::hash.$_SESSION["id"]).'";var url_api="'.configuration::url_api.'";</script>';?>
<script>
function generarCodigoQr() {
    let url = url_api+"assign.php?key="+option;
    console.log(url);
    let contenedorCodigoQr = document.getElementById("codigoqr");
    new QRCode(contenedorCodigoQr, url);
}
generarCodigoQr();
</script>
</body>
</html>
