<?php require_once("session.php");
require_once "dbConnect.php";
require_once "../config/configuration.php";

/* Glicemia */
$mysqli = dbConnect::connection();
$days = 90;
$query = "SELECT * FROM registro_glucosa rg INNER JOIN usuarios u on u.id = rg.usuario WHERE u.nombre = '".$_SESSION["nombre"]."' LIMIT ".$days;
$dataA = array();
$dataB = array();
$glicemia_promedio=0;
$cont=0;
try { 
	if(!$mysqli->connect_errno) {
    if($rs = $mysqli->query($query)){
      while($row = $rs->fetch_assoc()){
        array_push($dataA,$row["fecha"]);
        array_push($dataB,$row["glucosa"]);
        $glicemia_promedio=$glicemia_promedio+$row["glucosa"];
        $cont++;
      }
    }
	}
	$mysqli->close();
} catch (Exception $ex) {
  echo $ex->getMessage();
}

$glicemia_promedio=$glicemia_promedio/$cont;
//A1C(%) = (Glucosa promedio estimada (mg/dL) +46,7) / 28,7
$glicada = number_format(($glicemia_promedio + 46.7) / 28, 2);

/*Peso*/
$peso_actual=0;
$mysqli = dbConnect::connection();
$query = "SELECT * FROM registro_peso rp INNER JOIN usuarios u on u.id = rp.usuario WHERE u.nombre = '".$_SESSION["nombre"]."' LIMIT ".$days;
$dataC = array();
$dataD = array();
try { 
	if(!$mysqli->connect_errno) {
    if($rs = $mysqli->query($query)){
      while($row = $rs->fetch_assoc()){
        array_push($dataC,$row["fecha"]);
        array_push($dataD,$row["peso"]);
        $peso_actual=$row["peso"];
      }
    }
	}
	$mysqli->close();
} catch (Exception $ex) {
  echo $ex->getMessage();
}
$peso_objetivo = 80;
$glicemia_promedio_objetivo = 110;
$diff_glicemia_promedio_objetivo = (($glicemia_promedio-$glicemia_promedio_objetivo)/100);

/* Actividad*/
$mysqli = dbConnect::connection();
$query = "SELECT * FROM registro_actividad ra INNER JOIN usuarios u on u.id = ra.usuario WHERE u.nombre = '".$_SESSION["nombre"]."' LIMIT ".$days;
$dataE = array();
$dataF = array();

