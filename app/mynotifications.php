<?php 
require_once("session.php");
require_once("dbConnect.php");
require_once("../config/configuration.php");
$notificaciones=[];
$i=0;
$no_leidas=0;
$query = "SELECT n.id, n.orden, n.fecha, n.titulo, n.notificacion, n.leida FROM notificaciones n INNER JOIN usuarios u on u.id = n.usuario WHERE u.nombre = '".$_SESSION["nombre"]."' ORDER BY n.id ASC;";
try {
    $mysqli = dbConnect::connection();
    $cont=1;
    if(!$mysqli->connect_errno) {
        if($rs = $mysqli->query($query)){
            while($row = $rs->fetch_assoc()){
                $notificaciones[$i]["id"]=$row["id"];
                $notificaciones[$i]["fecha"]=$row["fecha"];
                $notificaciones[$i]["titulo"]=$row["titulo"];
                $notificaciones[$i]["notificacion"]=$row["notificacion"];
                $notificaciones[$i]["leida"]=$row["leida"];
                if($row["leida"]==0){$no_leidas++;}
                $i++;
            }
        }
    }
    $num_notificaciones=$i;
	$mysqli->close();
} catch (Exception $ex) {
	echo $ex->getMessage();
}
?>