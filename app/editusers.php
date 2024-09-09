<?php 
require_once("session.php");
require_once "../config/configuration.php";
require_once "dbConnect.php";
$mysqli = dbConnect::connection();
$query = "SELECT * FROM usuarios as u INNER JOIN grupos_usuarios as gu ON gu.id = u.grupo LEFT JOIN datos_usuario as du ON du.usuario = u.id WHERE u.nombre='".$_GET["user"]."';";
try {
    $mysqli = dbConnect::connection();
    if(!$mysqli->connect_errno) {
        if($rs = $mysqli->query($query)){
            $row = $rs->fetch_assoc();
        }
	  }
    $mysqli->close();
} catch (Exception $ex) {
  echo $ex->getMessage();
}
if(isset($_POST["nombre"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["fechanacimiento"]) && isset($_POST["altura"]) && isset($_POST["complexion"])) {
  try {
    $mysqli = dbConnect::connection();
    if(!$mysqli->connect_errno) {
      //Password
      if($_POST["password"]!=""){
        $query = "UPDATE usuarios SET password='".md5($_POST['password'])."' WHERE nombre='".$_GET["user"]."';";
        $mysqli->query($query);
      }
      
      //Email
      if($_POST["email"]!=""){
        $query = "UPDATE usuarios SET email='".$_POST["email"]."' WHERE nombre='".$_GET["user"]."';";
        $mysqli->query($query);
      }
      
      //Activo
      if($_SESSION["idgrupo"]=="1"){
        if($_POST["activo"]=="Y"){$activo = 1;} else {$activo = 0;}
        $query = "UPDATE usuarios SET activo=".$activo." WHERE nombre='".$_GET["user"]."';";
        $mysqli->query($query);
      }
      
      //Fecha nacimiento
      if($_POST["fechanacimiento"]!=""){
        $query = "UPDATE datos_usuario SET fechanacimiento='".$_POST["fechanacimiento"]."' WHERE usuario='".$row['usuario']."';";
        $mysqli->query($query);
      }
      
      //Altura
      if($_POST["altura"]!=""){
        $query = "UPDATE datos_usuario SET altura='".$_POST["altura"]."' WHERE usuario='".$row['usuario']."';";
        $mysqli->query($query);
      }
      
      //Complexión
      if($_POST["complexion"]!=""){
        $query = "UPDATE datos_usuario SET complexion='".$_POST["complexion"]."' WHERE usuario='".$row['usuario']."';";
        $mysqli->query($query);
      }
    }
    $mysqli->close();
    header("Location: editusers.php?user=".$row['nombre']);
  } catch (Exception $ex) {
    echo $ex->getMessage();
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SugarCare | Editar Usuario</title>

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
            <h1>Editar Usuario</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="main.php">Home</a></li>
              <li class="breadcrumb-item active">Editar Usuario</li>
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
                <h3 class="card-title"><?php echo $_GET["user"]?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php echo $row['nombre'];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $row['email'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Contraseña</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInput">Fecha nacimiento</label>
                    <input type="text" class="form-control" name="fechanacimiento"  placeholder="fechanacimiento" value="<?php echo $row['fechanacimiento'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInput">Altura</label>
                    <input type="text" class="form-control" name="altura" placeholder="altura" value="<?php echo $row['altura'];?>">
                  </div>
                  <div class="form-group" data-select2-id="29">
                    <label>Complexión</label>
                    <select class="form-control" style="width: 100%;" type="text" name="complexion">
                    <option data-select2-id="00" <?php if($row['complexion']==""){echo 'selected="selected"';}?>></option>
                      <option data-select2-id="01" <?php if($row['complexion']=="Pequeña"){echo 'selected="selected"';}?>>Pequeña</option>
                      <option data-select2-id="02" <?php if($row['complexion']=="Mediana"){echo 'selected="selected"';}?>>Mediana</option>
                      <option data-select2-id="03" <?php if($row['complexion']=="Grande"){echo 'selected="selected"';}?>>Grande</option>
                    </select>
                  </div>
                  <?php if($_SESSION["idgrupo"]=="1"){?>
                  <div class="form-group" data-select2-id="29">
                    <label>Activo</label>
                    <select class="form-control" style="width: 100%;" type="text" name="activo">
                      <option data-select2-id="01" <?php if($row['activo']=="1"){echo 'selected="selected"';}?>>Y</option>
                      <option data-select2-id="02" <?php if($row['activo']=="0"){echo 'selected="selected"';}?>>N</option>
                    </select>
                  </div><?php } ?>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Guardar</button><?php if($_SESSION["idgrupo"]==1) {?> <button type="submit" class="btn btn-primary">Eliminar</button><?php } ?>
                </div>
              </form>
            </div>          
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