try { 
	if(!$mysqli->connect_errno) {
    if($rs = $mysqli->query($query)){
      while($row = $rs->fetch_assoc()){
        array_push($dataE,$row["tiempo"]);
        array_push($dataF,$row["actividad"]);
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
  <title>SugarCare | Advance Analysis</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Custom -->
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
            <h1>Análisis Avanzado</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="main.php">Home</a></li>
              <li class="breadcrumb-item active">Análisis Avanzado</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- Line chart 1-->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Histórico Glicemia - <?php echo $days?> Días
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div id="line-chart" style="height: 300px;"></div>
              </div>
              <!-- /.card-body-->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-12">
            <!-- Line chart 2-->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Histórico Peso - <?php echo $days?> Días
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div id="line-chart-2" style="height: 300px;"></div>
              </div>
              <!-- /.card-body-->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-12">
            <!-- Line chart 3-->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Histórico Actividad - <?php echo $days?> Días
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div id="line-chart-3" style="height: 300px;"></div>
              </div>
              <!-- /.card-body-->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>

        <!-- /.row -->
        <div class="row">
          <div class="col-md-6">
            <!-- Line chart -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Otros Datos - <?php echo $days?> Días
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <h3>Peso Actual</h3><?php echo "<div class='text-advance'><b>".($peso_actual)." Kg</b></div>";?>
                <h3>Nivel de glucosa en la sangre promedio estimada</h3><?php echo "<div class='text-advance'><b>".number_format($glicemia_promedio,2)." mg/dL</b></div>";?>
                <h3>Nivel de hemoglobina glicosilada (HbA1c)</h3><?php echo "<div class='text-advance'><b>".($glicada)." %</b></div>";?>
                <h3>Nivel de Riesgo</h3>
                <ul> 
                  <li><?php if($glicada<154){echo "<b>";}?>6 % 	126 mg/dL (7 mmol/L) Riesgo Bajo</li><?php echo "</b>";?>
                  <li><?php if($glicada>=154 && $glicada<183){echo "<b>";}?>7 % 	154 mg/dL (8,6 mmol/L) Riesgo moderado</li><?php echo "</b>";?>
                  <li><?php if($glicada>=183 && $glicada<212){echo "<b>";}?>8 % 	183 mg/dL (10,2 mmol/L) Riesgo Alto</li><?php echo "</b>";?>
                  <li><?php if($glicada>=212 && $glicada<240){echo "<b>";}?>9 % 	212 mg/dL (11,8 mmol/L) Riesgo Alto</li><?php echo "</b>";?>
                  <li><?php if($glicada>=240 && $glicada<269){echo "<b>";}?>10 % 	240 mg/dL (13,4 mmol/L) Riego aumentado</li><?php echo "</b>";?>
                  <li><?php if($glicada>=269 && $glicada<298){echo "<b>";}?>11 % 	269 mg/dL (14,9 mmol/L) Riego aumentado</li><?php echo "</b>";?>
                  <li><?php if($glicada>=298){echo "<b>";}?>12 % 	298 mg/dL (16,5 mmol/L) Riesgo Crítico</li>
                </ul>
              </div>
              <!-- /.card-body-->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-6">
            <!-- Line chart -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Objetivo
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <h3>Peso Ideal</h3><?php echo "<div class='text-advance'><b>".($peso_objetivo)." Kg</b></div>";?>
                <h3>Nivel de glucosa en sangre promedio</h3><?php echo "<div class='text-advance'><b>".($glicemia_promedio_objetivo)." mg/dL </b></div>";
                echo "<div>(".number_format($diff_glicemia_promedio_objetivo,2)." % de diferencia respecto a ".number_format($glicemia_promedio,2)." actual estimado)</div>";
                ?>
              </div>
              <!-- /.card-body-->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

        </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->
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

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- FLOT CHARTS -->
<script src="../plugins/flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="../plugins/flot/plugins/jquery.flot.resize.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="../plugins/flot/plugins/jquery.flot.pie.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/app.js"></script>
<!-- Page specific script -->
<script>
<?php
$js_arrayA = json_encode($dataA);
$js_arrayB = json_encode($dataB);
echo "var dataA = ".$js_arrayA.";";
echo "var dataB = ".$js_arrayB.";";

$js_arrayC = json_encode($dataC);
$js_arrayD = json_encode($dataD);
echo "var dataC = ".$js_arrayC.";";
echo "var dataD = ".$js_arrayD.";";

$js_arrayE = json_encode($dataE);
$js_arrayF = json_encode($dataF);
echo "var dataE = ".$js_arrayE.";";
echo "var dataF = ".$js_arrayF.";";
?>
  //console.log(dataA);
  //console.log(dataB);
  //console.log(dataC);
  //console.log(dataD);
  //console.log(dataE);
  //console.log(dataF);
  $(function () {
    /*
     * LINE CHART 1
     * ----------
     */
    var A = [],
        B = []

    for (var i = 0; i < dataB.length; i++) {
      A.push([i, dataB[i]])
    }
    var line_data1 = {
      data : A,
      color: '#3c8dbc'
    }
    $.plot('#line-chart', [line_data1], {
      grid  : {
        hoverable  : true,
        borderColor: '#f3f3f3',
        borderWidth: 1,
        tickColor  : '#f3f3f3'
      },
      series: {
        shadowSize: 0,
        lines     : {
          show: true
        },
        points    : {
          show: true
        }
      },
      lines : {
        fill : false,
        color: ['#3c8dbc', '#f56954']
      },
      yaxis : {
        show: true
      },
      xaxis : {
        show: true
      }
    })
    //Initialize tooltip on hover
    $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
      position: 'absolute',
      display : 'none',
      opacity : 0.8
    }).appendTo('body')
    $('#line-chart').bind('plothover', function (event, pos, item) {

      if (item) {
        var x = item.datapoint[0],
            y = item.datapoint[1].toFixed(2)
        $('#line-chart-tooltip').html(dataA[x]+ ' | ' + y + " mg/dL")
          .css({
            top : item.pageY + 5,
            left: item.pageX + 5
          })
          .fadeIn(200)
      } else {
        $('#line-chart-tooltip').hide()
      }

    })
    /* END LINE CHART */
  })

  
  $(function () {
    /*
     * LINE CHART 2
     * ----------
     */
    var C = [],
        D = []

    for (var i = 0; i < dataD.length; i++) {
      C.push([i, dataD[i]])
    }
    var line_data2 = {
      data : C,
      color: '#3c8dbc'
    }
    $.plot('#line-chart-2', [line_data2], {
      grid  : {
        hoverable  : true,
        borderColor: '#f3f3f3',
        borderWidth: 1,
        tickColor  : '#f3f3f3'
      },
      series: {
        shadowSize: 0,
        lines     : {
          show: true
        },
        points    : {
          show: true
        }
      },
      lines : {
        fill : false,
        color: ['#3c8dbc', '#f56954']
      },
      yaxis : {
        show: true
      },
      xaxis : {
        show: false
      }
    })
    //Initialize tooltip on hover
    $('<div class="tooltip-inner" id="line-chart-tooltip-2"></div>').css({
      position: 'absolute',
      display : 'none',
      opacity : 0.8
    }).appendTo('body')
    $('#line-chart-2').bind('plothover', function (event, pos, item) {

      if (item) {
        var x = item.datapoint[0],
            y = item.datapoint[1].toFixed(2)
        $('#line-chart-tooltip-2').html(dataC[x]+ ' | ' + y + " kg")
          .css({
            top : item.pageY + 5,
            left: item.pageX + 5
          })
          .fadeIn(200)
      } else {
        $('#line-chart-tooltip-2').hide()
      }

    })
    /* END LINE CHART */
  })

  $(function () {
    /*
     * LINE CHART 3
     * ----------
     */
    var E = [],
        F = []

    for (var i = 0; i < dataE.length; i++) {
      var time = dataE[i].split(':');
      var Totaltime=0;
      if(time[0]>0) {Totaltime = parseFloat(time[0])*3600;}
      if(time[1]>0){Totaltime += parseFloat(time[1])*60;}
      if(time[2]>0){Totaltime += time[2];}
      Totaltime = (Totaltime/3600).toFixed(2);
      //console.log("Time"+i+": "+(Totaltime));
      E.push([i, Totaltime])
    }
    var line_data3 = {
      data : E,
      color: '#3c8dbc'
    }
    $.plot('#line-chart-3', [line_data3], {
      grid  : {
        hoverable  : true,
        borderColor: '#f3f3f3',
        borderWidth: 1,
        tickColor  : '#f3f3f3'
      },
      series: {
        shadowSize: 0,
        lines     : {
          show: true
        },
        points    : {
          show: true
        }
      },
      lines : {
        fill : false,
        color: ['#3c8dbc', '#f56954']
      },
      yaxis : {
        show: true
      },
      xaxis : {
        show: false
      }
    })
    //Initialize tooltip on hover
    $('<div class="tooltip-inner" id="line-chart-tooltip-3"></div>').css({
      position: 'absolute',
      display : 'none',
      opacity : 0.8
    }).appendTo('body')
    $('#line-chart-3').bind('plothover', function (event, pos, item) {

      if (item) {
        var x = item.datapoint[0],
            y = item.datapoint[1].toFixed(2)
        $('#line-chart-tooltip-3').html(dataF[x]+ ' | ' + y + "h")
          .css({
            top : item.pageY + 5,
            left: item.pageX + 5
          })
          .fadeIn(200)
      } else {
        $('#line-chart-tooltip-3').hide()
      }

    })
    /* END LINE CHART */
  })

  /*
   * Custom Label formatter
   * ----------------------
   */
  function labelFormatter(label, series) {
    return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
      + label
      + '<br>'
      + Math.round(series.percent) + '%</div>'
  }
</script>
</body>
</html>
