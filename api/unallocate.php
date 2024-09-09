<?php
require_once "../config/configuration.php";
require_once "../app/dbConnect.php";
function assign(){
if(isset($_POST["key"]) && $_POST["key"]!="" && $_POST["email"]!=""){
  $user=base64_decode($_POST["key"]);
  $user=explode('_',$user);
  $user = $user[1];
$encontrado=false;
$mysqli = dbConnect::connection();
$query = "SELECT * FROM usuarios as u INNER JOIN grupos_usuarios as gu on gu.id = u.grupo WHERE u.email='".$_POST["email"]."';";
try {
  if(!$mysqli->connect_errno) {
    if($rs = $mysqli->query($query)){
        $row = $rs->fetch_assoc();
        if($_POST["email"] == $row["email"]){
          $encontrado=true;
          $query2 = "SELECT Count(*) as count FROM usuarios_medicos WHERE usuario =".$user." AND medico =".$row["id"].";";
          if($rs2 = $mysqli->query($query2)){
            $row2 = $rs2->fetch_assoc();
            if($row2["count"]>=1){echo "Ya está asociado este médico al usuario";}
            else {
              $id_medico = $row["id"];
              $query = 'INSERT INTO usuarios_medicos (usuario,medico) values ('.$user.','.$id_medico.');';
              if($rs = $mysqli->query($query)){echo "Médico asociado al usuario correctamente";}
              echo "El Médico ya está asociado al usuario correctamente";
            }
          }
        } 
        
	  }
  }
  if(!$encontrado){echo 'El email <b>'.$_POST["email"].'</b> no está registrado';}
	$mysqli->close();
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
  <title>SugarCare | Asignación Médico</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-3">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Asignar Médico</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email">
                    <input type="text" class="form-control" name="key" value="<?php echo $_GET["key"]?>" hidden>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
              </form>
              
            </div>          
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
      <?php assign();?>
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
