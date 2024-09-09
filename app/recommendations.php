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
    <!-- Custom style -->
    <link rel="stylesheet" href="../dist/css/custom.css">
  <!-- Leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

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
            <h1 class="m-0">Salud colaborativa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="main.php">Home</a></li>
              <li class="breadcrumb-item active">Recomendaciones</li>
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
            <?php 
                 $query = "SELECT r.id, r.titulo, r.recomendacion FROM recomendaciones r INNER JOIN usuarios u on u.id = r.usuario WHERE u.nombre = '".$_SESSION["nombre"]."';";
                 try {
                   $mysqli = dbConnect::connection();
                   if(!$mysqli->connect_errno) {
                     if($rs = $mysqli->query($query)){
                       while($row = $rs->fetch_assoc()){?>
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                            <h5 class="m-0"><?php echo "<b>".$row["titulo"]."</b>" ?></h5>
                          </div>
                          <div class="card-body">
                            <!--<h6 class="card-title"><b></b></h6>-->
                            <p class="card-text"><?php echo $row["recomendacion"]?></p>
                            <!--<a href="#" class="btn btn-primary">Leer más</a>-->
                          </div>
                        </div>
                        <?php
                       }
                     }
                   }
                   $mysqli->close();
                 } catch (Exception $ex) {
                   echo $ex->getMessage();
                 }
            ?>
          </div>
          <!-- /.col-md-6 -->

          

          <!-- /.col-md-6 -->
          <div class="col-lg-6">
          <?php
          $query = "SELECT CONVERT(ruta USING utf8) as latlng, actividad, puntuacion FROM registro_actividad WHERE ruta<>'' AND usuario=".$_SESSION["id"]." AND puntuacion>=4";
          //echo $query;
          try {
            $mysqli = dbConnect::connection();
            if(!$mysqli->connect_errno) {
              if($rs = $mysqli->query($query)){
                while($row = $rs->fetch_assoc()){?>
          
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Actividad propuesta: <?php echo $row["actividad"]." ";for($i=0;$i<$row["puntuacion"];$i++){echo '<img src="../dist/img/star.png" width="18" height="18">';}?></h5>
              </div>
              <div class="card-body">
                <h6 class="card-title"><b></b></h6>
              <p class="card-text"><?php echo '<script>var latlngs="'.$row["latlng"].'";</script>'?></p>
                <div class="card-body" id="map"></div>
                <!--<a href="#" class="btn btn-primary">Ir</a>-->
              </div>
            </div>  
          
          <?php
                       }
                     }
                   }
                   $mysqli->close();
                 } catch (Exception $ex) {
                   echo $ex->getMessage();
                 }
            ?>
          </div>
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
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="crossorigin=""></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<script>
		var prevLat = 0;
		var prevLng = 0;
    latlngs = JSON.parse(latlngs);
		var polyline = L.polyline(latlngs, {color: 'red'});
		var layerGroup = new L.LayerGroup();
		var map_init = L.map('map', {
            center: [40.44440164793993,-3.36398328277781],
            zoom: 15
        });
		
        var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map_init);
        L.Control.geocoder().addTo(map_init);		
		if (!navigator.geolocation) {
            console.log("Your browser doesn't support geolocation feature!")
        }
		draw();
		
		//Inicial
		lat = 40.44440164793993;
        long = -3.36398328277781;
        var marker, circle, lat, long, accuracy;
		marker = L.marker([lat, long])
		var featureGroup = L.featureGroup([marker]).addTo(map_init)
		
		//Final
		lat = 40.444309854899146;
        long = -3.3638227961328764;
        var marker, circle, lat, long, accuracy;
		marker = L.marker([lat, long])
		var featureGroup = L.featureGroup([marker]).addTo(map_init)
		
        function getPosition(position) {
            lat = position.coords.latitude
            long = position.coords.longitude
            accuracy = position.coords.accuracy

            if (marker) {
                map_init.removeLayer(marker)
            }


            marker = L.marker([lat, long],{draggable:'true'})
            var featureGroup = L.featureGroup([marker]).addTo(map_init)
            map_init.fitBounds(featureGroup.getBounds())
            console.log("Lat: " + lat + " Long: " + long + " Accuracy: " + accuracy);
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
			//console.log(latlngs);
		}
</script>
<!-- Dependencias -->

</body>
</html>
