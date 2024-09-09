<?php
require_once("session.php");
require_once "dbConnect.php";
require_once "../config/configuration.php";
function save(){
if(isset($_POST["fecha"]) && $_POST["fecha"]!="" && isset($_POST["hora"]) && $_POST["hora"]!="" && isset($_POST["actividad"]) && $_POST["actividad"]!="" && isset($_POST["observaciones"]) && isset($_POST["puntuacion"])){
  $mysqli = dbConnect::connection();
  $usuario = $_SESSION['id'];
  $fecha = $_POST["fecha"];
  $hora = $_POST["hora"];
  $tiempo = $_POST["tiempo"];
  $actividad = $_POST["actividad"];
  $observaciones = $_POST["observaciones"];
  $ruta = $_POST["ruta"];
  $puntuacion=$_POST["puntuacion"];
  if($ruta!=""){
    $query = 'INSERT INTO registro_actividad (usuario,fecha,hora,tiempo,actividad,observaciones,ruta,puntuacion) values ('.$usuario.',"'.$fecha.'","'.$hora.'","'.$tiempo.'","'.$actividad.'","'.$observaciones.'","'.$ruta.'",'.$puntuacion.');';
  } else {
    $query = 'INSERT INTO registro_actividad (usuario,fecha,hora,tiempo,actividad,observaciones,puntuacion) values ('.$usuario.',"'.$fecha.'","'.$hora.'","'.$tiempo.'","'.$actividad.'","'.$observaciones.'",'.$puntuacion.');';
  }
  try {
    if(!$mysqli->connect_errno) {
        if($rs = $mysqli->query($query)){
            echo "Registro de actividad realizado";
        }
	  }
	  $mysqli->close();
  } catch (Exception $ex) {
    echo "El registro de actividad no se ha podido realizar. Inténtalo de nuevo.";
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
  <title>SugarCare | Registro actividad</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Custom style -->
  <link rel="stylesheet" href="../dist/css/custom.css">
  <!-- Leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Preloader -->
  <?php require_once("components/preloader.php");?>
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
            <h1>Registro de actividad</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="main.php">Home</a></li>
              <li class="breadcrumb-item active">Registro de actividad</li>
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
                <h3 class="card-title">Registro de actividad - <?php echo $_SESSION["nombre"]?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body" id="formulario">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Fecha</label>
                    <input type="text" class="form-control" name="fecha" placeholder="dd/mm/aaaa">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Hora</label>
                    <input type="text" class="form-control" name="hora" placeholder="00:00">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputTime">Tiempo</label>
                    <input type="text" class="form-control" name="tiempo" placeholder="00:00">
                  </div>
                  <div class="form-group" data-select2-id="29">
                    <label>Actividad</label>
                    <select id="actividad" name="actividad" class="form-control" style="width: 100%;" type="text"  onchange="isRecordable()">
                      <option data-select2-id="" selected="selected"></option>  
                      <option data-select2-id="00">Caminar</option>
                      <option data-select2-id="01">Correr</option>
                      <option data-select2-id="02">Bicicleta</option>
                      <option data-select2-id="03">Nadar</option>
                      <option data-select2-id="04">Pádel</option>
                      <option data-select2-id="05">Ténis</option>
                      <option data-select2-id="06">Fútbol</option>
                      <option data-select2-id="07">Golf</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Observaciones</label>
                    <textarea class="form-control" rows="5" name="observaciones" placeholder="Describe como te sentiste durante la actividad realizada..."></textarea>
                    <textarea class="form-control" rows="5" id="ruta" name="ruta" hidden></textarea>
                  </div>
                  <div class="form-group" data-select2-id="29">
                    <label>Puntuación</label>
                    <select id="puntuacion" name="puntuacion" class="form-control" style="width: 100%;" type="text">
                      <option data-select2-id="" selected="selected"></option>  
                      <option data-select2-id="00">1</option>
                      <option data-select2-id="01">2</option>
                      <option data-select2-id="02">3</option>
                      <option data-select2-id="03">4</option>
                      <option data-select2-id="04">5</option>
                    </select>
                  </div>
                </div>
                <div class="card-body" id="map"></div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" id="guardar">Guardar</button>
                  <button type="button" onClick="iniciarRuta()" class="btn btn-primary" id="iniciar_ruta" hidden>Iniciar ruta</button>
                  <button type="button" onClick="terminarRuta()" class="btn btn-primary" id="terminar_ruta" hidden>Terminar ruta</button>
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
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/app.js"></script>
<!-- Page specific script -->

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="crossorigin=""></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<script>
var latlngs = [];
var recordroute=false;
document.getElementById("map").hidden = true;
function isRecordable(){
  option = document.getElementById("actividad").value;
  if((option=="Caminar" || option=="Correr" || option=="Bicicleta") && !recordroute){
    document.getElementById("iniciar_ruta").hidden = false;
  } else {
    document.getElementById("iniciar_ruta").hidden = true;
    document.getElementById("terminar_ruta").hidden = true;
  }
}
function iniciarRuta(){
  document.getElementById("formulario").hidden = true;
  document.getElementById("guardar").hidden = true;
  document.getElementById("iniciar_ruta").hidden = true;
  document.getElementById("terminar_ruta").hidden = false;
  document.getElementById("map").hidden = false;
  var prevLat = 0;
		var prevLng = 0;
		var polyline = L.polyline(latlngs, {color: 'red'});
		var layerGroup = new L.LayerGroup();
		var map_init = L.map('map', {
            center: [40.444458, -3.361092],
            zoom: 8
        });
		
        var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map_init);
        L.Control.geocoder().addTo(map_init);		
		    if (!navigator.geolocation) {
            console.log("Your browser doesn't support geolocation feature!")
        } else {
            setInterval(() => {
              navigator.geolocation.getCurrentPosition(getPosition)
				      draw();
            }, 5000);
        };
        var marker, circle, lat, long, accuracy;
				
        function getPosition(position) {
            lat = position.coords.latitude
            long = position.coords.longitude
            accuracy = position.coords.accuracy

            if (marker) {
                map_init.removeLayer(marker)
            }

            marker = L.marker([lat, long])
            var featureGroup = L.featureGroup([marker]).addTo(map_init)
            map_init.fitBounds(featureGroup.getBounds())
            //console.log("Lat: " + lat + " Long: " + long + " Accuracy: " + accuracy);
			
            //ubicación inicial
			if(prevLat==0 || prevLng==0){latlngs.push([lat, long]);prevLat=lat;prevLng=long;};
			if(lat!=prevLat || long!=prevLng){
				latlngs.push([lat, long]);
				prevLat=lat;
				prevLng=long;
			};
        }
		
		function draw(){
			map_init.removeLayer(layerGroup);
			layerGroup.addTo(map_init);
			polyline = L.polyline(latlngs, {color: 'red'});
			layerGroup.addLayer(polyline);
			console.log(latlngs);
		}
}
function terminarRuta(){
  document.getElementById("formulario").hidden = false;
  document.getElementById("guardar").hidden = false;
  document.getElementById("iniciar_ruta").hidden = true;
  document.getElementById("terminar_ruta").hidden = true;
  document.getElementById("map").hidden = true;
  if(latlngs.length > 10){document.getElementById("ruta").value=JSON.stringify(latlngs);}
  recordroute=true;
  //var ruta = document.getElementById("ruta");
  //ruta.innerHTML = latlngs;
  //var json_str = JSON.stringify(latlngs); 
  //console.log("Encode:"+json_str);
  // To decode (This produces an object)
  //var obj = JSON.parse(json_str);
  //console.log("Decode:"+obj);
}

</script>
</body>

</html>